<?php
    if(!isset($_SESSION['inf_usu']['usu_id'])) {
        $_SESSION['msg'] = "Você precisa estar logado";
        header("Location: ../");
    }

    $sel = $conn->prepare("SELECT COUNT(compra_id) AS qtd_compra, SUM(compra_total) AS soma_compra FROM compra WHERE usu_id=:id");
    $sel->bindValue(":id", "{$_SESSION['inf_usu']['usu_id']}");
    $sel->execute();
    $inf_compra = $sel->fetch( PDO::FETCH_ASSOC );
    if($sel->rowCount() > 0) {
        $sel = $conn->prepare("SELECT c.compra_id, c.compra_registro, c.compra_total, f.forma_nome FROM compra AS c JOIN status_compra AS s ON c.status_id=s.status_id JOIN forma_pag AS f ON c.forma_id=f.forma_id WHERE c.usu_id=:id ORDER BY c.compra_registro DESC");
        $sel->bindValue(":id", "{$_SESSION['inf_usu']['usu_id']}");
        $sel->execute();
        while($row = $sel->fetch( PDO::FETCH_ASSOC )) {
            $exp = explode(" ", $row['compra_registro']);
            $day = explode("-", $exp[0]);
            $hour = explode(":", $exp[1]);
            $row['compra_registro'] = $day[2] . "/" . $day[1] . "/" . $day[0] . 
            " às " . $hour['0'] . "h" . $hour[1];

            $row['compra_total'] = number_format($row['compra_total'], 2, ',', '.');

            $compra[] = $row;
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
    <title>e.conomize | Minhas compras</title>
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
        
        <div class="l-mainCad">
            <h2 class="defaultTitle"><i class="fas fa-shopping-bag"></i> HISTÓRICO DE COMPRAS</h2>
            <div class="divCompraRight">
                <div class="answer-purch">
                    <h1>Clique em uma compra e ela aparecerá aqui!</h1>
                </div>
            </div>
            <div class="divCompraLeft">
                <div class="titleLeft">
                    <h2 class="menuTit">HISTÓRICO</h2>
                    
                    <p class="menuSubtit">
                        <b>Total de compras:</b> <?= $inf_compra['qtd_compra']; ?><br/><br>
                        <b>Total de gastos:</b> R$<?= number_format($inf_compra['soma_compra'], 2, ',', '.'); ?>
                    </p>
                        <?php
                            if(isset($compra)):?>
                                <div class="searchPurch">
                                    <input type="text" class="inputHistoric" name="inputSearchPurch" id="inputSearchPurch" placeholder="Pesquise">
                                    <span class="help-block-purch"></span>
                                </div>
                                <div class="showCompras">
                                    <?php
                                    foreach($compra as $k => $v):?>
                                        <a href="#" class="viewPurchase" data-purch="<?= $v['compra_id'] ?>">
                                            <p class="p_showPurch">
                                                Data: <?= $v['compra_registro']; ?><br/>
                                                Total: R$<?= $v['compra_total'] ?><br/>
                                                Meio Pag.: <?= $v['forma_nome']; ?>
                                            </p>
                                        </a>
                                        <?php
                                    endforeach;
                                    ?>
                                </div>
                                <?php
                            endif;
                        ?>
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
	<script src="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/owl.carousel.js"></script>
    <script src="<?= base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>js/util.js"></script>
    <script src="<?= base_url(); ?>js/verificaLogin.js"></script>
    <script src="<?= base_url(); ?>js/login.js"></script>
    <script src="<?= base_url(); ?>js/listArmazem.js"></script>
    <script src="<?= base_url(); ?>js/main.js"></script>
    <script src="<?= base_url(); ?>js/historicoCompra.js"></script>
</body>
</html>