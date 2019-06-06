<?php
    require_once 'connection/conn.php';

    if(isXmlHttpRequest()) {
        if(isset($_POST['buscaProd_id'])) {
            $json['produto'] = NULL;
            $sel = $conn->prepare("SELECT c.categ_nome, s.subcateg_nome, d.depart_nome, p.produto_id, p.produto_img, p.produto_descricao, p.produto_nome, p.produto_tamanho, m.marca_nome, da.produto_qtd, da.produto_preco, da.produto_desconto_porcent FROM produto AS p JOIN categ AS c ON c.categ_id=p.produto_categ JOIN subcateg AS s ON c.subcateg_id=s.subcateg_id JOIN departamento AS d ON s.depart_id=d.depart_id JOIN marca_prod AS m ON p.produto_marca=m.marca_id JOIN dados_armazem AS da ON p.produto_id=da.produto_id WHERE p.produto_id={$_POST['buscaProd_id']} AND da.armazem_id={$_SESSION['arm_id']}");
            $sel->execute();
            if($sel) {
                if($sel->rowCount() > 0) {
                    $prods = $sel->fetchAll();
                    foreach($prods as $v) {
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
                        }

                        $v["produto_preco"] = number_format($v["produto_preco"], 2, ',', '.');
                        if(isset($_SESSION['carrinho'][$v['produto_id']])) {
                            $v["carrinho"] = $_SESSION['carrinho'][$v['produto_id']];
                        } else {
                            $v["carrinho"] = 0;
                        }

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