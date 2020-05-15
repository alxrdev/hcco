<form action="" method="POST">
    <?php wp_nonce_field( 'hcco_configuracoes', 'hcco_configuracoes_nonce' ); ?>
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