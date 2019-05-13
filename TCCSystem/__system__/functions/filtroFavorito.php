<?php
    require_once 'connection/conn.php';

    if(isXmlHttpRequest()) {
        $json = array();
        $json["empty"] = FALSE;
        $json['logado'] = TRUE;

        if(isset($_SESSION["inf_usu"]['usu_id'])) {
            if(!isset($_POST['prod_fav'])) {
                $_SESSION['query_fav'][] = "produto AS p JOIN produtos_favorito AS pf ON p.produto_id=pf.produto_id";
                $_SESSION['query_fav'][] = "WHERE pf.usu_id={$_SESSION["inf_usu"]['usu_id']} AND";

                $_SESSION['query_proc'] = str_replace("produto AS p", $_SESSION['query_fav'][0], $_SESSION['query_proc']);
                $_SESSION['query_proc'] = str_replace("WHERE", $_SESSION['query_fav'][1], $_SESSION['query_proc']);
                
                $sel = $conn->prepare($_SESSION['query_proc']);
                $sel->execute();
                if($sel->rowCount() > 0) {
                    $result = $sel->fetchAll();
                    foreach($result as $v) {
                        if($v['produto_desconto_porcent'] <> "") {
                            $v["produto_desconto"] = $v["produto_preco"]*($v["produto_desconto_porcent"]/100);
                            $v["produto_desconto"] = $v["produto_preco"]-$v["produto_desconto"];
                            $v["produto_desconto"] = number_format($v["produto_desconto"], 2, ',', '.');
                        }
                        
                        $v["produto_preco"] = number_format($v["produto_preco"], 2, ',', '.');
                        $json['produtos'][] = $v;
                    }
                } else {
                    $json['empty'] = true;
                }

                $json['query'] = $_SESSION['query_proc'];
            } else {
                $_SESSION['query_proc'] = str_replace( $_SESSION['query_fav'][0], "produto AS p", $_SESSION['query_proc']);
                $_SESSION['query_proc'] = str_replace($_SESSION['query_fav'][1], "WHERE", $_SESSION['query_proc']);
                unset($_SESSION['query_fav']);

                $sel = $conn->prepare($_SESSION['query_proc']);
                $sel->execute();
                if($sel->rowCount() > 0) {
                    $result = $sel->fetchAll();
                    foreach($result as $v) {
                        if($v['produto_desconto_porcent'] <> "") {
                            $v["produto_desconto"] = $v["produto_preco"]*($v["produto_desconto_porcent"]/100);
                            $v["produto_desconto"] = $v["produto_preco"]-$v["produto_desconto"];
                            $v["produto_desconto"] = number_format($v["produto_desconto"], 2, ',', '.');
                        }
                        
                        $v["produto_preco"] = number_format($v["produto_preco"], 2, ',', '.');
                        $json['produtos'][] = $v;
                    }
                } else {
                    $json['empty'] = true;
                }

                $json['query'] = $_SESSION['query_proc'];
            }
        } else {
            $json['logado'] = FALSE;
        }
        echo json_encode($json);
    } else {
        header('Location: ../');
    }
?>