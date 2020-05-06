<?php

namespace Holos\Hcco\Api;

use Holos\Hcco\Email\Hcco_Email_Notification;
use Holos\Hcco\Mapper\Hcco_Pedido_Mapper;
use Holos\Hcco\Mapper\Hcco_Configuracoes_Mapper;
use Holos\Hcco\Payment\Hcco_Mercado_Pago;
use \WP_REST_Controller;
use \WP_REST_Response;

class Hcco_Mercado_Pago_Controller extends WP_REST_Controller {

    /**
	 * Propertie that stores the plugin name.
	 * 
	 * @since 	1.0.0
	 * @access 	private
	 */
    private $plugin_name;
    
    /**
	 * Propertie that stores the plugin version.
	 * 
	 * @since 	1.0.0
	 * @access 	private
	 */ 
    private $version;

    /**
	 * The class constructor.
	 * 
	 * @since 	1.0.0
	 * @access 	public
	 * @param 	string	$plugin_name The plugin name.
	 * @param	string 	$version The plugin version.
	 */
    public function __construct( string $plugin_name, string $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Method that register all controller routes.
     * 
     * @since   1.0.0
     * @access  public
     * @param   string  $plugin_name The plugin name.
     * @param   string  $version The plugin version.
     */
    public function register_routes() {

        // api namespace and resource
        $namespace  = $this->plugin_name . '/v' . $this->version;
        $resource   = 'mp-notifications';

        register_rest_route( $namespace, '/' . $resource, array(
            array(
                'methods'             => 'GET',
                'callback'            => array( $this, 'get' ),
                'permission_callback' => array( $this, 'get_permissions_check' )
            ),
            array(
                'methods'             => 'POST',
                'callback'            => array( $this, 'post' ),
                'permission_callback' => array( $this, 'post_permissions_check' )
            )
        ) );

    }

    /**
     * 
     */
    public function get( $request ) {

        return new WP_REST_Response( array( 'message' => 'Hello World Api Wordpress!' ), 200 );

    }

    /**
     * 
     */
    public function get_permissions_check( $request ) {

        return true;

    }

    /**
     * Handle the post request.
     * 
     * @since   1.0.0
     * @access  private
     * @param   object      $request Wordpress Rest Request.
     * @return  object      Wordpres Rest Response.
     */
    public function post( $request ) {

        \MercadoPago\SDK::setAccessToken( Hcco_Configuracoes_Mapper::get_mercado_pago_access_tokens()['private_token'] );

        // get mercado pago sended data
        $type = $request->get_param( 'type' );
        $payment_id = $request->get_param( 'data' )['id'];

        // checks if the notification is not payment.updated
        if ( $type != 'payment' )
            return new WP_REST_Response( array( __( 'Ok', 'hcco' ) ), 200 );

        // get the pedido
        $pedido = Hcco_Pedido_Mapper::get_by_payment_id( $payment_id );

        // check if the pedido exists
        if ( empty( $pedido->get_id() ) )
            return new WP_REST_Response( array( 'message' => __( 'Ops! Pedido não encontrado.', 'hcco' ) ), 400 );
        
        // get transaction status from mercado pago api
        $payment = \MercadoPago\Payment::find_by_id( $payment_id );

        // check if the payment exists
        if ( $payment == null )
            return new WP_REST_Response( array( 'message' => __( 'Ops! Pagamento não encontrado.', 'hcco' ) ), 400 );
        
        // check if the status code is the same that are in the pedido
        if ( Hcco_Mercado_Pago::get_status_pt( $payment->status ) == $pedido->get_status_pagamento() )
            return new WP_REST_Response( array( 'Ok' ), 200 );
        
        // update the pedido status pagamento
        $status = Hcco_Mercado_Pago::get_status_pt( $payment->status );
        $pedido->set_status_pagamento( $status );
        $pedido->set_atualizado_em( current_time( 'yy/m/d h:m:s' ) );
        $pedido = Hcco_Pedido_Mapper::update( $pedido );

        // get the cliente email and nome
        $nome = $payment->payer->first_name;
        $email = $payment->payer->email;

        // send the email
        $email_notification = new Hcco_Email_Notification();
        call_user_func_array( array( $email_notification, 'send_' . $status ), array( $email, $nome ) );

        return new WP_REST_Response( array( 'Ok' ), 200 );

    }

    /**
     * Method that checks permissions from post request
     * 
     * @since   1.0.0
     * @access  public
     * @param   object  $request Wordpress Rest Request.
     * @return  bool    True.
     */
    public function post_permissions_check( $request ) {

        return true;

    }

}