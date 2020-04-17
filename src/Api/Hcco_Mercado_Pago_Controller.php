<?php

namespace Holos\Hcco\Api;

class Hcco_Mercado_Pago_Controller extends \WP_REST_Controller {

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

        // api namespace and path
        $namespace  = $this->plugin_name . '/v' . $this->version;
        $path       = 'mp-notifications';

        register_rest_route( $namespace, '/' . $path, array(
            array(
                'methods'             => \WP_REST_Server::READABLE,
                'callback'            => array( $this, 'get_items' ),
                'permission_callback' => array( $this, 'get_items_permissions_check' )
            )
        ) );

    }

    /**
     * 
     */
    public function get_items( $request ) {

        return new \WP_REST_Response( array( 'message' => 'Hello World Api Wordpress!' ), 200 );

    }

    /**
     * 
     */
    public function get_items_permissions_check( $request ) {
        return true;
    }

}