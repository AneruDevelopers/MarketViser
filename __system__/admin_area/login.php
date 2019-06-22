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
    <div class="l-wrapperLogin backgroundAdmLogin">
        <div class="modalAdmLogin">   
            <h2>Login</h2> 
            <form id="form-login-adm">
                <div class="outsideSecInputCad">
                    <div class="field -md">
                        <input type="text" name="funcionario_cpf" value="477.608.258-62" id="funcionario_cpf" class="placeholder-shown" placeholder="Some placeholder"/>
                        <label class="labelFieldCad"><strong><i class="fas fa-id-card"></i> CPF</strong></label>
                    </div>
                    <div class="help-block"></div><br/>
                </div>
                <div class="outsideSecInputCad">
                    <div class="field -md">
                        <input type="password" value="economize" name="funcionario_senha" id="funcionario_senha" class="placeholder-shown" placeholder="Some placeholder"/>
                        <label class="labelFieldCad"><strong><i class="fas fa-unlock"></i> SENHA</strong></label>
                    </div>
                    <div class="help-block"></div><br/>
                </div>
                <button type="submit" class="btnSend" id="btnLogin">ENTRAR</button>
                <div class="help-block-login"></div>
                </div>
            </form>
        </div>
    </div>
    
    <script src="<?= base_url(); ?>js/JQuery/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>js/util.js"></script>
    <script src="<?= base_url_adm(); ?>js/login.js"></script>
</body>
</html>