<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       rodriguesalex793@gmail.com
 * @since      1.0.0
 *
 * @package    Hcco
 * @subpackage Hcco/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin o, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Hcco
 * @subpackage Hcco/public
 * @author     Alex Rodrigues Moreira <rodriguesalex793@gmail.com>
 */
class Hcco_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Hcco_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hcco_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/hcco-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Hcco_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hcco_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'jquery-steps', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js', array( 'jquery' ), '1.1.0', false );
		wp_enqueue_script( 'jquery-validate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js', array( 'jquery' ), '1.19.1', false );
		wp_enqueue_script( 'jquery-mask', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js', array( 'jquery' ), '1.14.16', false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/hcco-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Função inicial do plugin
	 */
	public function hcco_content() {

		// inicia a sessão php
		session_start();

		// pega o nome da página e determina o nome do método a ser chamado
		$page_to_call = wp_parse_url( get_the_permalink() )['path'];
		$page_to_call = trim( $page_to_call, '/' );
		$page_to_call = 'display_' . str_replace( '-', '_', $page_to_call );		

		// execulta o método correspondente a página
		if ( method_exists( $this, $page_to_call ) )
			call_user_func( array( $this, $page_to_call ) );

	}

	/**
	 * Função que exibe o formulario de cadastro de curriculo
	 */
	private function display_cadastro_de_curriculo() {
		
		$curriculo = new Hcco_Curriculo();
		$error = false;

		// verifica se o formulario foi enviado
		if ( isset( $_POST['cadastrar_curriculo_nonce'] ) && wp_verify_nonce( $_POST['cadastrar_curriculo_nonce'], 'cadastrar_curriculo' ) ) {
			
			// inicia o curriculo
			$curriculo->read( $_POST );

			// verifica se os dados foram preenchidos
			if ( ! empty( $curriculo->get_no_filled_properties_list() ) ) {
				$error = true;
			}

			// se não ocorreu nehum erro
			if ( $error == false ) {

				// salva em um cookie uma key para identificar o 
				// pedido e o curriculo no banco de dados
				$user_id_hash = md5( $curriculo->get_nome() . current_time( 'd/m/yy h:m:s' ) );
				setcookie( 'user_id_hash', $user_id_hash, strtotime( '+30 days' ), '/' );

				// salva o curriculo no banco de dados
				$curriculo->save();

				// cria o pedido para realizar o checkout
				$pedido = new Hcco_Pedido();
				$pedido->set_curriculo_id( $curriculo->get_id() );
				$pedido->set_usuario_id( $user_id_hash );
				$pedido->set_preco( '10.00' );
				$pedido->set_status_pagamento( 'pendente' );
				$pedido->save();

				// redireciona para a pagina de finalização do cadastro do curriculo
				wp_redirect( home_url( '/finalizar-o-cadastro-do-curriculo' ) );
				exit;

			}

		}

		// get page header
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/hcco-header.php';
		// get page content
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/hcco-formulario-cadastro.php';
		// get page footer
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/hcco-footer.php';

	}

	/**
	 * Função que exibe a página para finaliza o cadastro do curriculo
	 */
	private function display_finalizar_o_cadastro_do_curriculo() {

		// verifica se existe o cookie
		if ( ! isset( $_COOKIE['user_id_hash'] ) ) {
			// redireciona para a pagina de cadastro de curriculo
			wp_redirect( home_url( '/cadastro-de-curriculo' ) );
			exit;
		}

		// busca o pedido
		$pedido = new Hcco_Pedido();
		$pedido->get_by_usuario_id( $_COOKIE['user_id_hash'] );

		// verifica se o pedido realmente existe
		if ( empty( $pedido->get_id() ) ) {
			// redireciona para a pagina de cadastro de curriculo
			wp_redirect( home_url( '/cadastro-de-curriculo' ) );
			exit;
		}

		// verifica se o pedido está 

		// get page header
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/hcco-header.php';
		// get page content
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/hcco-checkout.php';
		// get page footer
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/hcco-footer.php';

	}

}
