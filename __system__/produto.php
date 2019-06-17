<?php
    if(isset($URL[2])) {
        $sel = $conn->prepare("SELECT c.categ_nome, s.subcateg_nome, d.depart_nome, p.produto_id, p.produto_img, p.produto_descricao, p.produto_nome, p.produto_tamanho, da.produto_qtd, da.produto_desconto_porcent, da.produto_preco, m.marca_nome, pr.promo_desconto FROM produto AS p JOIN dados_armazem AS da ON da.produto_id=p.produto_id JOIN categ AS c ON c.categ_id=p.produto_categ JOIN subcateg AS s ON c.subcateg_id=s.subcateg_id JOIN departamento AS d ON s.depart_id=d.depart_id JOIN marca_prod AS m ON p.produto_marca=m.marca_id LEFT JOIN dados_promocao AS dp ON p.produto_id=dp.produto_id LEFT JOIN promocao_temp AS pr ON dp.promo_id=pr.promo_id WHERE da.armazem_id={$_SESSION['arm_id']}");
        $sel->execute();
        while($v = $sel->fetch( PDO::FETCH_ASSOC )) {
            if($URL[2] == md5($v['produto_id'])) {
                if($v['produto_qtd'] > 0) {
                    $v['empty'] = false;
                } else {
                    $v['empty'] = true;
                }

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

                $v["produto_preco"] = number_format($v["produto_preco"], 2, ',', '.');
                if(isset($_SESSION['carrinho'][$v['produto_id']])) {
                    $v["carrinho"] = $_SESSION['carrinho'][$v['produto_id']];
                } else {
                    $v["carrinho"] = 0;
                }
                
                $product = $v;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>e.conomize | <?= isset($product) ? $product['produto_nome'] . " - " . $product['produto_tamanho'] : "Produto inexistente"; ?></title>
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

        <div class="l-mainProduto">
            <div class="l-pageProd">
                <?php
                    if(isset($product)):?>
                        <div class="divProdutoLeft">
                            <img class="imgProduto" src="<?= base_url_adm(); ?>imagens_produtos/<?= $product['produto_img']; ?>"/>
                        </div>

                        <div class="divProdutoRight">
                        <div class="infProduto">
                            <h2 class="categProduto"><?= $product['depart_nome']; ?> <span class="ponto">.</span> <?= $product['subcateg_nome']; ?> <span class="ponto">.</span> <?= $product['categ_nome']; ?></h2>
                            <span class="marcaProdutoModal"><?= $product['marca_nome']; ?></span>
                            <h2 class="nomeProdutoModal">
                                <?= $product['produto_nome']; ?><br/>
                                <span class="volProdutoModal"><?= $product['produto_tamanho']; ?></span>
                            </h2>
                        </div>
                        <div class="precoProduto">
                            <p class="precoProdutoModal">
                                <?php
                                    if($product['produto_desconto_porcent'] || $product['promo_desconto']):?>
                                                <span class="antPreco">R$ <?= $product['produto_preco']; ?></span><br/>
                                                R$ <?= $product['produto_desconto']; ?>
                                            </p>
                                        </div>
                                        <?php
                                    else:?>
                                                R$ <?= $product['produto_preco']; ?>
                                            </p>
                                        </div>
                                        <?php
                                    endif;

                                    if(!$product['empty']):?>
                                        <div class="cartProdutoModal cartProd">
                                            <form class="formBuy">
                                                <input type="hidden" value="<?= $product['produto_id']; ?>" name="id_prod"/>
                                                <input type="number" min="0" max="20" value="<?= $product['carrinho']; ?>" class="inputQtdModal inputBuy<?= $product['produto_id']; ?>" name="qtd_prod"/>
                                                <button class="btnBuyModal" type="submit">ADICIONAR</button>
                                            </form>
                                        </div>
                                        <?php
                                    else:?>
                                        <div class="cartProdutoModal cartProd">
                                            <span class="esgotModal">ESGOTADO</span>
                                            <form class="formBuy">
                                                <button class="btnBuyModal" type="submit">ADICIONAR</button>
                                            </form>
                                        </div>
                                        <?php
                                    endif;
                                ?>
                            <div class="compProduto">
                                <p class="imgLust">Imagem meramente ilustrativa</p>
                                <p class="compartProduto">
                                    Compartilhar: &nbsp;&nbsp;
                                    <a class="linkShareProd" href="https://www.facebook.com/sharer.php?u=http://www.economize.top/produto/<?= $URL[2]; ?>" target="_blank" title="Compartilhar produto no Facebook">
                                        <button class="btnShareProd">
                                            <i class="fab fa-facebook-f"></i>
                                        </button>
                                    </a>
                                    <a class="linkShareProd" href="http://twitter.com/intent/tweet?text=<?= $product['produto_nome'] . " - " . $product['produto_tamanho']; ?>&url=http://www.economize.top/produto/<?= $URL[2]; ?>&via=economizebrazil" title="" target="_blank">
                                        <button class="btnShareProd">
                                            <i class="fab fa-twitter"></i>
                                        </button>
                                    </a>
                                    <a class="linkShareProd" href="https://web.whatsapp.com/send?text=<?= $product['produto_nome'] . " - " . $product['produto_tamanho']; ?> http://www.economize.top/produto/<?= $URL[2]; ?>" class="pc" target="_blank">
                                        <button class="btnShareProd">
                                            <i class="fab fa-whatsapp"></i> Web
                                        </button>
                                    </a>
                                    <a class="linkShareProd" href="whatsapp://send?text=<?= $product['produto_nome'] . " - " . $product['produto_tamanho']; ?> http://www.economize.top/produto/<?= $URL[2]; ?>" data-action="share/whatsapp/share">
                                        <button class="btnShareProd">
                                            <i class="fab fa-whatsapp"></i> App
                                        </button>
                                    </a>
                                </p>
                            </div>
                            <div class="descProduto">
                                <h4 class="descTitleProduto">Descrição:</h4>
                                <p>
                                    <?= $product['produto_descricao']; ?>
                                </p>
                            </div>
                        </div>
                        <?php
                    else:?>
                        <div class="msgNoProds">
                            <h3>O produto procurado é inexistente ou deletado!</h3>
                        </div>
                        <?php
                    endif;
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
    <script src="<?= base_url(); ?>js/verificaLogin.js"></script>
    <script src="<?= base_url(); ?>js/attCarrinho.js"></script>
    <script src="<?= base_url(); ?>js/listArmazem.js"></script>
    <script src="<?= base_url(); ?>js/favoritar.js"></script>
    <script src="<?= base_url(); ?>js/btnFavorito.js"></script>
    <script src="<?= base_url(); ?>js/main.js"></script>
    <script src="<?= base_url(); ?>js/login.js"></script>
</body>
</html>