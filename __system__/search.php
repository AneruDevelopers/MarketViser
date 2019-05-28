<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>e.conomize | Busca de Produtos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url(); ?>img/e_icon.png"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url(); ?>/style/css/main.css">
    <link href="<?= base_url(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>style/fonts/Icons/icons_pack/font/flaticon.css">
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
            include('functions/includes/bottom.html');
        ?>
        </div>

		<!-- Title/Display Products -->

        <div class="l-mainFiltroPesq">
            <h2 class="tituloOfertas">
                <?= isset($_POST['buscaBarra']) ? "Sua pesquisa sobre: " . $_POST['buscaBarra'] : "Pesquise seu produto no campo acima" ; ?>
            </h2>
            <div class="divShowProdFav">
                <?php
                    if(isset($_POST['buscaBarra'])) {
                        $sel = $conn->prepare("SELECT * FROM produto AS p JOIN dados_armazem AS d ON p.produto_id=d.produto_id WHERE d.armazem_id={$_SESSION['arm_id']} AND MATCH (p.produto_nome, p.produto_descricao, p.produto_tamanho) AGAINST (:search);");
                        $sel->bindValue(":search", "{$_POST["buscaBarra"]}");
                        $sel->execute();
                        if($sel->rowCount() > 0) {
                            $rows = $sel->fetchAll();
                            foreach($rows as $row) {
                                if($row['produto_desconto_porcent']) {
                                    $row["produto_desconto"] = $row["produto_preco"]*($row["produto_desconto_porcent"]/100);
                                    $row["produto_desconto"] = $row["produto_preco"]-$row["produto_desconto"];
                                    $row["produto_desconto"] = number_format($row["produto_desconto"], 2, ',', '.');
                                    $row["produto_preco"] = number_format($row["produto_preco"], 2, ',', '.');
                                    if(isset($_SESSION['carrinho'][$row['produto_id']])) {
                                        $row["carrinho"] = $_SESSION['carrinho'][$row['produto_id']];
                                    } else {
                                        $row["carrinho"] = 0;
                                    }
                                    echo '
                                        <div class="prodFilter">
                                            <div class="btnFavoriteFilter btnFavorito' . $row['produto_id'] . '">
                                                
                                            </div>
                                            <img src="' . base_url_adm() . 'imagens_produtos/' . $row['produto_img'] . '"/>
                                            <p class="divProdPromo">-' . $row['produto_desconto_porcent'] . '%</p>
                                            <div class="divisorFilter"></div>
                                            <h5 class="titleProdFilter">' . $row['produto_nome'] . ' - ' . $row['produto_tamanho'] . '</h5>
                                            <p class="priceProdFilter">
                                                <span class="divProdPrice1">R$' . $row['produto_preco'] . '</span> R$' . $row['produto_desconto'] . '
                                            </p>
                                            <div>
                                                <button class="btnBuyFilter btnBuy">ADICIONAR</button>
                                                <form class="formBuy">
                                                    <input type="hidden" value="' . $row['produto_id'] . '" name="id_prod"/>
                                                    <input type="number" min="0" max="20" value="' . $row['carrinho'] . '" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                                </form>
                                            </div>
                                        </div>
                                    ';
                                } else {
                                    $row["produto_preco"] = number_format($row["produto_preco"], 2, ',', '.');
                                    if(isset($_SESSION['carrinho'][$row['produto_id']])) {
                                        $row["carrinho"] = $_SESSION['carrinho'][$row['produto_id']];
                                    } else {
                                        $row["carrinho"] = 0;
                                    }
                                    echo '
                                        <div class="prodFilter">
                                            <div class="btnFavoriteFilter btnFavorito' . $row['produto_id'] . '">
                                                
                                            </div>
                                            <img src="' . base_url_adm() . 'imagens_produtos/' . $row['produto_img'] . '"/>
                                            <div class="divisorFilter"></div>
                                            <h5 class="titleProdFilter">' . $row['produto_nome'] . ' - ' . $row['produto_tamanho'] . '</h5>
                                            <p class="priceProdFilter">
                                                R$' . $row['produto_preco'] . '
                                            </p>
                                            <div>
                                                <button class="btnBuyFilter btnBuy">ADICIONAR</button>
                                                <form class="formBuy">
                                                    <input type="hidden" value="' . $row['produto_id'] . '" name="id_prod"/>
                                                    <input type="number" min="0" max="20" value="' . $row['carrinho'] . '" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                                </form>
                                            </div>
                                        </div>
                                    ';
                                }
                            }
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

		<!-- -------------------- -->
        <div class="myModalArmazem" id="myModalArmazem">
			<div class="modalArmazemContent">
                <div class="modalArmTopContent">
                    <div class="meuArmazem">
                        
                    </div>
                    <span class="closeModalArmazem">&times;</span>
                </div>
                <div class="modalArmBottomContent">
                    <div class="Armazens">

                    </div>
                </div>
			</div>
		</div>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="modalLeftContent">
                    <form id="form-login">
                        <!-- <i class="far fa-check-circle"></i> -->
                        <h4 class="titleModalLogin">LOG IN</h4>
                        <div class="outsideSecInputCad">
                            <div class="field -md">
                                <input type="text" name="usu_email_login" id="usu_email_login" class="placeholder-shown" placeholder="Some placeholder"/>
                                <label class="labelFieldCad"><strong>EMAIL</strong></label>
                            </div>
                            <div class="help-block"></div><br/>
                        </div>
                        <div class="outsideSecInputCad">
                            <div class="field -md">
                                <input type="password" name="usu_senha_login" id="usu_senha_login" class="placeholder-shown" placeholder="Some placeholder"/>
                                <label class="labelFieldCad"><strong>SENHA</strong></label>
                            </div>
                            <div class="help-block"></div><br/>
                        </div>
                        <button class="btnSend" type="submit" id="btn-login" value="Entrar">ENTRAR</button>
                        <div class="help-block-login"></div>
                    </form>
                </div>
                <div class="modalRightContent">
                    <span class="close">&times;</span>
                    <p class="textModal">Olá, amigo!</p>
                    <p class="textModalBottom">Entre com seus detalhes pessoais e comece sua jornada conosco</p>
                    <div class="divLinkCad">    
                        <a class="linkCadModal" href="<?= base_url_php(); ?>usuario/cadastro">Cadastre-se já</a>
                    </div>    
                </div>
            </div>
        </div>
        <!-- -------------------- -->

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
    <script src="<?= base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/owl.carousel.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>js/util.js"></script>
    <script src="<?= base_url(); ?>js/listSearch.js"></script>
    <script src="<?= base_url(); ?>js/verificaLogin.js"></script>
    <script src="<?= base_url(); ?>js/listDepartamento.js"></script>
    <script src="<?= base_url(); ?>js/attCarrinho.js"></script>
    <script src="<?= base_url(); ?>js/listArmazem.js"></script>
    <script src="<?= base_url(); ?>js/btnFavorito.js"></script>
</body>
</html>