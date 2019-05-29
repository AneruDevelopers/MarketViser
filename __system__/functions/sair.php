<?php
    require_once 'connection/conn.php';

    if((isset($_SESSION["inf_usu"])) || (isset($_COOKIE['inf_usu']))) {
        if(isset($_COOKIE['inf_usu'])) {
            setcookie("inf_usu");
        }
        
        session_destroy();

        if(isset($_SESSION["url_sair"])) {
            $url = $_SESSION['url_sair'];
            unset($_SESSION['url_sair']);
            header("Location: $url");
        } else {
            header("Location: ../home");
        }
    } else {
        header("Location: ../home");
    }
?>