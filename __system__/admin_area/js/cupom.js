var qtd_result = 5;
var page = 1;
var max_links = 2;

function dataCupons(page, qtd_result) {
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
        url: BASE_URL4 + 'functions/cupom',
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
                    for(var i = 0; json['cupons'].length > i; i++) {
                        $('.tbodyProd').append(`
                            <tr>
                                <td>` + json['cupons'][i].cupom_codigo + `</td>
                                <td class="tdCenter">` + json['cupons'][i].cupom_desconto_porcent + `</td>
                                <td class="tdCenter">
                                    <button class="myBtnUpd btnEditCupom btnProductConfigAdm" id-cupom="` + json['cupons'][i].cupom_id + `"><i class="fa fa-edit"></i></button>
                                    <button class="btnDelCupom btnProductConfigAdm" id-cupom="` + json['cupons'][i].cupom_id + `"><i class="fa fa-times"></i></button>
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
                                    <div class="divCadCupom">
                                        <form class="formUpdateCupom">
                                            <div class="divUpdCadCupom">
                                                <div style="margin:25px 0;">
                                                <table class="tableSectionConfigArm" width="80%" align="center">
                                                    <tr align="center">
                                                        <td colspan="8"><h2 style="text-align:center;color:#9C45EB;font-size:14px;">EDITAR CUPOM</h2></td>
                                                    </tr>
                                                    <tr>
                                                        <input type="hidden" id="cupom_idUpd" name="cupom_idUpd">
                                                        <td align="center" style="text-align:center;color:#9C45EB;"><b>CÓDIGO</b></td>
                                                        <td><input type="text" class="selectConfigArm" id="cupom_codigoUpd" name="cupom_codigoUpd" size="60"></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="text-align:center;color:#9C45EB;"><b>DESCONTO %</b></td>
                                                        <td><input type="text" class="selectConfigArm porcent" id="cupom_desconto_porcentUpd" name="cupom_desconto_porcentUpd" size="60"></td>
                                                    </tr>
                                                </table>
                                                </div>
                                            </div>
                                            <div class="divSubmit" align="center">
                                                <button type="submit" id="btnUpdateCupom"><i class="fas fa-save"></i> Editar</button>
                                                <div class="help-block"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                    deleteCupom();
                    modalUpd();
                    updCupom();
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
                <a href="#" class="linkPaginacao" onclick="dataCupons(1, qtd_result)">Primeira</a> 
            `);

            for(var pag_ant = (page - max_links); pag_ant <= (page - 1); pag_ant++) {
                if(pag_ant >= 1) {
                    $('.paginacao').append(`
                        <button class="btnPaginacao" onclick="dataCupons(` + pag_ant + `, qtd_result)">` + pag_ant + `</button> 
                    `);
                }
            }

            $('.paginacao').append(` ` + page + ` `);

            for(var pag_dep = (page + 1); pag_dep <= (page + max_links); pag_dep++) {
                if(pag_dep <= totPage) {
                    $('.paginacao').append(`
                        <button class="btnPaginacao" onclick="dataCupons(` + pag_dep + `, qtd_result)">` + pag_dep + `</button> 
                    `);
                }
            }

            $('.paginacao').append(`
                <a href="#" class="linkPaginacao" onclick="dataCupons(` + totPage + `, qtd_result)">Última</a>
            `);
        }
    });
}

function updCupom() {
    $(".btnEditCupom").click(function(e) {
        e.preventDefault();
        clearErrors();
        var dado = "updCupom_id=" + $(this).attr("id-cupom");
        $.ajax({
            dataType: 'json',
                type: 'post',
                data: dado,
                url: BASE_URL4 + 'functions/cupom',
                beforeSend: function() {
                    $('#cupom_idUpd').val("");
                    $('#cupom_codigoUpd').val("");
                    $('#cupom_desconto_porcentUpd').val("");
                },
                success: function(json) {
                    $('#cupom_idUpd').val(json['cupom']['cupom_id']);

                    $('#cupom_codigoUpd').val(json['cupom']['cupom_codigo']);

                    $('#cupom_desconto_porcentUpd').val(json['cupom']['cupom_desconto_porcent']);
                    updateCupom();
                }
        });
    });
}

function updateCupom() {
    $('.formUpdateCupom').submit(function(e) {
        e.preventDefault();
        var formCupom = $(this).serialize();

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/cupom',
            type: 'POST',
            data: formCupom,
            beforeSend() {
                clearErrors();
                $("#btnUpdateCupom").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                clearErrors();
                if(json['status']) {
                    Swal.fire({
                        title: "Cupom editado com sucesso!",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#333",
                        confirmButtonText: "Ok",
                    }).then((result) => {
                        if(result.value) {
                            var modalUpd = document.getElementById('myModalUpd');
                            modalUpd.style.display = "none";
                            dataCupons(page, qtd_result);
                        } else {
                            var modalUpd = document.getElementById('myModalUpd');
                            modalUpd.style.display = "none";
                            dataCupons(page, qtd_result);
                        }
                    });
                } else {
                    $("#btnUpdateCupom").siblings(".help-block").html(json['error']);
                }
            }
        });
    });
}

function insertCupom() {
    $('.formInserirCupom').submit(function(e) {
        e.preventDefault();
        var formCupom = $(this).serialize();

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/cupom',
            type: 'POST',
            data: formCupom,
            beforeSend() {
                clearErrors();
                $("#btnInsertCupom").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                clearErrors();
                dataCupons(page, qtd_result);
                
                if(json['status']) {
                    Swal.fire({
                        title: "Cupom(ns) cadastrado(s) com sucesso!",
                        text: "Deseja continuar cadastrando Cupom(ns)?",
                        type: "success",
                        showCancelButton: true,
                        confirmButtonColor: "#333",
                        confirmButtonText: "Continuar",
                        cancelButtonColor: "#999",
                        cancelButtonText: "Sair"
                    }).then((result) => {
                        if(result.value) {
                            mostraModalAdd();
                        } else {
                            modalAdd.style.display = "none";
                        }
                    });
                } else {
                    $("#btnInsertCupom").siblings(".help-block").html(json['error']);
                }
            }
        });
    });
}

function deleteCupom() {
    $('.btnDelCupom').click(function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: "Deseja mesmo excuir este cupom?",
            text: "Uma vez feito, não haverá volta!",
            type: "warning",
            showCancelButton: true,
            cancelButtonColor: "#494949",
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#A94442",
            confirmButtonText: "Sim, excluir"
        }).then((result) => {
            if(result.value) {
                var dado = "delCupom_id=" + $(this).attr("id-cupom");
                $.ajax({
                    dataType: 'json',
                    url: BASE_URL4 + 'functions/cupom',
                    type: 'POST',
                    data: dado,
                    success: function(json) {
                        if(json['status']) {
                            Swal.fire({
                                title: "Cupom excluido com sucesso!",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#494949",
                                confirmButtonText: "Ok"
                            });
                            dataCupons(page, qtd_result);
                        } else {
                            Swal.fire({
                                title: "Ocorreu um erro ao excluir cupom!",
                                text: json['error_del'],
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#494949",
                                confirmButtonText: "Ok"
                            });
                        }
                    }
                });
            }
        });
    });
}

dataCupons(page, qtd_result);