<?php
    if(!isset($_SESSION['inf_usu']['usu_id'])) {
        $_SESSION['msg'] = "Você precisa estar logado";
        header("Location: ../");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
    <title>e.conomize | Minhas estatísticas</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?= base_url(); ?>img/e_icon.png"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>style/css/main.css">
    <link href="<?= base_url(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>style/fonts/Icons/icons_pack/font/flaticon.css">
</head>
<body>
	<div class="l-wrapper_cadastro">
		<div class="l-topNavCad" id="topNav">
		<?php
			include('__system__/functions/includes/topNav.php');
		?>    
		</div>
		<div class="l-headerNavMobile" id="headerNav">
		<?php
			include('__system__/functions/includes/header.php');
		?>    
		</div>
        <div class="l-mainCad" style="width:40%;margin:0 auto;">
            <h2 class="tituloOfertas"><i class="fas fa-chart-line"></i> MINHAS ESTATÍSTICAS</h2>
        </div>

        <?php
            include('functions/includes/modal.php');
        ?>
        
		<div class="l-footer" id="footer">
        <?php
            include('__system__/functions/includes/footer.php');
		?>
		</div>
        <div class="l-footerBottomCad" id="footerBottom">
		<?php
            include('__system__/functions/includes/bottomFooter.html');
        ?>
		</div>
    </div>

	<script src="<?= base_url(); ?>js/JQuery/jquery-3.3.1.min.js"></script>
	<script src="<?= base_url(); ?>js/JQuery/jquery-mask.js"></script>
	<script src="<?= base_url(); ?>js/mask.js"></script>
	<script src="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/owl.carousel.js"></script>
    <script src="<?= base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>js/util.js"></script>
    <script src="<?= base_url(); ?>js/verificaLogin.js"></script>
    <script src="<?= base_url(); ?>js/login.js"></script>
    <script src="<?= base_url(); ?>js/listArmazem.js"></script>
    <script src="<?= base_url(); ?>js/configurarPerfil.js"></script>
    <script src="<?= base_url(); ?>js/main.js"></script>
</body>
</html>