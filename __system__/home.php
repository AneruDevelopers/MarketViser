<?php
    if(isset($_SESSION['query_tam'])) {
        unset($_SESSION['query_tam']);
    }
    if(isset($_SESSION['query_marca'])) {
        unset($_SESSION['query_marca']);
    }
    if(isset($_SESSION['query_preco'])) {
        unset($_SESSION['query_preco']);
    }
    if(isset($_SESSION['query_fav'])) {
        unset($_SESSION['query_preco']);
    }

    //BUSCANDO PRODUTOS COM PROMOÇÕES CUMUNS
    $empty = TRUE;
    $sel = $conn->prepare("SELECT p.produto_id, p.produto_nome, d.produto_qtd, p.produto_img, p.produto_tamanho, d.produto_preco, d.produto_desconto_porcent FROM produto AS p JOIN dados_armazem AS d ON p.produto_id=d.produto_id WHERE d.produto_desconto_porcent <> '' AND d.armazem_id={$_SESSION['arm_id']}");
    $sel->execute();
    if($sel->rowCount() > 0) {
        $empty = FALSE;
        while($row = $sel->fetch( PDO::FETCH_ASSOC )) {
            if($row['produto_qtd'] > 0) {
                $row['empty'] = FALSE;
            } else {
                $row['empty'] = TRUE;
            }
            $row["produto_desconto"] = $row["produto_preco"]*($row["produto_desconto_porcent"]/100);
            $row["produto_desconto"] = number_format($row["produto_desconto"], 2, '.', '');
            $row["produto_desconto"] = $row["produto_preco"]-$row["produto_desconto"];
            
            $row["produto_preco"] = number_format($row["produto_preco"], 2, ',', '.');
            $row["produto_desconto"] = number_format($row["produto_desconto"], 2, ',', '.');
            if(isset($_SESSION['carrinho'][$row['produto_id']])) {
                $row["carrinho"] = $_SESSION['carrinho'][$row['produto_id']];
            } else {
                $row["carrinho"] = 0;
            }
            $produtos[] = $row;
        }
    }


    //BUSCANDO PROMOCÕES PERSONALIZADAS
    $empty_promo = TRUE;
    $sel_promo = $conn->prepare("SELECT p.produto_id, p.produto_nome, p.produto_img, p.produto_tamanho, pr.promo_id, pr.promo_desconto, pr.promo_nome, pr.promo_subtit, pr.promo_expira, d.produto_qtd, d.produto_preco FROM produto AS p JOIN dados_promocao AS dp ON p.produto_id=dp.produto_id JOIN promocao_temp AS pr ON pr.promo_id=dp.promo_id JOIN dados_armazem AS d ON dp.produto_id=d.produto_id WHERE pr.promo_status=1 AND d.armazem_id={$_SESSION['arm_id']} ORDER BY pr.promo_id");
    $sel_promo->execute();
    if($sel_promo->rowCount() > 0) {
        $empty_promo = FALSE;
        $promo_id = "";
        $c = 0;
        while($row = $sel_promo->fetch( PDO::FETCH_ASSOC )) {
            if($row['produto_qtd'] > 0) {
                $row['empty'] = FALSE;
            } else {
                $row['empty'] = TRUE;
            }
            $row["produto_desconto"] = $row["produto_preco"]*($row["promo_desconto"]/100);
            $row["produto_desconto"] = number_format($row["produto_desconto"], 2, '.', '');
            $row["produto_desconto"] = $row["produto_preco"]-$row["produto_desconto"];
            
            $row["produto_preco"] = number_format($row["produto_preco"], 2, ',', '.');
            $row["produto_desconto"] = number_format($row["produto_desconto"], 2, ',', '.');
            if(isset($_SESSION['carrinho'][$row['produto_id']])) {
                $row["carrinho"] = $_SESSION['carrinho'][$row['produto_id']];
            } else {
                $row["carrinho"] = 0;
            }

            // if($row['promo_expira'] != '') {
            //     $temp[$c] = $row['promo_id'];
            //     $exp = explode(" ", $row['promo_expira']);
            //     $dia = explode("-", $exp[0]);
            //     $hora = explode(":", $exp[1]);
            //     $function[$c] = $dia[0] . ", " . $dia[1] . ", " . $dia[2] . 
            //         ", " . $hora[0] . ", " . $hora[1] . ", " . $hora[2] . ", " . "'temp" . $row['promo_id'] . "'";
            // } else {
            //     $temp[$c] = FALSE;
            // }

            if($row['promo_expira'] != '') {
                $exp = explode(" ", $row['promo_expira']);
                $dia = explode("-", $exp[0]);
                $hora = explode(":", $exp[1]);

                $row['promo_expira'] = $dia[2] . "/" . $dia[1] . "/" . $dia[0] . " às " . $hora[0] . "h" . $hora[1];
            }
            
            if($promo_id != $row['promo_id']) {
                $produtos_topo[$c] = '
                <br>
                    <div class="l-prods">
                        <div class="loop owl-carousel">
                ';
                $promo_id = $row['promo_id'];
            } else {
                $produtos_topo[$c] = '';
            }

            $produtos_promo[$c] = '
                <div class="divProdCarousel">
                    <div class="btnFavorito' . $row['produto_id'] . '"></div>
                    <a class="linksProdCarousel" id-produto="' .  $row['produto_id'] . '">
                        <img class="divProdImg" src="' .  base_url_adm() . "imagens_produtos/" . $row['produto_img'] . '">
                        <div class="divisorFilterCar"></div>
                        <p class="divProdPromo">-' .  $row['promo_desconto'] . '%</p>
                        <h4 class="divProdTitle">
                            ' .  $row['produto_nome'] . " - " . $row['produto_tamanho'] . '
                        </h4>
                        <p class="divProdPrice">
                            <span class="divProdPrice1">R$ ' .  $row['produto_preco'] . '</span> R$ ' . $row['produto_desconto'] . '
                        </p>
                    </a>
            ';
            
            if($row['empty']) {
                $produtos_promo[$c] .= '
                    <div>
                        <div class="quantity">
                            <span class="esgotQtd">ESGOTADO</span>
                        </div>
                        <form class="formBuy">
                            <button class="btnBuy" type="submit">ADICIONAR</button>
                        </form>
                    </div>
                ';
            } else {
                $produtos_promo[$c] .= '
                    <div>
                        <form class="formBuy">
                            <input type="hidden" value="' .  $row['produto_id'] . '" name="id_prod"/>
                            <div class="quantity">
                                <input type="number" min="0" max="20" value="' .  $row['carrinho'] . '" class="inputQtd inputBuy' .  $row['produto_id'] . '" name="qtd_prod"/>
                            </div>
                            <button class="btnBuy" type="submit">ADICIONAR</button>
                        </form>
                    </div>
                ';
            }

            $produtos_promo[$c] .= '
                </div>
            ';
            $c++;
        }
    }
?>
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
            include('functions/includes/bottom.php');
        ?>
        </div>
        

        
        <!-- -------------------- -->



        <!-- Carousel -->
        
        <div class="l-carousel">
            <div id="owl-demo" class="owl-carousel">
                <div class="item"><img src="<?= base_url(); ?>img\Banner_TCC\Banner_Wine.png" alt="The Last of us"></div>
                <div class="item"><img src="<?= base_url(); ?>img\Banner_TCC\Banner2_Otimizado.png" alt="GTA V"></div>
                <div class="item"><img src="<?= base_url(); ?>img\Banner_TCC\Banner_junina.jpg" alt="Mirror Edge"></div>
            </div>
        </div>

        <!-- Title/Display Products -->

        <div class="l-main">
            <h2 class="defaultTitle">OFERTAS IMPERDÍVEIS</h2>
            <div class="l-prods">
                <?php
                    if(!$empty):?>
                        <div class="loop owl-carousel">
                            <?php
                            foreach($produtos as $v):?>
                                <div class="divProdCarousel">
                                    <div class="btnFavorito<?= $v['produto_id']; ?>"></div>
                                    <a class="linksProdCarousel" id-produto="<?= $v['produto_id']; ?>">
                                        <img class="divProdImg" src="<?= base_url_adm() . "imagens_produtos/" . $v['produto_img']; ?>">
                                        <div class='divisorFilterCar'></div>
                                        <p class="divProdPromo">-<?= $v['produto_desconto_porcent']; ?>%</p>
                                        <h4 class="divProdTitle">
                                            <?= $v['produto_nome'] . " - " . $v['produto_tamanho']; ?>
                                        </h4>
                                        <p class="divProdPrice">
                                            <span class="divProdPrice1">R$ <?= $v['produto_preco']; ?></span> R$ <?= $v['produto_desconto']; ?>
                                        </p>
                                    </a>
                                    <?php 
                                        if($v['empty']):?>
                                            <div>
                                                <div class="quantity">
                                                    <span class="esgotQtd">ESGOTADO</span>
                                                </div>
                                                <form class="formBuy">
                                                    <button class="btnBuy" type="submit">ADICIONAR</button>
                                                </form>
                                            </div>
                                            <?php
                                        else:?>
                                            <div>
                                                <form class="formBuy">
                                                    <input type="hidden" value="<?= $v['produto_id']; ?>" name="id_prod"/>
                                                    <div class="quantity">
                                                        <input type="number" min="0" max="20" value="<?= $v['carrinho']; ?>" class="inputQtd inputBuy<?= $v['produto_id']; ?>" name="qtd_prod"/>
                                                    </div>
                                                    <button class="btnBuy" type="submit">ADICIONAR</button>
                                                </form>
                                            </div>
                                            <?php
                                        endif;
                                    ?>
                                </div>
                                <?php
                            endforeach;?>
                        </div>
                        <?php
                    else:?>
                        <h2 class="sem_promo">Sem promoções hoje. Aproveite a barra de pesquisa</h2>
                        <?php
                    endif;
                ?>
            </div> 
                <center>
                    <img width="100%"  src="<?= base_url(); ?>img\Banner_TCC\bannerDiaDosPaisRoxo.png" alt="Banner Dia dos Pais">
                </center>
                <?php
                if(!$empty_promo):
                    foreach($produtos_promo as $k => $v):
                        echo $produtos_topo[$k];
                        echo $v;

                        $c = $k + 1;
                        if(isset($produtos_topo[$c])) {
                            if($produtos_topo[$c] != '') {
                                echo '
                                        </div>
                                    </div>
                                ';
                            }
                        } else {
                            echo '
                                    </div>
                                </div>
                            ';
                        }
                    endforeach;
                endif;
            ?>
            
        </div>

        <!-- Display Products -->

        <?php
            include('functions/includes/modal.php');
        ?>

        <div class="l-footer" id="footer">
        <?php
            include('functions/includes/footer.php');
        ?>
        </div>
        <div class="l-footerBottom" id="footerBottom">
        <?php
            include('functions/includes/bottomFooter.html');
        ?>
        </div>
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

        // if(!$empty_promo):
        //     $c = "";
        //     foreach($produtos_promo as $k => $v):
        //         if($c != $k):
        //             if($temp[$k]):
        //                 <script>
        //                     atualizaContador();
        //                 </script>
        //             endif;
        //             $c = $k;
        //         endif;
        //     endforeach;
        // endif;
    ?>
</body>
</html>