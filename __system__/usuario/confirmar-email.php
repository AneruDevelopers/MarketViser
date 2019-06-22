<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
    <title>e.conomize | Cadastro</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?= base_url(); ?>img/e_icon.png"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>style/css/main.css">
    <link href="<?= base_url(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>style/fonts/Icons/icons_pack/font/flaticon.css">
	
	<script src="<?= base_url(); ?>js/JQuery/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>js/JQuery/jquery-mask.js"></script>
    <script src="<?= base_url(); ?>js/mask.js"></script>
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
		<div class="l-mainCad">
	<?php include('__system__/functions/confmail.php');
/*	if(isset($_SESSION['inf_usu']['usu_nome'])){
	 if(isset($_SESSION['conf_status']['vr'])){
		if($_SESSION['conf_status']['vr'] == "Email Confirmado Com Sucesso"){
			?>
			<h2 class="tituloOfertas"><i class="fas fa-check-double"></i><?php echo $_SESSION['conf_status']['vr']; ?></h2>
			<p>Olá <?php echo $_SESSION['inf_usu']['usu_nome'];?>, Bem-vindo ao e.conomize a equipe agradece sua inscrição.</p><br>
			 <a href="configurar">Ir para seu perfil</a>
			<?php 
	      }elseif($_SESSION['conf_status']['vr'] == "Codigo Expirado"){
			?>
		    <h2 class="tituloOfertas">Codigo Expirado</h2>
			<p>Olá <?php echo $_SESSION['inf_usu']['usu_nome'];?>, deseja que envie-mos um novo codigo ?</p><br>
			 <button id="submit1" type="submit">Enviar novamente</button>
			<?php
		   }
		   else{
			   header("location:configurar");
		   }
	    }
   }

 else{
	 echo "Você Não está logado";
  }
		*/	?> 
	
        

		</div>
		
		<?php
            include('__system__/functions/includes/modal.php');
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
	<script src="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/owl.carousel.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>js/util.js"></script>
    <script src="<?= base_url(); ?>js/JQuery/jquery-mask.js"></script>
    <script src="<?= base_url(); ?>js/mask.js"></script>
    <script src="<?= base_url(); ?>js/verificaLogin.js"></script>
    <script src="<?= base_url(); ?>js/main.js"></script>
    <script src="<?= base_url(); ?>js/login.js"></script>
    <script src="<?= base_url(); ?>js/cadastro_usuario.js"></script>
	<script src="<?= base_url(); ?>js/listArmazem.js"></script>
	<script src="<?= base_url(); ?>js/novEmail.js"></script>
	</body>
</html>