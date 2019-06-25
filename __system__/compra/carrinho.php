<?php
    $empty = TRUE;
    $logado = TRUE;
    $totDesconto = 0;
    $totCompra = 0;
    $_SESSION['totCompra'] = 0;

    function getProductsByIds($ids) {
        global $conn;
        $sel = $conn->prepare("SELECT p.produto_id, p.produto_nome, d.produto_qtd, p.produto_img, p.produto_tamanho, d.produto_preco, d.produto_desconto_porcent, m.marca_nome, pr.promo_desconto FROM produto AS p JOIN dados_armazem AS d ON p.produto_id=d.produto_id JOIN marca_prod AS m ON p.produto_marca=m.marca_id LEFT JOIN dados_promocao AS dp ON p.produto_id=dp.produto_id LEFT JOIN promocao_temp AS pr ON dp.promo_id=pr.promo_id WHERE d.armazem_id={$_SESSION['arm_id']} AND p.produto_id IN (".$ids.")");
        $sel->execute();
        if($sel->rowCount() > 0) {
            while($v = $sel->fetch( PDO::FETCH_ASSOC )) {
                $dados[] = $v;
            }
        }
        return $dados;
    }

    function getContentCart() {
        global $conn;
        $results = array();
        
        if(isset($_SESSION['carrinho'])) {
            $cart = $_SESSION['carrinho'];
            $products =  getProductsByIds(implode(',', array_keys($cart)));

            foreach($products as $k => $product) {
                if($product['produto_desconto_porcent'] != "") {
                    $product["produto_desconto"] = $product["produto_preco"]*($product["produto_desconto_porcent"]/100);
                    $product["produto_desconto"] = number_format($product["produto_desconto"], 2, '.', '');
                    $product["produto_desconto"] = $product["produto_preco"]-$product["produto_desconto"];
                    $results[$k] = $product;
                    $results[$k]['subtotal'] = $cart[$product['produto_id']] * $product['produto_desconto'];
                } elseif($product['promo_desconto']) {
                    $product["produto_desconto"] = $product["produto_preco"]*($product["promo_desconto"]/100);
                    $product["produto_desconto"] = number_format($product["produto_desconto"], 2, '.', '');
                    $product["produto_desconto"] = $product["produto_preco"]-$product["produto_desconto"];
                    $results[$k] = $product;
                    $results[$k]['subtotal'] = $cart[$product['produto_id']] * $product['produto_desconto'];
                } else {
                    $results[$k] = $product;
                    $results[$k]['subtotal'] = $cart[$product['produto_id']] * $product['produto_preco'];
                }
            }
        }
        
        return $results;
    }

    if(isset($_SESSION['carrinho'])) {
        if(!empty($_SESSION['carrinho'])) {
            $empty = FALSE;
            if(!isset($_SESSION['inf_usu']['usu_id'])) {
                $logado = FALSE;
            }
            $resultsCarts = getContentCart();
            
            foreach($resultsCarts as $k => $v) {
                if($v['produto_desconto_porcent'] <> "") {
                    $v["produto_desconto"] = $v["produto_preco"]*($v["produto_desconto_porcent"]/100);
                    $v["produto_desconto"] = number_format($v["produto_desconto"], 2, '.', '');
                    $totDesconto += ($v["produto_desconto"] * $_SESSION['carrinho'][$v['produto_id']]);
                    $v["produto_desconto"] = $v["produto_preco"]-$v["produto_desconto"];
                    $v["produto_desconto"] = number_format($v["produto_desconto"], 2, ',', '.');
                } elseif($v['promo_desconto']) {
                    $v["produto_desconto"] = $v["produto_preco"]*($v["promo_desconto"]/100);
                    $v["produto_desconto"] = number_format($v["produto_desconto"], 2, '.', '');
                    $totDesconto += ($v["produto_desconto"] * $_SESSION['carrinho'][$v['produto_id']]);
                    $v["produto_desconto"] = $v["produto_preco"]-$v["produto_desconto"];
                    $v["produto_desconto"] = number_format($v["produto_desconto"], 2, ',', '.');
                }
                
                $_SESSION['totCompra'] += $v['subtotal'];
                $_SESSION['subtotal'][$k] = $v['subtotal'];
                $v['subtotal'] = number_format($v['subtotal'], 2, ',', '.');
                $v["produto_preco"] = number_format($v["produto_preco"], 2, ',', '.');
                $v['carrinho'] = $_SESSION['carrinho'][$v['produto_id']];

                $produtosCart[] = $v;
            }
            
            if(isset($_SESSION['cupom_compra'])) {
                $_SESSION['totCompraCupom'] = $_SESSION['totCompra'];
                $totCupomPorc = $_SESSION['totCompra']*($_SESSION['cupom_compra']['cupom_desconto_porcent']/100);
                $totCupomPorc = number_format($totCupomPorc,2,'.','');
                $_SESSION['totCompra'] -= $totCupomPorc;
            }

            if(isset($_SESSION['subcid_frete'])) {
                if($_SESSION['subcid_frete'] > 0) {
                    $_SESSION['totCompra'] += $_SESSION['subcid_frete'];
                }
                $frete = number_format($_SESSION['subcid_frete'], 2, ',', '.');
            }

            $totDesconto = number_format($totDesconto, 2, ',', '.');
            $totCompra = number_format($_SESSION['totCompra'], 2, ',', '.');
        }
    }
?>
<ul class="progress-tracker progress-tracker--word progress-tracker--word-left progress-tracker--center anim-ripple-large">
    <li class="progress-step is-active">
        <span class="progress-marker"></span>
        <span class="progress-text">
            <h4 class="progress-title">PASSO 1</h4>
            <i class="fas fa-shopping-cart"></i> CARRINHO
        </span>
    </li>
    <li class="progress-step">
        <span class="progress-marker"></span>
        <span class="progress-text">
            <h4 class="progress-title">PASSO 2</h4>
            <i class="fas fa-map-marker-alt"></i> ENDEREÇO
        </span>
    </li>
    <li class="progress-step">
        <span class="progress-marker"></span>
        <span class="progress-text">
            <h4 class="progress-title">PASSO 3</h4>
            <i class="far fa-clock"></i> AGENDAMENTO
        </span>
    </li>
    <li class="progress-step">
        <span class="progress-marker"></span>
        <span class="progress-text">
            <h4 class="progress-title">PASSO 4</h4>
            <i class="far fa-credit-card"></i> PAGAMENTO
        </span>
    </li>
    <li class="progress-step">
        <span class="progress-marker"></span>
        <span class="progress-text">
            <h4 class="progress-title">PASSO 5</h4>
            <i class="fas fa-file-alt"></i> EXTRATO
        </span>
    </li>
</ul>
<h2 class="defaultTitle"><i class="fas fa-shopping-cart"></i> MEU CARRINHO</h2>
<?php
    if(!$empty):?>
        <div class="divShowOpt">
            <h2 class="summaryTitle">RESUMO</h2>
            <div class="divisorSummary"></div>
            <div class="summarySubTitles">
                <h3 class="totalDesc">DESCONTOS:</h3><h3 class="valueDesc">- R$<?= $totDesconto; ?></h3>
            </div>
            <div class="summarySubTitles">
                <h2 class="totalPrice">TOTAL DA COMPRA:</h2><h2 class="valueBuy">R$<?= $totCompra; ?></h2>
            </div>
            <?php
                if(isset($_SESSION['subcid_frete'])):?>
                    <div class="summarySubTitles">
                        <h2 class="totalFrete">FRETE:</h2><h2 class="valueFrete">R$<?= $frete; ?></h2>
                    </div>
                    <script>
                        $('.divShowTot').css({'height':'auto'});
                    </script>
                    <?php
                endif;
            ?>
        </div>
        <div class="divShowOptBtn">
            <div class="inlineDivShowOptBtn">
                <a class="linkShop" href="<?= base_url_php(); ?>">CONTINUAR COMPRANDO<br><i class="fas fa-arrow-left"></i></a>
            </div>
            <div class="inlineDivShowOptBtn">
                <button class="limparCart">LIMPAR CARRINHO<br><i class="far fa-trash-alt"></i></button>
            </div>
            <div class="inlineDivShowOptBtn">
                <button class="addCupom">ADICIONAR CUPOM<br><i class="fas fa-tag"></i></button>
            </div>
            <div class="divAddCupom"></div>
            <div class="divAnswer"></div>
            <div class="inlineDivShowOptBtn">
                <button class="finalizaCompra">PRÓXIMO PASSO<br><i class="fas fa-arrow-right"></i></button>
            </div>    
        </div>
        <div class="divTable">
            <table class="divShowProdFav tableCart" width="100%" padding="0" margin="0">
                <tr class="trNames">
                    <th>PRODUTO</th>
                    <th>QUANTIDADE</th>
                    <th>PREÇO</th>
                    <th>SUBTOTAL</th>
                    <th></th>
                </tr>
                <?php
                    foreach($produtosCart as $v):?>
                        <tr class="trCart">
                            <td class="tdCart" width="50%">
                                <img class="imgCart" src="<?= base_url_adm() . "imagens_produtos/" . $v['produto_img']; ?>"/>
                                <h5 class="titleProdCart">
                                    <?= $v['produto_nome'] . " - " . $v['produto_tamanho']; ?>
                                </h5>
                                <h5 class="brandProdCart"><?= $v['marca_nome']; ?></h5>
                            </td>
                            <td class="tdCart" width="15%">
                                <input type='number' min='0' max='20' class="qtdProdCart" id-prod="<?= $v['produto_id']; ?>" value="<?= $v['carrinho']; ?>">
                            </td>
                            <td class="tdCart" width="15%">
                                <?php
                                    if($v['produto_desconto_porcent'] || $v['promo_desconto']):?>
                                        <h3 class="descProdCart">R$<?= $v['produto_preco']; ?></h3>
                                        <h3 class="priceProdCart">R$<?= $v['produto_desconto']; ?></h3>
                                        <?php
                                    else:?>
                                        <h3 class="descProdCart">-</h3>
                                        <h3 class="priceProdCart">R$<?= $v['produto_preco']; ?></h3>
                                        <?php
                                    endif;
                                ?>
                            </td>
                            <td class="tdCart" width="15%">
                                <h3 class="priceProdCart subtot<?= $v['produto_id']; ?>">
                                    R$<?= $v['subtotal']; ?>
                                </h3>
                            </td>
                            <td class="tdCart" width="5%">
                                <button class="tirarProd btnProdCart" id-prod="<?= $v['produto_id']; ?>"><i class="far fa-times-circle"></i></button>
                            </td>
                        </tr>
                        <?php
                    endforeach;
                ?>
            </table>
        </div>
        <div class="divShowTot">
            <h2 class="summaryTitle">RESUMO</h2>
            <div class="divisorSummary"></div>
            <div class="summarySubTitles">
                <h3 class="totalDesc">DESCONTOS:</h3><h3 class="valueDesc">- R$<?= $totDesconto; ?></h3>
            </div>
            <div class="summarySubTitles">
                <h2 class="totalPrice">TOTAL DA COMPRA:</h2><h2 class="valueBuy">R$<?= $totCompra; ?></h2>
            </div>
            <?php
                if(isset($_SESSION['subcid_frete'])):?>
                    <div class="summarySubTitles">
                        <h2 class="totalFrete">FRETE:</h2><h2 class="valueFrete">R$<?= $frete; ?></h2>
                    </div>
                    <script>
                        $('.divShowTot').css({'height':'auto'});
                    </script>
                    <?php
                endif;
            ?>
        </div>
        <div class="divShowOptDesk">
            <button class="limparCart">LIMPAR CARRINHO <i class="far fa-trash-alt"></i></button>
            <div class="divButtonCupom">
                <button class="addCupom">ADICIONAR CUPOM <i class="fas fa-tag"></i></button>
            </div>
            <div class="divAddCupom"></div>
            <div class="divAnswer"></div>
            <button class="finalizaCompra">PRÓXIMO PASSO <i class="fas fa-arrow-right"></i></button><br>
            <a class="linkShop" href="<?= base_url_php(); ?>"><i class="fas fa-arrow-left"></i> CONTINUAR COMPRANDO</a>
        </div>
        <script>
            attCarrinho();
            verificaCupom();
            botaoAddCupom();

            $('.finalizaCompra').click(function() {
                <?php
                    if($logado):?>
                        buscaEndereco();
                        <?php
                    else:?>
                        Toast.fire({
                            type: 'error',
                            title: 'Você precisa estar logado'
                        });

                        $("#usu_email_login").val("");
                        $("#usu_senha_login").val("");
                        $(".help-block-login").html("");
                        modal.style.display = "block";
                        <?php
                    endif;
                ?>
            });
        </script>
        <?php
    else:?>
        <div class="divTable">
            <table class="divShowProdFav tableCart" width="100%" padding="0" margin="0">
                Sem produtos no carrinho!
            </table>
        </div>
        <?php
    endif;
?>