<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>e.conomize | Processo de Compra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url(); ?>img/e_icon.png"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>/style/css/main.css">
    <link href="<?= base_url(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>style/libraries/progress-tracker-master/app/styles/progress-tracker.css">
</head>
<body>
    <div class="l-wrapper_FiltroPesq">
    <div class="l-mainFiltroPesq">
        <ul class="progress-tracker progress-tracker--word progress-tracker--word-left progress-tracker--center anim-ripple-large">
            <li class="progress-step is-complete">
                <span class="progress-marker"></span>
                <span class="progress-text">
                    <h4 class="progress-title">PASSO 1</h4>
                    <i class="fas fa-shopping-cart"></i> CARRINHO
                </span>
            </li>
            <li class="progress-step is-complete">
                <span class="progress-marker"></span>
                <span class="progress-text">
                    <h4 class="progress-title">PASSO 2</h4>
                    <i class="fas fa-map-marker-alt"></i> ENDEREÇO
                </span>
            </li>
            <li class="progress-step is-complete">
                <span class="progress-marker"></span>
                <span class="progress-text">
                    <h4 class="progress-title">PASSO 3</h4>
                    <i class="far fa-clock"></i> AGENDAMENTO
                </span>
            </li>
            <li class="progress-step is-active">
                <span class="progress-marker"></span>
                <span class="progress-text">
                    <h4 class="progress-title">PASSO 4</h4>
                    <i class="far fa-credit-card"></i> PAGAMENTO
                </span>
            </li>
            <li class="progress-step">
                <span class="progress-marker"></span>
                <span class="progress-text">
                    <h4 class="progress-title">PASSO 5</h4>
                    <i class="fas fa-file-alt"></i> EXTRATO
                </span>
            </li>
        </ul>
        <h2 class="tituloOfertas"><i class="far fa-credit-card"></i> PAGAMENTO</h2>
        <pre>
        <?php
            print_r($_SESSION['end_agend']);
        ?>
        </pre>
        <button class="pagamento_feito">
            Fiz o pagamento
        </button>
        <?php
            require_once '__system__/functions/pagseguro/vendor/pagseguro/pagseguro-php-sdk/public/Checkout/modal_compra.php';
            // $hora = substr($_SESSION['agend_horario'],0,2) . "h" . substr($_SESSION['agend_horario'],3,2);
            // $totCompra = number_format($_SESSION['totCompra'], 2, ',', '.');
            // echo "<b>Entrega no dia:</b> {$_SESSION['agend_horario']}<br/><b>Total à pagar:</b> R$" . $totCompra;
        ?>
    </div>
</body>
</html>