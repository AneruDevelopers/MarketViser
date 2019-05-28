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
    <title>e.conomize - Configurar perfil</title>
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
            <h2 class="tituloOfertas"><i class="fas fa-cog"></i> CONFIGURAÇÕES DO PERFIL</h2>
            <div class="showUsuario">
                <h3><?= $_SESSION['inf_usu']['usu_tipo'] . "<br/>" . $_SESSION['inf_usu']['usu_nome'] . " " . $_SESSION['inf_usu']['usu_sobrenome']; ?></h3>

                <p>
                    <b>
                        DADOS PESSOAIS<br/>
                        CPF: <?= $_SESSION['inf_usu']['usu_cpf']; ?><br/>
                        EMAIL: <?= $_SESSION['inf_usu']['usu_nome']; ?><br/>
                    </b>
                </p>

                <p>
                    <b>
                        ENDEREÇO<br/>
                        <?= $_SESSION['inf_usu']['usu_end'] . ", " . $_SESSION['inf_usu']['usu_num']; ?>
                        <?= $_SESSION['inf_usu']['usu_complemento']; ?><br/>
                        <?= $_SESSION['inf_usu']['usu_cep']; ?><br/>
                        <?= $_SESSION['inf_usu']['usu_bairro'] . ", " . $_SESSION['inf_usu']['usu_cidade'] . " - " . $_SESSION['inf_usu']['usu_uf']; ?>
                    </b>
                </p>

                <div class="divTelefones">

                </div><br/>

                <b>Total de compras:</b> 
                <?php
                    $sel = $conn->prepare("SELECT COUNT(usu_id) AS qtd_compra, SUM(compra_total) AS total_compra FROM compra WHERE usu_id=:id");
                    $sel->bindValue(":id", "{$_SESSION['inf_usu']['usu_id']}");
                    $sel->execute();
                    $res = $sel->fetchAll();
                    if($res[0]['qtd_compra'] > 0) {
                        echo '
                            ' . $res[0]['qtd_compra'] . '
                            <br/><b>Total de gastos:</b> R$' . number_format($res[0]['total_compra'], 2, ',', '.')
                        ;
                    } else {
                        echo "0";
                    }
                ?><br/>
                <b>Total de produtos favoritos:</b> 
                <?php
                    $sel = $conn->prepare("SELECT COUNT(usu_id) AS qtd_fav FROM produtos_favorito WHERE usu_id=:id");
                    $sel->bindValue(":id", "{$_SESSION['inf_usu']['usu_id']}");
                    $sel->execute();
                    if($sel->rowCount() > 0) {
                        $res = $sel->fetchAll();
                        echo $res[0]['qtd_fav'];
                    } else {
                        echo "0";
                    }
                ?><br/>
            </div>
            <div class="divMudarSenha">
                <button class="mudarSenha">Mudar senha</button>
            </div>

            <div class="divMudarTelefone">
                <button class="mudarTelefone">Mudar, excluir ou adicionar telefone(s)</button>
            </div>

            <div class="divMudarEndereco">
                <button class="mudarEndereco">Exigir mudança de endereço</button>
            </div>
        </div>

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