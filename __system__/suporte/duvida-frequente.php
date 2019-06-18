<?php
    $empty = TRUE;
    $sel = $conn->prepare("SELECT duvida_id, duvida_pergunta FROM duvida_frequente ORDER BY duvida_pergunta");
    $sel->execute();
    if($sel->rowCount() > 0) {
        $empty = FALSE;
        
        while($row = $sel->fetch( PDO::FETCH_ASSOC )) {
            $duvidas[] = $row;
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>e.conomize | Dúvidas frequentes</title>
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
        
        <div class="l-main">
            <h2 class="tituloOfertas"><i class="fas fa-question"></i> DÚVIDAS FREQUENTES</h2>
            <div class="divSearchDuvida">
                <label for="search_duvida">Digite o que está procurando: </label><input type="text" class="inputSearchDuvida" id="search_duvida" name="search_duvida"/>
            </div>
            <div class="l-duvida">
                <?php
                    if(!$empty):
                        if(count($duvidas) > 8):?>
                            <div class="divSearchDuvida">
                                <label for="search_duvida">Digite o que está procurando: </label><input type="text" class="inputSearchDuvida" id="search_duvida" name="search_duvida"/>
                            </div>
                            <?php
                        endif;

                        foreach($duvidas as $k => $v):
                            $c = $k + 1;?>
                            <div>
                                <div class="divDuvida" id-duvida="<?= $v['duvida_id'] ?>">
                                    <h4 class="perguntaDuvida"><?= $c . " - " . $v['duvida_pergunta']; ?></h4>
                                </div>
                                <div class="respostaDuvida"></div>
                            </div>
                            <?php
                        endforeach;
                    else:?>
                        <div class="msgNoProds">
                            <h3>Não há dúvidas disponíveis, no momento!</h3>
                        </div>
                        <?php
                    endif;
                ?>
            </div>
            <p class="linkDuvida"><a class="llinkDuvida" href="<?= base_url_php(); ?>suporte/atendimento">Não encontrou a resposta que estava procurando? Contate-nos!</a></p>
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
    </div>

    <script src="<?= base_url(); ?>js/JQuery/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/owl.carousel.js"></script>
    <script src="<?= base_url(); ?>js/util.js"></script>
    <script src="<?= base_url(); ?>js/verificaLogin.js"></script>
    <script src="<?= base_url(); ?>js/listArmazem.js"></script>
    <script src="<?= base_url(); ?>js/envatd.js"></script>
    <script src="<?= base_url(); ?>js/main.js"></script>
    <script src="<?= base_url(); ?>js/login.js"></script>
    <script src="<?= base_url(); ?>js/duvida.js"></script>
</body>
</html>