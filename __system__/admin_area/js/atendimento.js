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
        url: BASE_URL4 + 'functions/atendimento',
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
                    for(var i = 0; json['atendimentos'].length > i; i++) {
                        $('.tbodyProd').append(`
                            <tr>
                                <td class="tdCenter">` + json['atendimentos'][i].nome_usu + `</td>
                                <td class="tdCenter">` + json['atendimentos'][i].tp_problema + `</td>
                                <td class="tdCenter">` + json['atendimentos'][i].resp_id + `</td>
                                <td class="tdCenter">` + json['atendimentos'][i].dataenv_pro + `</td>
                                <td class="tdCenter">
                                    <button class="myBtnView btnViewProd btnProductConfigAdm" id-atendimento="` + json['atendimentos'][i].id_atd + `"><i class="fa fa-eye"></i></button>
                                </td>
                            </tr>
                        `);
                    }
                } else {
                    $('.tbodyProd').html(`
                        <tr>
                            <th colspan="5" class="thNoData">- NÃO HÁ MENSAGENS CADASTRADAS -</th>
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
                Mostrando ` + json['registrosMostra'] + ` de ` + json['registrosTotal'] + ` mensagens
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

function enviaRespAtend() {
    $('.respAtendOnline').submit(function(e) {
        e.preventDefault();
        var dado = $(this).serialize();

        $.ajax({
            dataType: 'json',
            type: 'post',
            data: dado,
            url: BASE_URL4 + 'functions/atendimento',
            beforeSend: function() {
                $(".respAtendOnline .help-block").html(`
                    <p style="color:#333;text-align:center;">
                        <i class='fa fa-circle-notch fa-spin'></i> &nbsp; Verificando...
                    </p>
                `);
            },
            success: function(json) {
                clearErrors();
                if(json['status']) {
                    Toast.fire({
                        type: "success",
                        title: "Resposta enviada com sucesso"
                    });
                    mostraModalAdd();
                    // modalAdd.style.display = "none";
                } else {
                    $(".respAtendOnline .help-block").html(json['error']);
                }
            }
        });
        return false;
    });
}

dataProds(page, qtd_result);
enviaRespAtend();