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
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>e.conomize</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h2>Você não tem permissão de acesso à essa página!</h2>
</body>
</html>