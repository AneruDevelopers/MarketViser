<?php
    require_once 'connection/conn.php';
    
    if(isXmlHttpRequest()) {
        $json = array();
        $json['logado'] = TRUE;

        if(!isset($_SESSION['inf_usu']['usu_id'])) {
            $json['logado'] = FALSE;
        }

        echo json_encode($json);
    } else {
        header('Location: ../');
    }
?>