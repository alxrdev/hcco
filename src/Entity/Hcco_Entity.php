<?php

namespace Holos\Hcco\Entity;

abstract class Hcco_Entity {

    /**
     * Receives an array with all class properties.
     *
     * @since   1.0.0
     * @access  public
     * @param   array|null $props Entity props.
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
     * Return all no filled properties.
     * 
     * @since   1.0.0
     * @access  public
     * @return  array|null     No filled propertis.
     */
    public function get_no_filled_properties_list() : ?array {

        $no_filled_props = [];
        
        foreach ( $this->required_properties as $prop ) {
            if ( empty( $this->{ 'get_' . $prop }() ) ) {
                array_push( $no_filled_props, $prop );
            }
        }

        return $no_filled_props;

    }
    
}