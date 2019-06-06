    <div class="divCadProduto divCadSubcateg">
        <form class="formInserirSubcateg">
            <div class="divAddCadSubcateg">
                <div style="margin-bottom:60px;">
                    <table class="tableSectionConfigArm" width="80%" align="center">
                        <tr align="center">
                            <td colspan="8"><h2 style="text-align:center;color:#9C45EB;font-size:14px;">CADASTRAR SUBCATEGORIA</h2></td>
                        </tr>
                        <tr>
                            <td align="center" style="text-align:center;color:#9C45EB;"><b>NOME</b></td>
                            <td><input type="text" class="selectConfigArm" name="subcateg_nome[]" size="60"></td>
                        </tr>
                        <tr>
                            <td align="center" style="text-align:center;color:#9C45EB;"><b>DEPARTAMENTO</b></td>
                            <td>
                                <select class="selectConfigArm" name="depart_id[]">
                                    <option value="*000*"> -- Selecione o departamento: --</option>
                                    <?php
                                        $sel = $conn->prepare("SELECT * FROM departamento");
                                        $sel->execute();
                                        if($sel->rowCount() > 0):
                                            $results = $sel->fetchAll();
                                            foreach($results as $k => $v):?>
                                                <option value="<?= $v['depart_id'] ?>"><?= $v['depart_nome']; ?></option>
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
                <button type="button" class="addCadSubcateg">Adicionar mais subcategorias</button>
            </div>
            <div class="divSubmit" align="center">
                <button type="submit" id="btnInsertSubcateg"><i class="fas fa-save"></i> Cadastrar</button>
                <div class="help-block"></div>
            </div>
        </form>
    </div>

    <script>
        $('.addCadSubcateg').click(function(e) {
            e.preventDefault();
            $('.divAddCadSubcateg').append(`
                <div>
                    <table width="auto" align="center" border="2">
                        <tr align="center">
                            <td colspan="8"><h2>Insira os dados aqui</h2></td>
                        </tr>
                        <tr>
                            <td align="center"><b>Nome da subcategoria:</b></td>
                            <td><input type="text" name="subcateg_nome[]" size="60"></td>
                        </tr>
                        <tr>
                            <td align="center"><b>Departamento da subcateg:</b></td>
                            <td>
                                <select name="depart_id[]">
                                    <option value="*000*">--- Selecione o depart: ---</option>
                                    <?php
                                        $sel = $conn->prepare("SELECT * FROM departamento");
                                        $sel->execute();
                                        if($sel->rowCount() > 0):
                                            $results = $sel->fetchAll();
                                            foreach($results as $k => $v):?>
                                                <option value="<?= $v['depart_id'] ?>"><?= $v['depart_nome']; ?></option>
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
        $('.divAddCadSubcateg').on("click",".remover_div",function(e) {
                e.preventDefault();
                $(this).parent().parent('div').remove();
                $(this).parent('div').remove();
        });
        
        insertSubcateg();
    </script>