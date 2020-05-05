<?php

namespace Holos\Hcco\Payment;

use Holos\Hcco\Mapper\Hcco_Configuracoes_Mapper;
use Holos\Hcco\Entity\Hcco_Curriculo;
use Holos\Hcco\Entity\Hcco_Pedido;

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

        echo "<pre>x-picpay-token: {$this->x_picpay_token} x-seller-token: {$this->x_seller_token}</pre>";

        // format the customer phone number
        $phoneArray = explode( ' ', $curriculo->get_telefone_1() );
        $telefone   = "+55 {$phoneArray[0]} ";
        $telefone   .= "telefone: {$phoneArray[1]}-{$phoneArray[2]}";

        echo "<pre>telefone: {$telefone}</pre>";
        
        // format the customer name
        $nameArray  = explode( ' ', $curriculo->get_nome() );
        $first_name = $nameArray[0];
        $last_name  = '';
        for ( $count = 1; $count <= count( $nameArray ); $count++ )
            $last_name .= $nameArray[$count] . ' ';
        
        echo "<pre>nome: {$first_name} {$last_name}</pre>";

        // callback url
        $callbackUrl = get_home_url() . '/wp-json/hcco/v1/picpay-notifications';
        
        echo "<pre>callbackUrl: {$callbackUrl}</pre>";

        // return url
        $returnUrl = home_url( '/cadastro-do-curriculo-finalizado?ref_code=' . $pedido->get_codigo_referencia() );

        echo "<pre>returnUrl: {$returnUrl}</pre>";
		// $item->title 		= "Cadastro de Curríclo";
		// $item->unit_price 	= $pedido->get_preco();
		// $payer->first_name 		= $curriculo->get_nome();
		// $payer->email 			= $curriculo->get_email();

    }

}