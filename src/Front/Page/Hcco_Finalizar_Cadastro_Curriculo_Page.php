<?php

namespace Holos\Hcco\Front\Page;

use Holos\Hcco\Front\Page\Hcco_Front_Page;
use Holos\Hcco\Entity\Hcco_Curriculo;
use Holos\Hcco\Entity\Hcco_Pedido;
use Holos\Hcco\Mapper\Hcco_Pedido_Mapper;
use Holos\Hcco\Payment\Hcco_Mercado_Pago;
use Holos\Hcco\Email\Hcco_Email_Notification;
use Holos\Hcco\Payment\Hcco_PicPay;

class Hcco_Finalizar_Cadastro_Curriculo_Page extends Hcco_Front_Page {

    /**
     * The home page.
     * 
     * @since   1.0.0
     * @access  public
     */
    public function home() : void {

        // control variables
        $error = false;
        $messages = [];
        $user_id_hash = $_REQUEST['uih'] ?? $_COOKIE['user_id_hash'];

        // check if the cookie exists
        if ( $user_id_hash == null || empty( $user_id_hash ) ) {
            wp_redirect( home_url( '/cadastro-de-curriculo' ) );
            exit;
        }

        // get pedido and curriculo
        [$pedido, $curriculo] = $this->get_pedido_e_curriculo( $user_id_hash );

        // check if the mercado pago payment form has been sent
        if ( isset( $_REQUEST['pagar_mercado_pago_api_nonce'] ) && wp_verify_nonce( $_REQUEST['pagar_mercado_pago_api_nonce'], 'pagar_mercado_pago_api' ) ) {

            $messages = $this->handle_mp_api_payment( $pedido, $curriculo );
            $error = true;

        }

        // check if the mercado pago payment form has been sent
        if ( isset( $_REQUEST['pagar_mercado_pago_tokenize_nonce'] ) && wp_verify_nonce( $_REQUEST['pagar_mercado_pago_tokenize_nonce'], 'pagar_mercado_pago_tokenize' ) ) {
            
            $messages = $this->handle_mp_tokenize_payment( $pedido, $curriculo );
            $error = true;

        }

        // check if the picpay payment form has been sent
        if ( isset( $_POST['pagar_picpay_nonce'] ) && wp_verify_nonce( $_POST['pagar_picpay_nonce'], 'pagar_picpay' ) ) {
            
            $messages = $this->handle_picpay_payment( $pedido, $curriculo );
            $error = true;

        }

        $this->display_finalizar_o_cadastro_do_curriculo( $pedido, $curriculo, $error, $messages );
        
    }

    /**
     * Method that handle mercado pago payment api form.
     * 
     * @since   1.0.0
     * @access  private
     * @param   Hcco_Pedido     $pedido Pedido entity.
     * @param   Hcco_Curriculo  $curriculo Curriculo entity.
     * @return  array           Error messages.
     */
    private function handle_mp_api_payment( Hcco_Pedido $pedido, Hcco_Curriculo $curriculo ) : array {

        // checks if the required data has been filled
        if ( ! isset( $_POST['paymentMethodId'] ) || ! isset( $_POST['token'] ) )
            return array( 'Formulário de pagamento inválido, tente novamente.' );
        
        // get the data
        $payment_method_id = sanitize_text_field( $_POST['paymentMethodId'] );
        $token = sanitize_text_field( $_POST['token'] );

        // processes payment
        $mp = new Hcco_Mercado_Pago();
        $mp->process_credit_card_api_payment( $pedido, $curriculo, $payment_method_id, $token );

        // if has an error
        if ( $mp->has_error() == true )
            return $mp->get_messages();

        // change the pedido payment status
        $status = Hcco_Mercado_Pago::get_status_pt( $mp->get_status() );
        $pedido->set_status_pagamento( $status );
        $pedido->set_payment_id( $mp->get_payment_id() );
        $pedido->set_atualizado_em( current_time( 'yy/m/d h:m:s' ) );
        Hcco_Pedido_Mapper::update( $pedido );
        
        // send an email notification message
        call_user_func_array( 
            array( 
                new Hcco_Email_Notification(),
                'send_' . $status
            ), 
            array( 
                $curriculo->get_email(),
                $curriculo->get_nome() 
            )
        );

        // redireciona para a página de informações
        wp_redirect( home_url( '/cadastro-do-curriculo-finalizado?ref_code=' . $pedido->get_codigo_referencia() ) );
        exit;

    }

    /**
     * Method that handle mercado pago payment tokenize form.
     * 
     * @since   1.0.0
     * @access  private
     * @param   Hcco_Pedido     $pedido Pedido entity.
     * @param   Hcco_Curriculo  $curriculo Curriculo entity.
     * @return  array           Error messages.
     */
    private function handle_mp_tokenize_payment( Hcco_Pedido $pedido, Hcco_Curriculo $curriculo ) : array {

        // checks if the required data has been filled
        if ( ! isset( $_REQUEST['payment_method_id'] ) || ! isset( $_REQUEST['token'] ) || ! isset( $_REQUEST['installments'] ) || ! isset( $_REQUEST['issuer_id'] ) )
            return array( 'Formulário de pagamento inválido, tente novamente.' );
        
        // get the data
        $payment_method_id = sanitize_text_field( $_REQUEST['payment_method_id'] );
        $token = sanitize_text_field( $_REQUEST['token'] );
        $installments = sanitize_text_field( $_REQUEST['installments'] );
        $issuer_id = sanitize_text_field( $_REQUEST['issuer_id'] );

        // processes payment
        $mp = new Hcco_Mercado_Pago();
        $mp->process_credit_card_tokenize_payment( $pedido, $curriculo, $payment_method_id, $token, $installments, $issuer_id );

        // if has an error
        if ( $mp->has_error() == true )
            return $mp->get_messages();

        // change the pedido payment status
        $status = Hcco_Mercado_Pago::get_status_pt( $mp->get_status() );
        $pedido->set_status_pagamento( $status );
        $pedido->set_payment_id( $mp->get_payment_id() );
        $pedido->set_atualizado_em( current_time( 'yy/m/d h:m:s' ) );
        Hcco_Pedido_Mapper::update( $pedido );
        
        // send an email notification message
        call_user_func_array( 
            array( 
                new Hcco_Email_Notification(),
                'send_' . $status
            ), 
            array( 
                $curriculo->get_email(),
                $curriculo->get_nome() 
            )
        );

        // redireciona para a página de informações
        wp_redirect( home_url( '/cadastro-do-curriculo-finalizado?ref_code=' . $pedido->get_codigo_referencia() ) );
        exit;

    }

    /**
     * Method that handle picpay payment form.
     * 
     * @since   1.0.0
     * @access  private
     * @param   Hcco_Pedido     $pedido Pedido entity.
     * @param   Hcco_Curriculo  $curriculo Curriculo entity.
     * @return  array           Error messages.
     */
    private function handle_picpay_payment( Hcco_Pedido $pedido, Hcco_Curriculo $curriculo ) : array {

        // get the data
        $cpf = sanitize_text_field( $_POST['picPayCpf'] ?? '' );

        // checks if the cpf field has been filled
        if ( empty( $cpf ) )
            return array( 'Você deve informar o seu CPF.' );
        
        // refresh the pedido reference code
        $pedido->gerar_codigo_referencia();
        $pedido = Hcco_Pedido_Mapper::update( $pedido );

        // proccess the payment
        $picpay = new Hcco_PicPay();
        $picpay->process_payment( $pedido, $curriculo, $cpf );

        if ( $picpay->has_error() )
            return array( $picpay->get_error_message() );
        
        // redirect to the picpay payment url
        wp_redirect( $picpay->get_payment_url() );
        exit;

    }

    /**
     * Method that display the finalizar cadastro do curriculo page.
     * 
     * @since   1.0.0
     * @access  private
     * @param   Hcco_Pedido     $pedido Pedido entity.
     * @param   Hcco_Curriculo  $curriculo Curriculo entity.
     * @param   bool|false      $error Error status.
     * @param   array|null      $messages Error messages.
     */
    private function display_finalizar_o_cadastro_do_curriculo( Hcco_Pedido $pedido, Hcco_Curriculo $curriculo, $error = false, $messages = null ) : void {

        $this->display_header();
        require_once HCCO_PATH . 'resources/public/templates/hcco-checkout.php';
        $this->display_footer();

    }

}