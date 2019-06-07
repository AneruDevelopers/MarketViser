<div class="divCadProduto divCadDep">
        <form class="formInserirDep">
            <div class="divAddCadDep">
                <div style="margin-bottom:60px;">
                    <table class="tableSectionConfigArm" width="80%" align="center">
                        <tr align="center">
                            <td colspan="8" ><h2 style="text-align:center;color:#9C45EB;font-size:14px;">CADASTRAR DEPARTAMENTO</h2></td>
                        </tr>
                        <tr>
                            <td align="center" style="text-align:center;color:#9C45EB;"><b>NOME</b></td>
                            <td><input type="text" class="selectConfigArm" name="depart_nome[]" size="60"></td>
                        </tr>
                        <tr>
                            <td align="center" style="text-align:center;color:#9C45EB;"><b>ÍCONE</b></td>
                            <td><input type="text" class="selectConfigArm" name="depart_icon[]" size="60"></td>
                        </tr>
                        <tr>
                            <td align="center" style="text-align:center;color:#9C45EB;"><b>DESCRIÇÃO</b></td>
                            <td><input type="text" class="selectConfigArm" name="depart_desc[]" size="60"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="divSubmit" align="center">
                <button type="button" class="addCadDep">Adicionar mais departamentos</button>
            </div>
            <div class="divSubmit" align="center">
                <button type="submit" id="btnInsertDep"><i class="fas fa-save"></i> Cadastrar</button>
                <div class="help-block"></div>
            </div>
        </form>
    </div>

    <script>
        $('.addCadDep').click(function(e) {
            e.preventDefault();
            $('.divAddCadDep').append(`
                <div>
                    <table width="auto" align="center" border="2">
                        <tr align="center">
                            <td colspan="8"><h2>Insira os dados aqui</h2></td>
                        </tr>
                        <tr>
                            <td align="center"><b>Nome do departamento:</b></td>
                            <td><input type="text" name="depart_nome[]" size="60"></td>
                        </tr>
                        <tr>
                            <td align="center"><b>Ícone do departamento:</b></td>
                            <td><input type="text" name="depart_icon[]" size="60"></td>
                        </tr>
                        <tr>
                            <td align="center"><b>Descrição do departamento:</b></td>
                            <td><input type="text" name="depart_desc[]" size="60"></td>
                        </tr>
                    </table>
                    <div class="btnRemove">
                        <a href="#" class="remover_div"><i class="fas fa-times"></i></a>
                    </div>
                </div>
            `);
        });

        // Remover o div anterior
        $('.divAddCadDep').on("click",".remover_div",function(e) {
                e.preventDefault();
                $(this).parent().parent('div').remove();
                $(this).parent('div').remove();
        });
        
        insertDep();
    </script>