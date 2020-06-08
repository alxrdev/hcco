<form action="" method="POST">
    <?php wp_nonce_field( 'hcco_configuracoes', 'hcco_configuracoes_nonce' ); ?>
    <div>
        <h3>Modo SandBox</h3>
        <table class="form-table">
            <tr>
                <th scope="row">Email do vendedor</th>
                <td>
                    <input type="email" name="pagseguro_sandbox_email" id="pagseguro_sandbox_email" class="regular-text" value="<?php echo $configuracoes['pagseguro']['sandbox']['email']; ?>">
                </td>
            </tr>
            <tr>
                <th scope="row">Token de SandBox</th>
                <td>
                    <input type="text" name="pagseguro_sandbox_token" id="pagseguro_sandbox_token" class="regular-text" value="<?php echo $configuracoes['pagseguro']['sandbox']['token']; ?>">
                </td>
            </tr>
        </table>
    </div>
    <br>

    <div>
        <h3>Modo Produção</h3>
        <table class="form-table">
            <tr>
                <th scope="row">Email do vendedor</th>
                <td>
                    <input type="email" name="pagseguro_production_email" id="pagseguro_production_email" class="regular-text" value="<?php echo $configuracoes['pagseguro']['production']['email']; ?>">
                </td>
            </tr>
            <tr>
                <th scope="row">Token de Produção</th>
                <td>
                    <input type="text" name="pagseguro_production_token" id="pagseguro_production_token" class="regular-text" value="<?php echo $configuracoes['pagseguro']['production']['token']; ?>">
                </td>
            </tr>
        </table>
        <br>
        <table class="form-table">
            <tr>
                <th scope="row">Ambiente</th>
                <td>
                    <select name="pagseguro_ambiente" id="pagseguro_ambiente">
                        <option value="sandbox" <?php echo ($configuracoes['pagseguro']['ambiente'] == 'sandbox') ? 'selected' : ''; ?>>Sandbox</option>
                        <option value="production" <?php echo ($configuracoes['pagseguro']['ambiente'] == 'production') ? 'selected' : ''; ?>>Production</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>

    <br><br>                
    <button type="submit" class="button button-primary">Salvar Configurações</button>
</form>