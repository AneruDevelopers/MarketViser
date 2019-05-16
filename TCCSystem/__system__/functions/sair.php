<?php
    session_start();

    if((isset($_SESSION["inf_usu"])) || (isset($_COOKIE['inf_usu']))) {
        if(isset($_COOKIE['inf_usu'])) {
            unset($_COOKIE['inf_usu']);
        }
        unset($_SESSION["inf_usu"]);
        if(isset($_SESSION["url_sair"])) {
            $url = $_SESSION['url_sair'];
            unset($_SESSION['url_sair']);
            header("Location: $url");
        } else {
            header("Location: ../home");
        }
    }
?>