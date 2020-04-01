
<div class="page-content">
    <div class="site-section">
    </div>
</div>


<div class="page-content">
    <div class="section">
        <h3 class="mb-5 text-center">Selecione um método de pagamento</h3>

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
                                    <button type="button" class="btn btn-primary d-block w-100">Finalizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

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
            </div>
        </div>
    </div>
</div>