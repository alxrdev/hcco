
<div class="page-content">
    <div class="section">

        <!-- Container -->
        <div class="container">
            <div class="row justify-content-between">
                <!-- Review -->
                <div class="col-lg-7 pr-lg-5 mb-5 mb-lg-0">
                    <h3 class="mb-5">Pequeno resumo do seu currículo</h3>

                    <div class="review-curriculo table-responsive">
                        <table class="table">
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

                <!-- Pagamento -->
                <div class="col-lg-5">
                    <h3 class="mb-5">Escolha uma forma de pagamento</h3>

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

                    <div class="d-flex justify-content-center">
                        <div class="payment-methods mb-5" id="paymentMethods">

                            <!-- Cartão de Credito -->
                            <div class="payment-item">
                                <div class="payment-item-header" id="paymentItemHeaderCreditCard">
                                    <button type="button" class="btn btn-link payment-item-button" data-toggle="collapse" data-target="#paymentItemCreditCard" aria-expanded="true" aria-controls="paymentItemCreditCard">
                                        Cartão de crédito
                                        <img src="https://yevgenysim.github.io/shopper/assets/img/brands/color/cards.svg" alt="" class="ml-2">
                                    </button>
                                </div>
                                <div id="paymentItemCreditCard" class="collapse show" aria-labelledby="paymentItemHeaderCreditCard" data-parent="#paymentMethods">
                                    <div class="payment-item-content">
                                        <!-- MP Script -->
                                        <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
                                        <img src="https://imgmp.mlstatic.com/org-img/MLB/MP/BANNERS/tipo2_468X60.jpg?v=1" 
                                        alt="Mercado Pago - Meios de pagamento" title="Mercado Pago - Meios de pagamento" 
                                        class="img-fluid w-100 mb-3" />
                                        
                                        <form action="#" method="POST" id="creditCardPaymentForm">
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
                                                <button type="submit" class="btn btn-primary d-block w-100"><i class="fas fa-lock"></i> Pagar R$ <?php echo $pedido->get_preco(); ?></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Cartão de Crédito -->

                            <!-- Picpay -->
                            <div class="payment-item">
                                <div class="payment-item-header" id="paymentItemHeaderPicpay">
                                    <h5>
                                        <button type="button" class="btn btn-link payment-item-button collapsed" data-toggle="collapse" data-target="#paymentItemPicpay" aria-expanded="false" aria-controls="paymentItemPicpay">Picpay</button>
                                    </h5>
                                </div>
                                <div id="paymentItemPicpay" class="collapse" aria-labelledby="paymentItemHeaderPicpay" data-parent="#paymentMethods">
                                    <div class="payment-item-content">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum, atque.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Picpay -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Container -->
    </div>
</div>