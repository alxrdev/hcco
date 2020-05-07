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
     * Returns a pedido by id.
     *
     * @since   1.0.0
     * @access  public
     * @global  wpdb            $wpdb Wordpress database connection.
     * @param   string|int      $id The pedido's id.
     * @return  Hcco_Pedido     The pedido from database.
     */
    public static function fetch( $id ) : Hcco_Pedido {

        global $wpdb;

        $sql = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . self::$table . " WHERE id = %d", $id );
        $result = $wpdb->get_row( $sql, ARRAY_A );

        return new Hcco_Pedido( $result );

    }

    /**
     * Returns a pedido by curriculo id.
     *
     * @since   1.0.0
     * @access  public
     * @global  wpdb            $wpdb Wordpress database connection.
     * @param   string|int      $id The curriculo id.
     * @return  Hcco_Pedido     The pedido from database.
     */
    public static function get_by_curriculo_id( $id ) : Hcco_Pedido {

        global $wpdb;
        
        $sql = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . self::$table . " WHERE curriculo_id = %s", $id );
        $result = $wpdb->get_row( $sql, ARRAY_A );

        return new Hcco_Pedido( $result );

    }

    /**
     * Returns a pedido by usuraio id.
     *
     * @since   1.0.0
     * @access  public
     * @global  wpdb            $wpdb Wordpress database connection.
     * @param   string          $id The usuario id.
     * @return  Hcco_Pedido     The pedido from database.
     */
    public static function get_by_usuario_id( string $id ) : Hcco_Pedido {

        global $wpdb;
        
        $sql = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . self::$table . " WHERE usuario_id = %s", $id );
        $result = $wpdb->get_row( $sql, ARRAY_A );

        return new Hcco_Pedido( $result );

    }

    /**
     * Returns a pedido by codigo de referencia.
     *
     * @since   1.0.0
     * @access  public
     * @global  wpdb            $wpdb Wordpress database connection.
     * @param   string          $cod The pedido's codigo de referencia.
     * @return  Hcco_Pedido     The pedido from database.
     */
    public static function get_by_codigo_referencia( string $cod ) : Hcco_Pedido {

        global $wpdb;

        $sql = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . self::$table . " WHERE codigo_referencia = %s", $cod );
        $result = $wpdb->get_row( $sql, ARRAY_A );

        return new Hcco_Pedido( $result );

    }

    /**
     * Returns a pedido by peyment id.
     *
     * @since   1.0.0
     * @access  public
     * @global  wpdb            $wpdb Wordpress database connection.
     * @param   string          $id The pedido payment id.
     * @return  Hcco_Pedido     The pedido from database.
     */
    public static function get_by_payment_id( string $id ) : Hcco_Pedido {

        global $wpdb;

        $sql = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . self::$table . " WHERE payment_id = %d", $id );
        $result = $wpdb->get_row( $sql, ARRAY_A );

        return new Hcco_Pedido( $result );

    }

    /**
     * Stores a pedido in the database.
     *
     * @since   1.0.0
     * @access  public
     * @global  wpdb            $wpdb Wordpress database connection.
     * @param   Hcco_Pedido     $pedido The pedido entity.
     * @return  Hcco_Pedido     The pedido from database.
     */
    public static function create( Hcco_Pedido $pedido ) : Hcco_Pedido {

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

    /**
     * Update a pedido in the database.
     *
     * @since   1.0.0
     * @access  public
     * @global  wpdb             $wpdb Wordpress database connection.
     * @param   Hcco_Pedido     $pedido The pedido entity.
     * @return  Hcco_Pedido     The pedido from database.
     */
    public static function update( Hcco_Pedido $pedido ) : Hcco_Pedido {

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

    /**
     * Delete a pedido by id.
     *
     * @since   1.0.0
     * @access  public
     * @global  wpdb             $wpdb Wordpress database connection.
     * @param   int|string       $id The pedido id.
     */
    public static function delete( $id ) : void {

        global $wpdb;

        $wpdb->delete( $wpdb->prefix . self::$table, array( 'id' => $id ) );
        
    }

}