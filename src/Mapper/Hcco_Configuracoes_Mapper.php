<?php

namespace Holos\Hcco\Mapper;

class Hcco_Configuracoes_Mapper {

    /**
     * Return an array with all plugin settings from database.
     *
     * @since   1.0.0
     * @access  public
     * @return  array   All plugin settings.
     */
    public static function fetch() : array {

        return get_option( 'hcco_configuracoes' );

    }

    /**
     * Stores the plugin settings in the database.
     * 
     * @since   1.0.0
     * @access  public
     * @param   array       Plugin settings.
     */
    public static function save( array $configuracoes ) : void {

        if ( count( $configuracoes ) < 1 ) 
            add_option( 'hcco_configuracoes', $configuracoes );
        else
            update_option( 'hcco_configuracoes', $configuracoes );

    }

    /**
     * Stores the currículo price.
     *
     * @since   1.0.0
     * @access  public
     * @param   string      $preco The curriculo price.
     * @return  array       Plugin settings.
     */
    public static function save_curriculo_preco( string $preco ) : array {

        $configuracoes = self::fetch();
        $configuracoes['curriculo'] = array( 'preco' => $preco );
        
        self::save( $configuracoes );

        return $configuracoes;

    }

    /**
     * Stores the mercado pago settings
     *
     * @since   1.0.0
     * @access  public
     * @param   array       $mercado_pago The mercado pago settings.
     * @return  array       Plugin settings.
     */
    public static function save_mercado_pago( $mercado_pago ) : array {

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
     * Stores the pagseguro settings
     *
     * @since   1.0.0
     * @access  public
     * @param   array       $pagseguro The pagseguro settings.
     * @return  array       Plugin settings.
     */
    public static function save_pagseguro( $pagseguro ) : array {

        $configuracoes = self::fetch();
        $configuracoes['pagseguro']['sandbox']['email']      = $pagseguro['pagseguro_sandbox_email'];
        $configuracoes['pagseguro']['sandbox']['token']      = $pagseguro['pagseguro_sandbox_token'];
        $configuracoes['pagseguro']['production']['email']   = $pagseguro['pagseguro_production_email'];
        $configuracoes['pagseguro']['production']['token']   = $pagseguro['pagseguro_production_token'];
        $configuracoes['pagseguro']['ambiente']              = $pagseguro['pagseguro_ambiente'];
        
        self::save( $configuracoes );

        return $configuracoes;

    }

    /**
     * Stores the picpay settings.
     *
     * @since   1.0.0
     * @access  public
     * @param   array       $picpay The picpay settings.
     * @return  array       Plugin settings.
     */
    public static function save_picpay( $picpay ) : array {

        $configuracoes = self::fetch();
        $configuracoes['picpay']['x_picpay_token']  = $picpay['x_picpay_token'];
        $configuracoes['picpay']['x_seller_token']  = $picpay['x_seller_token'];
        
        self::save( $configuracoes );

        return $configuracoes;

    }

    /**
     * Returns the mercado pago access tokens based in the environment, sandbox or production.
     * 
     * @since   1.0.0
     * @access  public
     * @return  array       Array with mercado pago access tokens.
     */
    public static function get_mercado_pago_access_tokens() : array {

        $configuracoes = self::fetch();
        
        return $configuracoes['mercado_pago'][$configuracoes['mercado_pago']['ambiente']];

    }

    /**
     * Returns the pagseguro credentials based in the environment, sandbox or production.
     * 
     * @since   1.0.0
     * @access  public
     * @return  array       Array with pagseguro credentials.
     */
    public static function get_pagseguro_credentials() : array {

        $configuracoes = self::fetch();
        
        $pagseguro = $configuracoes['pagseguro'][$configuracoes['pagseguro']['ambiente']];
        $pagseguro['ambiente'] = $configuracoes['pagseguro']['ambiente'];

        return $pagseguro;

    }

    /**
     * Return the picpay access tokens.
     *
     * @since   1.0.0
     * @access  public
     * @return  array       Array with picpay access tokens.
     */
    public static function get_picpay_access_tokens() : array {

        $configuracoes = self::fetch();
        
        return $configuracoes['picpay'];

    }

    /**
     * Returns the curriculo price.
     *
     * @since   1.0.0
     * @access  public
     * @return  string      Curriculo price.
     */
    public static function get_preco() : string {

        $configuracoes = self::fetch();

        return $configuracoes['curriculo']['preco'];

    }

}