<?php

namespace Holos\Hcco;

use Holos\Hcco\Admin\Menu\Hcco_Menu_Curriculo;
use Holos\Hcco\Admin\Menu\Hcco_Menu_Configuracoes;

class Hcco_Admin {

    //
    private $plugin_name;
    
    // 
    private $version;

    /**
     * 
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Method that register all menu items
     */
    public function register_menus() {

		add_menu_page(
			__( 'Curriculos', 'hcco' ), 
			__( 'Curriculos', 'hcco' ), 
			'manage_options', 
			'hcco', 
			array( $this, 'menu_curriculo' ),
			'dashicons-schedule', 
			3
        );
        
        add_submenu_page(
            'hcco',
			__( 'Configurações', 'hcco' ), 
			__( 'Configurações', 'hcco' ), 
			'manage_options', 
			'hcco_configuracoes', 
			array( $this, 'menu_configuracoes' )
        );

    }
    
    /**
     * 
     */
    public function menu_curriculo() {

        return $this->run_menu( new Hcco_Menu_Curriculo() );

    }

    /**
     * 
     */
    public function menu_configuracoes() {

        return $this->run_menu( new Hcco_Menu_Configuracoes() );

    }

    /**
     *  Method that execute a menu page
     * 
     * @param object $menu Menu object
     */
    private function run_menu( $menu ) {

        $method = ( isset( $_REQUEST['action'] ) ) ? sanitize_text_field( $_REQUEST['action'] ) : 'home';

        if ( method_exists( $menu, $method ) )
            return call_user_func( [$menu, $method] );

    }

}