<?php

namespace Holos\Hcco\Payment;

use Holos\Hcco\Mapper\Hcco_Configuracoes_Mapper;
use Holos\Hcco\Entity\Hcco_Curriculo;
use Holos\Hcco\Entity\Hcco_Pedido;
use Holos\Hcco\Mapper\Hcco_Pedido_Mapper;

class Hcco_PagSeguro {

    /**
     * Propertie that stores the pagseguro token.
     * 
     * @since 	1.0.0
     * @access 	private
     * @var 	string		The pagseguro private token.
     */
    private $token;

    /**
     * Propertie that stores the pagseguro email.
     * 
     * @since 	1.0.0
     * @access 	private
     * @var 	string		The pagseguro email.
     */
    private $email;

    /**
     * Propertie that stores the pagseguro api address.
     * 
     * @since 	1.0.0
     * @access 	private
     * @var 	string		The pagseguro api address.
     */
    private $api_address;

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
    private $payment_status;

    /**
     * Propertie that stores the payment status message details.
     * 
     * @since 	1.0.0
     * @access 	private
     * @var 	string		The payment status details.
     */
    private $payment_status_details;

    /**
     * Propertie that stores the payment error status.
     * 
     * @since 	1.0.0
     * @access 	private
     * @var		bool		The payment error status.
     */
    private $has_payment_error;

    /**
     * Propertie that stores the payment error messages.
     * 
     * @since 	1.0.0
     * @access 	private
     * @var 	bool 		The payment error messages.
     */
    private $error_messages = [];

    /**
     * Contructor method.
     * 
     * @since 	1.0.0
     * @access	public
     */
    public function __construct() {

        $credentials = Hcco_Configuracoes_Mapper::get_pagseguro_credentials();
        $this->email = $credentials['email'];
        $this->token = $credentials['token'];
        $this->api_address = ( $credentials['ambiente'] == 'production' ) ? 'https://ws.pagseguro.uol.com.br/v2/' : 'https://ws.sandbox.pagseguro.uol.com.br/v2/';

    }

    /**
     * Method that process a credit card payment.
     * 
     * @since 	1.0.0
     * @access 	public
     * @param	Hcco_Pedido		$pedido Pedido entity.
     * @param	Hcco_Curriculo	$curriculo Curriculo entity.
     */
    public function process_credit_card_payment( Hcco_Pedido $pedido, Hcco_Curriculo $curriculo ) : void {

        //

    }

    /**
     * Method that receive an ajax request and create a pagseguro session.
     * 
     * @since   1.0.0
     * @access  public
     */
    public function create_pagseguro_session() {

        // get the parameters
        $nonce = $_POST['_wpnonce'] ?? '';
        $curriculo_id = $_POST['curriculoId'] ?? '';
        $pedido_id = $_POST['pedidoId'] ?? '';
        $cliente_email = $_POST['clienteEmail'] ?? '';

        // check infos
        if ( empty( $curriculo_id ) || empty( $pedido_id ) || empty( $cliente_email ) ) {
            wp_send_json_error( 'Bad Request' );
            wp_die();
        }

        // verify the nonce
        if ( ! wp_verify_nonce( $nonce, 'pagseguro_session' ) ) {
            wp_send_json_error( 'Bad Request' );
            wp_die();
        }

        $pedido = Hcco_Pedido_Mapper::get_by_curriculo_id($curriculo_id);

        if ( empty( $pedido->get_id() ) ) {
            wp_send_json_error( 'Bad Request' );
            wp_die();
        }

		$params = array(
            'email'                     => $this->email,
            'token'                     => $this->token,
            'senderEmail'               => 'c97139654663187660797@sandbox.pagseguro.com.br', // email de teste
            'currency'                  => 'BRL',
            'itemId1'                   => $pedido->get_id(),
            'itemDescription1'          => 'Cadastro de Currículo',
            'reference'                 => $pedido->get_codigo_referencia(),
            'itemAmount1'               => $pedido->get_preco(),
            'itemQuantity1'             => 1,
            'redirectURL'               => home_url( '/' ) . 'cadastro-do-curriculo-finalizado?ref_code=' . $pedido->get_codigo_referencia(),
            'notificationURL'           => home_url( '/' ) . 'wp-json/hcco/v1/pagseguro-notifications'
        );

        $header = array( 'Content-Type application/x-www-form-urlencoded; charset=ISO-8859-1' );
        $url = $this->api_address . 'checkout';

        $curl = curl_init( $url );
        curl_setopt( $curl, CURLOPT_POST, true );
        curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query( $params ) );
        curl_setopt( $curl, CURLOPT_HTTPHEADER, $header );
        curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );

        $xml = curl_exec( $curl );
        
        if( $xml == 'Unauthorized' ){
            wp_send_json_error( 'Bad Request' );
            wp_die();
        }

		curl_close($curl);

        wp_send_json_success( json_encode( simplexml_load_string( $xml ) ) );
        wp_die();

    }

    /**
     * Method that return the transaction details.
     * 
     * @since 	1.0.0
     * @access 	public
     * @param	string	 $transaction_code Transaction code.
     */
    public function get_transaction_details( string $transaction_code ) {

        $url = $this->api_address . 'transactions/' . $transaction_code . '/?email=' . $this->email . '&token=' . $this->token;

        $curl = curl_init( $url );
        curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );

        $xml = curl_exec( $curl );

        if( $xml == 'Unauthorized' ){
            wp_send_json_error( 'Bad Request' );
            wp_die();
        }

        curl_close($curl);

        return simplexml_load_string( $xml );

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
    public function get_payment_status() {
        
        return $this->payment_status;

    }

    /**
     * Method that set the payment status.
     * 
     * @since 	1.0.0
     * @access 	public
     * @param	string	$status Payment status.
     */
    private function set_payment_status( $status ) : void {

        $this->payment_status = $payment_status ?? 'error';

    }

    /**
     * Method that return the payment status message details.
     * 
     * @since 	1.0.0
     * @access 	public
     * @return	string|null	Payment status details.
     */
    public function get_payment_status_details() : string {
        
        return $this->payment_status_details;

    }

    /**
     * Method that set the payment status message details.
     * 
     * @since 	1.0.0
     * @access 	public
     * @param	string	$status Payment status message details.
     */
    private function set_payment_status_details( $status ) : void {

        $this->payment_status_details = ($status != null) ? $status : 'error';

    }

    /**
     * Method that return the payment erro status.
     * 
     * @since 	1.0.0
     * @access 	public
     * @return	bool|null	Payment status.
     */
    public function has_payment_error() {
        
        return $this->has_payment_error;

    }

    /**
     * Method that set the payment erro status.
     * 
     * @since 	1.0.0
     * @access 	private
     * @param	string|null	$status Payment status.
     */
    private function set_has_payment_error( $status ) : void {

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
    public function get_error_messages() {
        
        return $this->error_messages;

    }

    /**
     * Method that set the payment erro messages.
     * 
     * @since 	1.0.0
     * @access 	private
     * @param	array	$errors Payment errors.
     */
    private function set_error_messages( $errors ) : void {}

    /**
     * Method that return the payment status in portugues.
     * 
     * @since 	1.0.0
     * @access 	public
     * @param	string		$status The status name.
     * @return	string		Payment status.
     */
    public static function get_payment_status_pt( string $status ) : string {

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

}