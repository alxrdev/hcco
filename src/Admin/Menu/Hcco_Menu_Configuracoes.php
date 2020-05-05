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

        ?>
        <div class="wrap">
            <h1>Configurações</h1>

            <div class="nav-tab-wrapper">
				<a 
                    class="nav-tab 
                    <?php echo $active_tab === 'curriculo' ? 'nav-tab-active' : ''; ?>" 
                    href="<?php echo esc_url( '?page=hcco_configuracoes&active_tab=curriculo' ); ?>"
                >
                    <?php _e( 'Currículo', 'hcco' ); ?>
                </a>
				<a 
                    class="nav-tab 
                    <?php echo $active_tab === 'mercado_pago' ? 'nav-tab-active' : ''; ?>" 
                    href="<?php echo esc_url( '?page=hcco_configuracoes&active_tab=mercado_pago' ); ?>"
                >
                    <?php _e( 'Mercado Pago', 'hcco' ); ?>
                </a>
                <a 
                    class="nav-tab 
                    <?php echo $active_tab === 'picpay' ? 'nav-tab-active' : ''; ?>" 
                    href="<?php echo esc_url( '?page=hcco_configuracoes&active_tab=picpay' ); ?>"
                >
                    <?php _e( 'PicPay', 'hcco' ); ?>
                </a>
			</div>
			<div class="tabs-content">
				<?php
					if ( method_exists( $this, $method_to_call ) )
						call_user_func( array( $this, $method_to_call ) );
					else
						echo '<h1>' . __( 'Página não encontrada.', 'hfio' ) . '</h1>';
				?>
			</div>
        </div>
        <?php

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

        ?>
        <form action="" method="POST">
            <?php wp_nonce_field( 'hcco_configuracoes', 'hcco_configuracoes_nonce' ); ?>

            <table class="form-table">
                <tr>
                    <th scope="row">Preço do currículo</th>
                    <td>
                        <input type="text" name="preco" id="preco" class="regular-text" placeholder="Ex: 0.00" value="<?php echo $configuracoes['curriculo']['preco']; ?>">
                        <p class="description">Use '.' ao invés de ','</p>
                    </td>
                </tr>
            </table>

            <br><br>                
            <button type="submit" class="button button-primary">Salvar Configurações</button>
        </form>
        <?php

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

        ?>
        <form action="" method="POST">
        <?php wp_nonce_field( 'hcco_configuracoes', 'hcco_configuracoes_nonce' ); ?>
        <div>
            <h3>Modo SandBox</h3>
            <table class="form-table">
                <tr>
                    <th scope="row">Token publico</th>
                    <td>
                        <input type="text" name="mercado_pago_sandbox_public_token" id="mercado_pago_sandbox_public_token" class="regular-text" value="<?php echo $configuracoes['mercado_pago']['sandbox']['public_token']; ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Token de privado</th>
                    <td>
                        <input type="text" name="mercado_pago_sandbox_private_token" id="mercado_pago_sandbox_private_token" class="regular-text" value="<?php echo $configuracoes['mercado_pago']['sandbox']['private_token']; ?>">
                    </td>
                </tr>
            </table>
            <br>
            <h3>Modo Produção</h3>
            <table class="form-table">
                <tr>
                    <th scope="row">Token publico</th>
                    <td>
                        <input type="text" name="mercado_pago_production_public_token" id="mercado_pago_production_public_token" class="regular-text" value="<?php echo $configuracoes['mercado_pago']['production']['public_token']; ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Token privado</th>
                    <td>
                        <input type="text" name="mercado_pago_production_private_token" id="mercado_pago_production_private_token" class="regular-text" value="<?php echo $configuracoes['mercado_pago']['production']['private_token']; ?>">
                    </td>
                </tr>
            </table>
            <br>
            <table class="form-table">
                <tr>
                    <th scope="row">Ambiente</th>
                    <td>
                        <select name="mercado_pago_ambiente" id="mercado_pago_ambiente">
                            <option value="sandbox" <?php echo ($configuracoes['mercado_pago_ambiente'] == 'sandbox') ? 'selected' : ''; ?>>Sandbox</option>
                            <option value="production" <?php echo ($configuracoes['mercado_pago_ambiente'] == 'production') ? 'selected' : ''; ?>>Production</option>
                        </select>
                    </td>
                </tr>
            </table>

            <br><br>                
            <button type="submit" class="button button-primary">Salvar Configurações</button>
        </form>
        <?php

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

        ?>
        <form action="" method="POST">
        <?php wp_nonce_field( 'hcco_configuracoes', 'hcco_configuracoes_nonce' ); ?>
        <div>
            <h3>Tokens do PicPay</h3>
            <table class="form-table">
                <tr>
                    <th scope="row">x-picpay-token</th>
                    <td>
                        <input type="text" name="picpay_x_picpay_token" id="picpay_x_picpay_token" class="regular-text" value="<?php echo $configuracoes['picpay']['x_picpay_token']; ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">x-seller-token</th>
                    <td>
                        <input type="text" name="picpay_x_seller_token" id="picpay_x_seller_token" class="regular-text" value="<?php echo $configuracoes['picpay']['x_seller_token']; ?>">
                    </td>
                </tr>
            </table>

            <br><br>                
            <button type="submit" class="button button-primary">Salvar Configurações</button>
        </form>
        <?php

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
