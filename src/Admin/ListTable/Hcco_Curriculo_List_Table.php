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
     * All the data manipulation goes here.
     * 
     * @since   1.0.0
     * @access  public
     */
    public function prepare_items() : void {

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
     * Map database table columns, to the list table.
     * 
     * @since   1.0.0
     * @access  public
     * @return  array       $table_columns Array with the name os the columns.
     */
    public function get_columns() : array {

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
     * Column defaults is used to identify the individual column method.
     * 
     * @since   1.0.0
     * @access  public
     * @return  string      The column name.
     */
    public function column_default( $item, $column_name ) : string {

        return $item[$column_name];

    }

    /**
     * Columns that will be sortable.
     *
     * @since   1.0.0
     * @access  public
     * @return  array  The array with columns that will be sortable.
     */
    public function get_sortable_columns() : array {

        $sortable_columns = array(
            'nome'      => array( 'nome', true ),
            'criado_em' => array( 'criado_em', false )
        );
    
        return $sortable_columns;

    }

    /**
     * Retrieve curriculo's data from the database.
     * 
     * @since   1.0.0
     * @access  public
     * @param   int         $per_page The number of items per page.
     * @param   int         $page_number The currente page count.
     * @return array|null   Array with items from database.
     */
    public function fetch_table_data( $per_page, $page_number ) :?array {

        // verifica se está pesquisando
        $search = ( ! empty( $_REQUEST['s'] ) ) ? wp_unslash( trim( $_REQUEST['s'] ) ) : '';

        // se estiver filtrando
        $order_by = ( ! empty( $_REQUEST['orderby'] ) ) ? esc_sql( $_REQUEST['orderby'] ) : '';
        $order = ( ! empty( $_REQUEST['order'] ) ) ? esc_sql( $_REQUEST['order'] ) : ' ASC';
        $payment_status = ( ! empty( $_REQUEST['active_tab'] ) ) ? esc_sql( $_REQUEST['active_tab'] ) : 'aprovado';

        // busca os dados
        $result = Hcco_Curriculo_Mapper::fetch_all_raw( $search, $order_by, $order, $per_page, $page_number, $payment_status );

        return $result;

    }

    /**
     * Returns the count of records in the database.
     *
     * @since   1.0.0
     * @access  public
     * @return  string|null
     */
    public static function record_count() {
    
        return Hcco_Curriculo_Mapper::get_count();

    }

    /**
     * Returns an associative array containing the bulk action.
     *
     * @since   1.0.0
     * @access  public
     * @return  array
     */
    public function get_bulk_actions() :array {

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
     * 
     * @since   1.0.0
     * @access  public
     */
    public function no_items() {

        _e( 'Nehum currículo foi encontrado', 'hcco' );

    }

    /**
     * Get value for checkbox column.
     *
     * @since   1.0.0
     * @access  public
     * @param   object      $item  A row's data.
     * @return  string      Text to be placed inside the column <td>.
     */
    protected function column_cb( $item ) {

        return sprintf(		
            '<label class="screen-reader-text" for="curriculo_' . $item['id'] . '">' . sprintf( __( 'Select %s' ), $item['nome'] ) . '</label>'
            . "<input type='checkbox' name='curriculos[]' id='curriculo_{$item['id']}' value='{$item['id']}' />"					
        );

    }

    /**
     * Returns the content from column name.
     * 
     * @since   1.0.0
     * @access  protected
     * @param   object      The curriculo entity.
     * @return  string      The column content.
     */
    protected function column_nome( $curriculo ) : string {

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
     * Returns the content from column cargos_profissoes.
     * 
     * @since   1.0.0
     * @access  protected
     * @param   object      The curriculo entity.
     * @return  string      The column content.
     */
    protected function column_cargos_profissoes( $curriculo ) {

        return substr( $curriculo['cargos_profissoes'], 0, 50 ) . '...';

    }

}