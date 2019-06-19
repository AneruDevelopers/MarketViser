<?php
    require_once 'connection/conn.php';

    if(isXmlHttpRequest()) {
        if(isset($_POST['buscaBarra'])) {
            $json = array();
            $json["empty"] = TRUE;
            $json['prods'] = array();

            $sel = $conn->prepare("SELECT p.produto_id, p.produto_img, p.produto_descricao, p.produto_nome, p.produto_tamanho, d.produto_qtd, d.produto_preco, d.produto_desconto_porcent, pr.promo_desconto FROM produto AS p JOIN dados_armazem AS d ON p.produto_id=d.produto_id LEFT JOIN dados_promocao AS dp ON p.produto_id=dp.produto_id LEFT JOIN promocao_temp AS pr ON dp.promo_id=pr.promo_id WHERE d.armazem_id={$_SESSION['arm_id']} AND MATCH (p.produto_nome, p.produto_descricao, p.produto_tamanho) AGAINST (:search);");
            $sel->bindValue(":search", "{$_POST["buscaBarra"]}");
            $sel->execute();
            if($sel->rowCount() > 0) {
                $json['empty'] = FALSE;
                while($v = $sel->fetch( PDO::FETCH_ASSOC )) {
                    if($v['produto_qtd'] > 0) {
                        $v['empty'] = FALSE;
                    } else {
                        $v['empty'] = TRUE;
                    }

                    if($v['produto_desconto_porcent'] <> "") {
                        $v["produto_desconto"] = $v["produto_preco"]*($v["produto_desconto_porcent"]/100);
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
                    
                    $json['prods'][] = $v;
                }
            }

            echo json_encode($json);
        }
    }
?>