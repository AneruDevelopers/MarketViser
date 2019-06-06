    <div class="divCadProduto divCadCateg">
        <form class="formInserirCateg">
            <div class="divAddCadCateg">
                <div style="margin-bottom:60px;">
                    <table class="tableSectionConfigArm" width="80%" align="center">
                        <tr align="center">
                            <td colspan="8"><h2 style="text-align:center;color:#9C45EB;font-size:14px;">CADASTRAR CATEGORIA</h2></td>
                        </tr>
                        <tr>
                            <td align="center" style="text-align:center;color:#9C45EB;"><b>CATEGORIA</b></td>
                            <td><input type="text" class="selectConfigArm" name="categ_nome[]" size="60"></td>
                        </tr>
                        <tr>
                            <td align="center" style="text-align:center;color:#9C45EB;"><b>SUBCATEGORIA</b></td>
                            <td>
                                <select class="selectConfigArm" name="subcateg_id[]">
                                    <option value="*000*"> -- Selecione o subcategoria: --</option>
                                    <?php
                                        $sel = $conn->prepare("SELECT * FROM subcateg AS s JOIN departamento AS d ON s.depart_id=d.depart_id");
                                        $sel->execute();
                                        if($sel->rowCount() > 0):
                                            $results = $sel->fetchAll();
                                            foreach($results as $k => $v):?>
                                                <option value="<?= $v['subcateg_id'] ?>"><?= $v['depart_nome'] . " / " . $v['subcateg_nome']; ?></option>
                                                <?php
                                            endforeach;
                                        endif;
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="divSubmit" align="center">
                <button type="button" class="addCadCateg">Adicionar mais categorias</button>
            </div>
            <div class="divSubmit" align="center">
                <button type="submit" id="btnInsertCateg"><i class="fas fa-save"></i> Cadastrar</button>
                <div class="help-block"></div>
            </div>
        </form>
    </div>

    <script>
        $('.addCadCateg').click(function(e) {
            e.preventDefault();
            $('.divAddCadCateg').append(`
                <div>
                    <table class="tableSectionConfigArm" width="80%" align="center">
                        <tr align="center">
                            <td colspan="8"><h2 style="text-align:center;color:#9C45EB;font-size:14px;">CADASTRAR CATEGORIA</h2></td>
                        </tr>
                        <tr>
                            <td align="center" style="text-align:center;color:#9C45EB;"><b>CATEGORIA</b></td>
                            <td><input type="text" class="selectConfigArm" name="categ_nome[]" size="60"></td>
                        </tr>
                        <tr>
                            <td align="center" style="text-align:center;color:#9C45EB;"><b>SUBCATEGORIA</b></td>
                            <td>
                                <select class="selectConfigArm" name="subcateg_id[]">
                                    <option value="*000*"> -- Selecione o subcategoria: --</option>
                                    <?php
                                        $sel = $conn->prepare("SELECT * FROM subcateg AS s JOIN departamento AS d ON s.depart_id=d.depart_id");
                                        $sel->execute();
                                        if($sel->rowCount() > 0):
                                            $results = $sel->fetchAll();
                                            foreach($results as $k => $v):?>
                                                <option value="<?= $v['subcateg_id'] ?>"><?= $v['depart_nome'] . " / " . $v['subcateg_nome']; ?></option>
                                                <?php
                                            endforeach;
                                        endif;
                                    ?>
                                </select>
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
        $('.divAddCadCateg').on("click",".remover_div",function(e) {
                e.preventDefault();
                $(this).parent().parent('div').remove();
                $(this).parent('div').remove();
        });
        
        insertCateg();
    </script>