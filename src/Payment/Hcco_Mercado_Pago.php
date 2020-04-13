<?php

namespace Holos\Hcco\Payment;

use Holos\Hcco\Mapper\Hcco_Configuracoes_Mapper;

class Hcco_Mercado_Pago {

    public function process_credit_card_payment( $pedido, $curriculo, $payment_method_id, $token ) {

        \MercadoPago\SDK::setAccessToken( Hcco_Configuracoes_Mapper::get_mercado_pago_access_tokens()[1] );
			
		$payment = new \MercadoPago\Payment();
		$payment->transaction_amount = $pedido->get_price();
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
				"area_code" => substr( str_replace( " ", "", $curriculo->get_telefone_1() ), 0, 2),
				"number" => substr( str_replace( " ", "", $curriculo->get_telefone_1() ), 2)
			),
			"email" => "larue.nienow@hotmail.com"
        );
        // $payment->notification_url = '';

		$payment->save();
        var_dump($payment);
        
        return array( 'status' => $payment->status );

    }

}