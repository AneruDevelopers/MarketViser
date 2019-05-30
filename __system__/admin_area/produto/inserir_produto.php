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
                            <td><input type="file" name="imagem_produto[]"></td>
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

    <script>
        $('.addCadProduto').click(function(e) {
            e.preventDefault();
            $('.divAddCadProduto').append(`
            <div>
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
                        <td><input type="file" name="imagem_produto[]"></td>
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
                <div class="btnRemove">
                    <a href="#" class="remover_div"><i class="fas fa-times"></i></a>
                </div>
            </div>
            `);
            mask();
        });

        // Remover o div anterior
        $('.divAddCadProduto').on("click",".remover_div",function(e) {
                e.preventDefault();
                $(this).parent().parent('div').remove();
                $(this).parent('div').remove();
        });
        
        mask();
        insertProduto();
    </script>