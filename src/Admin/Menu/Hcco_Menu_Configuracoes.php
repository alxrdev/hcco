<?php

namespace Holos\Hcco\Admin\Menu;

use Holos\Hcco\Mapper\Hcco_Configuracoes_Mapper;

class Hcco_Menu_Configuracoes {

    /**
     * Display Home Page.
     * 
     * @since   1.0.0
     * @access  public
     */
    public function home() : void {

        $active_tab = ( ! empty( $_GET['active_tab'] ) ? sanitize_text_field( $_GET['active_tab'] ) : 'curriculo' );
        $method_to_call = $active_tab . '_tab';

        require HCCO_PATH . 'resources/admin/templates/menu-configuracoes/tabs.php';

    }

    /**
     * Display curriculo tab.
     * 
     * @since   1.0.0
     * @access  public
     */
    public function curriculo_tab() : void {

        $configuracoes = Hcco_Configuracoes_Mapper::fetch();

        // verifica se o formulario foi enviado
        if ( isset( $_POST['hcco_configuracoes_nonce'] ) && wp_verify_nonce( $_POST['hcco_configuracoes_nonce'], 'hcco_configuracoes' ) ) {

            $configuracoes = $this->handle_curriculo_form();

        }

        require HCCO_PATH . 'resources/admin/templates/menu-configuracoes/curriculo-tab.php';

    }

    /**
     * Display mercado pago tab.
     * 
     * @since   1.0.0
     * @access  public
     */
    public function mercado_pago_tab() : void {

        $configuracoes = Hcco_Configuracoes_Mapper::fetch();

        // verifica se o formulario foi enviado
        if ( isset( $_POST['hcco_configuracoes_nonce'] ) && wp_verify_nonce( $_POST['hcco_configuracoes_nonce'], 'hcco_configuracoes' ) ) {

            $configuracoes = $this->handle_mp_form();

        }

        require HCCO_PATH . 'resources/admin/templates/menu-configuracoes/mercado-pago-tab.php';

    }

    /**
     * Display PicPay tab.
     * 
     * @since   1.0.0
     * @access  public
     */
    public function picpay_tab() : void {

        $configuracoes = Hcco_Configuracoes_Mapper::fetch();

        // verifica se o formulario foi enviado
        if ( isset( $_POST['hcco_configuracoes_nonce'] ) && wp_verify_nonce( $_POST['hcco_configuracoes_nonce'], 'hcco_configuracoes' ) ) {

            $configuracoes = $this->handle_picpay_form();

        }

        require HCCO_PATH . 'resources/admin/templates/menu-configuracoes/picpay-tab.php';

    }

    /**
     * Handle the curriculo config form.
     * 
     * @since   1.0.0
     * @access  private
     * @return  array|null  The array with all configs.
     */
    private function handle_curriculo_form() :?array {

        // pega os parametros
        $preco = sanitize_text_field( $_POST['preco'] );        

        // salva no banco
        $configuracoes = Hcco_Configuracoes_Mapper::save_curriculo_preco( $preco );

        return $configuracoes;

    }

    /**
     * Handle the mercado pago config form.
     * 
     * @since   1.0.0
     * @access  public
     * @return  array|null  The array with all configs
     */
    private function handle_mp_form() :?array {

        // pega os parametros
        $mercado_pago['mercado_pago_sandbox_public_token'] = sanitize_text_field( $_POST['mercado_pago_sandbox_public_token'] );
        $mercado_pago['mercado_pago_sandbox_private_token'] = sanitize_text_field( $_POST['mercado_pago_sandbox_private_token'] );
        $mercado_pago['mercado_pago_production_public_token'] = sanitize_text_field( $_POST['mercado_pago_production_public_token'] );
        $mercado_pago['mercado_pago_production_private_token'] = sanitize_text_field( $_POST['mercado_pago_production_private_token'] );
        $mercado_pago['mercado_pago_ambiente'] = sanitize_text_field( $_POST['mercado_pago_ambiente'] );

        // salva no banco
        $configuracoes = Hcco_Configuracoes_Mapper::save_mercado_pago( $mercado_pago );

        return $configuracoes;

    }

    /**
     * Handle the PicPay form.
     * 
     * @since   1.0.0
     * @access  private
     * @return  array|null  The array with all configs.
     */
    private function handle_picpay_form() :?array {

        // pega os parametros
        $picpay['x_picpay_token'] = sanitize_text_field( $_POST['picpay_x_picpay_token'] );        
        $picpay['x_seller_token'] = sanitize_text_field( $_POST['picpay_x_seller_token'] );        

        // salva no banco
        $configuracoes = Hcco_Configuracoes_Mapper::save_picpay( $picpay );

        return $configuracoes;

    }

}
