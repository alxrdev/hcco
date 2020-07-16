<?php

namespace Holos\Hcco;

use Holos\Hcco\Mapper\Hcco_Configuracoes_Mapper;

class Hcco_Front {

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
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     * 
     * @since 	1.0.0
     * @access	public
     */
    public function enqueue_styles() : void {

        wp_enqueue_style( $this->plugin_name, HCCO_URL . 'resources/public/css/hcco-public.css', array(), $this->version, 'all' );

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     * 
     * @since 	1.0.0
     * @access	public
     */
    public function enqueue_scripts() : void {

        wp_enqueue_script( 'jquery-steps', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js', array( 'jquery' ), '1.1.0', false );
        wp_enqueue_script( 'jquery-validate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js', array( 'jquery' ), '1.19.1', false );
        wp_enqueue_script( 'jquery-mask', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js', array( 'jquery' ), '1.14.16', false );
        wp_enqueue_script( $this->plugin_name, HCCO_URL . 'resources/public/js/hcco-public.js', array( 'jquery' ), $this->version, false );

        wp_localize_script(
            $this->plugin_name,
            'hcco_ajax_object',
            array(
                'ajax_url'                          => admin_url( 'admin-ajax.php' ),
                'generate_pagseguro_checkout_code'  => 'generate_pagseguro_checkout_code'
            )
        );

    }

    /**
     * Method that register what class and method to call, based on page url and return it.
     * 
     * @since 	1.0.0
     * @access	private
     * @param	string		$page Page namer.
     * @return 	array		Class and method to call.
     */
    private function pages( $page ) : array {

        $registred_pages = array(
            'cadastro_de_curriculo' => ['Hcco_Cadastro_Curriculo_Page', 'home'],
            'finalizar_o_cadastro_do_curriculo' => ['Hcco_Finalizar_Cadastro_Curriculo_Page', 'home'],
            'cadastro_do_curriculo_finalizado' => ['Hcco_Cadastro_Curriculo_Finalizado_Page', 'home']
        );

        return $registred_pages[$page];

    }

    /**
     * Inicial method that determine what method to call, based on page url.
     * 
     * @since 	1.0.0
     * @access	public
     */
    public function hcco_content() {
        
        // get the page url path
        $page_to_call = wp_parse_url( get_the_permalink() )['path'];
        $page_to_call = trim( $page_to_call, '/' );
        $page_to_call = str_replace( '-', '_', $page_to_call );

        $page = $this->pages( $page_to_call );

        // executes class and method
        if ( $page != null ) {
            $class = '\Holos\Hcco\Front\Page\\' . $page[0];
            return call_user_func( array( new $class(), $page[1] ) );
        }

    }
    
}