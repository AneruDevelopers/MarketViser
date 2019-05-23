<?php
    require_once 'functions/connection/conn.php';

    if(!isset($_SESSION['carrinho'])) {
        header("Location: carrinho");
    } else {
        if((!isset($_SESSION['agend_horario'])) && (!isset($_SESSION['inf_usu']['usu_id']))) {
            header("Location: carrinho");
        } else {
            if(!isset($_SESSION['agend_horario'])) {
                header("Location: agendamento");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>e.conomize</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>img/e_icon.png"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>/style/css/main.css">
    <link href="<?php echo base_url(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/fonts/Icons/icons_pack/font/flaticon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/libraries/progress-tracker-master/app/styles/progress-tracker.css">
</head>
<body>
    <div class="l-wrapper_FiltroPesq">

        <div class="l-topNav" id="topNav">
        <?php
            include('functions/includes/topNav.php');
        ?>
        </div>

        <div class="l-bottomNav" id="bottomNav">
        <?php
            include('functions/includes/bottom.html');
        ?>
        </div>

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
                        <i class="far fa-clock"></i> AGENDAMENTO
                    </span>
                </li>
                <li class="progress-step is-complete">
                    <span class="progress-marker"></span>
                    <span class="progress-text">
                        <h4 class="progress-title">PASSO 3</h4>
                        <i class="far fa-credit-card"></i> PAGAMENTO
                    </span>
                </li>
                <li class="progress-step is-active">
                    <span class="progress-marker"></span>
                    <span class="progress-text">
                        <h4 class="progress-title">PASSO 4</h4>
                        <i class="fas fa-clipboard"></i> EXTRATO
                    </span>
                </li>
            </ul>
            <h2 class="tituloOfertas"><i class="fas fa-shopping-bag"></i> FINALIZAR COMPRA</h2>
            <?php
                // $hora = substr($_SESSION['agend_horario'],0,2) . "h" . substr($_SESSION['agend_horario'],3,2);
                echo "<b>Entrega no dia:</b> {$_SESSION['agend_horario']}<br/><b>Total à pagar:</b> R$" . $_SESSION['totCompra'];
            ?>
        </div>

        <!-- -------------------- -->
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
                <div class="modalLeftContent">
                    <form id="form-login">
                        <!-- <i class="far fa-check-circle"></i> -->
                        <h4 class="titleModalLogin">LOG IN</h4>
                        <div class="outsideSecInputCad">
                            <div class="field -md">
                                <input type="text" name="usu_email_login" id="usu_email_login" class="placeholder-shown" placeholder="Some placeholder"/>
                                <label class="labelFieldCad"><strong>EMAIL</strong></label>
                            </div>
                            <div class="help-block"></div><br/>
                        </div>
                        <div class="outsideSecInputCad">
                            <div class="field -md">
                                <input type="password" name="usu_senha_login" id="usu_senha_login" class="placeholder-shown" placeholder="Some placeholder"/>
                                <label class="labelFieldCad"><strong>SENHA</strong></label>
                            </div>
                            <div class="help-block"></div><br/>
                        </div>
                        <button class="btnSend" type="submit" id="btn-login" value="Entrar">ENTRAR</button>
                        <div class="help-block-login"></div>
                    </form>
                </div>
                <div class="modalRightContent">
                    <span class="close">&times;</span>
                    <p class="textModal">Olá, amigo!</p>
                    <p class="textModalBottom">Entre com seus detalhes pessoais e comece sua jornada conosco</p>
                    <div class="divLinkCad">    
                        <a class="linkCadModal" href="<?php echo base_url_php(); ?>cadastro">Cadastre-se já</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- -------------------- -->

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
    <script src="<?php echo base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?php echo base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/owl.carousel.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/util.js"></script>
    <script src="<?php echo base_url(); ?>js/verificaLogin.js"></script>
    <script src="<?php echo base_url(); ?>js/listDepartamento.js"></script>
    <script src="<?php echo base_url(); ?>js/listArmazem.js"></script>
</body>
</html>