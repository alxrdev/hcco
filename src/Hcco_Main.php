<?php

namespace Holos\Hcco;

use Holos\Hcco\Hcco_Loader;
use Holos\Hcco\Hcco_Front;
use Holos\Hcco\Hcco_Admin;

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

        // dashboard menus
        $this->loader->add_action( $admin, 'admin_menu', 'register_menus' );

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