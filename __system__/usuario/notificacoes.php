<?php
    if(!isset($_SESSION['inf_usu']['usu_id'])) {
        $_SESSION['msg'] = "Você precisa estar logado";
        header("Location: ../");
    }

    $sel = $conn->prepare("SELECT * FROM postagem ORDER BY post_registro DESC");
    $sel->execute();
    while($v = $sel->fetch( PDO::FETCH_ASSOC )) {
        $v['post_title'] = (strlen($v['post_title']) > 65) ? substr($v['post_title'],0,65) . "..." : $v['post_title'];

        $exp = explode(" ", $v['post_registro']);
        $day = explode("-", $exp[0]);
        $v['post_registro'] = $day[2] . "/" . $day[1] . "/" . $day[0] . " às " . $exp[1];

        $postagem[] = $v;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
    <title>e.conomize | Notificações</title>
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
            <h2 class="defaultTitle"><i class="fas fa-bell"></i> NOTIFICAÇÕES</h2>
            <div class="divCompraRight">
                <div class="answer-purch">
                    <h1>Clique em uma notificação e ela aparecerá aqui!</h1>
                </div>
            </div>
            <div class="divCompraLeft">
                <div class="titleLeft">
                    <br/><br/>
                    <?php
                        if(isset($postagem)):?>
                            <div class="searchPurch">
                                <p style="margin-bottom:.6rem;"><label for="inputSearch">Procure: </label></p>
                                <input type="text" class="inputSearchDuvida" name="inputSearch" id="inputSearch">
                                <span class="help-block-post"></span>
                            </div>
                            <div class="showCompras">
                                <?php
                                foreach($postagem as $k => $v):?>
                                    <a href="#" class="viewPurchase viewPost" data-post="<?= $v['post_id'] ?>">
                                        <p class="p_showPurch">
                                            <b><?= $v['post_title'] ?></b><br/>
                                            <small><?= $v['post_registro']; ?></small>
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
    <script src="<?= base_url(); ?>js/notifica.js"></script>
</body>
</html>