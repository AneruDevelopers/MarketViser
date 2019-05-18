<?php
    require_once 'connection/conn.php';

    if(isXmlHttpRequest()) {
        if(isset($_POST['buscaBarra'])) {
            $json = array();
            $json["empty"] = TRUE;
            $json['prods'] = array();

            $sel = $conn->prepare("SELECT * FROM produto AS p JOIN dados_armazem AS d ON p.produto_id=d.produto_id WHERE d.armazem_id={$_SESSION['arm_id']} AND MATCH (p.produto_nome, p.produto_descricao, p.produto_tamanho) AGAINST (:search);");
            $sel->bindValue(":search", "{$_POST["buscaBarra"]}");
            $sel->execute();
            if($sel->rowCount() > 0) {
                $json['empty'] = FALSE;
                
                $rows = $sel->fetchAll();
                foreach($rows as $v) {
                    if($v['produto_desconto_porcent'] <> "") {
                        $v["produto_desconto"] = $v["produto_preco"]*($v["produto_desconto_porcent"]/100);
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