var amount = $('#amount').val();
payment();

function payment() {
    $.ajax({
        url: BASE_URL + 'functions/pagseguro-transparente/payment',
        type: 'post',
        dataType: 'json',
        beforeSend: function() {
            $('.listPayments').html(loadingRes("Criando sessão..."));
        },
        success: function(sessionId) {
            // console.log(sessionId);
            PagSeguroDirectPayment.setSessionId(sessionId.id);
        },
        complete: function() {
            listDirectPayment();
        }
    });
}

function listDirectPayment() {
    PagSeguroDirectPayment.getPaymentMethods({
        amount: amount,
        beforeSend: function() {
            $('.listPayments').html(loadingRes("Buscando meios de pagamento..."));
        },
        success: function(response) {
            // Buscando Cartões de Crédito
            $('.listPayments').html(`<h4>Cartão de Crédito</h4>`);
            $.each(response.paymentMethods.CREDIT_CARD.options, function(i, obj) {
                $('.listPayments').append(`<span><img src="https://stc.pagseguro.uol.com.br` + obj.images.SMALL.path + `"/></span>`);
            });

            // Buscando Boleto
            $('.listPayments').append(`
                <h4>Boleto</h4>
                <span><img src="https://stc.pagseguro.uol.com.br` + response.paymentMethods.BOLETO.options.BOLETO.images.SMALL.path + `"/></span>
            `);
            
            $('#bankName').html(`<option value="*000*">...</option>`);

            // Buscando Débitos Online
            $('.listPayments').append(`<h4>Débito Online</h4>`);
            $.each(response.paymentMethods.ONLINE_DEBIT.options, function(i, obj) {
                $('.listPayments').append(`<span><img src="https://stc.pagseguro.uol.com.br` + obj.images.SMALL.path + `"/></span>`);
                $('#bankName').append(`<option value="` + obj.name + `">` + obj.displayName + `</option>`);
            });
        },
        error: function(response) {
            // Callback para chamadas que falharam.
        },
        complete: function(response) {
            
        }
    });
}

$('[name=paymentMethod]').change(function(e) {
    e.preventDefault();
    var dado = $(this).val();
    if(dado == "creditCard") {
        $('.divDebitoOnline').css({'display':'none'});
        $('.CardsData').css({'display':'block'});
    } else if (dado == "boleto") {
        $('.divDebitoOnline').css({'display':'none'});
        $('.CardsData').css({'display':'none'});
    } else {
        $('.divDebitoOnline').css({'display':'block'});
        $('.CardsData').css({'display':'none'});
    }
});

$('[name=billingAddress]').change(function(e) {
    e.preventDefault();
    var dado = $(this).val();
    if(!dado) {
        $('.divEndFatura').hide().fadeOut('slow');
        $('.divOtherEndFatura').show().fadeIn('slow');
    } else {
        $('.divOtherEndFatura').hide().fadeOut('slow');
        $('.divEndFatura').show().fadeIn('slow');
    }
});

$('#inputNumCard').keyup(function(e) {
    e.preventDefault();

    var numCard = $(this).val();
    var qtdNum = numCard.length;

    if(qtdNum >= 6) {
        $('.brandCard').html(loadingResSmall("Buscando bandeira..."));
        PagSeguroDirectPayment.getBrand({
            cardBin: numCard,
            success: function(response) {
                var imgBrand = response.brand.name;
                $('.brandCard').html(`<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/42x20/` + imgBrand + `.png"/>`);

                $('#inputBrandCard').val(imgBrand);
                getParcelas(imgBrand);
            },
            error: function() {
                $('.brandCard').html(`<small>Cartão inválido!</small>`);
                $('#inputBrandCard').val(``);
                $('#selQtdParc').html(``);
                $('#selQtdParc').attr('disabled', true);
            },
            complete: function(response) {
                //tratamento comum para todas chamadas
            }
        });
    } else {
        $('.brandCard').html(``);
        $('#selQtdParc').html(``);
        $('#selQtdParc').attr('disabled', true);
        $('#inputBrandCard').val(``);
    }
});

// RECUPERANDO A QUANTIDADE DE PARCELAS E SEUS RESPECTIVOS VALORES
function getParcelas(brand) {
    var maxInstallment = 2;
    PagSeguroDirectPayment.getInstallments({
        amount: amount,
        maxInstallmentNoInterest: maxInstallment,
        brand: brand,
        success: function(response) {
            $('#selQtdParc').attr('disabled', false);
            $('#selQtdParc').show().html(`
                <option value="*000*">...</option>
            `);
            var c = 1;
            $.each(response.installments, function(ia, obja) {
                $.each(obja, function(ib, objb) {
                    var valorParc = objb.installmentAmount.toFixed(2).replace(".", ","); // Padrão BR
                    var totalAmount = objb.totalAmount.toFixed(2).replace(".", ","); // Padrão BR
                    var valorParcDouble = objb.installmentAmount.toFixed(2); // Com 2 casas decimais

                    if(c <= maxInstallment) {
                        $('#selQtdParc').append(`
                            <option value="` + objb.quantity + `" data-parcelas="` + valorParcDouble + `">` + objb.quantity + ` x R$ ` + valorParc + ` = R$ ` + totalAmount + ` sem acréscimo</option>
                        `);
                    } else {
                        $('#selQtdParc').append(`
                            <option value="` + objb.quantity + `" data-parcelas="` + valorParcDouble + `">` + objb.quantity + ` x R$ ` + valorParc + ` = R$ ` + totalAmount + `</option>
                        `);
                    }
                    c++;
                });
            });
        },
        error: function(response) {
            // callback para chamadas que falharam.
        },
        complete: function(response) {
            // Callback para todas chamadas.
        }
    });
}

// ENVIANDO O VALOR DA PARCELA PARA O FORMULÁRIO
$('#selQtdParc').change(function(e) {
    e.preventDefault();
    $('#inputParcValue').val($(this).find(":selected").attr("data-parcelas"));
});

$('#formBuyPagSeguro').submit(function(e) {
    e.preventDefault();
    var paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;

    if(paymentMethod == "creditCard") {
        // RECUPERANDO TOKEN DO CARTÃO DE CRÉDITO
        PagSeguroDirectPayment.createCardToken({
            cardNumber: $('#inputNumCard').val(), // Número do cartão de crédito
            brand: $('#inputBrandCard').val(), // Bandeira do cartão
            cvv: $('#inputCvvCard').val(), // CVV do cartão
            expirationMonth: $('#inputMonthValid').val(), // Mês da expiração do cartão
            expirationYear: $('#inputYearValid').val(), // Ano da expiração do cartão, é necessário os 4 dígitos.
            success: function(response) {
                $('.help-card').html(``);
                $('#inputTokenCard').val(response.card.token);
                recupHash();
            },
            error: function(response) {
                console.log(response);
                $.each(response.errors, function(i, obj) {
                    $('.help-card').html(`<p>Erro ` + i + ` - ` + obj + `</p>`);
                });
                return false;
            },
            complete: function(response) {

            }
        });
    } else if(paymentMethod == "boleto") {
        recupHash();
    } else {
        recupHash();
    }

    return false;
});

function recupHash() {
    // RECUPERANDO O HASH DO CARTÃO
    PagSeguroDirectPayment.onSenderHashReady(function(response){
        if(response.status == 'error') {
            console.log(response.message);
            return false;
        } else {
            $('#inputHashSender').val(response.senderHash);
            var dataForm = $('#formBuyPagSeguro').serialize();

            $.ajax({
                type: 'post',
                url: BASE_URL + 'functions/pagseguro-transparente/processPurchase',
                data: dataForm,
                dataType: 'json',
                beforeSend: function() {

                },
                success: function(response) {
                    if(response.dados.paymentMethod.type == 1) {

                    } else if(response.dados.paymentMethod.type == 2) {
                        $('#answer').html(`
                            <p>Transação realizada com sucesso</p>
                            <a target="_blank" href="` + response.dados.paymentLink + `">Gerar boleto</a>
                        `);
                    } else {
                        window.open(response.dados.paymentLink);
                    }
                },
                error: function() {
                    $('#answer').html(`
                        <p>Erro ao realizar a transação</p>
                    `);
                }
            });
        }
    });
}