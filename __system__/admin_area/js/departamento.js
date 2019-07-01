var qtd_result = 5;
var page = 1;
var max_links = 2;

function dataDeparts(page, qtd_result) {
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
        url: BASE_URL4 + 'functions/departamento',
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
                    for(var i = 0; json['departamentos'].length > i; i++) {
                        $('.tbodyProd').append(`
                            <tr>
                                <td>` + json['departamentos'][i].depart_nome + `</td>
                                <td class="tdCenter">` + json['departamentos'][i].depart_desc + `</td>
                                <td class="tdCenter">
                                    <button class="myBtnUpd btnEditDepart btnProductConfigAdm" id-depart="` + json['departamentos'][i].depart_id + `"><i class="fa fa-edit"></i></button>
                                </td>
                            </tr>
                        `);
                    }
                    $('body').append(`
                        <div class="myModalUpd" id="myModalUpd">
                            <div class="modalUpdContent">
                                <span class="closeModalUpd">&times;</span>
                                <div class="showUpdModal">
                                    <div class="divCadDepart">
                                        <form class="formUpdateDepart">
                                            <div class="divUpdCadDepart">
                                                <div style="margin:25px 0;">
                                                <table class="tableSectionConfigArm" width="80%" align="center">
                                                    <tr align="center">
                                                        <td colspan="8"><h2 style="text-align:center;color:#9C45EB;font-size:14px;">EDITAR DEPARTAMENTO</h2></td>
                                                    </tr>
                                                    <tr>
                                                        <input type="hidden" id="depart_idUpd" name="depart_idUpd">
                                                        <td align="center" style="text-align:center;color:#9C45EB;"><b>NOME</b></td>
                                                        <td><input type="text" class="selectConfigArm" id="depart_nomeUpd" name="depart_nomeUpd" size="60"></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="text-align:center;color:#9C45EB;"><b>DESCRIÇÃO</b></td>
                                                        <td><input type="text" class="selectConfigArm porcent" id="depart_descUpd" name="depart_descUpd" size="60"></td>
                                                    </tr>
                                                </table>
                                                </div>
                                            </div>
                                            <div class="divSubmit" align="center">
                                                <button type="submit" id="btnUpdateDepart"><i class="fas fa-save"></i> Editar</button>
                                                <div class="help-block"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                    modalUpd();
                    updDepart();
                } else {
                    $('.tbodyProd').html(`
                        <tr>
                            <th colspan="5" class="thNoData">- NÃO HÁ CUPONS CADASTRADOS -</th>
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
                Mostrando ` + json['registrosMostra'] + ` de ` + json['registrosTotal'] + ` banners
            `);

            var totPage = Math.ceil(json['registrosTotal'] / qtd_result);

            $('.paginacao').html(`
                <a href="#" class="linkPaginacao" onclick="dataDeparts(1, qtd_result)">Primeira</a> 
            `);

            for(var pag_ant = (page - max_links); pag_ant <= (page - 1); pag_ant++) {
                if(pag_ant >= 1) {
                    $('.paginacao').append(`
                        <button class="btnPaginacao" onclick="dataDeparts(` + pag_ant + `, qtd_result)">` + pag_ant + `</button> 
                    `);
                }
            }

            $('.paginacao').append(` ` + page + ` `);

            for(var pag_dep = (page + 1); pag_dep <= (page + max_links); pag_dep++) {
                if(pag_dep <= totPage) {
                    $('.paginacao').append(`
                        <button class="btnPaginacao" onclick="dataDeparts(` + pag_dep + `, qtd_result)">` + pag_dep + `</button> 
                    `);
                }
            }

            $('.paginacao').append(`
                <a href="#" class="linkPaginacao" onclick="dataDeparts(` + totPage + `, qtd_result)">Última</a>
            `);
        }
    });
}

function updDepart() {
    $(".btnEditDepart").click(function(e) {
        e.preventDefault();
        clearErrors();
        var dado = "updDepart_id=" + $(this).attr("id-depart");
        $.ajax({
            dataType: 'json',
                type: 'post',
                data: dado,
                url: BASE_URL4 + 'functions/departamento',
                beforeSend: function() {
                    $('#depart_idUpd').val("");
                    $('#depart_nomeUpd').val("");
                    $('#depart_descUpd').val("");
                },
                success: function(json) {
                    $('#depart_idUpd').val(json['depart']['depart_id']);

                    $('#depart_nomeUpd').val(json['depart']['depart_nome']);

                    $('#depart_descUpd').val(json['depart']['depart_desc']);
                    updateDepart();
                }
        });
    });
}

function updateDepart() {
    $('.formUpdateDepart').submit(function(e) {
        e.preventDefault();
        var formDepart = $(this).serialize();

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/departamento',
            type: 'POST',
            data: formDepart,
            beforeSend() {
                clearErrors();
                $("#btnUpdateDepart").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                clearErrors();
                if(json['status']) {
                    Swal.fire({
                        title: "Departamento editado com sucesso!",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#333",
                        confirmButtonText: "Ok",
                    }).then((result) => {
                        if(result.value) {
                            var modalUpd = document.getElementById('myModalUpd');
                            modalUpd.style.display = "none";
                            dataDeparts(page, qtd_result);
                        } else {
                            var modalUpd = document.getElementById('myModalUpd');
                            modalUpd.style.display = "none";
                            dataDeparts(page, qtd_result);
                        }
                    });
                } else {
                    $("#btnUpdateDepart").siblings(".help-block").html(json['error']);
                }
            }
        });
    });
}

dataDeparts(page, qtd_result);