<?php

namespace Holos\Hcco\Entity;

abstract class Hcco_Entity {

    /**
     * If an id is gived, get search the object
     *
     * @param int|null $id Id of object
     */
    public function __construct( array $props = null ) {

        if ( $props != null ) {
            foreach ( $props as $prop => $value ) {
                if ( method_exists( $this, 'set_' . $prop ) ) {
                    call_user_func( array( $this, 'set_' . $prop ), sanitize_text_field( $value ) );
                }
            }
        }

    }


    /**
     * Return all no filled properties
     */
    public function get_no_filled_properties_list() {

        $no_filled_props = [];
        
        foreach ( $this->required_properties as $prop ) {
            if ( empty( $this->{ 'get_' . $prop }() ) ) {
                array_push( $no_filled_props, $prop );
            }
        }

        return $no_filled_props;

    }
    
}