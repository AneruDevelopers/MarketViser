<?php require_once "configuration.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>e.conomize | Checkout Transparente</title>
    <link rel="icon" href="<?= base_url(); ?>img/e_icon.png"/>
    <link href="<?= base_url(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet"/>
    <link href="<?= base_url(); ?>functions/pagseguro-transparente/style/main.css" rel="stylesheet"/>
</head>
<body>
    <form id="formBuyPagSeguro">
        <input type="hidden" name="paymentMethod" id="paymentMethod" value="creditCard"/>
        <input type="hidden" name="receiverEmail" id="receiverEmail" value="<?= EMAIL_LOJA; ?>"/>
        <input type="hidden" name="currency" id="currency" value="<?= MOEDA_PAGAMENTO; ?>"/>
        <input type="hidden" name="extraAmount" id="extraAmount" value=""/>

        <input type="hidden" name="itemId1" id="itemId1" value="0001"/>
        <input type="hidden" name="itemDescription" id="itemDescription" value="SAMSUNG GALAXY J5"/>
        <input type="hidden" name="itemAmount1" id="itemAmount1" value="600.00"/>
        <input type="hidden" name="itemQuantity1" id="itemQuantity1" value="1"/>
        
        <input type="hidden" name="notificationURL" id="notificationURL" value="<?= URL_NOTIFICATION; ?>"/>
        <input type="hidden" name="reference" id="reference" value="ECONOMIZE0101"/>

        <h4>Dados do comprador</h4>
        <div class="infComp"></div>

        <h4>Endereco da entrega</h4>
        <div class="endComp"></div>

        <h4>Agendamento da entrega</h4>
        <div class="agendComp"></div>

        <h4>Dados do cartao</h4>
        <label for="inputNumCard">Numero:</label>
        <input type="text" name="inputNumCard" class="numberCard" id="inputNumCard"/>
        <span class="brandCard"></span>
        <br/>

        <label for="inputBrandCard">Bandeira:</label>
        <input type="text" name="inputBrandCard" id="inputBrandCard"/><br/>

        <label for="inputCvvCard">CVV:</label>
        <input type="text" name="inputCvvCard" class="cvv" id="inputCvvCard"/><br/>

        <label for="inputMonthValid">Mes de validade (mm):</label>
        <input type="text" name="inputMonthValid" class="month" id="inputMonthValid"/><br/>

        <label for="inputYearValid">Ano de validade (aaaa):</label>
        <input type="text" name="inputYearValid" class="year" id="inputYearValid"/><br/>

        <label for="selQtdParc">Quantidade de parcelas:</label>
        <select name="selQtdParc" id="selQtdParc" disabled></select><br/>
        
        <input type="hidden" name="inputParcValue" id="inputParcValue"/><br/>

        <label for="creditCardHolderCPF">CPF:</label>
        <input type="text" name="creditCardHolderCPF" class="cpf" id="creditCardHolderCPF"/><br/>

        <label for="creditCardHolderNome">Nome:</label>
        <input type="text" name="creditCardHolderNome" id="creditCardHolderNome"/><br/>

        <h4>Endereco da fatura do cartao</h4>
        <input type="radio" checked value="1" name="billingAddress" id="sameAddress"/><label for="sameAddress"> Mesmo endereco da entrega</label>
        <input type="radio" value="0" name="billingAddress" id="otherAddress"/><label for="otherAddress"> Outro endereco</label>

        <input type="hidden" name="inputTokenCard" id="inputTokenCard"/><br/>
        <input type="hidden" name="inputHashSender" id="inputHashSender"/><br/>

        <button type="submit" name="btnBuyPagSeguro" id="btnBuyPagSeguro">Comprar</button>
    </form>

    <div class="listPayments"></div>

    <script src="<?= base_url(); ?>js/JQuery/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>js/JQuery/jquery-mask.js"></script>
    <script src="<?= base_url(); ?>js/mask.js"></script>
    <script src="<?= base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>js/util.js"></script>
    <script src="<?= SCRIPT_PAGSEGURO; ?>"></script>
    <script src="<?= base_url(); ?>functions/pagseguro-transparente/js/pagseguro.js"></script>
</body>
</html>