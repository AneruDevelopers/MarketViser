<?php
    require_once '__system__/functions/connection/conn.php';
    // if(!isset($_SESSION['inf_usu']['usu_id'])) {
    //     header("Location: " . base_url_php());
    // } else {
    //     if($_SESSION["inf_usu"]['usu_tipo_id'] != 3) {
    //         header("Location: " . base_url_php());
    //     }
    // }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>e.conomize | Central de marcas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="<?= base_url(); ?>img/e_icon.png"/>
    <link href="<?= base_url_adm(); ?>style/admin.css" rel="stylesheet"/>
    <link href="<?= base_url(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet"/>
</head>
<body>
    <div class="l-wrapper">
        <?php
            require '__system__/admin_area/functions/includes/menu.php';
        ?>
        <section class="l-main">
            <a href="#" onclick="carregar('inserir_marca')">Inserir marca</a>
            <div id="conteudo">
                
            </div>
        </section>
        <footer class="l-footer">
        </footer>
    </div>

    <script src="<?= base_url(); ?>js/JQuery/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>js/JQuery/jquery-mask.js"></script>
    <script src="<?= base_url(); ?>js/mask.js"></script>
    <script src="<?= base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>js/util.js"></script>
    <script src="<?= base_url_adm(); ?>js/admin.js"></script>
    <script src="<?= base_url_adm(); ?>js/marca.js"></script>
</body>
</html>