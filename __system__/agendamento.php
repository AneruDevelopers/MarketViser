<?php
    if(!isset($_SESSION['carrinho'])) {
        header("Location: carrinho");
    } else {
        if(empty($_SESSION['carrinho'])) {
            header("Location: carrinho");
        } elseif(isset($_SESSION['agend_horario'])) {
            header("Location: finalizaCompra");
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
</head>
<body>
    <div class="l-wrapper_FiltroPesq">

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

		<!-- Title/Display Products -->

        <div class="l-mainFiltroPesq">
            <h2 class="tituloOfertas"><i class="far fa-clock"></i> AGENDAMENTO</h2>
            <div class="divAgend">
                <h2>Confirme ou mude o endereço para fazermos a entrega!</h2>
                <form id="endereco_entrega">
                    <div class="outsideSecInputCad">
                        <div class="field -md">
                            <input type="text" placeholder=" CEP" class="form-control cep placeholder-shown" id="usu_cep" value="<?= $_SESSION['inf_usu']['usu_cep'] ?>" name="usu_cep"/>
                            <label class="labelFieldCad"><strong>CEP</strong></label>
                        </div>
                        <div class="help-block"></div><br/>
                    </div>
                    <div class="outsideSecInputCad">
                        <div class="field -md">
                            <input type="text" placeholder=" Logradouro" class="placeholder-shown" readonly id="usu_end" value="<?= $_SESSION['inf_usu']['usu_end'] ?>" name="usu_end"/>
                            <label class="labelFieldCad"><strong>LOGRADOURO</strong></label>
                        </div>
                        <div class="help-block"></div><br/>
                    </div>
                    <div class="outsideSecInputCad">
                        <div class="field -md">
                            <input type="text" placeholder=" Número" class="placeholder-shown" id="usu_num" value="<?= $_SESSION['inf_usu']['usu_num'] ?>" name="usu_num"/>
                            <label class="labelFieldCad"><strong>NÚMERO</strong></label>
                        </div>
                        <div class="help-block"></div><br/>
                    </div>
                    <div class="outsideSecInputCad">
                        <div class="field -md">
                            <input type="text" placeholder=" Complemento" class="placeholder-shown" id="usu_complemento" value="<?= $_SESSION['inf_usu']['usu_complemento'] ?>" name="usu_complemento"/>
                            <label class="labelFieldCad"><strong>COMPLEMENTO</strong></label>
                        </div>
                        <div class="help-block"></div><br/>
                    </div>
                    <div class="outsideSecInputCad">
                        <div class="field -md">
                            <input type="text" placeholder=" Bairro" class="placeholder-shown" readonly id="usu_bairro" value="<?= $_SESSION['inf_usu']['usu_bairro'] ?>" name="usu_bairro"/>
                            <label class="labelFieldCad"><strong>BAIRRO</strong></label>
                        </div>
                        <div class="help-block"></div><br/>
                    </div>
                    <div class="outsideSecInputCad">
                        <div class="field -md">
                            <input type="text" placeholder=" Cidade" class="placeholder-shown" readonly id="usu_cidade" value="<?= $_SESSION['inf_usu']['usu_cidade'] ?>" name="usu_cidade"/>
                            <label class="labelFieldCad"><strong>CIDADE</strong></label>
                        </div>
                        <div class="help-block"></div><br/>
                    </div>
                    <div class="outsideSecInputCad">
                        <div class="field -md">
                            <input type="text" placeholder=" Estado" class="placeholder-shown" readonly id="usu_uf" value="<?= $_SESSION['inf_usu']['usu_uf'] ?>" name="usu_uf"/>
                            <label class="labelFieldCad"><strong>ESTADO</strong></label>
                        </div>
                        <div class="help-block"></div><br/>
                    </div>
                    <div class="btnSendCad">
                        <button class="btnSubCad" type="submit" id="btn-cad">CONFIRMAR</button>
                        <div class="help-block"><p style="opacity:0;">A</p></div>
                    </div>
                </form>
            </div>

            <!-- <h3 style="opacity:0;">A</h3>
            <h2 class="tituloOfertas"><i class="fas fa-shopping-cart"></i> SUA COMPRA</h2>
            <div class="divShowOpt">
				
            </div>
            <div class="divShowOptBtn">

            </div>
            <div class="divTable">
                <table class="divShowProdFav tableCart" width="100%" padding="0" margin="0">
                    
                </table>
            </div>
            <div class="divShowTot">
				
            </div>
            <div class="divShowOptDesk">

            </div> -->
        </div>

        <!-- Display Products -->

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
    <script src="<?php echo base_url(); ?>js/JQuery/jquery-mask.js"></script>
    <script src="<?php echo base_url(); ?>js/mask.js"></script>
    <script src="<?php echo base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?php echo base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/owl.carousel.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/util.js"></script>
    <script src="<?php echo base_url(); ?>js/verificaLogin.js"></script>
    <script src="<?php echo base_url(); ?>js/listDepartamento.js"></script>
    <script src="<?php echo base_url(); ?>js/listArmazem.js"></script>
    <script src="<?php echo base_url(); ?>js/agendamento.js"></script>
</body>
</html>