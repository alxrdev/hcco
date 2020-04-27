<?php

namespace Holos\Hcco\Front\Page;

use Holos\Hcco\Front\Page\Hcco_Front_Page;
use Holos\Hcco\Entity\Hcco_Curriculo;
use Holos\Hcco\Entity\Hcco_Pedido;
use Holos\Hcco\Mapper\Hcco_Configuracoes_Mapper;
use Holos\Hcco\Mapper\Hcco_Curriculo_Mapper;
use Holos\Hcco\Mapper\Hcco_Pedido_Mapper;

class Hcco_Cadastro_Curriculo_Page extends Hcco_Front_Page {

    /**
     * The home page.
     * 
     * @since   1.0.0
     * @access  public
     */
    public function home() : void {

        $curriculo = new Hcco_Curriculo();
		$pedido = null;
		$error = false;

		// checks if the cookie exists, and then search the pedido and the curriculo
		if ( isset( $_COOKIE['user_id_hash'] ) ) {
			[$pedido, $curriculo] = $this->get_pedido_e_curriculo( $_COOKIE['user_id_hash'] );
		}

		// checks if the form is sended
		if ( isset( $_POST['cadastrar_curriculo_nonce'] ) && wp_verify_nonce( $_POST['cadastrar_curriculo_nonce'], 'cadastrar_curriculo' ) ) {
			
			$curriculo = $this->handle_form( $pedido );
			$error = true;

		}

		$this->display_cadastro_curriculo( $curriculo, $error );

    }

    /**
	 * Method that handle the form.
     * 
     * @since   1.0.0
     * @access  private
     * @param   Hcco_Pedido|null    $pedido Pedido entity
     * @return  Hcco_Pedido         Pedido entity
	 */
	private function handle_form( Hcco_Pedido $pedido = null ) : Hcco_Curriculo {
			
		// build a curriculo from form
		$curriculo = new Hcco_Curriculo( $_POST );

		// checks if the data has been filled
		if ( ! empty( $curriculo->get_no_filled_properties_list() ) )
			return $curriculo;

		// if is creating a new curriculo
		if ( $pedido == null ) {

            // stores a hash key in a cookie to identify the pedido and the curriculo in database
			$user_id_hash = md5( $curriculo->get_nome() . current_time( 'd/m/yy h:m:s' ) );
			setcookie( 'user_id_hash', $user_id_hash, strtotime( '+30 days' ), '/' );

			// stores curriculo in database
			$curriculo = Hcco_Curriculo_Mapper::create( $curriculo );

			// create the pedido
			$pedido = new Hcco_Pedido();
			$pedido->set_curriculo_id( $curriculo->get_id() );
			$pedido->set_usuario_id( $user_id_hash );
			$pedido->set_preco( Hcco_Configuracoes_Mapper::get_preco() );
			$pedido->set_status_pagamento( 'pendente' );
			$pedido->gerar_codigo_referencia();

			// stores pedido in database
			$pedido = Hcco_Pedido_Mapper::create( $pedido );

			// redirect to finalize page
			wp_redirect( home_url( '/finalizar-o-cadastro-do-curriculo' ) );
			exit;

		}

		// if is updating an curriculo
		if ( $pedido != null ) {

			$curriculo->set_id( $pedido->get_curriculo_id() );
			$curriculo = Hcco_Curriculo_Mapper::update( $curriculo );

			// redirect to finalize page
			wp_redirect( home_url( '/finalizar-o-cadastro-do-curriculo' ) );
			exit;

		}

		return $curriculo;

    }
    
    /**
	 * Method that display the cadastro de curriculo page.
     * 
     * @since   1.0.0
     * @access  private
     * @param   Hcco_Curriculo  $curriculo  Curriculo entity.
     * @param   bool|false      $error      Erro status.
	 */
	private function display_cadastro_curriculo( Hcco_Curriculo $curriculo, $error = false ) {

		$this->display_header();
		require_once HCCO_PATH . 'resources/public/templates/hcco-formulario-cadastro.php';
		$this->display_footer();

	}

}