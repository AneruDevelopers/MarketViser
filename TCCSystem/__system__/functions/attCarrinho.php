<?php
    require_once 'connection/conn.php';

    if(isXmlHttpRequest()) {
        $json['type'] = "success";
        $json['answer'] = NULL;

        $id = $_POST['id_prod'];
        if($_POST['qtd_prod'] > 0) {
            $_SESSION['carrinho'][$id] = $_POST['qtd_prod'];
            $json['answer'] = "Produto adicionado ao carrinho";
        } else {
            if(isset($_SESSION['carrinho'][$id])) {
                unset($_SESSION['carrinho'][$id]);
                $json['answer'] = "Produto removido do carrinho";
            } else {
                $json['type'] = "error";
                $json['answer'] = "Produto não está no carrinho";
            }
        }

        echo json_encode($json);
    }
?>