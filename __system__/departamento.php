<?php
    if(isset($_SESSION['query_tam'])) {
        unset($_SESSION['query_tam']);
    }
    if(isset($_SESSION['query_marca'])) {
        unset($_SESSION['query_marca']);
    }
    if(isset($_SESSION['query_preco'])) {
        unset($_SESSION['query_preco']);
    }
    if(isset($_SESSION['query_fav'])) {
        unset($_SESSION['query_preco']);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>e.conomize | Departamentos</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="<?= base_url(); ?>img/e_icon.png"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>/style/css/main.css"/>
    <link href="<?= base_url(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css" type="text/css"/>
    <link rel="stylesheet" href="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.css" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>style/fonts/Icons/icons_pack/font/flaticon.css"/>
</head>
<body>
    <div class="l-wrapper_FiltroPesq">
        <div class="l-topNavFiltroPesq" id="topNav">
        <?php
            include('functions/includes/topNav.php');
        ?>    
        </div>

        <nav class="l-headerNav" id="headerNav">
        <?php
            include('functions/includes/header.php');
        ?>
        </nav>

        <div class="l-bottomNav" id="bottomNav">
        <?php
            include('functions/includes/bottom.php');
        ?>
        </div>

        <div class="l-mainFiltroPesq">
            <?php require_once 'functions/includes/filtroPesquisa.php'; ?>
        </div>

        <?php
            include('functions/includes/modal.php');
        ?>
        
        <div class="l-footerFiltroPesq" id="footer">
        <?php
            include('functions/includes/footer.php');
        ?>
        </div>
        <div class="l-footerBottomFiltroPesq" id="footerBottom">
        <?php
            include('functions/includes/bottomFooter.html');
        ?>
        </div>
    </div>

    <script src="<?= base_url(); ?>js/JQuery/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/owl.carousel.js"></script>
    <script src="<?= base_url(); ?>js/util.js"></script>
    <script src="<?= base_url(); ?>js/verificaLogin.js"></script>
    <script src="<?= base_url(); ?>js/favoritar.js"></script>
    <script src="<?= base_url(); ?>js/btnFavorito.js"></script>
    <script src="<?= base_url(); ?>js/attCarrinho.js"></script>
    <script src="<?= base_url(); ?>js/listArmazem.js"></script>
    <script src="<?= base_url(); ?>js/main.js"></script>
    <script src="<?= base_url(); ?>js/login.js"></script>
    <script src="<?= base_url(); ?>js/procuraProdutos.js"></script>
</body>
</html>