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
    </div>
    <br>

    <div>
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
                        <option value="sandbox" <?php echo ($configuracoes['mercado_pago']['ambiente'] == 'sandbox') ? 'selected' : ''; ?>>Sandbox</option>
                        <option value="production" <?php echo ($configuracoes['mercado_pago']['ambiente'] == 'production') ? 'selected' : ''; ?>>Production</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>

    <br><br>                
    <button type="submit" class="button button-primary">Salvar Configurações</button>
</form>