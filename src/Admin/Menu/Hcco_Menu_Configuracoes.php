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
        if ( isset( $_POST['hcco_configuracoes_nonce'] ) && verify_nonce( $_POST['hcco_configuracoes_nonce'], 'hcco_configuracoes' ) ) {

            $configuracoes = $this->handle_form();

        }

        ?>
        <div class="wrap">
            <h1>Configuracoes</h1>

            <form action="" method="POST">
                <?php wp_nonce_field( 'hcco_configuracoes', 'hcco_configuracoes_nonce' ); ?>

                <h3>Curriculo</h3>
                <table class="form-table">
                    <tr>
                        <th scope="row">Preço do currículo</th>
                        <td>
                            <input type="text" name="preco" id="preco" class="regular-text" placeholder="Ex: 0.00" value="<?php echo $configuracoes['preco']; ?>">
                            <p class="description">Use '.' ao invés de ','</p>
                        </td>
                    </tr>
                </table>

                <h3>Mercado Pago</h3>
                <table class="form-table">
                    <tr>
                        <th scope="row">Token de Sandbox</th>
                        <td>
                            <input type="text" name="mercado_pago_sandbox_token" id="mercado_pago_sandbox_token" class="regular-text" value="<?php echo $configuracoes['mercado_pago_sandbox_token']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Token de Produção</th>
                        <td>
                            <input type="text" name="mercado_pago_production_token" id="mercado_pago_production_token" class="regular-text" value="<?php echo $configuracoes['mercado_pago_production_token']; ?>">
                        </td>
                    </tr>
                </table>

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
        $configuracoes['mercado_pago_sandbox_token'] = sanitize_text_field( $_POST['mercado_pago_sandbox_token'] );
        $configuracoes['mercado_pago_production_token'] = sanitize_text_field( $_POST['mercado_pago_production_token'] );

        // salva no banco
        $configuracoes = Hcco_Configuracoes_Mapper::save( $configuracoes );

        return $configuracoes;

    }

}