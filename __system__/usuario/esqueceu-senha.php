<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>e.conomize | Início</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="<?= base_url(); ?>img/e_icon.png"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>/style/css/main.css"/>
    <link href="<?= base_url(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css" type="text/css"/>
    <link rel="stylesheet" href="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.css" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>style/fonts/Icons/icons_pack/font/flaticon.css"/>
</head>
<body>
    <div class="l-wrapper">
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
        <section class="">
    <form  method="post" id="form-esqsenha">
    <label>Email:</label>
      <input type="text" name="usu_email" placeholder="Insira seu email">
      <button type="submit" id="btn-esq" >Enviar</button>
      <div class="help-block"></div>
    </form>
  </section>
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
    <script src="<?= base_url(); ?>js/JQuery/jquery-mask.js"></script>
    <script src="<?= base_url(); ?>js/mask.js"></script>
    <script src="<?= base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/owl.carousel.js"></script>
    <script src="<?= base_url(); ?>js/util.js"></script>
    <script src="<?= base_url(); ?>js/verificaLogin.js"></script>
    <script src="<?= base_url(); ?>js/favoritar.js"></script>
    <script src="<?= base_url(); ?>js/btnFavorito.js"></script>
    <script src="<?= base_url(); ?>js/attCarrinho.js"></script>
    <script src="<?= base_url(); ?>js/listArmazem.js"></script>
    <script src="<?= base_url(); ?>js/esqSenha.js"></script>
    <script src="<?= base_url(); ?>js/main.js"></script>
    <script src="<?= base_url(); ?>js/login.js"></script>
    <?php
        if(isset($_SESSION['msg_cad'])):?>
            <script>
                Swal.fire({
                    title: "e.conomize informa:",
                    text: "<?= $_SESSION['msg_cad']['text']; ?>",
                    type: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#A94442",
                    confirmButtonText: "Ok"
                });
            </script>
            <?php
            unset($_SESSION['msg_cad']);
        endif;
    ?>
</body>
</html>