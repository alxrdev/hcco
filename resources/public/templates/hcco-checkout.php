
<div class="page-content">
    <div class="section">

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
                                        <script src="https://www.mercadopago.com/v2/security.js" view="hcco_checkout"></script>
                                        <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
                                        <img src="<?php echo HCCO_URL . '/resources/public/img/banner-mp.jpg' ?>"
                                        alt="Mercado Pago - Meios de pagamento" title="Mercado Pago - Meios de pagamento" 
                                        class="img-fluid w-100 mb-3" />
                                        
                                        <form action="" method="POST" id="creditCardPaymentForm">
                                            <?php wp_nonce_field( 'pagar_mercado_pago', 'pagar_mercado_pago_nonce' ); ?>
                                            <div class="form-group">
                                                <label for="cardNumber">Numero do cartão</label>
                                                <!-- <input type="text" id="cardNumber" name="cardNumber" data-checkout="cardNumber" class="form-control" placeholder="0000 0000 0000 0000" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off> -->
                                                <div class="input-group">
                                                    <input type="text" id="cardNumber" name="cardNumber" data-checkout="cardNumber" class="form-control" placeholder="0000 0000 0000 0000">
                                                    <span class="input-group-append">
                                                        <img src="/wp-content/plugins/hcco/resources/public/img/credit-card.svg" id="creditCardPaymentInputIcon">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="cardholderName">Nome no cartão</label>
                                                <input type="text" id="cardholderName" name="cardholderName" data-checkout="cardholderName" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="docNumber">CPF</label>
                                                <input type="text" id="docNumber" name="docNumber" data-checkout="docNumber" class="form-control" placeholder="000 000 000 00" >
                                                <input type="hidden" id="docType" data-checkout="docType" value="CPF">
                                            </div>
                                            <div class="form-row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="expirationMonth">Data de validade</label>
                                                        <div class="input-group">
                                                            <input type="text" id="cardExpirationMonth" name="cardExpirationMonth" data-checkout="cardExpirationMonth" class="form-control" placeholder="MM" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
                                                            <input type="text" id="cardExpirationYear" name="cardExpirationYear" data-checkout="cardExpirationYear" class="form-control" placeholder="AAAA" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="securityCode">Código CVC</label>
                                                        <div class="input-group">
                                                            <input type="text" id="securityCode" name="securityCode" data-checkout="securityCode" class="form-control" placeholder="CVC" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
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
                                    </div>
                                </div>
                                <!-- Crédit Card -->

                                <!-- PicPay -->
                                <div class="tab-pane fade" id="hcco-payment-picpay" role="tabpanel" aria-labelledby="hcco-payment-picpay-tab">
                                    <div class="hcco-payment-method-content">
                                        <img src="<?php echo HCCO_URL; ?>/resources/public/img/banner-picpay.svg" alt="Banner PicPay">
                                        <h4>Pague com PicPay, direto do seu celular.</h4>
                                        <p>Ao clicar em pagar, você será redirecionado para a página do PicPay e um código será exibido. Para pagar, basta escanear o código com seu PicPay.</p>
                                        
                                        <form action="" method="POST" id="picPayPaymentForm">
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
</div>