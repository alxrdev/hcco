<?php

namespace Holos\Hcco\Front\Page;

use Holos\Hcco\Front\Page\Hcco_Front_Page;
use Holos\Hcco\Entity\Hcco_Curriculo;
use Holos\Hcco\Entity\Hcco_Pedido;
use Holos\Hcco\Mapper\Hcco_Curriculo_Mapper;
use Holos\Hcco\Mapper\Hcco_Pedido_Mapper;
use Holos\Hcco\Payment\Hcco_PagSeguro;
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
        $user_id_hash = $_COOKIE['user_id_hash'] ?? $_REQUEST['uih'];

        // check if the cookie exists
        if ( $user_id_hash == null || empty( $user_id_hash ) ) {
            wp_redirect( home_url( '/cadastro-de-curriculo' ) );
            exit;
        }

        // get pedido and curriculo
        [$pedido, $curriculo] = $this->get_pedido_e_curriculo( $user_id_hash );

        // check if the picpay payment form has been sent
        if ( isset( $_REQUEST['pagar_picpay_nonce'] ) && wp_verify_nonce( $_REQUEST['pagar_picpay_nonce'], 'pagar_picpay' ) ) {
            
            $messages = $this->handle_picpay_payment( $pedido, $curriculo );
            $error = true;

        }

        $this->display_finalizar_o_cadastro_do_curriculo( $pedido, $curriculo, $error, $messages );
        
    }

    /**
     * Method that receive an ajax request and create a pagseguro checkout code.
     * 
     * @since   1.0.0
     * @access  public
     */
    public function generate_pagseguro_checkout_code() {

        // get the parameters
        $checkout_nonce = $_POST['pagseguro_checkout_nonce'] ?? '';
        $pedido_id      = $_POST['pedidoId'] ?? '';

        // check infos
        if ( empty( $pedido_id ) ) {
            wp_send_json_error( 'Bad Request' );
            wp_die();
        }

        // verify the nonce
        if ( ! wp_verify_nonce( $checkout_nonce, 'pagseguro_checkout' ) ) {
            wp_send_json_error( 'Bad Request' );
            wp_die();
        }

        $pedido = Hcco_Pedido_Mapper::fetch( $pedido_id );

        if ( empty( $pedido->get_id() ) ) {
            wp_send_json_error( 'Bad Request' );
            wp_die();
        }

        $curriculo = Hcco_Curriculo_Mapper::fetch( $pedido->get_curriculo_id() );

		$params = array(
            'currency'                  => 'BRL',
            'itemId1'                   => $pedido->get_id(),
            'itemDescription1'          => 'Cadastro de Curriculo',
            'itemAmount1'               => $pedido->get_preco(),
            'itemQuantity1'             => 1,
            'itemWeight1'               => 0,
            'reference'                 => $pedido->get_codigo_referencia(),
            'senderEmail'               => $curriculo->get_email(),
            'senderName'                => $curriculo->get_nome(),
            'shippingType'              => 1,
            'shippingAddressStreet'     => $curriculo->get_endereco(),
            'shippingAddressNumber'     => $curriculo->get_numero(),
            'shippingAddressPostalCode' => str_replace( '-', '', $curriculo->get_cep() ),
            'shippingAddressCity'       => $curriculo->get_cidade(),
            'shippingAddressState'      => $curriculo->get_estado(),
            'shippingAddressCountry'    => 'BRA',
            'excludePaymentMethodGroup' => 'BOLETO,DEPOSIT',
            'redirectURL'               => home_url( '/' ) . 'cadastro-do-curriculo-finalizado',
            'notificationURL'           => home_url( '/' ) . 'wp-json/hcco/v1/pagseguro-notifications'
        );

        $pagseguro = new Hcco_PagSeguro();
        $code = $pagseguro->get_checkout_code( $params );
        
        if( $code == 'Unauthorized' ) {
            wp_send_json_error( 'Bad Request' );
            wp_die();
        }

        wp_send_json_success( $code );
        wp_die();

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
