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
	 * Propertie that stores the payment id.
	 * 
	 * @since 	1.0.0
	 * @access 	private
	 */
	private $payment_id;

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
		$payment->description = "HOLOS Cadastro de Curriculo";
		$payment->installments = 1;
        $payment->payment_method_id = $payment_method_id;
		$payment->external_reference = $pedido->get_codigo_referencia();
		$payment->payer = array(
			"first_name" => $curriculo->get_nome(),
			"address" => array( 
				"zip_code" => $curriculo->get_cep(),
				"street_name" => $curriculo->get_endereco(),
				"street_number" => $curriculo->get_numero(),
			),
			"phone" => array(
				"area_code" => '0' . substr( str_replace( " ", "", $curriculo->get_telefone_1() ), 0, 2),
				"number" => substr( str_replace( " ", "", $curriculo->get_telefone_1() ), 2)
			),
			"email" => "test_user_80507629@testuser.com"
        );
        $payment->notification_url = get_home_url() . '/wp-json/hcco/v1/mp-notifications';

		$payment->save();

		$this->set_payment_id( $payment->id );
		$this->set_status( $payment->status );
		$this->set_status_details( $payment->status_details );
		$this->set_error( $payment->status );
		$this->set_messages( $payment->error );

	}

	/**
	 * Method that return the payment id.
	 * 
	 * @since 	1.0.0
	 * @access 	public
	 * @return	string|null	Payment status details.
	 */
	public function get_payment_id() : string {
		
		return $this->payment_id;

	}

	/**
	 * Method that set the payment id.
	 * 
	 * @since 	1.0.0
	 * @access 	public
	 * @param	string	$payment_id Payment id.
	 */
	private function set_payment_id( $payment_id ) : void {

		$this->payment_id = $payment_id;

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
	 * @param	string		$status The status name.
	 * @return	string		Payment status.
	 */
	public static function get_status_pt( string $status ) : string {

		$status_list = array(
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

		return $status_list[$status] ?? 'pendente';

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
	public function has_error() {
		
		return $this->error;

	}

	/**
	 * Method that set the payment erro status.
	 * 
	 * @since 	1.0.0
	 * @access 	private
	 * @param	string|null	$status Payment status.
	 */
	private function set_error( $status ) : void {

		$error_status = array(
			'refunded',
			'charged_back',
			'cancelled',
			'rejected',
		);

		$this->error = ( $status == null || array_search( $status, $error_status ) !== false ) ? true : false;

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
	 * Method that return an portugues erro message based in the status code.
	 * 
	 * @since 	1.0.0
	 * @access 	private
	 * @param	string 		$code Payment erro code.
	 */
	private function get_message_pt( $code ) {

		$messages = array(
			'2001' => 'Este pagamento já foi solicitado.',
			'2002' => 'Formulario de pagamento inválido, tente novamente.',
			'2006' => 'Formulario de pagamento inválido, tente novamente.',
			'2009' => 'Formulario de pagamento inválido, tente novamente.',
			'3000' => 'Preencha todos os campos e tente novamente.',
			'3001' => 'Preencha todos os campos e tente novamente.',
			'3003' => 'Formulario de pagamento inválido, tente novamente.',
			'3011' => 'Formulario de pagamento inválido, tente novamente.',
			'3010' => 'Cartão de crédito inválido, tete usar outro cartão.',
			'3011' => 'Formulario de pagamento inválido, tente novamente.',
			'3012' => 'Código de segurança inválido, tente novamente.',
			'3013' => 'O Código de segurança é necessário, tente novamente.',
			'3014' => 'Formulario de pagamento inválido, tente novamente.',
			'3015' => 'O numero do cartão inválido, tente novamente.',
			'3016' => 'O numero do cartão inválido, tente novamente.',
			'3017' => 'O numero do cartão inválido, tente novamente.',
			'3018' => 'O mês de validade é inválido, tente novamente.',
			'3019' => 'O ano de validade é inválido, tente novamente.',
			'3020' => 'Informe o nome no cartão, tente novamente.',
			'3021' => 'Informe o numero do cartão, tente novamente.',
			'3022' => 'Informe o seu CPF, tente novamente.',
			'3023' => 'Informe o seu CPF, tente novamente.',
			'3027' => 'Formulario de pagamento inválido, tente novamente.',
			'3028' => 'Formulario de pagamento inválido, tente novamente.',
			'3029' => 'O mês de validade é inválido, tente novamente.',
			'3030' => 'O ano de validade é inválido, tente novamente.',
			'4001' => 'Formulario de pagamento inválido, tente novamente.',
			'4050' => 'Você deve informar um email válido, tente novamente.'
		);

		return $messages[$code] ?? 'Formulario de pagamento inválido, tente novamente.';

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

		if ( $errors != null || ! empty( $errors ) ) {
			foreach ( $errors->causes as $error ) {
				array_push( $messages, $this->get_message_pt( $error->code ) );
			}
		} 
		
		if ( $errors == null || empty( $errors ) ) {
			array_push( $messages, 'Ops! Verifique os dados do seu cartão, ou ligue para a sua operadora.' );
		}

		$this->messages = $messages;

	}

}