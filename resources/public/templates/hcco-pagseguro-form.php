<!-- MP Script -->
<script src="https://www.mercadopago.com/v2/security.js" view="<?php echo esc_url( home_url() . '/finalizar-o-cadastro-do-curriculo' ); ?>"></script>
<img src="<?php echo HCCO_URL . '/resources/public/img/banner-mp.jpg' ?>" alt="Mercado Pago - Meios de pagamento" title="Mercado Pago - Meios de pagamento" class="img-fluid w-100 mb-3" />
<h4>Pague com cartão de crédito.</h4>
<p>Ao clicar em pagar, você será redirecionado para a página do Mercado Pago. Para pagar, basta preencher os dados corretamente.</p>

<form action="<?php echo esc_url( '/finalizar-o-cadastro-do-curriculo/?uih=' . $_COOKIE['user_id_hash'] . '&pagar_pagseguro_nonce=' . wp_create_nonce( 'pagar_pagseguro' ) ); ?>" method="POST">
    <script
        src="https://www.mercadopago.com.br/integrations/v1/web-tokenize-checkout.js"
        data-public-key="<?php echo \Holos\Hcco\Mapper\Hcco_Configuracoes_Mapper::get_mercado_pago_access_tokens()['public_token']; ?>"
        data-transaction-amount="<?php echo $pedido->get_preco(); ?>"
        data-button-label="Pagar R$ <?php echo $pedido->get_preco(); ?>">
    </script>
</form>
