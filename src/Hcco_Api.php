<?php

namespace Holos\Hcco;

use Holos\Hcco\Api\Hcco_Mercado_Pago_Controller;

class Hcco_Api {

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
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Method that register the Mercado Pago Controller.
     * 
     * @since   1.0.0
     * @access  public
     */
    public function register_mercado_pago_controller() : void {

        $controller = new Hcco_Mercado_Pago_Controller( $this->plugin_name, $this->version );
        $controller->register_routes();

    }

}