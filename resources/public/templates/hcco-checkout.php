
<div class="holos-section">

    <!-- Container -->
    <div class="container">
        <div class="row justify-content-between">

            <!-- Review -->
            <div class="col-lg-7 pr-lg-5 mb-5 mb-lg-0">
                <h3 class="mb-5">Resumo</h3>

                <div class="hcco-review-section table-responsive">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <th scope="col">Nome:</th>
                            <td scope="row"><?php echo $curriculo->get_nome(); ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Data de nascimento:</th>
                            <td scope="row"><?php echo $curriculo->get_data_nascimento(); ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Sexo:</th>
                            <td scope="row"><?php echo $curriculo->get_sexo(); ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Nacionalidade:</th>
                            <td scope="row"><?php echo $curriculo->get_nacionalidade(); ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Estado civil:</th>
                            <td scope="row"><?php echo $curriculo->get_estado_civil(); ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Filhos:</th>
                            <td scope="row"><?php echo $curriculo->get_filhos(); ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Empregado:</th>
                            <td scope="row"><?php echo $curriculo->get_empregado(); ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Escolaridade:</th>
                            <td scope="row"><?php echo $curriculo->get_escolaridade(); ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Telefone:</th>
                            <td scope="row"><?php echo $curriculo->get_telefone_1(); ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Email:</th>
                            <td scope="row"><?php echo $curriculo->get_email(); ?></td>
                        </tr>
                        <tr>
                            <th scope="col">CEP:</th>
                            <td scope="row"><?php echo $curriculo->get_cep(); ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Estado:</th>
                            <td scope="row"><?php echo $curriculo->get_estado(); ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Cidade:</th>
                            <td scope="row"><?php echo $curriculo->get_cidade(); ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Endereco:</th>
                            <td scope="row"><?php echo $curriculo->get_endereco(); ?></td>
                        </tr>
                    </table>

                    <a class="btn btn-primary" href="<?php echo esc_html( home_url( '/cadastro-de-curriculo' ) ); ?>">Alterar</a>
                </div>
            </div>
            <!-- Review -->

            <!-- Pagamento -->
            <div class="col-lg-5">
                <h3 class="mb-5">Pagamento</h3>

                <?php
                // se houver algum erro
                if ( $error == true ) :
                    ?>
                    <div class="alert alert-danger">
                        <p style="font-size:0.75rem;">
                            <?php
                            foreach ( $messages as $message ) :

                                echo '<p>' . $message . '</p>';

                            endforeach;
                            ?>
                        </p>
                    </div>
                    <?php
                endif;
                ?>

                <div class="hcco-payment-section">
                    <!-- Payment Tabs -->
                    <div class="hcco-payment-tabs">
                        <ul class="nav nav-pills" id="hcco-payment-tabs-list" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="hcco-payment-cc-tab" data-toggle="pill" href="#hcco-payment-cc" role="tab" aria-controls="hcco-payment-cc" aria-selected="true">
                                    <img src="<?php echo HCCO_URL ?>/resources/public/img/credit-card.svg" alt="icon credit card"> <span>Cartão de crédito</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="hcco-payment-picpay-tab" data-toggle="pill" href="#hcco-payment-picpay" role="tab" aria-controls="hcco-payment-picpay" aria-selected="false">
                                    <img src="<?php echo HCCO_URL ?>/resources/public/img/picpay-icon.svg" alt="icon picpay"> <span>PicPay</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Payment Tabs -->

                    <!-- Payment Methods -->
                    <div class="hcco-payment-methods">
                        <div class="tab-content" id="pills-tabContent">

                            <!-- Crédit Card -->
                            <div class="tab-pane fade show active" id="hcco-payment-cc" role="tabpanel" aria-labelledby="hcco-payment-cc-tab">
                                <div class="hcco-payment-method-content">
                                    <!-- MP Script -->
                                    <script src="https://www.mercadopago.com/v2/security.js" view="checkout"></script>
                                    <img src="<?php echo HCCO_URL . '/resources/public/img/banner-mp.jpg' ?>" alt="Mercado Pago - Meios de pagamento" title="Mercado Pago - Meios de pagamento" class="img-fluid w-100 mb-3" />
                                    <h4>Pague com cartão de crédito.</h4>
                                    <p>Ao clicar em pagar, você será redirecionado para a página do Mercado Pago. Para pagar, basta preencher os dados corretamente.</p>

                                    <form action="<?php echo esc_url( '/finalizar-o-cadastro-do-curriculo/?uih=' . $_COOKIE['user_id_hash'] . '&pagar_mercado_pago_tokenize_nonce=' . wp_create_nonce( 'pagar_mercado_pago_tokenize' ) ); ?>" method="POST">
                                    <script
                                        src="https://www.mercadopago.com.br/integrations/v1/web-tokenize-checkout.js"
                                        data-public-key="<?php echo \Holos\Hcco\Mapper\Hcco_Configuracoes_Mapper::get_mercado_pago_access_tokens()['public_token']; ?>"
                                        data-transaction-amount="<?php echo $pedido->get_preco(); ?>"
                                        data-button-label="Pagar R$ <?php echo $pedido->get_preco(); ?>">
                                    </script>
                                    </form>
                                </div>
                            </div>
                            <!-- Crédit Card -->

                            <!-- PicPay -->
                            <div class="tab-pane fade" id="hcco-payment-picpay" role="tabpanel" aria-labelledby="hcco-payment-picpay-tab">
                                <div class="hcco-payment-method-content">
                                    <img src="<?php echo HCCO_URL; ?>/resources/public/img/banner-picpay.svg" alt="Banner PicPay">
                                    <h4>Pague com PicPay, direto do seu celular.</h4>
                                    <p>Ao clicar em pagar, você será redirecionado para a página do PicPay e um código será exibido. Para pagar, basta escanear o código com seu PicPay.</p>
                                    
                                    <form action="<?php echo esc_url( home_url( '/' ) . '/finalizar-o-cadastro-do-curriculo' ); ?>" method="POST" id="picPayPaymentForm">
                                        <?php wp_nonce_field( 'pagar_picpay', 'pagar_picpay_nonce' ); ?>
                                        <div class="form-group">
                                            <label for="picPayCpf">CPF</label>
                                            <input type="text" name="picPayCpf" id="picPayCpf" class="form-control" placeholder="000.000.000-00" maxlength="14" required="true">
                                        </div>
                                        <button class="btn btn-lg d-block w-100 hcco-picpay-button"><i class="fas fa-lock"></i> Pagar R$ <?php echo $pedido->get_preco(); ?></button>
                                    </form>
                                </div>
                            </div>
                            <!-- PicPay -->

                        </div>
                    </div>
                    <!-- Payment Methods -->                        
                </div>
            </div>
            <!-- Pagamento -->

        </div>
    </div>
    <!-- Container -->

</div>