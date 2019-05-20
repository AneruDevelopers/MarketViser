<?php
    require_once 'connection/conn.php';

    if((isset($_SESSION["inf_usu"])) || (isset($_COOKIE['inf_usu']))) {
        if(isset($_COOKIE['inf_usu'])) {
            setcookie("inf_usu");
        }
        if(isset($_SESSION['carrinho'])) {
            unset($_SESSION['carrinho']);
        }
        if(isset($_SESSION['agend_horario'])) {
            unset($_SESSION['agend_horario']);
        }
        if(isset($_SESSION['end_cep'])) {
            unset($_SESSION['end_cep']);
            unset($_SESSION['end_end']);
            unset($_SESSION['end_num']);
            unset($_SESSION['end_complemento']);
            unset($_SESSION['end_bairro']);
            unset($_SESSION['end_cidade']);
            unset($_SESSION['end_uf']);
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