<?php

namespace Holos\Hcco\Api;

use Holos\Hcco\Email\Hcco_Email_Notification;
use Holos\Hcco\Mapper\Hcco_Pedido_Mapper;
use Holos\Hcco\Mapper\Hcco_Curriculo_Mapper;
use Holos\Hcco\Payment\Hcco_PagSeguro;
use \WP_REST_Controller;
use \WP_REST_Response;

class Hcco_PagSeguro_Controller extends WP_REST_Controller {

    /**
     * Propertie that stores the plugin name.
     * 
     * @since 	1.0.0
     * @access 	private
     * @var     string      The plugin name.
     */
    private $plugin_name;
    
    /**
     * Propertie that stores the plugin version.
     * 
     * @since 	1.0.0
     * @access 	private
     * @var     string      The plugin version.
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
        $resource   = 'pagseguro-notifications';

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
     * Handle the post request.
     * 
     * @since   1.0.0
     * @access  private
     * @param   object      $request Wordpress Rest Request.
     * @return  object      Wordpres Rest Response.
     */
    public function post( $request ) {

        // get mercado pagseguro sended data
        $notification_type = $request->get_param( 'notificationType' );
        $notification_code = $request->get_param( 'notificationCode' );

        // checks if the notification is transaction
        if ( $notification_type != 'transaction' ) {
            return new WP_REST_Response( array( __( 'Ok', 'hcco' ) ), 200 );
        }

        $pagseguro = new Hcco_PagSeguro();
        $transaction = $pagseguro->get_transaction_details_by_notification_code( $notification_code );

        if ( $transaction == 'Unauthorized' ) {
            return new WP_REST_Response( array( 'message' => __( 'Ops! Não autorizado.', 'hcco' ) ), 400 );
        }

        $pedido = Hcco_Pedido_Mapper::get_by_codigo_referencia( $transaction->reference );

        if ( empty( $pedido->get_id() ) ) {
            return new WP_REST_Response( array( 'message' => __( 'Ops! Pedido não encontrado.', 'hcco' ) ), 400 );
        }

        $pedido->set_payment_id( $transaction->code );

        $payment_status = Hcco_PagSeguro::get_payment_status_pt( $transaction->status );

        $pedido->set_status_pagamento( $payment_status );
        $pedido->set_atualizado_em( current_time( 'yy/m/d h:m:s' ) );

        $pedido = Hcco_Pedido_Mapper::update( $pedido );

        $curriculo = Hcco_Curriculo_Mapper::fetch( $pedido->get_curriculo_id() );

        $nome  = $curriculo->get_nome();
        $email = $curriculo->get_email();

        $email_notification = new Hcco_Email_Notification();
        call_user_func_array( array( $email_notification, 'send_' . $payment_status ), array( $email, $nome ) );

        return new WP_REST_Response( 'Ok', 200 );        

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

    /**
     * Handle the get request.
     * 
     * @since   1.0.0
     * @access  private
     * @param   object      $request Wordpress Rest Request.
     * @return  object      Wordpres Rest Response.
     */
    public function get( $request ) {

        return new WP_REST_Response( 'Ok', 200 );

    }

    /**
     * Method that checks permissions from get request
     * 
     * @since   1.0.0
     * @access  public
     * @param   object  $request Wordpress Rest Request.
     * @return  bool    True.
     */
    public function get_permissions_check( $request ) {

        return true;

    }

}
