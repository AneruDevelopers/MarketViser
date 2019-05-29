<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>e.conomize | Institucional</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url(); ?>img/e_icon.png"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>/style/css/main.css">
    <link href="<?= base_url(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>style/fonts/Icons/icons_pack/font/flaticon.css">
</head>
<body>
    <div class="l-wrapper_FiltroPesq">
        <div class="l-topNavFiltroPesq" id="topNav">
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
            include('__system__/functions/includes/bottom.html');
        ?>
        </div>

        <div class="l-mainFiltroPesq">
            <h2 class="tituloOfertas">INSTITUCIONAL</h2>
            <div class="obj I">
                <h3>QUEM SOMOS</h3>
                <img src="../__system__\img\Banner_TCC\startup-593296_640.jpg" alt="Equipe e.conomize">
            </div>
            <p class="parag elementParag1"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi iure quaerat laborum at labore tempore ipsum quia nemo pariatur, 
                        alias eius, consectetur iste reiciendis, unde minima! Minima, quo sit. Nesciunt.
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Mollitia optio amet sint asperiores, voluptatem sunt debitis error 
                    illum odit repudiandae eos deleniti ratione maiores blanditiis, ipsam suscipit, commodi earum magnam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius doloremque ea cum tempore maiores praesentium iste! 
                    Aut iure perspiciatis consequuntur illum qui molestiae? Tenetur culpa suscipit numquam ab assumenda in!
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae placeat expedita error ullam, voluptate vel in recusandae, quas doloremque fuga sequi, ipsum nesciunt animi sapiente exercitationem iusto dolores! Soluta, placeat.</p>
            <div class="obj II">
                <h3>A FAMÍLIA E.CONOMIZE!</h3>
                <img src="../__system__\img\Banner_TCC\adult-2449725_640.jpg" alt="Equipe e.conomize">
            </div>
            <p class="parag elementParag2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi iure quaerat laborum at labore tempore ipsum quia nemo pariatur, 
                        alias eius, consectetur iste reiciendis, unde minima! Minima, quo sit. Nesciunt.
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Mollitia optio amet sint asperiores, voluptatem sunt debitis error 
                    illum odit repudiandae eos deleniti ratione maiores blanditiis, ipsam suscipit, commodi earum magnam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius doloremque ea cum tempore maiores praesentium iste! 
                    Aut iure perspiciatis consequuntur illum qui molestiae? Tenetur culpa suscipit numquam ab assumenda in!
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae placeat expedita error ullam, voluptate vel in recusandae, quas doloremque fuga sequi, ipsum nesciunt animi sapiente exercitationem iusto dolores! Soluta, placeat.
            </p>
            <div class="obj III">
                <h3>NOSSO OBJETIVO</h3>
                <img src="../__system__\img\Banner_TCC\adult-2449725_640.jpg" alt="Equipe e.conomize">
            </div>
            <p class="parag elementParag3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi iure quaerat laborum at labore tempore ipsum quia nemo pariatur, 
                        alias eius, consectetur iste reiciendis, unde minima! Minima, quo sit. Nesciunt.
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Mollitia optio amet sint asperiores, voluptatem sunt debitis error 
                    illum odit repudiandae eos deleniti ratione maiores blanditiis, ipsam suscipit, commodi earum magnam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius doloremque ea cum tempore maiores praesentium iste! 
                    Aut iure perspiciatis consequuntur illum qui molestiae? Tenetur culpa suscipit numquam ab assumenda in!
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae placeat expedita error ullam, voluptate vel in recusandae, quas doloremque fuga sequi, ipsum nesciunt animi sapiente exercitationem iusto dolores! Soluta, placeat.
            </p>
        </div>
            
        <!-- -------------------- -->

        <div class="myModalArmazem" id="myModalArmazem">
			<div class="modalArmazemContent">
                <div class="modalArmTopContent">
                    <div class="meuArmazem">
                        
                    </div>
                    <span class="closeModalArmazem">&times;</span>
                </div>
                <div class="modalArmBottomContent">
                    <div class="Armazens">

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
                                <label class="labelFieldCad"><strong><i class="fas fa-envelope"></i> EMAIL</strong></label>
                            </div>
                            <div class="help-block"></div><br/>
                        </div>
                        <div class="outsideSecInputCad">
                            <div class="field -md">
                                <input type="password" name="usu_senha_login" id="usu_senha_login" class="placeholder-shown" placeholder="Some placeholder"/>
                                <label class="labelFieldCad"><strong><i class="fas fa-unlock"></i> SENHA</strong></label>
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
                        <a class="linkCadModal" href="<?= base_url_php(); ?>usuario/cadastro">Cadastre-se já</a>
                    </div>    
                </div>
            </div>
        </div>
        <!-- -------------------- -->
        <div class="l-footerFiltroPesq" id="footer">
        <?php
            include('__system__/functions/includes/footer.php');
        ?>
        </div>
        <div class="l-footerBottomFiltroPesq" id="footerBottom">
        <?php
            include('__system__/functions/includes/bottomFooter.html');
        ?>
        </div>
    </div>

    <script src="<?= base_url(); ?>js/JQuery/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/owl.carousel.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>js/util.js"></script>
    <script src="<?= base_url(); ?>js/verificaLogin.js"></script>
    <script src="<?= base_url(); ?>js/listDepartamento.js"></script>
    <script src="<?= base_url(); ?>js/listArmazem.js"></script>
</body>
</html>