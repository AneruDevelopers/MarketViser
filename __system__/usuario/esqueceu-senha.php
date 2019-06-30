<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>e.conomize | Esqueceu senha</title>
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
        <div class="l-topNav" id="topNav">
        <?php
            include('__system__/functions/includes/topNav.php');
        ?>
        </div>
        <nav class="l-headerNav" id="headerNav">
        <?php
            include('__system__/functions/includes/header.php');
        ?>
        </nav>

        <div class="l-bottomNav" id="bottomNav">
        <?php
            include('__system__/functions/includes/bottom.php');
        ?>
        </div>

        <div class="l-mainFiltroPesq">
            <?php
                if(!isset($_SESSION['inf_usu'])):?>
                    <div class="divAgend">
                        <h2 class="defaultTitle"><i class="fas fa-question"></i> RECUPERE SUA SENHA</h2>
                        <form id="form-esqsenha">
                            <div class="outsideSecInputCad">
                                <div class="field -md">
                                    <input type="text" class="placeholder-shown" name="usu_email" id="usu_emailSenha" placeholder=" ">
                                    <label class="labelFieldCad" for="usu_emailSenha"><b>EMAIL</b></label>
                                </div>
                            </div>

                            <button type="submit" class="btnPag" id="btn-esq">Recuperar senha</button>
                            <div class="help-block"></div>
                        </form><br/><br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>* Enviaremos um email com a nova senha para você!</small>
                    </div>
                    <?php
                else:?>
                    <div class="msgNoProds">
                        <h3>Você está logado, não precisa recuperar a senha!</h3>
                    </div>
                    <?php
                endif;
            ?>
        </div>

        <?php
            include('__system__/functions/includes/modal.php');
        ?>

        <div class="l-footer" id="footer">
        <?php
            include('__system__/functions/includes/footer.php');
        ?>
        </div>
        <div class="l-footerBottom" id="footerBottom">
        <?php
            include('__system__/functions/includes/bottomFooter.html');
        ?>
        
        </div>
    <script src="<?= base_url(); ?>js/JQuery/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/owl.carousel.js"></script>
    <script src="<?= base_url(); ?>js/util.js"></script>
    <script src="<?= base_url(); ?>js/verificaLogin.js"></script>
    <script src="<?= base_url(); ?>js/listArmazem.js"></script>
    <script src="<?= base_url(); ?>js/main.js"></script>
    <script src="<?= base_url(); ?>js/login.js"></script>
    <script src="<?= base_url(); ?>js/esqSenha.js"></script>
</body>
</html>