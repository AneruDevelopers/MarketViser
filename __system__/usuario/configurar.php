<?php
    if(!isset($_SESSION['inf_usu']['usu_id'])) {
        $_SESSION['msg'] = "Você precisa estar logado";
        header("Location: ../");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
    <title>e.conomize | Configurar Perfil</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="icon" href="<?= base_url(); ?>img/e_icon.png"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>style/css/main.css"/>
    <link href="<?= base_url(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css" type="text/css"/>
    <link rel="stylesheet" href="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>style/fonts/Icons/icons_pack/font/flaticon.css"/>
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
            <h2 class="tituloOfertas"><i class="fas fa-cog"></i> CONFIGURAÇÕES DO PERFIL</h2>
            <div class="leftContentConfigProfile">

            <div class="divConfigProfileFacts">
                    <h4>FATOS DESSA CONTA</h4>
                    <b class="titleDivConfigProfileFacts"><i class="fas fa-shopping-bag"></i> Total de compras:</b>
                    <p class="textDivConfigProfileFacts">
                    <b><?php
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
                    ?>
                    </b>
                    </p>
                <b class="titleDivConfigProfileFacts"><i class="fas fa-heart"></i> Produtos favoritos:</b> 
                <p class="textDivConfigProfileFacts">
                <b>
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
                ?>
                </b>
                </p>
                </div>
            </div>
            <div class="showUsuario">
                <div class="sectionConfigProfilePage">
                    <div class="topDivConfigProfilePage">
                        <h5><i class="fas fa-signature"></i> NOME:</h5>
                    </div>
                    <div class="bottomDivConfigProfilePage">
                        <span class="specialSpan"><?= $_SESSION['inf_usu']['usu_nome'] . " " . $_SESSION['inf_usu']['usu_sobrenome']; ?></span>
                    </div>
                </div>
                <div class="sectionConfigProfilePage">
                    <div class="topDivConfigProfilePage">
                        <h5><i class="fas fa-id-card"></i> CPF:</h5>
                    </div>
                    <div class="bottomDivConfigProfilePage">
                        <span class="specialSpan"><?= $_SESSION['inf_usu']['usu_cpf']; ?></span>
                    </div>
                </div>
                <div class="sectionConfigProfilePage">
                    <div class="topDivConfigProfilePage">
                        <h5><i class="far fa-envelope"></i> EMAIL:</h5>
                    </div>
                    <div class="bottomDivConfigProfilePage">
                        <span class="specialSpan"><?= $_SESSION['inf_usu']['usu_email']; ?></span>
                    </div>
                </div>
                <div class="sectionConfigProfilePage">
                    <div class="topDivConfigProfilePage">
                        <h5><i class="fas fa-unlock"></i> SENHA:</h5>
                    </div>
                    <div class="bottomDivConfigProfilePage">
                        <span></span>
                        <span class="editIcon">
                            <button class="mudarSenha">
                                <i class="fas fa-edit"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <div class="sectionConfigProfilePage">
                    <div class="topDivConfigProfilePage">
                        <h5><i class="fas fa-map-marker-alt"></i> ENDEREÇO:</h5>
                    </div>
                    <div class="bottomDivConfigProfilePage">
                        <span class="specialSpanEnd">
                        <?= $_SESSION['inf_usu']['usu_end'] . ", " . $_SESSION['inf_usu']['usu_num']; ?>
                        <?= $_SESSION['inf_usu']['usu_complemento']; ?>
                        </span><br/>
                        <span class="specialSpanEnd">
                        <?= $_SESSION['inf_usu']['usu_cep']; ?>
                        </span><br/>
                        <span class="specialSpanEnd">
                        <?= $_SESSION['inf_usu']['usu_bairro'] . ", " . $_SESSION['inf_usu']['usu_cidade'] . " - " . $_SESSION['inf_usu']['usu_uf']; ?>
                        </span>
                        <span class="editIconEnd">
                            <button class="mudarEndereco">
                                <i class="fas fa-edit"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <div class="sectionConfigProfilePage">
                    <div class="topDivConfigProfilePage">
                        <h5><i class="fas fa-mobile-alt"></i> TELEFONE(S):</h5>
                    </div>
                    <div class="bottomDivConfigProfilePage divTelefones">
                        
                    </div>
                    <span class="editIconTel">
                        <button class="mudarTelefone">
                            <i class="fas fa-edit"></i>
                        </button>
                    </span>
                </div>
                    
            </div>
            <div class="sectionAlterConfigProfilePage">
                <div class="divMudarSenha">
                    
                </div>

                <div class="divMudarTelefone">
                    
                </div>

                <div class="divMudarEndereco">
                    
                </div>
            </div>
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