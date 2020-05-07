<?php

namespace Holos\Hcco\Payment;

use Holos\Hcco\Mapper\Hcco_Configuracoes_Mapper;
use Holos\Hcco\Entity\Hcco_Curriculo;
use Holos\Hcco\Entity\Hcco_Pedido;
use Picpay\Buyer;
use Picpay\Exception\RequestException;
use Picpay\Payment;
use Picpay\Request\PaymentRequest;
use Picpay\Seller;

class Hcco_PicPay {

    /**
     * Propertie that stores the picpay token.
     * 
     * @since 	1.0.0
     * @access 	private
     * @var 	string		The picpay token.
     */
    private $x_picpay_token;
    
    /**
     * Propertie that stores the picpay seller token.
     * 
     * @since 	1.0.0
     * @access 	private
     * @var 	string		The picpay seller token.
     */
    private $x_seller_token;

    /**
     * Propertie that stores the payment error status.
     * 
     * @since 	1.0.0
     * @access 	private
     * @var 	bool		The error status.
     */
    private $error = false;

    /**
     * Propertie that stores the payment error message.
     * 
     * @since 	1.0.0
     * @access 	private
     * @var 	bool 		The payment error message.
     */
    private $message;

    /**
     * Propertie that stores the payment url.
     * 
     * @since 	1.0.0
     * @access	private
     * @var 	string		The payment url.
     */
    private $payment_url;

    /**
     * Contructor method.
     * 
     * @since 	1.0.0
     * @access	public
     */
    public function __construct() {

        $tokens = Hcco_Configuracoes_Mapper::get_picpay_access_tokens();
        $this->x_picpay_token = $tokens['x_picpay_token'];
        $this->x_seller_token = $tokens['x_seller_token'];

    }

    /**
     * Method that process a payment.
     * 
     * @since 	1.0.0
     * @access 	public
     * @param	Hcco_Pedido		$pedido Pedido entity.
     * @param	Hcco_Curriculo	$curriculo Curriculo entity.
     * @param 	string			$cpf Customer doc number.
     */
    public function process_payment( Hcco_Pedido $pedido, Hcco_Curriculo $curriculo, string $cpf ) : void {

        // format the customer phone number
        $phoneArray = explode( ' ', $curriculo->get_telefone_1() );
        $phone   = "+55 {$phoneArray[0]} ";
        $phone   .= "telefone: {$phoneArray[1]}-{$phoneArray[2]}";
        
        // format the customer name
        $nameArray  = explode( ' ', $curriculo->get_nome() );
        $first_name = $nameArray[0];
        $last_name  = '';
        for ( $count = 1; $count <= count( $nameArray ); $count++ )
            $last_name .= $nameArray[$count] . ' ';

        // callback url
        $callbackUrl = get_home_url() . '/wp-json/hcco/v1/picpay-notifications';

        // return url
        $returnUrl = home_url( '/cadastro-do-curriculo-finalizado?ref_code=' . $pedido->get_codigo_referencia() );
        
        // store infos
        $seller = new Seller( $this->x_picpay_token, $this->x_seller_token );

        // buyer infos
        $buyer = new Buyer( $first_name, $last_name, $cpf, $curriculo->get_email(), $phone );

        // order infos
        $payment = new Payment( $pedido->get_codigo_referencia(), $callbackUrl, $pedido->get_preco(), $buyer, $returnUrl );

        try {
            $payment_request = new PaymentRequest( $seller, $payment );
            $payment_response = $payment_request->execute();

            $this->set_payment_url( $payment_response->paymentUrl );
        } catch ( RequestException $e ) {
            $this->failed();
            $this->set_error_message( $e->getCode(), $e->getErrors() );
        }

    }
    
    /**
     * Method that set true if an error is ocurred.
     * 
     * @since 	1.0.0
     * @access 	private
     */
    private function failed() : void {

        $this->error = true;

    }

    /**
     * Method that returns the payment error status.
     * 
     * @since 	1.0.0
     * @access 	public
     * @return 	bool	 The payment error status.
     */
    public function has_error() : bool {

        return $this->error;

    }

    /**
     * Method that set the error message.
     * 
     * @since 	1.0.0
     * @access 	private
     * @param	int			$status_code The payment status code.
     * @param	object		$message The object with all error messages.
     */
    private function set_error_message( $status_code, $message ) {

        if ( $status_code === 422 && $message[0]->field === 'buyer.document' ) {
            $this->message = 'Ops! Verifique o seu CPF e tente novamente.';
            return true;
        }

        $this->message = 'Ops! Tivemos um erro interno, tente novamente.';

    }

    /**
     * Method that returns the error message.
     * 
     * @since 	1.0.0
     * @access 	public
     * @return	string		The error message.
     */
    public function get_error_message() {

        return $this->message;

    }

    /**
     * Method that set the payment url.
     * 
     * @since 	1.0.0
     * @access 	private
     * @param	string		$payment_url The payment url.
     */
    private function set_payment_url( string $payment_url ) : void {

        $this->payment_url = $payment_url;

    }

    /**
     * Method that return the picpay payment url.
     * 
     * @since 	1.0.0
     * @access	public
     * @return	string		The picpay payment url.
     */
    public function get_payment_url() {

        return $this->payment_url;

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
            'paid' 			=> 'aprovado',
            'completed' 	=> 'aprovado',
            'expired' 		=> 'rejeitado',
            'analysis' 		=> 'em_processo',
            'created' 		=> 'pendente',
            'refunded' 		=> 'devolvido',
            'chargeback' 	=> 'estornado'
        );

        return $status_list[$status] ?? 'pendente';

    }

}