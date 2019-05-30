<?php
    if(isXmlHttpRequest()) {
        $json['status'] = 1;
        $json['error_list'] = array();

        if(isset($_POST['produto_qtd'])) {
            for($k=0; $k<count($_POST['produto_qtd']); $k++) {
                $armazem_id = $_POST['armazem'][$k];
                $produto_id = $_POST['produto'][$k];
                $produto_qtd = $_POST['produto_qtd'][$k];

                $produto_preco = $_POST['produto_preco'][$k];
                $produto_preco = str_replace(".","",$produto_preco);
                $produto_preco = str_replace(",",".",$produto_preco);
                
                $produto_desconto_porcent = $_POST['produto_desconto_porcent'][$k];
                
                if($produto_desconto_porcent != "") {
                    $ins = $conn->prepare("INSERT INTO dados_armazem(produto_id,armazem_id,produto_qtd,produto_preco,produto_desconto_porcent) VALUES ($produto_id, $armazem_id,$produto_qtd,$produto_preco,$produto_desconto_porcent)");
                } else {
                    $ins = $conn->prepare("INSERT INTO dados_armazem(produto_id,armazem_id,produto_qtd,produto_preco) VALUES ($produto_id, $armazem_id,$produto_qtd,$produto_preco)");
                }
                
                if(!$ins->execute()) {
                    $json['status'] = 0;
                }
            }
        }
        echo json_encode($json);
    }
?>