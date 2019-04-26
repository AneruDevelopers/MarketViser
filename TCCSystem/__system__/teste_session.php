<?php
    session_start();

    foreach($_SESSION["tel_num"] as $k => $v) {
        $key = $k + 1;
        echo "<b>" . $key . "º Telefone:</b> " . $v . " - <b>Tipo:</b> " . $_SESSION["tipo_tel"][$k] . "<br/>";
    }

    foreach($_SESSION["inf_usu"] as $k => $v) {
        echo "<b>" . $k . ":</b> " . $v . "<br/>";
    }
?>