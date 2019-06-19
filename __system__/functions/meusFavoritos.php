<?php
    require_once 'connection/conn.php';
    
    if(isXmlHttpRequest()) {
        $json = array();
        $json['logado'] = TRUE;
        $json['tem_favorito'] = TRUE;
        $json['produtos'] = array();
        
        if(isset($_SESSION['inf_usu']['usu_id'])) {
            $sel = $conn->prepare("SELECT p.produto_id, p.produto_img, p.produto_descricao, p.produto_nome, p.produto_tamanho, d.produto_qtd, d.produto_preco, d.produto_desconto_porcent, pr.promo_desconto FROM produto AS p JOIN produtos_favorito AS pf ON p.produto_id=pf.produto_id JOIN dados_armazem AS d ON p.produto_id=d.produto_id LEFT JOIN dados_promocao AS dp ON p.produto_id=dp.produto_id LEFT JOIN promocao_temp AS pr ON dp.promo_id=pr.promo_id WHERE d.armazem_id={$_SESSION['arm_id']} AND pf.usu_id={$_SESSION['inf_usu']['usu_id']}");
            $sel->execute();
            if($sel->rowCount() > 0) {
                while($v = $sel->fetch(PDO::FETCH_ASSOC)) {
                    if($v["produto_desconto_porcent"] <> "") {
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
                    
                    $json['produtos'][] = $v;
                }
            } else {
                $json['tem_favorito'] = FALSE;
            }
        } else {
            $json['logado'] = FALSE;
        }

        echo json_encode($json);
    } else {
        header('Location: ../');
    }
?>