<?php
    require_once 'connection/conn.php';

    $json = array();
    $json['status'] = 1;
    $json['tem_favorito'] = TRUE;
    $json['nao_fav'] = NULL;
    
    $sel = $conn->prepare("SELECT produto_id FROM produto");
    $sel->execute();
    if($sel->rowCount() > 0) {
        $rows = $sel->fetchAll();
        foreach($rows as $k => $value) {
            $json['prod_id'][$k] = $value['produto_id'];
            $json['fav_id'][$k] = NULL;
            if(isset($_SESSION['inf_usu']['usu_id'])) {
                $sel2 = $conn->prepare("SELECT favorito_id FROM produtos_favorito WHERE usu_id=:u AND produto_id=:p");
                $sel2->bindValue(":u", "{$_SESSION['inf_usu']['usu_id']}");
                $sel2->bindValue(":p", "{$value['produto_id']}");
                $sel2->execute();
                if($sel2->rowCount() > 0) {
                    $rows2 = $sel2->fetchAll();
                    foreach($rows2 as $v) {
                        $json['fav_id'][$k] = $v['favorito_id'];
                    }
                } else {
                    $nao['nao_fav'] = 1;
                }
            }
        }
        if(!empty($json['nao_fav'])) {
            $json['tem_favorito'] = FALSE;
        }
    } else {
        $json['status'] = 0;
    }

    echo json_encode($json);
?>