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
    <title>e.conomize | Central de dúvidas frequentes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="<?= base_url(); ?>img/e_icon.png"/>
    <link href="<?= base_url_adm(); ?>style/admin.css" rel="stylesheet"/>
    <link href="<?= base_url(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet"/>
</head>
<body>
    <div class="l-wrapper">
        <?php
            require '__system__/admin_area/functions/includes/menu.php';
        ?>
        <section class="l-main">
            <h3 class="titleAdm">GERENCIADOR DE DÚVIDAS FREQUENTES</h3>
            <div id="conteudo">

            </div>
            <button class="linkAlterAdm"><i class="fa fa-plus"></i> &nbsp;Adicionar dúvida frequente</button>
        </section>

        <div class="myModalAdd" id="myModalAdd">
            <div class="modalAddContent">
                <span class="closeModalAdd">&times;</span>
                <div class="showAddModal">
                    <div class="divCadProduto divCadDuvida">
                        <form class="formInserir formInserirDuvida">
                            <div class="divDuvida">
                                <div style="margin-bottom:60px;">
                                    <div>
                                        <table class="tableSectionConfigArm" width="80%" align="center">
                                            <tr align="center">
                                                <td colspan="8"><h2 style="text-align:center;color:#9C45EB;font-size:14px;">CADASTRO DE DÚVIDAS FREQUENTES</h2></td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="text-align:center;color:#9C45EB;"><b>PERGUNTA</b></td>
                                                <td>
                                                    <textarea type="text" class="selectConfigArm" name="duvida_pergunta[]"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="text-align:center;color:#9C45EB;"><b>RESPOSTA</b></td>
                                                <td>
                                                    <textarea type="text" class="selectConfigArm" name="duvida_resposta[]"></textarea>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="divSubmit" align="center">
                                <button type="button" class="addCadDuvida">Adicionar mais dúvidas</button>
                            </div>
                            <div class="divSubmit" align="center">
                                <button type="submit" id="btnInsertDuvida"><i class="fas fa-save"></i> Cadastrar</button>
                                <div class="help-block"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url(); ?>js/JQuery/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>js/util.js"></script>
    <script src="<?= base_url_adm(); ?>js/admin.js"></script>
    <script src="<?= base_url_adm(); ?>js/duvida.js"></script>
    <script>
        $('.addCadDuvida').click(function(e) {
            e.preventDefault();
            $('.divDuvida').append(`
            <div class="newAdd">
                <table class="tableSectionConfigArm" width="80%" align="center">
                    <tr align="center">
                        <td colspan="8"><h2 style="text-align:center;color:#9C45EB;font-size:14px;">CADASTRO DE DÚVIDAS FREQUENTES</h2></td>
                    </tr>
                    <tr>
                        <td align="center" style="text-align:center;color:#9C45EB;"><b>PERGUNTA</b></td>
                        <td>
                            <textarea type="text" class="selectConfigArm" name="duvida_pergunta[]"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="text-align:center;color:#9C45EB;"><b>RESPOSTA</b></td>
                        <td>
                            <textarea type="text" class="selectConfigArm" name="duvida_resposta[]"></textarea>
                        </td>
                    </tr>
                </table>
                <div class="btnRemove">
                    <a href="#" class="remover_div"><i class="fas fa-times"></i></a>
                </div>
            </div>
            `);
        });

        // Remover o div anterior
        $('.divCadDuvida').on("click",".remover_div",function(e) {
                e.preventDefault();
                $(this).parent().parent('div').remove();
                $(this).parent('div').remove();
        });

        insertDuvida();
    </script>
    <?php
        if(isset($_GET['fnc'])):
            if($_GET['fnc'] == "IDF"):?>
                <script>
                    modalAdd.style.display = "block";
                </script>
                <?php
            endif;
        endif;
    ?>
</body>
</html>