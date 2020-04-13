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

        $sql = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . self::$table_name );
        $result = $wpdb->get_row( $sql, ARRAY_A );

        return $result;

    }

}