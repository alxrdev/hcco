<?php

class Hcco_Pedido extends Hcco_Entity {

    /*
     * Class properties
     */
    protected $data = array( 
        'id'                    => '',
        'curriculo_id'          => '',
        'usuario_id'            => '',
        'codigo_referencia'     => '',
        'preco'                 => '',
        'status_pagamento'      => '',
        'criado_em'             => '',
        'atualizado_em'         => ''
    );

    /**
     * Table name in the database
     */
    protected $table = 'wp_hcco_pedidos';

    public function __construct( $id = null ) {

        if ( $id == null )
            $this->gerar_codigo_referencia();
        else
            parent::__construct( $id );

    }

    /**
     * Método que gera o código de referencia do pedido
     * utilizando o nome do cliente e datetime no método md5
     *
     * @param string $nome Nome do cliente
     */
    private function gerar_codigo_referencia() {

        $this->set_codigo_referencia( 'HOLOS_' . md5( current_time( 'd/m/yy h:m:s' ) . rand( 0, 100 ) ) );

    }

    /*
    |--------------------------------------------------------------------------
    | CRUD operators
    |--------------------------------------------------------------------------
    */

    /**
     * Get an object by id
     *
     * @global wpdb $wpdb Wordpress database connection
     *
     * @param int $id The object id
     */
    protected function get_by_id( $id ) {

        global $wpdb;

        $sql = $wpdb->prepare( "SELECT * FROM {$this->table} WHERE id = %d", $id );
        $result = $wpdb->get_row( $sql, ARRAY_A );

        $this->read( $result );

    }

    /**
     * Get an object by usuario id
     *
     * @global wpdb $wpdb Wordpress database connection
     *
     * @param string $id The object id
     */
    public function get_by_usuario_id( $id ) {

        global $wpdb;

        $sql = $wpdb->prepare( "SELECT * FROM {$this->table} WHERE usuario_id = %s", $id );
        $result = $wpdb->get_row( $sql, ARRAY_A );

        $this->read( $result );

    }

    /**
     * Get an object by codigo referencia
     *
     * @global wpdb $wpdb Wordpress database connection
     *
     * @param string $cod The object id
     */
    public function get_by_codigo_referencia( $cod ) {

        global $wpdb;

        $sql = $wpdb->prepare( "SELECT * FROM {$this->table} WHERE codigo_referencia = %s", $cod );
        $result = $wpdb->get_row( $sql, ARRAY_A );

        $this->read( $result );

    }

    /**
     * Save the object in the database
     *
     */
    public function save() {

        if ( ( $this->get_id() != null ) && ( ! empty( $this->get_id() ) ) ) {
            $this->update();
        } else {
            $this->create();
        }

    }

    //
    protected function create() {

        global $wpdb;

        $this->set_criado_em( current_time( 'yy/m/d h:m:s' ) );
        $this->set_atualizado_em( current_time( 'yy/m/d h:m:s' ) );

        $result = $wpdb->insert( $this->table, $this->data );

        $this->set_id( $wpdb->insert_id );

    }

    //
    protected function update() {

        global $wpdb;

        $this->set_atualizado_em( current_time( 'yy/m/d h:m:s' ) );

        $wpdb->update( $this->table, $this->data, array( 'id' => $this->get_id() ) );

    }

    //
    public function delete() {

        global $wpdb;

        $wpdb->delete( $this->table, array( 'id' => $this->get_id() ) );
        
    }

    /*
    |--------------------------------------------------------------------------
    | GETTERS AND SETTERS methods
    |--------------------------------------------------------------------------
    */

    public function get_id() {

        return $this->get_prop( 'id' );
    
    }

    public function set_id( $id ) {

        $this->set_prop( 'id', $id );
    
    }

    public function get_curriculo_id()  {

        return $this->get_prop( 'curriculo_id' );
    
    }

    public function set_curriculo_id( $curriculo_id ) {

        $this->set_prop( 'curriculo_id', $curriculo_id );
    
    }

    public function get_usuario_id() {

        return $this->get_prop( 'usuario_id' );
    
    }

    public function set_usuario_id( $usuario_id ) {

        $this->set_prop( 'usuario_id', $usuario_id );
    
    }

    public function get_codigo_referencia() {

        return $this->get_prop( 'codigo_referencia' );
    
    }

    protected function set_codigo_referencia( $codigo_referencia ) {

        $this->set_prop( 'codigo_referencia', $codigo_referencia );
    
    }

    public function get_preco() {

        return $this->get_prop( 'preco' );
    
    }

    public function set_preco( $preco ) {

        $this->set_prop( 'preco', $preco );
    
    }

    public function get_status_pagamento() {

        return $this->get_prop( 'status_pagamento' );
    
    }

    public function set_status_pagamento( $status_pagamento ) {

        $this->set_prop( 'status_pagamento', $status_pagamento );
    
    }

    public function get_criado_em() {

        return $this->get_prop( 'criado_em' );
    
    }

    public function set_criado_em( $criado_em ) {

        $this->set_prop( 'criado_em', $criado_em );
    
    }

    public function get_atualizado_em() {

        return $this->get_prop( 'atualizado_em' );
    
    }

    public function set_atualizado_em( $atualizado_em ) {

        $this->set_prop( 'atualizado_em', $atualizado_em );
    
    }

}