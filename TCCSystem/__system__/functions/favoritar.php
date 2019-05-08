<?php
    require_once 'connection/conn.php';

    if(isXmlHttpRequest()) {
        if(isset($_POST['add_prod_id'])) {
            $json = array();
            $json['logado'] = TRUE;
    
            if(isset($_SESSION['inf_usu']['usu_id'])) {
                $sel = $conn->prepare("SELECT * FROM produtos_favorito WHERE produto_id=:p AND usu_id=:u");
                $sel->bindValue(":p", "{$_POST["add_prod_id"]}");
                $sel->bindValue(":u", "{$_SESSION["inf_usu"]["usu_id"]}");
                $sel->execute();
    
                if($sel->rowCount() > 0) {
                    $json['error'] = 'Este produto já está nos favoritos';
                } else {
                    $ins = $conn->prepare("INSERT INTO produtos_favorito(produto_id, usu_id) VALUES(:p,:u)");
                    $ins->bindValue(":p", "{$_POST["add_prod_id"]}");
                    $ins->bindValue(":u", "{$_SESSION["inf_usu"]["usu_id"]}");
                    if(!$ins->execute()) {
                        $json['error'] = $ins->errorInfo();
                    }
                }
            } else {
                $json['logado'] = FALSE;
                $json['error'] = 'Você precisa estar logado';
            }
        } elseif(isset($_POST['rem_prod_id'])) {
            $json['error'] = NULL;
    
            $sel = $conn->prepare("DELETE FROM produtos_favorito WHERE produto_id=:p AND usu_id=:u");
            $sel->bindValue(":p", "{$_POST["rem_prod_id"]}");
            $sel->bindValue(":u", "{$_SESSION["inf_usu"]["usu_id"]}");
            
            if($sel->execute()) {
                $json['success'] = "Deletado com sucesso";
            } else {
                $json['error'] = "Erro inesperado";
            }
        }
        echo json_encode($json);
    } else {
        header('Location: ../');
    }
?>