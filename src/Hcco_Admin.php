<?php

namespace Holos\Hcco;

use Holos\Hcco\Admin\Menu\Hcco_Menu_Curriculo;
use Holos\Hcco\Admin\Menu\Hcco_Menu_Configuracoes;

class Hcco_Admin {

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
     * Method that register all menu items.
     * 
     * @since   1.0.0
     * @access  public
     */
    public function register_menus() : void {

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
     * Method that define what class shoud be executed for curriculo menu.
     * 
     * @since   1.0.0
     * @access  public
     * @return  callable
     */
    public function menu_curriculo() {

        return $this->run_menu( new Hcco_Menu_Curriculo() );

    }

    /**
     * Method that define what class shoud be executed for configuracoes menu.
     * 
     * @since   1.0.0
     * @access  public
     * @return  callable
     */
    public function menu_configuracoes() {

        return $this->run_menu( new Hcco_Menu_Configuracoes() );

    }

    /**
     *  Method that executes a menu class.
     * 
     * @since   1.0.0
     * @param   object  $menu Menu object
     */
    private function run_menu( $menu ) {

        $method = ( isset( $_REQUEST['action'] ) ) ? sanitize_text_field( $_REQUEST['action'] ) : 'home';

        if ( method_exists( $menu, $method ) )
            return call_user_func( [$menu, $method] );

    }

}