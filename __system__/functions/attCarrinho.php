<?php
    require_once 'connection/conn.php';

    if(isXmlHttpRequest()) {
        $json['type'] = "success";
        $json['answer'] = NULL;

        if(isset($_POST['id_prod'])) {
            $id = $_POST['id_prod'];
            $qtd_post = $_POST['qtd_prod'];
            if($qtd_post > 0) {
                $sel = $conn->prepare("SELECT * FROM dados_armazem WHERE produto_id=$id AND armazem_id={$_SESSION['arm_id']}");
                $sel->execute();
                $rows = $sel->fetchAll();
                foreach($rows as $row) {
                    $qtd_prod = $row['produto_qtd'];
                }
                if(($qtd_prod >= 20) && ($qtd_post <= 20)) {
                    $_SESSION['carrinho'][$id] = $qtd_post;
                    $json['answer'] = "Produto adicionado ao carrinho";
                } elseif(($qtd_prod < 20) && ($qtd_post <= $qtd_prod)) {
                    $_SESSION['carrinho'][$id] = $qtd_post;
                    $json['answer'] = "Produto adicionado ao carrinho";
                } elseif(($qtd_prod >= 20) && ($qtd_post >= 20)) {
                    $json['type'] = "error";
                    $json['answer'] = "No máximo 20 produtos";
                } else {
                    $json['type'] = "error";
                    $json['answer'] = "No máximo $qtd_prod produtos";
                }
            } else {
                if(isset($_SESSION['carrinho'][$id])) {
                    unset($_SESSION['carrinho'][$id]);
                    if(empty($_SESSION['carrinho'])) {
                        unset($_SESSION['carrinho']);
                    }
                    $json['answer'] = "Produto removido do carrinho";
                } else {
                    $json['type'] = "error";
                    $json['answer'] = "Produto não está no carrinho";
                }
            }
        } elseif(isset($_POST['produto_id'])) {
            if(isset($_SESSION['carrinho'][$_POST['produto_id']])) {
                unset($_SESSION['carrinho'][$_POST['produto_id']]);
                $json['answer'] = "Produto retirado do carrinho";
            } else {
                $json['type'] = "error";
                $json['answer'] = "Produto não está mais no carrinho";
            }
            if(empty($_SESSION['carrinho'])) {
                unset($_SESSION['carrinho']);
            }
        } elseif(isset($_POST['limpaCart'])) {
            if(isset($_SESSION['carrinho'])) {
                unset($_SESSION['carrinho']);
                $json['answer'] = "Carrinho foi limpo";
            } else {
                $json['type'] = "error";
                $json['answer'] = "Carrinho está vazio";
            }
        } elseif(isset($_POST['prod_id'])) {
            $id = $_POST['prod_id'];
            $qtd_post = $_POST['qtd_prod'];
            if($qtd_post > 0) {
                $sel = $conn->prepare("SELECT * FROM dados_armazem WHERE produto_id=$id AND armazem_id={$_SESSION['arm_id']}");
                $sel->execute();
                $rows = $sel->fetchAll();
                foreach($rows as $row) {
                    $qtd_prod = $row['produto_qtd'];
                }
                if(($qtd_prod >= 20) && ($qtd_post <= 20)) {
                    $_SESSION['carrinho'][$id] = $qtd_post;
                    $json['answer'] = "Carrinho atualizado";
                } elseif(($qtd_prod < 20) && ($qtd_post <= $qtd_prod)) {
                    $_SESSION['carrinho'][$id] = $qtd_post;
                    $json['answer'] = "Carrinho atualizado";
                } elseif(($qtd_prod >= 20) && ($qtd_post >= 20)) {
                    $json['type'] = "error";
                    $json['answer'] = "No máximo 20 produtos";
                } else {
                    $json['type'] = "error";
                    $json['answer'] = "No máximo $qtd_prod produtos";
                }
            } else {
                if(isset($_SESSION['carrinho'][$id])) {
                    unset($_SESSION['carrinho'][$id]);
                    if(empty($_SESSION['carrinho'])) {
                        unset($_SESSION['carrinho']);
                    }
                    $json['answer'] = "Produto removido do carrinho";
                } else {
                    $json['type'] = "error";
                    $json['answer'] = "Produto não está mais no carrinho";
                }
            }
        }

        echo json_encode($json);
    }
?>