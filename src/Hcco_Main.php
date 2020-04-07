<?php

namespace Holos\Hcco;

use Holos\Hcco\Hcco_Loader;
use Holos\Hcco\Hcco_Front;
use Holos\Hcco\Hcco_Admin;

class Hcco_Main {

    //
    private $plugin_name = 'hcco';
    
    //
    private $version = '1.0.0';

    //
    private $loader;

    /**
     * 
     */
    public function __construct( Hcco_Loader $loader ) {

        // store the Loader object
        $this->loader = $loader;

        // init hooks
        $this->define_front_hooks();
        $this->define_admin_hooks();

    }

    /**
     * Define front hooks.
     */
    private function define_front_hooks() {

        $front = new Hcco_Front( $this->plugin_name, $this->version );

        // Stylesheets and Scripts
        $this->loader->add_action( $front, 'wp_enqueue_scripts', 'enqueue_styles' );
        $this->loader->add_action( $front, 'wp_footer', 'enqueue_scripts' );

        // Actions
        $this->loader->add_action( $front, 'hcco_content', 'hcco_content' );

    }

    /**
     * Define admin hooks
     */
    private function define_admin_hooks() {

        $admin = new Hcco_Admin( $this->plugin_name, $this->version );

        //
        $this->loader->add_action( $admin, 'admin_menu', 'register_menus' );

    }
    
    /**
     * Run the plugin
     */
    public function run() {

        $this->loader->run();

    }

}