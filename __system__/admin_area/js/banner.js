var qtd_result = 5;
var page = 1;
var max_links = 2;

function dataBanners(page, qtd_result) {
    var dados = new FormData();
    dados.append("page", page);
    dados.append("qtd_result", qtd_result);

    $.ajax({
        dataType: 'json',
        type: 'post',
        data: dados,
		cache: false,
		contentType: false,
		processData: false,
        url: BASE_URL4 + 'functions/produto',
        beforeSend: function() {
            $('.tbodyProd').html(`
                <tr>
                    <th colspan="5" class="thNoData">
                        - <i class='fa fa-circle-notch fa-spin'></i> PROCESSANDO -
                    </th>
                </tr>
            `);
        },
        success: function(json) {
            if(json['status']) {
                if(!json['empty']) {
                    $('.tbodyProd').html("");
                    for(var i = 0; json['produtos'].length > i; i++) {
                        $('.tbodyProd').append(`
                            <tr>
                                <td><img class="imgProd" style="width:100%;" src="` + BASE_URL3 + json['produtos'][i].produto_img + `"/></td>
                                <td class="tdCenter">` + json['produtos'][i].produto_nome + `</td>
                                <td class="tdCenter">` + json['produtos'][i].produto_tamanho + `</td>
                                <td class="tdCenter">` + json['produtos'][i].marca_nome + `</td>
                                <td class="tdCenter">
                                    <button class="myBtnView btnViewProd btnProductConfigAdm" id-produto="` + json['produtos'][i].produto_id + `"><i class="fa fa-eye"></i></button>
                                    <button class="myBtnUpd btnEditProd btnProductConfigAdm" id-produto="` + json['produtos'][i].produto_id + `"><i class="fa fa-edit"></i></button>
                                    <button class="btnDelProd btnProductConfigAdm" id-produto="` + json['produtos'][i].produto_id + `"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        `);
                    }
                    $('body').append(`
                        <div class="myModalView" id="myModalView">
                            <div class="modalViewContent">
                                <span class="closeModalView">&times;</span>
                                <div class="showViewModal">

                                </div>
                            </div>
                        </div>

                        <div class="myModalUpd" id="myModalUpd">
                            <div class="modalUpdContent">
                                <span class="closeModalUpd">&times;</span>
                                <div class="showUpdModal">
                                    <div class="divCadProduto">
                                        <form class="formUpdateProdutos" enctype="multipart/form-data">
                                            <div class="divAddCadProduto">
                                                <div style="margin:25px 0;">
                                                    <table class="tableSectionConfigArm" width="80%" align="center">
                                                        <tr align="center">
                                                            <td colspan="8"><h2 style="text-align:center;color:#9C45EB;font-size:14px;">EDITAR PRODUTO</h2></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="text-align:center;color:#9C45EB;"><b>NOME</b></td>
                                                            <td><input type="hidden" id="prod_idUpd" name="id_produto_upd"><input type="text" class="selectConfigArm" id="prod_nomeUpd" name="nome_produto_upd" size="60"></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="text-align:center;color:#9C45EB;"><b>MARCA</b></td>
                                                            <td>
                                                                <select class="selectConfigArm" name="marca_produto_upd" id="prod_marcaUpd">
                                                                    
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="text-align:center;color:#9C45EB;"><b>CATEGORIA</b></td>
                                                            <td>
                                                                <select class="selectConfigArm" name="categoria_produto_upd" id="prod_categUpd">
                                                                    
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="text-align:center;color:#9C45EB;"><b>IMAGEM</b></td>
                                                            <td>
                                                                <img class="imgUpload" src=""/><br/>
                                                                <label for="imagem_produtoEdit" class="selectConfigArm labelFile"><i class="fas fa-upload"></i> Alterar imagem</label>
                                                                <input type="file" class="selectConfigArm" accept="image/*" id="imagem_produtoEdit" name="imagem_produto_upd"/>
                                                                <br/><br/>
                                                                <small>* Caso não escolha nenhuma imagem, será mantida a atual</small>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="text-align:center;color:#9C45EB;"><b>DESCRIÇÃO</b></td>
                                                            <td><textarea name="descricao_produto_upd"  id="prod_descUpd" class="selectConfigArm" cols="30" rows="10"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="text-align:center;color:#9C45EB;"><b>VOLUME</b></td>
                                                            <td><input type="text" id="prod_tamUpd" class="selectConfigArm" name="produto_tamanho_upd" size="60"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="divSubmit" align="center">
                                                <button type="submit" id="btnUpdateProduto"><i class="fas fa-save"></i> Editar</button>
                                                <div class="help-block"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                    deleteProduto();
                    modalView();
                    modalUpd();
                    viewProduto();
                    updProduto();
                    uploadImg();
                } else {
                    $('.tbodyProd').html(`
                        <tr>
                            <th colspan="5" class="thNoData">- NÃO HÁ PRODUTOS CADASTRADOS -</th>
                        </tr>
                    `);
                }
            } else {
                $('.tbodyProd').html(`
                    <tr>
                        <th colspan="5" class="thNoData">- OCORREU UM ERRO -</th>
                    </tr>
                `);
            }
            $('.registShow').html(`
                Mostrando ` + json['registrosMostra'] + ` de ` + json['registrosTotal'] + ` produtos
            `);

            var totPage = Math.ceil(json['registrosTotal'] / qtd_result);

            $('.paginacao').html(`
                <a href="#" class="linkPaginacao" onclick="dataBanners(1, qtd_result)">Primeira</a> 
            `);

            for(var pag_ant = (page - max_links); pag_ant <= (page - 1); pag_ant++) {
                if(pag_ant >= 1) {
                    $('.paginacao').append(`
                        <button class="btnPaginacao" onclick="dataBanners(` + pag_ant + `, qtd_result)">` + pag_ant + `</button> 
                    `);
                }
            }

            $('.paginacao').append(` ` + page + ` `);

            for(var pag_dep = (page + 1); pag_dep <= (page + max_links); pag_dep++) {
                if(pag_dep <= totPage) {
                    $('.paginacao').append(`
                        <button class="btnPaginacao" onclick="dataBanners(` + pag_dep + `, qtd_result)">` + pag_dep + `</button> 
                    `);
                }
            }

            $('.paginacao').append(`
                <a href="#" class="linkPaginacao" onclick="dataBanners(` + totPage + `, qtd_result)">Última</a>
            `);
        }
    });
}

function uploadImg() {
    $("input[type=file]").on("change", function(e){
        e.preventDefault();
        var input = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return;

        if (/^image/.test( files[0].type)){
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);

            reader.onload = function() {
                input.siblings(".imgUpload").attr('src', this.result);
            }
        }
    });
}

dataBanners(page, qtd_result);