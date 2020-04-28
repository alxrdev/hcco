<?php

namespace Holos\Hcco;

use Holos\Hcco\Hcco_Loader;
use Holos\Hcco\Hcco_Front;
use Holos\Hcco\Hcco_Admin;
use Holos\Hcco\Hcco_Api;

class Hcco_Main {

    /**
	 * Propertie that stores the plugin name.
	 * 
	 * @since 	1.0.0
	 * @access 	private
	 */
    private $plugin_name = 'hcco';
    
    /**
	 * Propertie that stores the plugin version.
	 * 
	 * @since 	1.0.0
	 * @access 	private
	 */
    private $version = '1';

    /**
	 * Propertie that stores the hook's loader.
	 * 
	 * @since 	1.0.0
	 * @access 	private
	 */ 
    private $loader;

    /**
     * Class constructor.
     * 
     * @since   1.0.0
     * @access  public
     * @param   Hcco_Loader     $loader Hook's loader.
     */
    public function __construct( Hcco_Loader $loader ) {

        $this->loader = $loader;
        $this->define_front_hooks();
        $this->define_admin_hooks();
        $this->define_api_hooks();

    }

    /**
     * Method that define all front side hooks.
     * 
     * @since   1.0.0
     * @access  private
     */
    private function define_front_hooks() : void {

        $front = new Hcco_Front( $this->plugin_name, $this->version );

        // Stylesheets and Scripts
        $this->loader->add_action( $front, 'wp_enqueue_scripts', 'enqueue_styles' );
        $this->loader->add_action( $front, 'wp_footer', 'enqueue_scripts' );

        // Actions
        $this->loader->add_action( $front, 'hcco_content', 'hcco_content' );

    }

    /**
     * Method that define all admin hooks.
     * 
     * @since   1.0.0
     * @access  private
     */
    private function define_admin_hooks() : void {

        $admin = new Hcco_Admin( $this->plugin_name, $this->version );

        // Scripts
        $this->loader->add_action( $admin, 'admin_enqueue_scripts', 'enqueue_scripts' );

        // Ajax
        $this->loader->add_action( $admin, 'wp_ajax_delete_curriculo', 'delete_curriculo' );

        // Dashboard menus
        $this->loader->add_action( $admin, 'admin_menu', 'register_menus' );

    }

    /**
     * Method that define api hooks.
     * 
     * @since   1.0.0
     * @access  private
     */
    private function define_api_hooks() : void {

        $api = new Hcco_Api( $this->plugin_name, $this->version );

        // mercado pago controller
        $this->loader->add_action( $api, 'rest_api_init', 'register_mercado_pago_controller' );

    }
    
    /**
     * Method that run all hooks.
     * 
     * @since   1.0.0
     * @access  public
     */
    public function run() : void {

        $this->loader->run();

    }

}