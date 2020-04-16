<?php

namespace Holos\Hcco\Payment;

use Holos\Hcco\Mapper\Hcco_Configuracoes_Mapper;

class Hcco_Mercado_Pago {

	//
	private $status;

	// 
	private $status_details;

	//
	private $error;

	//
	private $messages;

    public function process_credit_card_payment( $pedido, $curriculo, $payment_method_id, $token ) {

        \MercadoPago\SDK::setAccessToken( Hcco_Configuracoes_Mapper::get_mercado_pago_access_tokens()['private_token'] );
			
		$payment = new \MercadoPago\Payment();
		$payment->transaction_amount = $pedido->get_preco();
		$payment->token = $token;
		$payment->description = "CDC";
		// $payment->description = "HOLOS Cadastro de Curriculo";
		$payment->installments = 1;
        $payment->payment_method_id = $payment_method_id;
		// $payment->external_reference = $pedido->get_codigo_referencia();
		$payment->external_reference = md5('éissoaimeubroder');
		$payment->payer = array(
			"first_name" => 'Seu João',
			"address" => array( 
				"zip_code" => '29968000', 
				"street_name" => 'a',
				"street_number" => '2',
			),
			"email" => "test_user_80507629@testuser.com"
        );
		// $payment->payer = array(
		// 	"first_name" => $curriculo->get_nome(),
		// 	"address" => array( 
		// 		"zip_code" => $curriculo->get_cep(), 
		// 		"street_name" => $curriculo->get_endereco(),
		// 		"street_number" => $curriculo->get_numero(),
		// 	),
		// 	"phone" => array(
		// 		"area_code" => substr( str_replace( " ", "", $curriculo->get_telefone_1() ), 0, 2),
		// 		"number" => substr( str_replace( " ", "", $curriculo->get_telefone_1() ), 2)
		// 	),
		// 	"email" => $curriculo->get_email()
        // );
        // $payment->notification_url = '';

		$payment->save();

		$this->set_status( $payment->status );
		$this->set_status_details( $payment->status_details );
		$this->set_error( $payment->error );
		$this->set_messages( $payment->error );

	}
	
	/**
	 * 
	 */
	public function get_status() {
		
		return $this->status;

	}

	public function get_status_pt() {

		$status = array(
			'approved' 		=> 'aprovado',
			'in_mediation' 	=> 'em_mediacao',
			'in_process' 	=> 'em_processo',
			'pending' 		=> 'pendente',
			'authorized' 	=> 'autorizado',
			'refunded' 		=> 'devolvido',
			'charged_back' 	=> 'estornado',
			'cancelled' 	=> 'cancelado',
			'rejected' 		=> 'rejeitado'
		);

		return $status[$this->status];

	}

	private function set_status( $status ) {

		$this->status = $status ?? 'error';

	}

	public function get_status_details() {
		
		return $this->status_details;

	}

	private function set_status_details( $status ) {

		$this->status_details = $status ?? 'error';

	}

	public function has_error() {
		
		return $this->error;

	}

	private function set_error( $error ) {

		$this->error = ( $error == null || empty( $error ) ) ? false : true ;

	}

	public function get_messages() {
		
		return $this->messages;

	}

	private function set_messages( $errors ) {

		if ( $errors == null || empty( $errors ) )
			return false;

		$messages = [];

		foreach ( $errors->causes as $error ) {
			// $error->code
			// $error->description
			array_push( $messages, $error->description );
		}

		$this->messages = $messages;

	}

}