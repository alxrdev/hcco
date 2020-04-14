<?php

namespace Holos\Hcco\Admin\Menu;

use Holos\Hcco\Mapper\Hcco_Configuracoes_Mapper;

class Hcco_Menu_Configuracoes {

    /**
     * Display Home Page
     */
    public function home() {

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
     * Display curriculo tab
     */
    public function curriculo_tab() {

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
     * Display mercado pago tab
     */
    public function mercado_pago_tab() {

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
     * 
     */
    private function handle_curriculo_form() {

        // pega os parametros
        $preco = sanitize_text_field( $_POST['preco'] );        

        // salva no banco
        $configuracoes = Hcco_Configuracoes_Mapper::save_curriculo_preco( $preco );

        return $configuracoes;

    }

    /**
     * 
     */
    private function handle_mp_form() {

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

}