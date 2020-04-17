<?php

namespace Holos\Hcco\Front\Page;

use Holos\Hcco\Entity\Hcco_Pedido;
use Holos\Hcco\Mapper\Hcco_Curriculo_Mapper;
use Holos\Hcco\Mapper\Hcco_Pedido_Mapper;

class Hcco_Front_Page {

    /**
	 * Method that validate an pedido based in it's status.
	 * 
	 * @since 	1.0.0
	 * @access 	protected
	 * @param 	Hcco_Pedido 	$pedido Pedido
	 * @return 	bool 			True or false
	 */
	protected function validate_pedido( Hcco_Pedido $pedido ) : bool {

		if ( empty( $pedido->get_id() ) )
			return false;
		
		$status = array(
			'pendente',
			'rejeitado'
		);

		if ( array_search( $pedido->get_status_pagamento(), $status ) !== false )
			return true;
		
		return false;

	}

	/**
	 * Method that return an array with Hcco_Curriculo and Hcco_Pedido entities.
	 * 
	 * @since 	1.0.0
	 * @access 	protected
	 * @param 	string 		$user_id_hash Id of the user
	 * @return 	array 		Entities
	 */
	protected function get_pedido_e_curriculo( $user_id_hash ) : array {

		$pedido = Hcco_Pedido_Mapper::get_by_usuario_id( $user_id_hash );

		// if pedido's status is not valid to see this page,
		// reset the cookie and redirect to the same page.
		if ( ! $this->validate_pedido( $pedido ) ) {

			unset( $_COOKIE['user_id_hash'] );
			wp_redirect( home_url( '/cadastro-de-curriculo' ) );
			exit;

		}

		$curriculo = Hcco_Curriculo_Mapper::fetch( $pedido->get_curriculo_id() );

		return array( $pedido, $curriculo );

	}

	/**
	 * Method that display de page header
	 *
	 * @since 	1.0.0
	 * @access 	protected
	 */
	protected function display_header() : void {

		require_once HCCO_PATH . 'resources/public/templates/hcco-header.php';

	}

	/**
	 * Method that display the page footer
	 * 
	 * @since 	1.0.0
	 * @access 	protected
	 */
	protected function display_footer() : void {

		require_once HCCO_PATH . 'resources/public/templates/hcco-footer.php';

	}

}