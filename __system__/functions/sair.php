<?php
    require_once 'connection/conn.php';

    if((isset($_SESSION["inf_usu"])) || (isset($_COOKIE['inf_usu']))) {
        if(isset($_COOKIE['inf_usu'])) {
            setcookie("inf_usu");
        }
        if(isset($_SESSION['carrinho'])) {
            unset($_SESSION['carrinho']);
        }
        if(isset($_SESSION['totCompra'])) {
          unset($_SESSION['totCompra']);
        }
        if(isset($_SESSION['totCompraCupom'])) {
          unset($_SESSION['totCompraCupom']);
        }
        if(isset($_SESSION['end_agend'])) {
          unset($_SESSION['end_agend']);
        }
        if(isset($_SESSION['agend_horario'])) {
          unset($_SESSION['agend_horario']);
        }
        unset($_SESSION["inf_usu"]);

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