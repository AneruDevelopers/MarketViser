var amount = "600.00";
getPurchase();
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
            
            // Buscando Débitos Online
            $('.listPayments').append(`<h4>Débito Online</h4>`);
            $.each(response.paymentMethods.ONLINE_DEBIT.options, function(i, obj) {
                $('.listPayments').append(`<span><img src="https://stc.pagseguro.uol.com.br` + obj.images.SMALL.path + `"/></span>`);
            });
        },
        error: function(response) {
            // Callback para chamadas que falharam.
        },
        complete: function(response) {
            
        }
    });
}

function getPurchase() {
    $.ajax({
        dataType: 'json',
        url: BASE_URL + 'functions/pagseguro-transparente/getPurchase',
        beforeSend: function() {
            $('.infComp').html(loadingResSmall("Buscando cliente..."));
            $('.endComp').html(loadingResSmall("Buscando endereço da entrega..."));
            $('.agendComp').html(loadingResSmall("Buscando agendamento da entrega..."));
        },
        success: function(response) {
            if(response['status']) {
                $('.infComp').html(`
                    <b>Nome: </b>` + response['client'].usu_nome + ` ` + response['client'].usu_sobrenome + `<br/>
                    <b>CPF: </b>` + response['client'].usu_cpf + `<br/>
                    <b>Telefone: </b>` + response['client'].tel_ddd + ` ` + response['client'].tel_num + `<br/>
                    <b>Email: </b>` + response['client'].usu_email + `

                    <input type="hidden" name="inputSenderName" id="inputSenderName" value="` + response['client'].usu_nome + ` ` + response['client'].usu_sobrenome + `"/>
                    <input type="hidden" name="inputSenderCPF" id="inputSenderCPF" value="` + response['client'].usu_cpf + `"/>
                    <input type="hidden" name="inputSenderDDD" id="inputSenderDDD" value="` + response['client'].tel_ddd + `"/>
                    <input type="hidden" name="inputSenderNum" id="inputSenderNum" value="` + response['client'].tel_num  + `"/>
                    <input type="hidden" name="inputSenderEmail" id="inputSenderEmail" value="` + response['client'].usu_email + `"/>
                `);
                
                $('.endComp').html(`
                    ` + response['end_entrega'][0] + `<br/>
                    ` + response['end_entrega'][1] + ` nº ` + response['end_entrega'][2] + `
                    ` + ((response['end_entrega'][3] != "") ? `, ` + response['end_entrega'][3] : ``) + `
                    ` + response['end_entrega'][4] + `
                    ` + response['end_entrega'][5] + ` - ` + response['end_entrega'][6] + `

                    <input type="hidden" name="shippingAddressRequired" id="shippingAddressRequired" value="true"/>
                    <input type="hidden" name="shippingAddressPostalCode" id="shippingAddressPostalCode" value="` + response['end_entrega'][0] + `"/>
                    <input type="hidden" name="shippingAddressStreet" id="shippingAddressStreet" value="` + response['end_entrega'][1] + `"/>
                    <input type="hidden" name="shippingAddressNumber" id="shippingAddressNumber" value="` + response['end_entrega'][2] + `"/>
                    <input type="hidden" name="shippingAddressComplement" id="shippingAddressComplement" value="` + response['end_entrega'][3]  + `"/>
                    <input type="hidden" name="shippingAddressDistrict" id="shippingAddressDistrict" value="` + response['end_entrega'][4]  + `"/>
                    <input type="hidden" name="shippingAddressCity" id="shippingAddressCity" value="` + response['end_entrega'][5]  + `"/>
                    <input type="hidden" name="shippingAddressState" id="shippingAddressState" value="` + response['end_entrega'][6]  + `"/>
                    <input type="hidden" name="shippingAddressCountry" id="shippingAddressCountry" value="BRA"/>
                `);
                
                $('.agendComp').html(`
                    <b>Nome: </b>` + response['client'].usu_nome + ` ` + response['client'].usu_sobrenome + `<br/>
                `);
            } else {
                return false;
            }
        }
    });
}

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
            },
            complete: function(response) {
                //tratamento comum para todas chamadas
            }
        });
    } else {
        $('.brandCard').html(``);
        $('#selQtdParc').html(``);
        $('#selQtdParc').attr('disabled', true);
    }
});

// RECUPERANDO A QUANTIDADE DE PARCELAS E SEUS RESPECTIVOS VALORES
function getParcelas(brand) {
    var maxInstallment = 3;
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

                    if(c <= maxInstallment) {
                        $('#selQtdParc').append(`
                            <option value="` + objb.quantity + `" data-parcelas="` + objb.installmentAmount + `">` + objb.quantity + ` x R$ ` + valorParc + ` = R$ ` + totalAmount + ` sem juros</option>
                        `);
                    } else {
                        $('#selQtdParc').append(`
                            <option value="` + objb.quantity + `" data-parcelas="` + objb.installmentAmount + `">` + objb.quantity + ` x R$ ` + valorParc + ` = R$ ` + totalAmount + `</option>
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
    
    // RECUPERANDO TOKEN DO CARTÃO DE CRÉDITO
    PagSeguroDirectPayment.createCardToken({
        cardNumber: $('#inputNumCard').val(), // Número do cartão de crédito
        brand: $('#inputBrandCard').val(), // Bandeira do cartão
        cvv: $('#inputCvvCard').val(), // CVV do cartão
        expirationMonth: $('#inputMonthValid').val(), // Mês da expiração do cartão
        expirationYear: $('#inputYearValid').val(), // Ano da expiração do cartão, é necessário os 4 dígitos.
        success: function(response) {
            $('#inputTokenCard').val(response.card.token);
        },
        error: function(response) {
            console.log(response);
            return false;
        },
        complete: function(response) {
            // Callback para todas chamadas.
            recupHashCard();
        }
    });

    return false;
});

function recupHashCard() {
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
                    console.log("Sucesso " + retorno);
                },
                error: function() {
                    console.log("ERROR")
                }
            });
        }
    });
}