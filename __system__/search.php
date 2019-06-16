<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>e.conomize | Busca de Produtos</title>
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

		<!-- Title/Display Products -->

        <div class="l-mainFiltroPesq">
            <h2 class="tituloOfertas">
                <?= isset($_POST['buscaBarra']) ? "Sua pesquisa sobre: " . $_POST['buscaBarra'] : "Pesquise seu produto no campo acima"; ?>
            </h2>
            <div class="divShowProdFav">
                <?php
                    if(isset($_POST['buscaBarra'])) {
                        $sel = $conn->prepare("SELECT * FROM produto AS p JOIN dados_armazem AS d ON p.produto_id=d.produto_id LEFT JOIN dados_promocao AS dp ON p.produto_id=dp.produto_id LEFT JOIN promocao_temp AS pr ON dp.promo_id=pr.promo_id WHERE d.armazem_id={$_SESSION['arm_id']} AND MATCH (p.produto_nome, p.produto_descricao, p.produto_tamanho) AGAINST (:search);");
                        $sel->bindValue(":search", "{$_POST["buscaBarra"]}");
                        $sel->execute();
                        if($sel->rowCount() > 0) {
                            $rows = $sel->fetchAll();
                            foreach($rows as $v):?>
                                <div class="prodFilter">
                                    <div class="btnFavoriteFilter btnFavorito<?= $v['produto_id']; ?>">
                                        
                                    </div>
                                    <img src="<?= base_url(); ?>admin_area/imagens_produtos/<?= $v["produto_img"]; ?>"/>
                                    <?php 
                                        if($v['produto_desconto_porcent'] <> "") {
                                            $v["produto_desconto"] = $v["produto_preco"]*($v["produto_desconto_porcent"]/100);
                                            $v["produto_desconto"] = number_format($v["produto_desconto"], 2, '.', '');
                                            $v["produto_desconto"] = $v["produto_preco"]-$v["produto_desconto"];
                                            $v["produto_desconto"] = number_format($v["produto_desconto"], 2, ',', '.');
                                        } elseif($v['promo_desconto']) {
                                            $v["produto_desconto"] = $v["produto_preco"]*($v["promo_desconto"]/100);
                                            $v["produto_desconto"] = number_format($v["produto_desconto"], 2, '.', '');
                                            $v["produto_desconto"] = $v["produto_preco"]-$v["produto_desconto"];
                                            $v["produto_desconto"] = number_format($v["produto_desconto"], 2, ',', '.');
                                        }
                                        $v['produto_preco'] = number_format($v["produto_preco"], 2, ',', '.');
                                    ?>
                                    <?= isset($v["produto_desconto"]) ? '<p class="divProdPromo">-' . $v['produto_desconto_porcent'] . $v['promo_desconto'] . '%</p>' : '' ; ?>
                                    <div class='divisorFilter'></div>
                                    <h5 class='titleProdFilter'><?= $v["produto_nome"]; ?> - <?= $v["produto_tamanho"]; ?></h5>
                                    <p class='priceProdFilter'>
                                        <?= isset($v["produto_desconto"]) ? '<span class="divProdPrice1">R$' . $v['produto_preco'] . '</span> R$' . $v['produto_desconto'] : 'R$ ' . $v["produto_preco"]; ?>
                                    </p>
                                    <div>
                                        <?php 
                                            if($v["produto_qtd"] > 0):?>
                                                <form class="formBuy">
                                                    <input type="hidden" value="<?= $v["produto_id"]; ?>" name="id_prod"/>
                                                    <input type="number" min="0" max="20" value="<?= isset($_SESSION['carrinho'][$v['produto_id']]) ? $_SESSION['carrinho'][$v['produto_id']] : 0 ; ?>" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                                    <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                                </form>
                                                <?php
                                            else:?>
                                                <span class="esgotQtdFilter">ESGOTADO</span>
                                                <form class="formBuy">
                                                    <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                                </form>
                                                <?php
                                            endif;
                                        ?>
                                    </div>
                                </div>
                                <?php
                            endforeach;
                        } else {
                            echo "
                                <p class='msgHelpSearch'>
                                    <h4>Não houve resposta para o que pesquisou!</h4>
                                    <b>Possíveis soluções:</b><br/>
                                    <b>1.</b> Tente ser bem específico ao que está procurando;<br/>
                                    <b>2.</b> Tente escrever pelo menos uma palavra inteira, por exemplo 'Refrigerante' ao invés de 'Refri';<br/>
                                    <b>3.</b> Não use palavras tão comuns;<br/>
                                    <b>4.</b> ...<br/>
                                </p>
                            ";
                        }
                    }
                ?>
			</div>
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
    <script src="<?= base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/owl.carousel.js"></script>
    <script src="<?= base_url(); ?>js/util.js"></script>
    <script src="<?= base_url(); ?>js/listSearch.js"></script>
    <script src="<?= base_url(); ?>js/verificaLogin.js"></script>
    <script src="<?= base_url(); ?>js/attCarrinho.js"></script>
    <script src="<?= base_url(); ?>js/listArmazem.js"></script>
    <script src="<?= base_url(); ?>js/favoritar.js"></script>
    <script src="<?= base_url(); ?>js/btnFavorito.js"></script>
    <script src="<?= base_url(); ?>js/main.js"></script>
    <script src="<?= base_url(); ?>js/login.js"></script>
</body>
</html>