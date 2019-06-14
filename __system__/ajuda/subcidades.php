<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>e.conomize | Subcidades</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
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
            include('__system__/functions/includes/bottom.php');
        ?>
        </div>

        <div class="l-mainFiltroPesq">
            <h2 class="tituloOfertas">ARMAZÉNS</h2>
            <p class="infoAgendText">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Os armazéns são depósitos onde as mercadorias comercializadas pela economize&#174 ficam estocadas para posteriormente serem distribuidos aos clientes. Esses armazéns contam com uma infraestrutura completa - refrigeradores de última geração, iluminação de LED, proteção contra corrosão e umidade, controle de pragas, segurança 24 horas - que garantem a integridade dos produtos e sua qualidade de fábrica. Todos os armazéns são certificados pela ANVISA e Corpo de Bombeiros com o selo de credibilidade garantida.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A Rede possui armazéns distribuidos em algumas cidades de maior relevância regional, onde estes servem a própria cidade e algumas outras próximas, conhecidadas como "<a href='#linkTitleShortcut'>subcidades</a>". Atualmente estamos presentes fisicamente em 3 municípios:</p>
            <img class="imgMapArmSub" src="../__system__\img\Banner_TCC\mapa_armazem_completo.jpg" alt="">
            <h2 id="linkTitleShortcut" class="tituloOfertas">SUBCIDADES</h2>
            <p class="infoAgendText">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;As subcidades são cidades que não possuem armazém próprio, mas ainda assim são atendidas por armazéns presentes em municípios de maior relevância em determinada região e, justamente por isso, a disponibilidade dos horários de entrega é menor. É necessário definir um endereço de entrega existente em uma cidade com armazém ou em uma subcidade, caso contrário, não será possível efetuar a compra. Se houver dúvidas, dê uma olhada em cada armazém e suas respectivas "subcidades". <a href="<?= base_url_php(); ?>ajuda/horario_armazem">Horários de entrega para <?= $_SESSION['arm']; ?></a></p>
            <div class="l-subcid">
                <?php
                    $sel = $conn->prepare("SELECT * FROM cidade AS c JOIN estado AS e ON c.est_id=e.est_id JOIN subcidade AS s ON s.cid_id=c.cid_id JOIN armazem AS a ON c.cid_id=a.cidade_id WHERE a.armazem_id={$_SESSION['arm_id']}");
                    $sel->execute();
                    $res = $sel->fetchAll();
                    foreach($res as $v) {
                        $subcid[] = $v['subcid_nome'] . " - " . $v['est_uf'];
                    }

                    if(isset($subcid)) {
                        echo '
                            <h4 style="text-align:center;">' . $_SESSION['arm'] . ' presta serviço à:</h4>
                        ';
                        foreach($subcid as $k => $v) {
                            echo '
                                <h5 style="text-align:center;font-size:14px;">' . $v . '</h5>
                            ';
                        }
                    } else {
                        echo '
                            <h4 style="text-align:center;font-size:14px;">' . $_SESSION['arm'] . ' presta serviço à nenhuma cidade</h4>
                        ';
                    }
                ?>
            </div>
        </div>
        
        <?php
            include('__system__/functions/includes/modal.php');
        ?>

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
    <script src="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/owl.carousel.js"></script>
    <script src="<?= base_url(); ?>js/util.js"></script>
    <script src="<?= base_url(); ?>js/verificaLogin.js"></script>
    <script src="<?= base_url(); ?>js/listArmazem.js"></script>
    <script src="<?= base_url(); ?>js/main.js"></script>
    <script src="<?= base_url(); ?>js/login.js"></script>
</body>
</html>