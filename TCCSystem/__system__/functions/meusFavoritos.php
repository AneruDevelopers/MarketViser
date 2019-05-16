<?php
    require_once 'connection/conn.php';
    
    if(isXmlHttpRequest()) {
        $json = array();
        $json['logado'] = TRUE;
        $json['tem_favorito'] = TRUE;
        $json['produtos'] = array();
        
        if(isset($_SESSION['inf_usu']['usu_id'])) {
            $sel = $conn->prepare("SELECT * FROM produto AS p JOIN produtos_favorito AS pf ON p.produto_id=pf.produto_id WHERE pf.usu_id={$_SESSION['inf_usu']['usu_id']}");
            $sel->execute();
            if($sel->rowCount() > 0) {
                $rows = $sel->fetchAll();
                foreach($rows as $v) {
                    if($v["produto_desconto_porcent"] <> "") {
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