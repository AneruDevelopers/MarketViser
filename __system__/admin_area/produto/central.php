<?php
    require_once '__system__/functions/connection/conn.php';
    // if(!isset($_SESSION['inf_usu']['usu_id'])) {
    //     header("Location: " . base_url_php());
    // } else {
    //     if($_SESSION["inf_usu"]['usu_tipo_id'] != 3) {
    //         header("Location: " . base_url_php());
    //     }
    // }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>e.conomize | Central de produtos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="<?= base_url(); ?>img/e_icon.png"/>
    <link href="<?= base_url_adm(); ?>style/admin.css" rel="stylesheet"/>
    <link href="<?= base_url(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet"/>
    <link href="<?= base_url(); ?>style/libraries/DataTables/datatables.min.css" rel="stylesheet"/>
</head>
<body>
    <div class="l-wrapper">
        <?php
            require '__system__/admin_area/functions/includes/menu.php';
        ?>
        <section class="l-main">
            <h3 class="titleAdm">GERENCIADOR DE PRODUTOS</h3>
            <div id="conteudo">

            </div>
            <button class="linkAlterAdm" onclick="carregar('inserir_produto')"><i class="fa fa-plus"></i> &nbsp;Adicionar produto</button>
            <div class="divSearch">
                <form class="formSearch">
                    <label for="searchProd">Procure: </label>
                    <input type="text" class="inputSearch" id="searchProd"/>
                </form>
            </div>
            <div class="divEcoTable">
                <table width="80%" class="tableView tableProdConfigAdm" align="center">
                    <thead>
                        <th class="thTitle" width="10%">IMAGEM</th>
                        <th class="thTitle" width="30%">NOME</th>
                        <th class="thTitle" width="25%">VOLUME</th>
                        <th class="thTitle" width="20%">MARCA</th>
                        <th class="thTitle" width="15%">AÇÕES</th>
                    </thead>
                    <tbody class="tbodyProd">

                    </tbody>
                </table>
                <span class="registShow">
                    
                </span>
            </div>
            <div class="dataProds">
                
            </div>
        </section>

        <div class="myModalView" id="myModalView">
            <div class="modalViewContent">
                <span class="closeModalView">&times;</span>
                <div class="showViewModal">

                </div>
            </div>
        </div>

        <footer class="l-footer">
        </footer>

        <div class="myModalAdd" id="myModalAdd">
            <div class="modalAddContent">
                <span class="closeModalAdd">&times;</span>
                <div class="showAddModal">
                    <div class="divCadProduto">
                        <form class="formInserirProdutos" enctype="multipart/form-data">
                            <div class="divAddCadProduto">
                                <div style="margin-bottom:60px;">
                                    <table width="auto" align="center" border="2">
                                        <tr align="center">
                                            <td colspan="8"><h2>Insira os dados aqui</h2></td>
                                        </tr>
                                        <tr>
                                            <td align="center"><b>Nome do produto:</b></td>
                                            <td><input type="text" name="nome_produto[]" size="60"></td>
                                        </tr>
                                        <tr>
                                            <td align="center"><b>Marca do produto:</b></td>
                                            <td>
                                                <select name="marca_produto[]">
                                                    <option value="*000*">--- Selecione a marca: ---</option>
                                                    <?php
                                                        $sel = $conn->prepare("SELECT * FROM marca_prod");
                                                        $sel->execute();
                                                        if($sel->rowCount() > 0):
                                                            $results = $sel->fetchAll();
                                                            foreach($results as $k => $v):?>
                                                                <option value="<?= $v['marca_id'] ?>"><?= $v['marca_nome']; ?></option>
                                                                <?php
                                                            endforeach;
                                                        endif;
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center"><b>Categoria do produto:</b></td>
                                            <td>
                                                <select name="categoria_produto[]">
                                                    <option>--- Selecione a categoria: ---</option>
                                                    <?php
                                                        $sel = $conn->prepare("SELECT * FROM categ AS c JOIN subcateg AS s ON c.subcateg_id=s.subcateg_id JOIN departamento AS d ON s.depart_id=d.depart_id");
                                                        $sel->execute();
                                                        if($sel->rowCount() > 0):
                                                            $results = $sel->fetchAll();
                                                            foreach($results as $k => $v):?>
                                                                <option value="<?= $v['categ_id'] ?>"><?= $v['depart_nome'] . " / " . $v['subcateg_nome'] . " / " . $v['categ_nome']; ?></option>
                                                                <?php
                                                            endforeach;
                                                        endif;
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center"><b>Imagem do produto:</b></td>
                                            <td><input type="file" id="imagem_produto" name="imagem_produto[]"></td>
                                        </tr>
                                        <tr>
                                            <td align="center"><b>Descrição do produto:</b></td>
                                            <td><textarea name="descricao_produto[]" cols="30" rows="10"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td align="center"><b>Volume do produto:</b></td>
                                            <td><input type="text" name="produto_tamanho[]" size="60"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="divSubmit" align="center">
                                <button type="button" class="addCadProduto">Adicionar mais produtos</button>
                            </div>
                            <div class="divSubmit" align="center">
                                <button type="submit" id="btnInsertProduto"><i class="fas fa-save"></i> Cadastrar</button>
                                <div class="help-block"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url(); ?>js/JQuery/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>js/JQuery/jquery-mask.js"></script>
    <script src="<?= base_url(); ?>js/mask.js"></script>
    <script src="<?= base_url(); ?>style/libraries/DataTables/datatables.min.js"></script>
    <script src="<?= base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>js/util.js"></script>
    <script src="<?= base_url_adm(); ?>js/admin.js"></script>
    <script src="<?= base_url_adm(); ?>js/produto.js"></script>
</body>
</html>