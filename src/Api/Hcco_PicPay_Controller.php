<?php

namespace Holos\Hcco\Api;

use Holos\Hcco\Email\Hcco_Email_Notification;
use Holos\Hcco\Mapper\Hcco_Configuracoes_Mapper;
use Holos\Hcco\Mapper\Hcco_Pedido_Mapper;
use Holos\Hcco\Mapper\Hcco_Curriculo_Mapper;
use Holos\Hcco\Payment\Hcco_PicPay;
use Picpay\Exception\RequestException;
use Picpay\Request\NotificationRemoteRequest;
use Picpay\Request\StatusRequest;
use Picpay\Seller;
use \WP_REST_Controller;
use \WP_REST_Response;

class Hcco_PicPay_Controller extends WP_REST_Controller {

    /**
	 * Propertie that stores the plugin name.
	 * 
	 * @since 	1.0.0
	 * @access 	private
     * @var   string  The plugin name.
	 */
    private $plugin_name;
    
    /**
	 * Propertie that stores the plugin version.
	 * 
	 * @since 	1.0.0
	 * @access 	private
     * @var   string  The plugin version.
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
        $resource   = 'picpay-notifications';

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

        return new WP_REST_Response( array( 'Ok' ), 200 );

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

        // process the picpay sended data
        $remoteNotification = new NotificationRemoteRequest( json_encode( $request->get_json_params() ) );

        // check the picpay api
        $_temp_tokens = Hcco_Configuracoes_Mapper::get_picpay_access_tokens();
        $seller = new Seller( $_temp_tokens['x_picpay_token'], $_temp_tokens['x_seller_token'] );

        try {
            $statusRequest = new StatusRequest( $seller, $request->get_param( 'referenceId' ) );
            $statusResponse = $statusRequest->execute();
        } catch ( RequestException $e ) {
            return new WP_REST_Response( array( $e->getMessage() ), 400 );
        }

        // if the status is created
        if ( $statusResponse->status === 'created' )
            return new WP_REST_Response( array( 'Ok' ), 200 );

        // get the pedido
        $pedido = Hcco_Pedido_Mapper::get_by_codigo_referencia( $request->get_param( 'referenceId' ) );

        // check if the pedido exists
        if ( empty( $pedido->get_id() ) )
            return new WP_REST_Response( array( 'message' => __( 'Ops! Pedido não encontrado.', 'hcco' ) ), 400 );
        
        // check if the status is the same
        if ( Hcco_PicPay::get_status_pt( $statusResponse->status ) === $pedido->get_status_pagamento() )
            return new WP_REST_Response( array( 'Ok' ), 200 );
        
        // update the pedido status pagamento
        $status = Hcco_PicPay::get_status_pt( $statusResponse->status );
        $pedido->set_status_pagamento( $status );
        $pedido->set_payment_id( $remoteNotification->getAuthorizationId() );
        $pedido->set_atualizado_em( current_time( 'yy/m/d h:m:s' ) );
        $pedido = Hcco_Pedido_Mapper::update( $pedido );

        // get the cliente email and nome
        $curriculo  = Hcco_Curriculo_Mapper::fetch( $pedido->get_curriculo_id() );
        $nome       = $curriculo->get_nome();
        $email      = $curriculo->get_email();

        // send the email
        $email_notification = new Hcco_Email_Notification();
        call_user_func_array( array( $email_notification, 'send_' . $status ), array( $email, $nome ) );

        return new WP_REST_Response( array( 'Ok' ), 200 );

    }

    /**
     * Method that checks permissions from post request.
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