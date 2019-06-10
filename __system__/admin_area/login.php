<?php
    require_once '__system__/functions/connection/conn.php';
    if(isset($_SESSION['inf_func']['funcionario_id'])) {
        header("Location: " . base_url_adm_php() . "dashboard");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>e.conomize | Login Admstr</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="<?= base_url(); ?>img/e_icon.png"/>
    <link href="<?= base_url_adm(); ?>style/admin.css" rel="stylesheet"/>
    <link href="<?= base_url(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet"/>
</head>
<body>
    <div class="l-wrapperLogin">
        <form id="form-login-adm">
            <label for="funcionario_cpf">CPF </label>
            <input type="text" name="funcionario_cpf" value="477.608.258-62" id="funcionario_cpf"/><br/>
            <label for="funcionario_senha">SENHA </label>
            <input type="password" value="economize" name="funcionario_senha" id="funcionario_senha"/><br/>
            <div class="">
                <button type="submit" id="btnLogin">ENTRAR</button>
                <div class="help-block"></div>
            </div>
        </form>
    </div>
    
    <script src="<?= base_url(); ?>js/JQuery/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>js/util.js"></script>
    <script src="<?= base_url_adm(); ?>js/login.js"></script>
</body>
</html>