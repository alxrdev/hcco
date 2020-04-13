<?php

namespace Holos\Hcco\Mapper;

class Hcco_Configuracoes_Mapper {

    /**
     * Table name in the database
     */
    private static $table_name = 'hcco_configuracoes';

    /**
     * Get an object
     *
     * @global wpdb $wpdb Wordpress database connection
     *
     * @return mixed
     */
    public static function fetch() {

        global $wpdb;

        $sql = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . self::$table_name . ' WHERE id = 1 ' );
        $result = $wpdb->get_row( $sql, ARRAY_A );

        return $result;

    }

    /**
     * Save an object
     *
     * @global wpdb $wpdb Wordpress database connection
     *
     * @return mixed
     */
    public static function save( $configuracoes ) {

        global $wpdb;

        // verifica se as configurações existem
        if ( isset( $configuracoes['id'] ) && ! empty( $configuracoes['id'] ) ) {

            $wpdb->update( $wpdb->prefix . self::$table_name, array(
                'preco'                             => $configuracoes['preco'],
                'mercado_pago_sandbox_token'        => $configuracoes['mercado_pago_sandbox_token'],
                'mercado_pago_production_token'     => $configuracoes['mercado_pago_production_token']
            ), array( 'id' => 1 ) );

            return $configuracoes;

        }

        $wpdb->insert( $wpdb->prefix . self::$table_name, array(
            'id'                                => '1',
            'preco'                             => $configuracoes['preco'],
            'mercado_pago_sandbox_token'        => $configuracoes['mercado_pago_sandbox_token'],
            'mercado_pago_production_token'     => $configuracoes['mercado_pago_production_token']
        ) );

        return $configuracoes;

    }


}