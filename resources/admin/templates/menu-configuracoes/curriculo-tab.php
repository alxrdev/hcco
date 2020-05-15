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