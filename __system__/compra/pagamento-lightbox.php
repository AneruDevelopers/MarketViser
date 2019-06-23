<?php
    if((!isset($_SESSION['end_agend'])) || (!isset($_SESSION['agend_horario']))) {
        $_SESSION['msg']['text'] = "Para chegar ao pagamento você precisa seguir os passos à seguir do carrinho!";
        header("Location: " . base_url_php() . "compra/etapas_compra");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>e.conomize | Pagamento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="<?= base_url(); ?>img/e_icon.png"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>/style/css/main.css"/>
    <link href="<?= base_url(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet"/>
</head>
<body class="bodyPagPage">
        <?php
            require_once '__system__/functions/pagseguro/vendor/pagseguro/pagseguro-php-sdk/public/Checkout/modal_compra.php';
            // $hora = substr($_SESSION['agend_horario'],0,2) . "h" . substr($_SESSION['agend_horario'],3,2);
            // $totCompra = number_format($_SESSION['totCompra'], 2, ',', '.');
            // echo "<b>Entrega no dia:</b> {$_SESSION['agend_horario']}<br/><b>Total à pagar:</b> R$" . $totCompra;
        ?>
</body>
</html>