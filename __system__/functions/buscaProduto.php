<?php
    require_once 'connection/conn.php';

    if(isXmlHttpRequest()) {
        if(isset($_POST['buscaProd_id'])) {
            $json['produto'] = NULL;
            $sel = $conn->prepare("SELECT p.produto_id, p.produto_img, p.produto_descricao, p.produto_nome, p.produto_tamanho, m.marca_nome, da.produto_qtd, da.produto_preco, da.produto_desconto_porcent, pr.promo_desconto FROM produto AS p JOIN marca_prod AS m ON p.produto_marca=m.marca_id JOIN dados_armazem AS da ON p.produto_id=da.produto_id LEFT JOIN dados_promocao AS dp ON p.produto_id=dp.produto_id LEFT JOIN promocao_temp AS pr ON dp.promo_id=pr.promo_id WHERE p.produto_id={$_POST['buscaProd_id']} AND da.armazem_id={$_SESSION['arm_id']}");
            $sel->execute();
            if($sel) {
                if($sel->rowCount() > 0) {
                    while($v = $sel->fetch( PDO::FETCH_ASSOC )) {
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

                        $v['id_cript'] = MD5($v['produto_id']);

                        $json['produto'] = $v;
                    }
                }
            } else {
                $json['status'] = 0;
            }
        }

        echo json_encode($json);
    }
?>