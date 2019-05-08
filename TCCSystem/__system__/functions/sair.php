<?php
    session_start();

    if(isset($_SESSION["inf_usu"])) {
        unset($_SESSION["inf_usu"]);
        unset($_SESSION["tel_num"]);
        unset($_SESSION["tipo_tel"]);
        if(isset($_SESSION["url_sair"])) {
            $url = $_SESSION['url_sair'];
            unset($_SESSION['url_sair']);
            header("Location: $url");
        } else {
            header("Location: ../home");
        }
    }
?>