var qtd_result = 5;
var page = 1;
var max_links = 2;

function dataProds(page, qtd_result) {
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
                    `);
                    modalView();
                    // viewEntrega();
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
                <a href="#" class="linkPaginacao" onclick="dataProds(1, qtd_result)">Primeira</a> 
            `);

            for(var pag_ant = (page - max_links); pag_ant <= (page - 1); pag_ant++) {
                if(pag_ant >= 1) {
                    $('.paginacao').append(`
                        <button class="btnPaginacao" onclick="dataProds(` + pag_ant + `, qtd_result)">` + pag_ant + `</button> 
                    `);
                }
            }

            $('.paginacao').append(` ` + page + ` `);

            for(var pag_dep = (page + 1); pag_dep <= (page + max_links); pag_dep++) {
                if(pag_dep <= totPage) {
                    $('.paginacao').append(`
                        <button class="btnPaginacao" onclick="dataProds(` + pag_dep + `, qtd_result)">` + pag_dep + `</button> 
                    `);
                }
            }

            $('.paginacao').append(`
                <a href="#" class="linkPaginacao" onclick="dataProds(` + totPage + `, qtd_result)">Última</a>
            `);
        }
    });
}

dataProds(page, qtd_result);