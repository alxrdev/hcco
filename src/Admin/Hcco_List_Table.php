<?php

namespace Holos\Hcco\Admin;

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Hcco_List_Table extends \WP_List_Table {}