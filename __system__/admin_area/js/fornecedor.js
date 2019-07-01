var qtd_result = 5;
var page = 1;
var max_links = 2;

function dataFornecedor(page, qtd_result) {
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
        url: BASE_URL4 + 'functions/fornecedor',
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
                    for(var i = 0; json['fornecedores'].length > i; i++) {
                        $('.tbodyProd').append(`
                            <tr>
                                <td>` + json['fornecedores'][i].fornecedor_nome + `</td>
                                <td class="tdCenter">` + json['fornecedores'][i].fornecedor_responsavel_nome + `</td>
                                <td class="tdCenter">` + json['fornecedores'][i].fornecedor_cnpj + `</td>
                                <td class="tdCenter">
                                    <button class="myBtnUpd btnEditFornecedor btnProductConfigAdm" id-fornecedor="` + json['fornecedores'][i].fornecedor_id + `"><i class="fa fa-edit"></i></button>
                                    <button class="btnDelFornecedor btnProductConfigAdm" id-fornecedor="` + json['fornecedores'][i].fornecedor_id + `"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        `);
                    }
                    $('body').append(`
                        <div class="myModalUpd" id="myModalUpd">
                            <div class="modalUpdContent">
                                <span class="closeModalUpd">&times;</span>
                                <div class="showUpdModal">
                                    <div class="divCadFornecedor">
                                        <form class="formUpdateFornecedor">
                                            <div class="divUpdCadFornecedor">
                                                <div style="margin:25px 0;">
                                                <table class="tableSectionConfigArm" width="80%" align="center">
                                                    <tr align="center">
                                                        <td colspan="8"><h2 style="text-align:center;color:#9C45EB;font-size:14px;">EDITAR FORNECEDOR</h2></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="text-align:center;color:#9C45EB;"><b>NOME</b></td>
                                                        <td>
                                                            <input type="hidden" name="fornecedor_idUpd" id="fornecedor_idUpd"/>
                                                            <input type="text" class="selectConfigArm" name="fornecedor_nomeUpd" id="fornecedor_nomeUpd"/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="text-align:center;color:#9C45EB;"><b>NOME RESPONSÁVEL</b></td>
                                                        <td>
                                                            <input type="text" class="selectConfigArm" name="fornecedor_responsavel_nomeUpd" id="fornecedor_responsavel_nomeUpd"/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="text-align:center;color:#9C45EB;"><b>CNPJ</b></td>
                                                        <td>
                                                            <input type="text" class="selectConfigArm cnpj" name="fornecedor_cnpjUpd" id="fornecedor_cnpjUpd"/>
                                                        </td>
                                                    </tr>
                                                </table>
                                                </div>
                                            </div>
                                            <div class="divSubmit" align="center">
                                                <button type="submit" id="btnUpdateFornecedor"><i class="fas fa-save"></i> Editar</button>
                                                <div class="help-block"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                    deleteFornecedor();
                    modalUpd();
                    updFornecedor();
                } else {
                    $('.tbodyProd').html(`
                        <tr>
                            <th colspan="5" class="thNoData">- NÃO HÁ FORNECEDORES CADASTRADOS -</th>
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
                <a href="#" class="linkPaginacao" onclick="dataFornecedor(1, qtd_result)">Primeira</a> 
            `);

            for(var pag_ant = (page - max_links); pag_ant <= (page - 1); pag_ant++) {
                if(pag_ant >= 1) {
                    $('.paginacao').append(`
                        <button class="btnPaginacao" onclick="dataFornecedor(` + pag_ant + `, qtd_result)">` + pag_ant + `</button> 
                    `);
                }
            }

            $('.paginacao').append(` ` + page + ` `);

            for(var pag_dep = (page + 1); pag_dep <= (page + max_links); pag_dep++) {
                if(pag_dep <= totPage) {
                    $('.paginacao').append(`
                        <button class="btnPaginacao" onclick="dataFornecedor(` + pag_dep + `, qtd_result)">` + pag_dep + `</button> 
                    `);
                }
            }

            $('.paginacao').append(`
                <a href="#" class="linkPaginacao" onclick="dataFornecedor(` + totPage + `, qtd_result)">Última</a>
            `);
        }
    });
}

function updFornecedor() {
    $(".btnEditFornecedor").click(function(e) {
        e.preventDefault();
        clearErrors();
        var dado = "updFornecedor_id=" + $(this).attr("id-fornecedor");
        $.ajax({
            dataType: 'json',
                type: 'post',
                data: dado,
                url: BASE_URL4 + 'functions/fornecedor',
                beforeSend: function() {
                    $('#funcionario_idUpd').val("");
                    $('#fornecedor_nomeUpd').val("");
                    $('#fornecedor_responsavel_nomeUpd').val("");
                    $('#fornecedor_cnpjUpd').val("");
                },
                success: function(json) {
                    $('#funcionario_idUpd').val(json['fornecedor']['funcionario_id']);

                    $('#fornecedor_nomeUpd').val(json['fornecedor']['fornecedor_nome']);

                    $('#fornecedor_responsavel_nomeUpd').val(json['fornecedor']['fornecedor_responsavel_nome']);

                    $('#fornecedor_cnpjUpd').val(json['fornecedor']['fornecedor_cnpj']);
                    updateFornecedor();
                }
        });
    });
}

function updateFornecedor() {
    $('.formUpdateFornecedor').submit(function(e) {
        e.preventDefault();
        var formFornecedor = $(this).serialize();

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/fornecedor',
            type: 'POST',
            data: formFornecedor,
            beforeSend() {
                clearErrors();
                $("#btnUpdateFornecedor").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                clearErrors();
                if(json['status']) {
                    Swal.fire({
                        title: "Fornecedor editado com sucesso!",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#333",
                        confirmButtonText: "Ok",
                    }).then((result) => {
                        if(result.value) {
                            var modalUpd = document.getElementById('myModalUpd');
                            modalUpd.style.display = "none";
                            dataFornecedor(page, qtd_result);
                        } else {
                            var modalUpd = document.getElementById('myModalUpd');
                            modalUpd.style.display = "none";
                            dataFornecedor(page, qtd_result);
                        }
                    });
                } else {
                    $("#btnUpdateFornecedor").siblings(".help-block").html(json['error']);
                }
            }
        });
    });
}

function insertFornecedor() {
    $('.formInserirFornecedor').submit(function(e) {
        e.preventDefault();

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/fornecedor',
            type: 'POST',
            data: $(this).serialize(),
            beforeSend() {
                clearErrors();
                $("#btnInsertFornecedor").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                clearErrors();
                if(json['status']) {
                    Swal.fire({
                        title: "Fornecedor(es) cadastrado(s) com sucesso!",
                        text: "Deseja continuar cadastrando fornecedor(es)?",
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
                    dataFornecedor(page, qtd_result);
                } else {
                    $("#btnInsertFornecedor").siblings(".help-block").html(json['error']);
                }
            }
        });
        return false;
    });
}

function deleteFornecedor() {
    $('.btnDelFornecedor').click(function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: "Deseja mesmo excuir este fornecedor?",
            text: "Uma vez feito, não haverá volta! (Qualquer relação que há com este fornecedor, será perdida)",
            type: "warning",
            showCancelButton: true,
            cancelButtonColor: "#494949",
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#A94442",
            confirmButtonText: "Sim, excluir"
        }).then((result) => {
            if(result.value) {
                var dado = "delFornecedor_id=" + $(this).attr("id-fornecedor");
                $.ajax({
                    dataType: 'json',
                    url: BASE_URL4 + 'functions/fornecedor',
                    type: 'POST',
                    data: dado,
                    success: function(json) {
                        if(json['status']) {
                            Swal.fire({
                                title: "Fornecedor excluido com sucesso!",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#494949",
                                confirmButtonText: "Ok"
                            });
                            dataFornecedor(page, qtd_result);
                        } else {
                            Swal.fire({
                                title: "Ocorreu um erro ao excluir fornecedor!",
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

dataFornecedor(page, qtd_result);