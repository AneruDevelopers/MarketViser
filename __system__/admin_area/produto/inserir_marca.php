    <div class="divCadProduto divCadMarca">
        <form class="formInserirMarca">
            <div class="divAddCadMarca">
                <div style="margin-bottom:60px;">
                    <table width="auto" align="center" border="2">
                        <tr align="center">
                            <td colspan="8"><h2>Insira os dados aqui</h2></td>
                        </tr>
                        <tr>
                            <td align="center"><b>Nome da marca:</b></td>
                            <td><input type="text" name="marca_nome[]" size="60"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="divSubmit" align="center">
                <button type="button" class="addCadMarca">Adicionar mais marcas</button>
            </div>
            <div class="divSubmit" align="center">
                <button type="submit" id="btnInsertMarca"><i class="fas fa-save"></i> Cadastrar</button>
                <div class="help-block"></div>
            </div>
        </form>
    </div>

    <script>
        $('.addCadMarca').click(function(e) {
            e.preventDefault();
            $('.divAddCadMarca').append(`
                <div>
                    <table width="auto" align="center" border="2">
                        <tr align="center">
                            <td colspan="8"><h2>Insira os dados aqui</h2></td>
                        </tr>
                        <tr>
                            <td align="center"><b>Nome da marca:</b></td>
                            <td><input type="text" name="marca_nome[]" size="60"></td>
                        </tr>
                    </table>
                    <div class="btnRemove">
                        <a href="#" class="remover_div"><i class="fas fa-times"></i></a>
                    </div>
                </div>
            `);
        });

        // Remover o div anterior
        $('.divAddCadMarca').on("click",".remover_div",function(e) {
                e.preventDefault();
                $(this).parent().parent('div').remove();
                $(this).parent('div').remove();
        });
        
        insertMarca();
    </script>