<?php
    require_once '__system__/functions/connection/conn.php';
    if(!isset($_SESSION['inf_func']['funcionario_id'])) {
        header("Location: " . base_url_adm_php() . "login");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>e.conomize | Meu perfil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="<?= base_url(); ?>img/e_icon.png"/>
    <link href="<?= base_url_adm(); ?>style/admin.css" rel="stylesheet"/>
    <link href="<?= base_url(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet"/>
</head>
<body>
    <div class="l-wrapper">
        <?php
            require 'functions/includes/menu.php';
        ?>
        <section id="conteudo" class="l-main">
            <pre>
                <?php
                    // print_r($_SESSION['inf_func']);
                    $exp = explode("-", $_SESSION['inf_func']['funcionario_datanasc']);
                    $datanasc = $exp[2] . "/" . $exp[1] . "/" . $exp[0];
                    
                    $exp = explode(" ", $_SESSION['inf_func']['funcionario_registro']);
                    $day = explode("-", $exp[0]);
                    $registro = $day[2] . "/" . $day[1] . "/" . $day[0] . " às " . $exp[1];
                ?>
            </pre>
            <div>
                <h3 class="dashTitle">Perfil</h3>
                <div class="divEcoTable">
                    <div class="divPerf">
                        <p>Nome: <b><?= $_SESSION['inf_func']['funcionario_nome']; ?></b></p>
                        <p>Email: <b><?= $_SESSION['inf_func']['funcionario_email']; ?></b></p>
                        <p>CPF: <b><?= $_SESSION['inf_func']['funcionario_cpf']; ?></b></p>

                        <p>Data de nascimento: <b><?= $datanasc; ?></b></p>
                        <p>Setor: <b><?= $_SESSION['inf_func']['setor_nome']; ?></b></p>
                        <p>Registro: <b><?= $registro; ?></b></p>

                        <!-- <p><button class="mudarSenha">Mudar senha</button></p> -->

                        <div class="divMudarSenha">
                            <!-- <button class="cancelarMudarSenha"><i class="far fa-times-circle"></i></button> -->
                            <h4 class="titleChangePass"><i class="fas fa-unlock"></i> MUDE A SENHA</h4>
                            <div class="divInputSenha">
                                <form id="formMudarSenha">
                                    <div class="sectionLabelInputChangePass">
                                        <div>
                                            <label for="senha_atual">Senha atual</label>
                                            <input type="password" id="senha_atual" name="senha_atual"/>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="sectionLabelInputChangePass">
                                        <div>
                                            <label for="senha_nova">Nova senha</label>
                                            <input type="password" id="senha_nova" name="senha_nova"/>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="sectionLabelInputChangePass">
                                        <div>
                                            <label for="senha_nova_confirme">Confirme a senha</label>
                                            <input type="password" id="senha_nova_confirme" name="senha_nova_confirme"/>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <button class="btnSaveMudarSenha" id="btnSaveMudarSenha" type="submit"><i class="fas fa-save"></i> SALVAR</button>
                                    <div class="help-block"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="<?= base_url(); ?>js/JQuery/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>js/JQuery/jquery-mask.js"></script>
    <script src="<?= base_url(); ?>js/mask.js"></script>
    <script src="<?= base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>js/util.js"></script>
    <script src="<?= base_url_adm(); ?>js/admin.js"></script>
    <script src="<?= base_url_adm(); ?>js/configUser.js"></script>
</body>
</html>