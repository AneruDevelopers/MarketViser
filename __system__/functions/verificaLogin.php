<?php
    require_once 'connection/conn.php';
    
    if(isXmlHttpRequest()) {
        $json = array();
        $json['logado'] = TRUE;
        $json['adm'] = FALSE;

        if(!isset($_SESSION['inf_usu']['usu_id'])) {
            $json['logado'] = FALSE;
        } else {
            $json['usuario'] = $_SESSION['inf_usu'];
            if($_SESSION["inf_usu"]['usu_tipo_id'] == 3) {
                $json['adm'] = TRUE;
            }
        }

        echo json_encode($json);
    } else {
        header('Location: ../');
    }
?>