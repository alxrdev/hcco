<?php

abstract class Hcco_Entity {

    /**
     * If an id is gived, get search the object
     *
     * @param int|null $id Id of object
     */
    public function __construct( $id = null ) {

        if ( $id != null ) {
            $this->get_by_id( $id );
        }

    }


    /**
     * Receive an array with all properties and build the class
     */
    public function read( $props ) {
        if ( $props == null || empty( $props ) )
            return false;

        foreach ( $props as $prop => $value ) {
            if ( array_key_exists( $prop , $this->data ) ) {
                call_user_func( array( $this, 'set_' . $prop ), sanitize_text_field( $value ) );
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

    /**
     * Get an propertie from object $data
     */
    protected function get_prop( $prop ) {
        
        return ( array_key_exists( $prop , $this->data ) ) ? $this->data[$prop] : null;

    }

    /**
     *
     */
    protected function set_prop( $prop, $value ) {
        
        if ( array_key_exists( $prop , $this->data ) ) {
            $this->data[$prop] = $value;
        }

    }

    abstract protected function get_by_id( $id );
    abstract public function save();
    abstract protected function create();
    abstract protected function update();
    abstract public function delete();

}