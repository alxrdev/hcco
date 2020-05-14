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
     * @var 	string		The mercado pago private access token.
     */
    private $access_token;

    /**
     * Propertie that stores the payment id.
     * 
     * @since 	1.0.0
     * @access 	private
     * @var 	string		The payment id.
     */
    private $payment_id;

    /**
     * Propertie that stores the payment status.
     * 
     * @since 	1.0.0
     * @access 	private
     * @var 	string		The payment status.
     */
    private $status;

    /**
     * Propertie that stores the payment status message details.
     * 
     * @since 	1.0.0
     * @access 	private
     * @var 	string		The payment status details.
     */
    private $status_details;

    /**
     * Propertie that stores the payment error status.
     * 
     * @since 	1.0.0
     * @access 	private
     * @var		bool		The payment error status.
     */
    private $error;

    /**
     * Propertie that stores the payment error messages.
     * 
     * @since 	1.0.0
     * @access 	private
     * @var 	bool 		The payment error messages.
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
     * Method that process a credit card api payment.
     * 
     * @since 	1.0.0
     * @access 	public
     * @param	Hcco_Pedido		$pedido Pedido entity.
     * @param	Hcco_Curriculo	$curriculo Curriculo entity.
     * @param	int 			$payment_method_id The payment method id.
     * @param 	string			$token Generated token.
     */
    public function process_credit_card_api_payment( Hcco_Pedido $pedido, Hcco_Curriculo $curriculo, $payment_method_id, $token ) : void {

        \MercadoPago\SDK::setAccessToken( $this->access_token );
        
        // Payment
        $payment = new \MercadoPago\Payment();
        $payment->transaction_amount 	= $pedido->get_preco();
        $payment->token 				= $token;
        $payment->description 			= "HOLOS Cadastro de Curriculo";
        $payment->installments 			= 1;
        $payment->payment_method_id 	= $payment_method_id;
        $payment->external_reference 	= $pedido->get_codigo_referencia();
        $payment->notification_url 		= get_home_url() . '/wp-json/hcco/v1/mp-notifications';

        // format the customer name
        $nameArray  = explode( ' ', $curriculo->get_nome() );
        $first_name = $nameArray[0];
        $last_name  = '';
        for ( $count = 1; $count <= count( $nameArray ); $count++ )
            $last_name .= $nameArray[$count] . ' ';
            
        // Payer
        $payer = new \MercadoPago\Payer();
        $payer->first_name 		= $first_name;
        $payer->last_name 		= $last_name;
        $payer->email 			= $curriculo->get_email();
        $payer->address 		= array( 
            "zip_code" 			=> $curriculo->get_cep(),
            "street_name" 		=> $curriculo->get_endereco(),
            "street_number" 	=> $curriculo->get_numero(),
        );

        $payment->payer = $payer;
        $payment->save();

        $this->set_payment_id( $payment->id );
        $this->set_status( $payment->status );
        $this->set_status_details( $payment->status_detail );
        $this->set_error( $payment->status );
        $this->set_messages( $payment->error );

    }

    /**
     * Method that process a credit card tokenize payment.
     * 
     * @since 	1.0.0
     * @access 	public
     * @param	Hcco_Pedido		$pedido Pedido entity.
     * @param	Hcco_Curriculo	$curriculo Curriculo entity.
     * @param	int 			$payment_method_id The payment method id.
     * @param	string 			$installments The installments.
     * @param	string 			$issuer_id The credit card issuer id.
     * @param 	string			$token Generated token.
     */
    public function process_credit_card_tokenize_payment( Hcco_Pedido $pedido, Hcco_Curriculo $curriculo, $payment_method_id, $token, $installments, $issuer_id ) : void {

        \MercadoPago\SDK::setAccessToken( $this->access_token );
        
        // Payment
        $payment = new \MercadoPago\Payment();
        $payment->transaction_amount 	= $pedido->get_preco();
        $payment->token 				= $token;
        $payment->description 			= "HOLOS Cadastro de Curriculo";
        $payment->installments 			= $installments;
        $payment->payment_method_id 	= $payment_method_id;
        $payment->issuer_id 	        = $issuer_id;
        $payment->external_reference 	= $pedido->get_codigo_referencia();
        $payment->notification_url 		= get_home_url() . '/wp-json/hcco/v1/mp-notifications';

        // format the customer name
        $nameArray  = explode( ' ', $curriculo->get_nome() );
        $first_name = $nameArray[0];
        $last_name  = '';
        for ( $count = 1; $count <= count( $nameArray ); $count++ )
            $last_name .= $nameArray[$count] . ' ';
            
        // Payer
        $payer = new \MercadoPago\Payer();
        $payer->first_name 		= $first_name;
        $payer->last_name 		= $last_name;
        $payer->email 			= $curriculo->get_email();
        $payer->address 		= array( 
            "zip_code" 			=> $curriculo->get_cep(),
            "street_name" 		=> $curriculo->get_endereco(),
            "street_number" 	=> $curriculo->get_numero(),
        );

        $payment->payer = $payer;
        $payment->save();
        
        $this->set_payment_id( $payment->id );
        $this->set_status( $payment->status );
        $this->set_status_details( $payment->status_detail );
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

        $this->status_details = ($status != null) ? $status : 'error';

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
            '4050' => 'Você deve informar um email válido, tente novamente.',
            'cc_rejected_bad_filled_card_number'    => 'Revise o número do cartão.',
            'cc_rejected_bad_filled_date'           => 'Revise a data de vencimento.',
            'cc_rejected_bad_filled_other'          => 'Revise os dados.',
            'cc_rejected_bad_filled_security_code'  => 'Revise o código de segurança do cartão.',
            'cc_rejected_blacklist'                 => 'Não pudemos processar seu pagamento.',
            'cc_rejected_call_for_authorize'        => 'Você deve autorizar a su operadora o pagamento do valor ao Mercado Pago.',
            'cc_rejected_card_error'                => 'Não conseguimos processar seu pagamento.',
            'cc_rejected_duplicated_payment'        => 'Você já efetuou um pagamento com esse valor. Caso precise pagar novamente, utilize outro cartão ou outra forma de pagamento.',
            'cc_rejected_high_risk'                 => 'Seu pagamento foi recusado pelo Mercado Pago por risco de fraude. Escolha outra forma de pagamento.',
            'cc_rejected_insufficient_amount'       => 'Seu cartão não possui saldo suficiente',
            'cc_rejected_invalid_installments'      => 'Seu cartão não processa pagamentos em parcelas.',
            'cc_rejected_max_attempts'              => 'Você atingiu o limite de tentativas permitido. Escolha outro cartão ou outra forma de pagamento.',
            'cc_rejected_other_reason'              => 'Não foi possível processar o pagamento.'
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
            array_push( $messages, $this->get_message_pt( $this->get_status_details() ) );
        }

        $this->messages = $messages;

    }

}