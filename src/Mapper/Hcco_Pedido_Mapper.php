<?php

namespace Holos\Hcco\Mapper;

use Holos\Hcco\Entity\Hcco_Pedido;

class Hcco_Pedido_Mapper {

    /**
     * Parameter that stores the table name in the database
     * 
     * @since   1.0.0
     * @access  private
     * @var     string
     */
    private static $table = 'hcco_pedidos';

    /**
     * Get an object by id
     *
     * @global wpdb $wpdb Wordpress database connection
     *
     * @param int $id The object id
     */
    public static function fetch( $id ) {

        global $wpdb;

        $sql = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . self::$table . " WHERE id = %d", $id );
        $result = $wpdb->get_row( $sql, ARRAY_A );

        return new Hcco_Pedido( $result );

    }

    /**
     * Get an object by usuario id
     *
     * @global wpdb $wpdb Wordpress database connection
     *
     * @param string $id The object id
     */
    public static function get_by_usuario_id( $id ) {

        global $wpdb;
        
        $sql = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . self::$table . " WHERE usuario_id = %s", $id );
        $result = $wpdb->get_row( $sql, ARRAY_A );

        return new Hcco_Pedido( $result );

    }

    /**
     * Get an object by codigo referencia
     *
     * @global wpdb $wpdb Wordpress database connection
     *
     * @param string $cod The object id
     */
    public static function get_by_codigo_referencia( $cod ) {

        global $wpdb;

        $sql = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . self::$table . " WHERE codigo_referencia = %s", $cod );
        $result = $wpdb->get_row( $sql, ARRAY_A );

        return new Hcco_Pedido( $result );

    }

    /**
     * Get an object by payment id
     *
     * @global wpdb $wpdb Wordpress database connection
     *
     * @param int $id The object id
     */
    public static function get_by_payment_id( $id ) {

        global $wpdb;

        $sql = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . self::$table . " WHERE payment_id = %d", $id );
        $result = $wpdb->get_row( $sql, ARRAY_A );

        return new Hcco_Pedido( $result );

    }

    //
    public static function create( Hcco_Pedido $pedido ) {

        global $wpdb;

        $result = $wpdb->insert( $wpdb->prefix . self::$table, array(
            'curriculo_id'          => $pedido->get_curriculo_id(),
            'usuario_id'            => $pedido->get_usuario_id(),
            'codigo_referencia'     => $pedido->get_codigo_referencia(),
            'payment_id'            => $pedido->get_payment_id(),
            'preco'                 => $pedido->get_preco(),
            'status_pagamento'      => $pedido->get_status_pagamento()
        ) );

        $pedido->set_id( $wpdb->insert_id );

        return $pedido;

    }

    //
    public static function update( Hcco_Pedido $pedido ) {

        global $wpdb;

        $pedido->set_atualizado_em( current_time( 'yy/m/d h:m:s' ) );

        $wpdb->update( $wpdb->prefix . self::$table, array(
            'curriculo_id'          => $pedido->get_curriculo_id(),
            'usuario_id'            => $pedido->get_usuario_id(),
            'codigo_referencia'     => $pedido->get_codigo_referencia(),
            'payment_id'            => $pedido->get_payment_id(),
            'preco'                 => $pedido->get_preco(),
            'status_pagamento'      => $pedido->get_status_pagamento(),
            'atualizado_em'         => $pedido->get_atualizado_em()
        ), array( 'id' => $pedido->get_id() ) );

        return $pedido;

    }

    //
    public static function delete( $id ) {

        global $wpdb;

        $wpdb->delete( $wpdb->prefix . self::$table, array( 'id' => $id ) );
        
    }

}