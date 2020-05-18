<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
<form action="<?php echo esc_url( home_url( '/' ) . 'finalizar-o-cadastro-do-curriculo/?pagar_mercado_pago_api_nonce=' . wp_create_nonce( 'pagar_mercado_pago_api' ) ); ?>" method="POST" id="creditCardPaymentForm">
    <div class="form-group">
        <label for="cardNumber">Numero do cartão</label>
        <div class="input-group">
            <label for="cardNumber" class="error" id="cardNumberError"></label>
            <input type="text" id="cardNumber" data-checkout="cardNumber" class="form-control" placeholder="0000 0000 0000 0000" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
            <span class="input-group-append">
                <img src="/wp-content/plugins/hcco/resources/public/img/credit-card.svg" id="creditCardPaymentInputIcon">
            </span>
        </div>
    </div>
    <div class="form-group">
        <label for="cardholderName">Nome no cartão</label>
        <input type="text" id="cardholderName" data-checkout="cardholderName" class="form-control">
    </div>
    <div class="form-group">
        <label for="docNumber">CPF</label>
        <input type="text" id="docNumber" data-checkout="docNumber" class="form-control" placeholder="000 000 000 00" >
        <input type="hidden" id="docType" data-checkout="docType" value="CPF">
    </div>
    <div class="form-row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="expirationMonth">Data de validade</label>
                <div class="input-group">
                    <input type="text" id="cardExpirationMonth" data-checkout="cardExpirationMonth" class="form-control" placeholder="MM" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
                    <input type="text" id="cardExpirationYear" data-checkout="cardExpirationYear" class="form-control" placeholder="AAAA" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="securityCode">Código CVC/CVV</label>
                <div class="input-group">
                    <input type="text" id="securityCode" data-checkout="securityCode" class="form-control" placeholder="CVC" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
                    <span class="input-group-append">
                        <img src="/wp-content/plugins/hcco/resources/public/img/security-code.svg" id="creditCardPaymentInputIcon">
                    </span>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="amount" id="amount" value="<?php echo $pedido->get_preco(); ?>" />
    <input type="hidden" name="paymentMethodId" />

    <div class="form-group">
        <button type="submit" class="btn btn-lg btn-primary d-block w-100"><i class="fas fa-lock"></i> Pagar R$ <?php echo $pedido->get_preco(); ?></button>
    </div>
</form>