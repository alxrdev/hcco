<?php

namespace Holos\Hcco\Mapper;

class Hcco_Configuracoes_Mapper {

    /**
     * Get an object
     *
     *
     * @return mixed
     */
    public static function fetch() {

        return get_option( 'hcco_configuracoes' );

    }

    /**
     * Save configuracoes
     */
    public static function save( $configuracoes ) {

        if ( count( $configuracoes ) < 1 ) 
            add_option( 'hcco_configuracoes', $configuracoes );
        else
            update_option( 'hcco_configuracoes', $configuracoes );

    }

    /**
     * Save curriculo preco
     *
     * @return mixed
     */
    public static function save_curriculo_preco( $preco ) {

        $configuracoes = self::fetch();
        $configuracoes = array( 'curriculo' => ['preco' => $preco] );
        
        self::save( $configuracoes );

        return $configuracoes;

    }

    /**
     * Save mercado pago configs
     *
     * @return mixed
     */
    public static function save_mercado_pago( $mercado_pago ) {

        $configuracoes = self::fetch();
        $configuracoes['mercado_pago']['sandbox']['public_token']       = $mercado_pago['mercado_pago_sandbox_public_token'];
        $configuracoes['mercado_pago']['sandbox']['private_token']      = $mercado_pago['mercado_pago_sandbox_private_token'];
        $configuracoes['mercado_pago']['production']['public_token']    = $mercado_pago['mercado_pago_production_public_token'];
        $configuracoes['mercado_pago']['production']['private_token']   = $mercado_pago['mercado_pago_production_private_token'];
        $configuracoes['mercado_pago']['ambiente']                      = $mercado_pago['mercado_pago_ambiente'];
        
        self::save( $configuracoes );

        return $configuracoes;

    }

    /**
     * Save picpay configs
     *
     * @return mixed
     */
    public static function save_picpay( $picpay ) {

        $configuracoes = self::fetch();
        $configuracoes['picpay']['x_picpay_token']  = $picpay['x_picpay_token'];
        $configuracoes['picpay']['x_seller_token']  = $picpay['x_seller_token'];
        
        self::save( $configuracoes );

        return $configuracoes;

    }

    /**
     * Return mercado pago access tokens
     *
     *
     * @return mixed
     */
    public static function get_mercado_pago_access_tokens() {

        $configuracoes = self::fetch();
        
        return $configuracoes['mercado_pago'][$configuracoes['mercado_pago']['ambiente']];

    }

    /**
     * Return picpay access tokens
     *
     *
     * @return mixed
     */
    public static function get_picpay_access_tokens() {

        $configuracoes = self::fetch();
        
        return $configuracoes['picpay'];

    }

    /**
     * Return the curriculo price
     *
     *
     * @return mixed
     */
    public static function get_preco() {

        $configuracoes = self::fetch();

        return $configuracoes['curriculo']['preco'];

    }

}