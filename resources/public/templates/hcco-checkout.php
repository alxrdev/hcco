
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
                                    <img src="<?php echo HCCO_URL ?>/resources/public/img/credit-card.svg" alt="icon credit card"> <span>Cartão de crédito ou Boleto</span>
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
                                    <img class="payment-banner" src="//assets.pagseguro.com.br/ps-integration-assets/banners/divulgacao/468X60_10X_pagseguro.gif" alt="Banner PagSeguro" title="Parcele suas compras em até 18x">
                                    <h4 class="payment-title">Pague com cartão de crédito ou boleto.</h4>
                                    <p>Ao clicar em pagar, você será redirecionado para a página do <b>PagSeguro</b>. Para pagar, basta preencher os dados corretamente.</p>
                                    <p>Assim que o pagamento for confirmado, você receberar uma mensagem no email cadastrado, notificando a realização do pagamento.</p>
                                    <button id="pagarPSButton" class="btn btn-lg d-block w-100 mercadopago-button"><i class="fas fa-lock"></i> Pagar R$ <?php echo $pedido->get_preco(); ?></button>
                                    
                                    <input type="hidden" id="pagSeguroCheckoutNonce" value="<?php echo wp_create_nonce( 'pagseguro_checkout' ); ?>">
                                    <input type="hidden" id="pedidoId" value="<?php echo $pedido->get_id(); ?>">
                                    
                                    <!-- PagSeguro Script -->
                                    <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
                                    <script type="text/javascript">
                            
                                        const pagarPSButton = document.getElementById('pagarPSButton');
                                        const pagSeguroCheckoutNonce = document.getElementById('pagSeguroCheckoutNonce');
                                        const pedidoId = document.getElementById('pedidoId');

                                        pagarPSButton.addEventListener('click', () => {
                                            getAuthorizationId()
                                                .then(response => {
                                                    if (response.success) {
                                                        // location.href = `https://pagseguro.uol.com.br/v2/checkout/payment.html?code=${response.data}`
                                                        openLightbox(response.data)
                                                    }
                                                })
                                        })

                                        // Obter Autorização
                                        function getAuthorizationId() {
                                            return new Promise((resolve, reject) => {
                                                httpRequest = new XMLHttpRequest()
                                                httpRequest.onreadystatechange = () => {
                                                    if (httpRequest.readyState === XMLHttpRequest.DONE && httpRequest.status === 200) {
                                                        resolve(JSON.parse(httpRequest.responseText))
                                                    }
                                                }

                                                httpRequest.open('POST', `${hcco_ajax_object.ajax_url}`)
                                                httpRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
                                                httpRequest.send(`action=${hcco_ajax_object.generate_pagseguro_checkout_code}&pagseguro_checkout_nonce=${pagSeguroCheckoutNonce.value}&pedidoId=${pedidoId.value}`)
                                            })
                                        }

                                        // Open lightbox
                                        function openLightbox(code) {
                                            const callback = {
                                                success : function(transactionCode) {
                                                    setTimeout(() => {
                                                        location.href = `https://holoscdh.com.br/cadastro-do-curriculo-finalizado`
                                                    }, 1500)
                                                },
                                                abort : function() {
                                                    console.log("abortado")
                                                }
                                            }
                                            
                                            const isOpenLightbox = PagSeguroLightbox(code, callback);

                                            if (!isOpenLightbox){
                                                location.href = `https://pagseguro.uol.com.br/v2/checkout/payment.html?code=${code}`
                                            }
                                        }
                                    </script>
                                </div>
                            </div>
                            <!-- Crédit Card -->

                            <!-- PicPay -->
                            <div class="tab-pane fade" id="hcco-payment-picpay" role="tabpanel" aria-labelledby="hcco-payment-picpay-tab">
                                <div class="hcco-payment-method-content">
                                    <img class="payment-banner" src="<?php echo HCCO_URL; ?>/resources/public/img/banner-picpay.svg" alt="Banner PicPay">
                                    <h4 class="payment-title">Pague com PicPay, direto do seu celular.</h4>
                                    <p>Ao clicar em pagar, você será redirecionado para a página do PicPay e um código será exibido. Para pagar, basta escanear o código com seu PicPay.</p>
                                    
                                    <form action="<?php echo esc_url( home_url( '/finalizar-o-cadastro-do-curriculo/' ) . '?pagar_picpay_nonce=' . wp_create_nonce( 'pagar_picpay' ) ); ?>" method="POST" id="picPayPaymentForm">
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