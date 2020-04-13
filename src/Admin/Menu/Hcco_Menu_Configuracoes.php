<?php

namespace Holos\Hcco\Admin\Menu;

use Holos\Hcco\Mapper\Hcco_Configuracoes_Mapper;

class Hcco_Menu_Configuracoes {

    /**
     * Display Home Page
     */
    public function home() {

        $configuracoes = Hcco_Configuracoes_Mapper::fetch();

        // verifica se o formulario foi enviado
        if ( isset( $_POST['hcco_configuracoes_nonce'] ) && wp_verify_nonce( $_POST['hcco_configuracoes_nonce'], 'hcco_configuracoes' ) ) {

            $configuracoes = $this->handle_form( $configuracoes );

        }

        ?>
        <div class="wrap">
            <h1>Configuracoes</h1>

            <form action="" method="POST">
                <?php wp_nonce_field( 'hcco_configuracoes', 'hcco_configuracoes_nonce' ); ?>

                <div>
                    <h2>Curriculo</h2>
                    <table class="form-table">
                        <tr>
                            <th scope="row">Preço do currículo</th>
                            <td>
                                <input type="text" name="preco" id="preco" class="regular-text" placeholder="Ex: 0.00" value="<?php echo $configuracoes['preco']; ?>">
                                <p class="description">Use '.' ao invés de ','</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div>
                    <br><br>
                    <h2>Mercado Pago</h2>
                    <h3>Modo SandBox</h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row">Token publico</th>
                            <td>
                                <input type="text" name="mercado_pago_sandbox_public_token" id="mercado_pago_sandbox_public_token" class="regular-text" value="<?php echo $configuracoes['mercado_pago_sandbox_public_token']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Token de privado</th>
                            <td>
                                <input type="text" name="mercado_pago_sandbox_private_token" id="mercado_pago_sandbox_private_token" class="regular-text" value="<?php echo $configuracoes['mercado_pago_sandbox_private_token']; ?>">
                            </td>
                        </tr>
                    </table>
                    <br>
                    <h3>Modo Produção</h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row">Token publico</th>
                            <td>
                                <input type="text" name="mercado_pago_production_public_token" id="mercado_pago_production_public_token" class="regular-text" value="<?php echo $configuracoes['mercado_pago_production_public_token']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Token privado</th>
                            <td>
                                <input type="text" name="mercado_pago_production_private_token" id="mercado_pago_production_private_token" class="regular-text" value="<?php echo $configuracoes['mercado_pago_production_private_token']; ?>">
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table class="form-table">
                        <tr>
                            <th scope="row">Ambiente</th>
                            <td>
                                <select name="mercado_pago_ambiente" id="mercado_pago_ambiente">
                                    <option value="SandBox" <?php echo ($configuracoes['mercado_pago_ambiente'] == 'SandBox') ? 'selected' : ''; ?>>SandBox</option>
                                    <option value="Production" <?php echo ($configuracoes['mercado_pago_ambiente'] == 'Production') ? 'selected' : ''; ?>>Production</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>

                <br><br>                
                <button type="submit" class="button button-primary">Salvar Configurações</button>
            </form>
        </div>
        <?php

    }

    /**
     * 
     */
    private function handle_form( $configuracoes ) {

        // pega os parametros
        $configuracoes['preco'] = sanitize_text_field( $_POST['preco'] );
        $configuracoes['mercado_pago_sandbox_public_token'] = sanitize_text_field( $_POST['mercado_pago_sandbox_public_token'] );
        $configuracoes['mercado_pago_sandbox_private_token'] = sanitize_text_field( $_POST['mercado_pago_sandbox_private_token'] );
        $configuracoes['mercado_pago_production_public_token'] = sanitize_text_field( $_POST['mercado_pago_production_public_token'] );
        $configuracoes['mercado_pago_production_private_token'] = sanitize_text_field( $_POST['mercado_pago_production_private_token'] );
        $configuracoes['mercado_pago_ambiente'] = sanitize_text_field( $_POST['mercado_pago_ambiente'] );

        // salva no banco
        $configuracoes = Hcco_Configuracoes_Mapper::save( $configuracoes );

        return $configuracoes;

    }

}