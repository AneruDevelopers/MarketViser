var qtd_result = 5;
var page = 1;
var max_links = 2;

function dataEntrega(page, qtd_result) {
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
        url: BASE_URL4 + 'functions/entrega',
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
                    for(var i = 0; json['entregas'].length > i; i++) {
                        $('.tbodyProd').append(`
                            <tr>
                                <td class="tdCenter">` + json['entregas'][i].compra_hash + `</td>
                                <td class="tdCenter">` + json['entregas'][i].entrega_horario + `</td>
                                <td class="tdCenter">` + json['entregas'][i].entrega_cidade + ` - ` + json['entregas'][i].entrega_uf + `</td>
                                <td class="tdCenter">` + json['entregas'][i].armazem_nome + `</td>
                                <td class="tdCenter">
                                    <button class="myBtnView btnViewEnt btnProductConfigAdm" id-entrega="` + json['entregas'][i].entrega_id + `"><i class="fa fa-eye"></i></button>
                                    <button class="myBtnUpd btnEditEnt btnProductConfigAdm" id-entrega="` + json['entregas'][i].entrega_id + `"><i class="fa fa-edit"></i></button>
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
                                        <form class="formUpdateEntrega" enctype="multipart/form-data">
                                            <div class="divUpdCadEntrega">
                                                <div style="margin:25px 0;">
                                                    <table class="tableSectionConfigArm" width="80%" align="center">
                                                        <tr align="center">
                                                            <td colspan="8"><h2 style="text-align:center;color:#9C45EB;font-size:14px;">EDITAR ENTREGA</h2></td>
                                                        </tr>
                                                        <tr>
                                                            <input type="hidden" id="entrega_idUpd" name="entrega_idUpd"/>
                                                            <td align="center" style="text-align:center;color:#9C45EB;"><b>ADICIONAR FUNCIONÁRIO</b></td>
                                                            <td><select class="selectConfigArm" id="funcionario_entrega" name="funcionario_entrega"></select></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="divSubmit" align="center">
                                                <button type="submit" id="btnUpdateEntrega"><i class="fas fa-save"></i> Adicionar funcionário</button>
                                                <div class="help-block"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                    modalView();
                    modalUpd();
                    viewEntrega();
                    updEntrega();
                } else {
                    $('.tbodyProd').html(`
                        <tr>
                            <th colspan="5" class="thNoData">- NÃO HÁ ENTREGAS CADASTRADAS -</th>
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
                Mostrando ` + json['registrosMostra'] + ` de ` + json['registrosTotal'] + ` entregas
            `);

            var totPage = Math.ceil(json['registrosTotal'] / qtd_result);

            $('.paginacao').html(`
                <a href="#" class="linkPaginacao" onclick="dataEntrega(1, qtd_result)">Primeira</a> 
            `);

            for(var pag_ant = (page - max_links); pag_ant <= (page - 1); pag_ant++) {
                if(pag_ant >= 1) {
                    $('.paginacao').append(`
                        <button class="btnPaginacao" onclick="dataEntrega(` + pag_ant + `, qtd_result)">` + pag_ant + `</button> 
                    `);
                }
            }

            $('.paginacao').append(` ` + page + ` `);

            for(var pag_dep = (page + 1); pag_dep <= (page + max_links); pag_dep++) {
                if(pag_dep <= totPage) {
                    $('.paginacao').append(`
                        <button class="btnPaginacao" onclick="dataEntrega(` + pag_dep + `, qtd_result)">` + pag_dep + `</button> 
                    `);
                }
            }

            $('.paginacao').append(`
                <a href="#" class="linkPaginacao" onclick="dataEntrega(` + totPage + `, qtd_result)">Última</a>
            `);
        }
    });
}

function viewEntrega() {
    $(".btnViewEnt").click(function(e) {
        e.preventDefault();
        var dado = "getEnt_id=" + $(this).attr("id-entrega");
        $.ajax({
            dataType: 'json',
                type: 'post',
                data: dado,
                url: BASE_URL4 + 'functions/entrega',
                beforeSend: function() {
                    $('.showViewModal').html(`
                        <p align="center"><i class='fa fa-circle-notch fa-spin'></i> &nbsp;Buscando dados...</p>
                    `);
                },
                success: function(json) {
                    $('.showViewModal').html(`
                        <div class="modalViewLeft">
                            <div class="headerShowPurch">
                                <span class="hashHeaderPurch">Código: ` + json['compra']['hash'] + `</span><br/>
                                <span class="totHeaderPurch">Valor total: R$` + json['compra']['total'] + `</span>
                            </div>

                            <div class="mainShowPurch">
                                Data realizada: <b>` + json['compra']['registro'] + `</b><br/>
                                Armazém: <b>` + json['compra']['armazem'] + `</b><br/>
                                Status: <b>` + json['compra']['status'] + `</b><br/>
                                Meio de pagamento: <b>` + json['compra']['forma_pag'] + `</b> 
                                <span class="linkPayment"></span><br/>
                                <a href="` + BASE_URL + `usuario/nota-fiscal?compra=` + json['compra']['id'] + `">Gerar PDF</a>
                            </div>

                            <div class="productsShowPurch">
                                <h4 class="itCart">Itens do carrinho</h4>
                                <div class="productCart"></div>
                            </div>

                            <div class="shippingShowPurch">
                                <h4 class="itCart">Endereço de entrega</h4>

                                Agendamento: <b>` + json['end']['horario'] + `</b><br/>
                                CEP: <b>` + json['end']['cep'] + `</b><br/>
                                Logradouro: <b>` + json['end']['log'] + `, ` + json['end']['num'] + ((json['end']['complemento'] != '') ? ` - ` + json['end']['complemento'] : `` ) + `</b><br/>
                                Bairro: <b>` + json['end']['bairro'] + `</b><br/>
                                Localidade: <b>` + json['end']['cidade'] + ` - ` + json['end']['uf'] + `</b><br/>
                            </div>
                        </div>
                        <div class="modalViewRight"></div>
                    `);
                    
                    for(var i = 0; i < json['produto_id'].length; i++) {
                        $('.modalViewRight').append(`
                            <p class="p_prodCart">
                                Produto: <b>` + json['produto_nome'][i] + `</b><br/>
                                Quantidade: <b>` + json['produto_qtd'][i] + `</b><br/>
                            </p>
                        `);
                    }
                }
        });
    });
}

function updEntrega() {
    $(".btnEditEnt").click(function(e) {
        e.preventDefault();
        clearErrors();
        var dado = "updEnt_id=" + $(this).attr("id-entrega");
        $.ajax({
            dataType: 'json',
                type: 'post',
                data: dado,
                url: BASE_URL4 + 'functions/entrega',
                beforeSend: function() {
                    $('#entrega_idUpd').val("");
                    $('#funcionario_entrega').html("");
                },
                success: function(json) {
                    $('#entrega_idUpd').val(dado);
                    for(var i = 0; i < json['funcionarios'].length; i++) {
                        $('#funcionario_entrega').append(`
                            <option value="` + json['funcionarios'][i].funcionario_id + `">` + json['funcionarios'][i].funcionario_nome + ` / ` + json['funcionarios'][i].funcionario_cpf + `</option>
                        `);
                    }
                    updateEntrega();
                }
        });
    });
}

function updateEntrega() {
    $('.formUpdateEntrega').submit(function(e) {
        e.preventDefault();
        var forEnt = $(this).serialize();

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/entrega',
            type: 'POST',
            data: forEnt,
            beforeSend() {
                clearErrors();
                $("#btnUpdateEntrega").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                clearErrors();
                if(json['status']) {
                    Swal.fire({
                        title: "Entregador adicionado com sucesso!",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#333",
                        confirmButtonText: "Ok",
                    }).then((result) => {
                        if(result.value) {
                            var modalUpd = document.getElementById('myModalUpd');
                            modalUpd.style.display = "none";
                            dataEntrega(page, qtd_result);
                        } else {
                            var modalUpd = document.getElementById('myModalUpd');
                            modalUpd.style.display = "none";
                            dataEntrega(page, qtd_result);
                        }
                    });
                } else {
                    $("#btnUpdateEntrega").siblings(".help-block").html(json['error']);
                }
            }
        });
    });
}

dataEntrega(page, qtd_result);