<?php

namespace Holos\Hcco\Admin\ListTable;

use Holos\Hcco\Admin\ListTable\Hcco_List_Table;
use Holos\Hcco\Mapper\Hcco_Curriculo_Mapper;

class Hcco_Curriculo_List_Table extends Hcco_List_Table {

    public function __construct() {

        $args = array(
            'plural'   => __( 'Currículos', 'hcco' ),
            'singular' => __( 'Currículo', 'hcco' ),
            'ajax'     => false,
            'screen'   => null,
        );

        parent::__construct( $args );

    }

    /**
     * All the data manipulation goes here
     */
    public function prepare_items() {

        //used by WordPress to build and fetch the _column_headers property
        // $this->_column_headers = $this->get_column_info();
        $this->_column_headers = array( $this->get_columns() );

        // code to handle bulk actions
        // $this->process_bulk_action();

        // code to handle data operations like sorting and filtering
        $per_page       = $this->get_items_per_page( 'curriculos_per_page', 5 );
        $current_page   = $this->get_pagenum();
        $total_items    = self::record_count();

        // code to handle pagination
        $this->set_pagination_args([
            'total_items' => $total_items,
            'per_page'    => $per_page,
            'total_pages' => ceil( $total_items/$per_page )
        ]);

        // start by assigning your data to the items variable
        $this->items = $this->fetch_table_data( $per_page, $current_page );

    }

    /**
     * Table columns name
     */
    public function get_columns() {

        $table_columns = array(
            'cb'                    => '<input type="checkbox" />',
            'nome'                  => __( 'Nome', 'hcco' ),
            'escolaridade'          => __( 'Escolaridade', 'hcco' ),
            'curso_formacao'        => __( 'Curso de Formação', 'hcco' ),
            'cargos_profissoes'     => __( 'Cargos / Profissões', 'hcco' ),
            'criado_em'             => __( 'Criado em', 'hcco' )
        );

        return $table_columns;

    }

    /**
     * Column defaults is used to identify the individual column method
     */
    public function column_default( $item, $column_name ) {

        return $item[$column_name];

    }

    /**
     * Columns to make sortable.
     *
     * @return array
     */
    public function get_sortable_columns() {

        $sortable_columns = array(
            'nome'      => array( 'nome', true ),
            'criado_em' => array( 'criado_em', false )
        );
    
        return $sortable_columns;

    }

    /**
     * Method for name column
     *
     * @param array $item an array of DB data
     *
     * @return string
     */
    protected function column_name( $item ) {

        // create a nonce
        $delete_nonce = wp_create_nonce( 'sp_delete_customer' );
    
        $title = '<strong>' . $item['name'] . '</strong>';
    
        $actions = [
            'delete' => sprintf( '<a href="?page=%s&action=%s&customer=%s&_wpnonce=%s">Delete</a>', esc_attr( $_REQUEST['page'] ), 'delete', absint( $item['ID'] ), $delete_nonce )
        ];
    
        return $title . $this->row_actions( $actions );

    }

    /**
     * Retrieve curriculo's data from the database
     * 
     * @param int $per_page
     * @param int $page_number
     * 
     * @return mixed
     */
    public function fetch_table_data( $per_page, $page_number ) {

        // verifica se está pesquisando
        $search = ( ! empty( $_REQUEST['s'] ) ) ? wp_unslash( trim( $_REQUEST['s'] ) ) : '';

        // se estiver filtrando
        $order_by = ( ! empty( $_REQUEST['orderby'] ) ) ? esc_sql( $_REQUEST['orderby'] ) : '';
        $order = ( ! empty( $_REQUEST['order'] ) ) ? esc_sql( $_REQUEST['order'] ) : ' ASC';

        // busca os dados
        $result = Hcco_Curriculo_Mapper::fetch_all_raw( $search, $order_by, $order, $per_page, $page_number );

        return $result;

    }

    /**
     * Returns the count of records in the database.
     *
     * @return null|string
     */
    public static function record_count() {
    
        return Hcco_Curriculo_Mapper::get_count();

    }

    /**
     * Get value for checkbox column.
     *
     * @param object $item  A row's data.
     * @return string Text to be placed inside the column <td>.
     */
    protected function column_cb( $item ) {

        return sprintf(		
            '<label class="screen-reader-text" for="curriculo_' . $item['id'] . '">' . sprintf( __( 'Select %s' ), $item['nome'] ) . '</label>'
            . "<input type='checkbox' name='curriculos[]' id='curriculo_{$item['id']}' value='{$item['id']}' />"					
        );

    }

    /**
     * Returns an associative array containing the bulk action
     *
     * @return array
     */
    public function get_bulk_actions() {

        /*
        * on hitting apply in bulk actions the url paramas are set as
        * ?action=bulk-download&paged=1&action2=-1
        * 
        * action and action2 are set based on the triggers above and below the table		 		    
        */
        $actions = [
            'bulk-delete' => 'Delete'
        ];
    
        return $actions;

    }

    /**
     * Message to display when no itens found.
     */
    public function no_items() {

        _e( 'Nehum currículo foi encontrado', 'hcco' );

    }

    /**
     * 
     */
    protected function column_nome( $curriculo ) {

        $actions = array(
            'edit' => sprintf(
                '<a href="?page=%s&action=%s&curriculo=%s">' . __( 'Editar', 'hcco' ) . '</a>', 
                $_REQUEST['page'], 
                'edit',
                $curriculo['id']
            ),
            'delete' => sprintf(
                '<a href="javascript:void(0)" onClick="hcco_delete_curriculo(\'%s\',%s)">' . __( 'Apagar', 'hcco' ) . '</a>',
                wp_create_nonce( 'delete_curriculo' . $curriculo['id'] ), 
                $curriculo['id']
            ),
            'view' => sprintf(
                '<a href="?page=%s&action=%s&curriculo=%s">' . __( 'Ver', 'hcco' ) . '</a>',  
                $_REQUEST['page'], 
                'view', 
                $curriculo['id']
            )
        );

        //Return the title contents
        return sprintf( 
            '<a href="?page=%s&action=%s&curriculo=%s">%s</a> %s',
            $_REQUEST['page'],
            'view',
            $curriculo['id'],
            $curriculo['nome'],
            $this->row_actions( $actions )
        );

    }

    /**
     * 
     */
    protected function column_cargos_profissoes( $curriculo ) {

        return substr( $curriculo['cargos_profissoes'], 0, 50 ) . '...';

    }

}