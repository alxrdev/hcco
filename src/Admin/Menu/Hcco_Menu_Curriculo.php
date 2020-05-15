<?php

namespace Holos\Hcco\Admin\Menu;

use Holos\Hcco\Admin\ListTable\Hcco_Curriculo_List_Table;
use Holos\Hcco\Mapper\Hcco_Curriculo_Mapper;
use Holos\Hcco\Mapper\Hcco_Pedido_Mapper;

class Hcco_Menu_Curriculo {

    /**
     * Display Home Page
     * 
     * @since   1.0.0
     * @access  public
     */
    public function home() {

        $curriculo_list_table = new Hcco_Curriculo_List_Table();
        $curriculo_list_table->prepare_items();

        require HCCO_PATH . 'resources/admin/templates/menu-curriculo/curriculos.php';

    }

    /**
     * Display a individual curriculo
     * 
     * @since   1.0.0
     * @access  public
     */
    public function view() {

        $curriculo_id = sanitize_text_field( $_GET['curriculo'] );
        $curriculo = Hcco_Curriculo_Mapper::fetch( $curriculo_id );

        require HCCO_PATH . 'resources/admin/templates/menu-curriculo/curriculo.php';

    }

    /**
     * Method that receive an ajax request and delete an curriculo.
     * 
     * @since   1.0.0
     * @access  public
     */
    public function delete_curriculo() {

        // get the parameters
        $nonce = $_POST['_wpnonce'] ?? '';
        $id = sanitize_text_field( $_POST['curriculo_id'] ?? '' );

        // verify the nonce
        if ( ! wp_verify_nonce( $nonce, 'delete_curriculo' . $id ) ) {
            wp_send_json_error( 'Bad Request' );
            wp_die();
        }
        
        // delete the curriculo
        Hcco_Curriculo_Mapper::delete( $id );
        Hcco_Pedido_Mapper::delete( Hcco_Pedido_Mapper::get_by_curriculo_id( $id )->get_id() );

        wp_send_json_success( 'Curriculo ' . $id . ' deleted' );
        wp_die();

    }

}