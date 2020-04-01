
<div class="page-content">
    <div class="section">

        <!-- Container -->
        <div class="container">
            <div class="row justify-content-between">
                <!-- Review -->
                <div class="col-lg-7 pr-lg-5 mb-5 mb-lg-0">
                    <h3 class="mb-5">Pequeno resumo do seu currículo</h3>

                    <div class="review-curriculo">
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
                    <h3 class="mb-5">Selecione um método de pagamento</h3>

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
                                        <form action="#">
                                            <div class="form-group">
                                                <label for="cardNumber">Numero do cartão</label>
                                                <input type="text" id="cardNumber" class="form-control" placeholder="xxxx xxxx xxxx xxxx">
                                            </div>
                                            <div class="form-group">
                                                <label for="cardholderName">Nome no cartão</label>
                                                <input type="text" id="cardholderName" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="docNumber">CPF</label>
                                                <input type="text" id="docNumber" class="form-control" placeholder="xxx xxx xxx xx">
                                            </div>
                                            <div class="form-row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="expirationDate">Data de validade</label>
                                                        <input type="text" id="expirationDate" class="form-control" placeholder="MM/AA">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="securityCode">Código CVV</label>
                                                        <input type="text" id="securityCode" class="form-control" placeholder="CVV">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary d-block w-100"><b>Pagar R$ <?php echo $pedido->get_preco(); ?></b></button>
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