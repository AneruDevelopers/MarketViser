<?php require_once '__system__/functions/connection/conn.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>e.conomize - Página não encontrada</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>img/e_icon.png"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>style/css/main.css">
    <link href="<?php echo base_url(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/fonts/Icons/icons_pack/font/flaticon.css">
</head>
<body>
    <div class="l-wrapper">
        <div class="l-topNav" id="topNav">
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
            include('functions/includes/bottom.html');
        ?>
        </div>
        
        <h2>Página não encontrada</h2>

        <div class="myModalArmazem" id="myModalArmazem">
			<div class="modalArmazemContent">
                <div class="modalProfileLeftContent">
                    <div class="Armazens">

                    </div>
                </div>
                <div class="modalProfileRightContent">
                    <span class="closeModalArmazem">&times;</span>
                    <div class="meuArmazem">
                        
                    </div>
                </div>
			</div>
		</div>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <form id="form-login">
                    <span class="close">&times;</span>
                    <!-- <i class="far fa-check-circle"></i> -->
                    <h4 class="titleModalLogin"><i class="fas fa-grip-lines"></i><i class="fas fa-grip-lines"></i><i class="fas fa-grip-lines"></i> LOG IN <i class="fas fa-grip-lines"></i><i class="fas fa-grip-lines"></i><i class="fas fa-grip-lines"></i></h4>
                    <strong><label class="labelInput">E-MAIL</label></strong>
                    <input class="inputModal" type="text" placeholder=" E-mail" name="usu_email_login" id="usu_email_login"/><br/>
                    <strong><label class="labelInput">SENHA</label></strong>
                    <input class="inputModal" type="password" placeholder=" Senha" name="usu_senha_login" id="usu_senha_login"/><br/>
                    <p class="textModal">Ainda não é cadastrado?<br>
                    <a class="linkCadModal" href="<?php echo base_url_php(); ?>cadastro">Cadastre-se já</a></p>
                    <input class="btnSend" type="submit" id="btn-login" value="Entrar"/>
                    <div class="help-block-login"></div>
                </form>
            </div>
        </div>
        <div class="l-footer" id="footer">
        <?php
            include('functions/includes/footer.html');
        ?>
        </div>
        <div class="l-footerBottom" id="footerBottom">
        <?php
            include('functions/includes/bottomFooter.html');
        ?>
        </div>
    </div>

	<script src="<?php echo base_url(); ?>js/JQuery/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/owl.carousel.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?php echo base_url(); ?>js/util.js"></script>
    <script src="<?php echo base_url(); ?>js/JQuery/jquery-mask.js"></script>
    <script src="<?php echo base_url(); ?>js/mask.js"></script>
    <script src="<?php echo base_url(); ?>js/verificaLogin.js"></script>
    <script src="<?php echo base_url(); ?>js/login.js"></script>
    <script src="<?php echo base_url(); ?>js/listDepartamento.js"></script>
    <script src="<?php echo base_url(); ?>js/listArmazem.js"></script>
</body>
</html>