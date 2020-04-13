<?php

namespace Holos\Hcco;

use Holos\Hcco\Entity\Hcco_Curriculo;
use Holos\Hcco\Entity\Hcco_Pedido;
use Holos\Hcco\Mapper\Hcco_Curriculo_Mapper;
use Holos\Hcco\Mapper\Hcco_Pedido_Mapper;
use Holos\Hcco\Payment\Hcco_Mercado_Pago;
use Holos\Hcco\Mapper\Hcco_Configuracoes_Mapper;

class Hcco_Front {

    //
    private $plugin_name;
    
    // 
    private $version;

    /**
     * 
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
	 * Register the stylesheets for the public-facing side of the site.
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, HCCO_URL . 'resources/public/css/hcco-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'jquery-steps', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js', array( 'jquery' ), '1.1.0', false );
		wp_enqueue_script( 'jquery-validate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js', array( 'jquery' ), '1.19.1', false );
		wp_enqueue_script( 'jquery-mask', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js', array( 'jquery' ), '1.14.16', false );
		wp_enqueue_script( $this->plugin_name, HCCO_URL . 'resources/public/js/hcco-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'hcco_ajax_object', array( 'mp_public_key' => Hcco_Configuracoes_Mapper::get_mercado_pago_access_tokens()[0] ) );

	}

	/**
	 * 
	 */
	public function hcco_content() {
		
		// pega o nome da página e determina o nome do método a ser chamado
		$method_to_call = wp_parse_url( get_the_permalink() )['path'];
		$method_to_call = trim( $method_to_call, '/' );
		$method_to_call = 'page_' . str_replace( '-', '_', $method_to_call );

		// execulta o método correspondente a página
		if ( method_exists( $this, $method_to_call ) )
			return call_user_func( array( $this, $method_to_call ) );

	}

	/**
	 * 
	 */
	private function page_cadastro_de_curriculo() {

		$curriculo = new Hcco_Curriculo();
		$pedido = null;
		$error = false;

		// verifica se existe o cookie, se existir
		// busca o pedido e o curriculo
		if ( isset( $_COOKIE['user_id_hash'] ) ) {
			[$pedido, $curriculo] = $this->get_pedido_e_curriculo();
		}

		// verifica se o formulario foi enviado
		if ( isset( $_POST['cadastrar_curriculo_nonce'] ) && wp_verify_nonce( $_POST['cadastrar_curriculo_nonce'], 'cadastrar_curriculo' ) ) {
			
			// trata o formulário, e se houver algum error
			$curriculo = $this->handle_cadastro_de_curriculo_form( $pedido );
			$error = true;

		}

		$this->display_cadastro_curriculo( $curriculo, $error );

	}

	/**
	 * 
	 */
	private function handle_cadastro_de_curriculo_form( Hcco_Pedido $pedido = null ) {
			
		// inicia o curriculo
		$curriculo = new Hcco_Curriculo( $_POST );

		// verifica se os dados foram preenchidos
		if ( ! empty( $curriculo->get_no_filled_properties_list() ) )
			return $curriculo;

		// se está criando um novo curriculo
		if ( $pedido == null ) {

			// salva em um cookie uma key para identificar o 
			// pedido e o curriculo no banco de dados
			$user_id_hash = md5( $curriculo->get_nome() . current_time( 'd/m/yy h:m:s' ) );
			setcookie( 'user_id_hash', $user_id_hash, strtotime( '+30 days' ), '/' );

			// salva o curriculo no banco de dados
			$curriculo = Hcco_Curriculo_Mapper::crerate( $curriculo );

			// cria o pedido para realizar o checkout
			$pedido = new Hcco_Pedido();
			$pedido->set_curriculo_id( $curriculo->get_id() );
			$pedido->set_usuario_id( $user_id_hash );
			$pedido->set_preco( '15.00' );
			$pedido->set_status_pagamento( 'pendente' );

			// salva o pedido
			$pedido = Hcco_Pedido_Mapper::create( $pedido );

			// redireciona para a pagina de finalização do cadastro do curriculo
			wp_redirect( home_url( '/finalizar-o-cadastro-do-curriculo' ) );
			exit;

		}

		// se está atualizando um curriculo
		if ( $pedido != null ) {

			$curriculo->set_id( $pedido->get_curriculo_id() );
			$curriculo = Hcco_Curriculo_Mapper::update( $curriculo );

			// redireciona para a pagina de finalização do cadastro do curriculo
			wp_redirect( home_url( '/finalizar-o-cadastro-do-curriculo' ) );
			exit;

		}

		return $curriculo;

	}

	/**
	 * 
	 */
	public function page_finalizar_o_cadastro_do_curriculo() {

		// variaveis de controle
		$error = false;
		$messages = [];

		// verifica se existe o cookie
		if ( ! isset( $_COOKIE['user_id_hash'] ) ) {
			// redireciona para a pagina de cadastro de curriculo
			wp_redirect( home_url( '/cadastro-de-curriculo' ) );
			exit;
		}

		// busca o pedido e o curriculo
		[$pedido, $curriculo] = $this->get_pedido_e_curriculo();

		// verifica se o formulario de pagamento via mercado pago foi enviado
		if ( isset( $_POST['pagar_mercado_pago_nonce'] ) && wp_verify_nonce( $_POST['pagar_mercado_pago_nonce'], 'pagar_mercado_pago' ) ) {
			
			$messages = $this->handle_pagamento_mp( $pedido, $curriculo );

		}

		$this->display_finalizar_o_cadastro_do_curriculo( $pedido, $curriculo, $error, $messages );

	}

	/**
	 * 
	 */
	private function handle_pagamento_mp( Hcco_Pedido $pedido, Hcco_Curriculo $curriculo ) {

		// verifica se os dados necessários foram enviados
		if ( ! isset( $_POST['paymentMethodId'] ) || ! isset( $_POST['token'] ) )
			return array( 'messages' => 'Formulário de pagamento inválido, tente novamente.' );
		
		// pega os dados
		$payment_method_id = sanitize_text_field( $_POST['paymentMethodId'] );
		$token = sanitize_text_field( $_POST['token'] );

		// processa o pagamento via mercado pago
		$mp = new Hcco_Mercado_Pago();
		$result = $mp->process_credit_card_payment( $pedido, $curriculo, $payment_method_id, $token );

		return array( 'messages' => array( 'message1', 'message2' ) );

	}

	/**
	 * 
	 */
	private function get_pedido_e_curriculo() {

		// busca o pedido
		$pedido = Hcco_Pedido_Mapper::get_by_usuario_id( $_COOKIE['user_id_hash'] );

		// se o status do pedido for diferente de pendente ou se o pedido 
		// não existir, exclui o cookie e redireciona para a mesma pagina
		if ( empty( $pedido->get_id() ) || ( $pedido->get_status_pagamento() != 'pendente' ) ) {

			setcookie( 'user_id_hash' );
			wp_redirect( home_url( '/cadastro-de-curriculo' ) );
			exit;

		}

		// busca o curriculo
		$curriculo = Hcco_Curriculo_Mapper::fetch( $pedido->get_curriculo_id() );

		return array( $pedido, $curriculo );

	}

	/**
	 * Method that display de page header
	 */
	private function display_header() {

		require_once HCCO_PATH . 'resources/public/templates/hcco-header.php';

	}

	/**
	 * Method that display the page footer
	 */
	private function display_footer() {

		require_once HCCO_PATH . 'resources/public/templates/hcco-footer.php';

	}

	/**
	 * Method that display the cadastro de curriculo page
	 */
	private function display_cadastro_curriculo( Hcco_Curriculo $curriculo, $error = false ) {

		$this->display_header();
		require_once HCCO_PATH . 'resources/public/templates/hcco-formulario-cadastro.php';
		$this->display_footer();

	}

	/**
	 * Method that display the finalizar cadastro do curriculo page
	 */
	private function display_finalizar_o_cadastro_do_curriculo( Hcco_Pedido $pedido, Hcco_Curriculo $curriculo, $error = false, $messages = null ) {

		$this->display_header();
		require_once HCCO_PATH . 'resources/public/templates/hcco-checkout.php';
		$this->display_footer();

	}
    
}