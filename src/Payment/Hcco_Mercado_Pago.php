<?php

namespace Holos\Hcco\Payment;

use Holos\Hcco\Mapper\Hcco_Configuracoes_Mapper;
use Holos\Hcco\Entity\Hcco_Curriculo;
use Holos\Hcco\Entity\Hcco_Pedido;

class Hcco_Mercado_Pago {

	/**
	 * Propertie that stores the mercado pago access token.
	 * 
	 * @since 	1.0.0
	 * @access 	private
	 */
	private $access_token;

	/**
	 * Propertie that stores the payment status.
	 * 
	 * @since 	1.0.0
	 * @access 	private
	 */
	private $status;

	/**
	 * Propertie that stores the payment status message details.
	 * 
	 * @since 	1.0.0
	 * @access 	private
	 */
	private $status_details;

	/**
	 * Propertie that stores the payment error status.
	 * 
	 * @since 	1.0.0
	 * @access 	private
	 */
	private $error;

	/**
	 * Propertie that stores the payment error messages.
	 * 
	 * @since 	1.0.0
	 * @access 	private
	 */
	private $messages;

	/**
	 * Contructor method.
	 * 
	 * @since 	1.0.0
	 * @access	public
	 */
	public function __construct() {

		$this->access_token = Hcco_Configuracoes_Mapper::get_mercado_pago_access_tokens()['private_token'];

	}

	/**
	 * Method that process a credit card payment.
	 * 
	 * @since 	1.0.0
	 * @access 	public
	 * @param	Hcco_Pedido		$pedido Pedido entity.
	 * @param	Hcco_Curriculo	$curriculo Curriculo entity.
	 * @param	int 			$payment_method_id The payment method id.
	 * @param 	string			$token Generated token.
	 */
    public function process_credit_card_payment( Hcco_Pedido $pedido, Hcco_Curriculo $curriculo, $payment_method_id, $token ) : void {

        \MercadoPago\SDK::setAccessToken( $this->access_token );
			
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
	 * Method that return the payment status.
	 * 
	 * @since 	1.0.0
	 * @access 	public
	 * @return	string|null	Payment status.
	 */
	public function get_status() {
		
		return $this->status;

	}

	/**
	 * Method that return the payment status in portugues.
	 * 
	 * @since 	1.0.0
	 * @access 	public
	 * @return	string|null	Payment status.
	 */
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

	/**
	 * Method that set the payment status.
	 * 
	 * @since 	1.0.0
	 * @access 	public
	 * @param	string	$status Payment status.
	 */
	private function set_status( $status ) : void {

		$this->status = $status ?? 'error';

	}

	/**
	 * Method that return the payment status message details.
	 * 
	 * @since 	1.0.0
	 * @access 	public
	 * @return	string|null	Payment status details.
	 */
	public function get_status_details() : string {
		
		return $this->status_details;

	}

	/**
	 * Method that set the payment status message details.
	 * 
	 * @since 	1.0.0
	 * @access 	public
	 * @param	string	$status Payment status message details.
	 */
	private function set_status_details( $status ) : void {

		$this->status_details = $status ?? 'error';

	}

	/**
	 * Method that return the payment erro status.
	 * 
	 * @since 	1.0.0
	 * @access 	public
	 * @return	bool|null	Payment status.
	 */
	public function has_error() : bool {
		
		return $this->error;

	}

	/**
	 * Method that set the payment erro status.
	 * 
	 * @since 	1.0.0
	 * @access 	private
	 * @param	string	$error Payment status.
	 */
	private function set_error( $error ) : void {

		$this->error = ( $error == null || empty( $error ) ) ? false : true ;

	}

	/**
	 * Method that return the payment erro messages.
	 * 
	 * @since 	1.0.0
	 * @access 	public
	 * @return	array|null	Error messages.
	 */
	public function get_messages() : array {
		
		return $this->messages;

	}

	/**
	 * Method that set the payment erro messages.
	 * 
	 * @since 	1.0.0
	 * @access 	private
	 * @param	array	$errors Payment errors.
	 */
	private function set_messages( $errors ) : void {

		$messages = [];

		foreach ( $errors->causes as $error ) {
			// $error->code
			// $error->description
			array_push( $messages, $error->description );
		}

		$this->messages = $messages;

	}

}