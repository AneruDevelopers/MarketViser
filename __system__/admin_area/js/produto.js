function dataProds() {
    $.ajax({
        dataType: 'json',
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
                                    <button class="btnEditProd btnProductConfigAdm" id-produto="` + json['produtos'][i].produto_id + `"><i class="fa fa-edit"></i></button>
                                    <button class="btnDelProd btnProductConfigAdm" id-produto="` + json['produtos'][i].produto_id + `"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        `);
                    }
                    $('.l-wrapper').append(`
                        <div class="myModalView" id="myModalView">
                            <div class="modalViewContent">
                                <span class="closeModalView">&times;</span>
                                <div class="showViewModal">

                                </div>
                            </div>
                        </div>
                    `);
                    deleteProduto();
                    modalView();
                    viewProduto();
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
        }
        //Executar função de x em x segundo(s)
        // complete: function() {
        //     setTimeout(dataProds, 5000);
        // }
    });
}

function searchProduto() {
    $('#searchProd').keyup(function(e) {
        e.preventDefault();

        if($(this).val().length > 0) {
            var dado = "searchProd=" + $(this).val();
            $.ajax({
                dataType: 'json',
                type: 'post',
                data: dado,
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
                                            <button class="myBtnView btnViewProd" id-produto="` + json['produtos'][i].produto_id + `"><i class="fa fa-eye"></i></button>
                                            <button class="btnEditProd" id-produto="` + json['produtos'][i].produto_id + `"><i class="fa fa-edit"></i></button>
                                            <button class="btnDelProd" id-produto="` + json['produtos'][i].produto_id + `"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                `);
                            }
                            deleteProduto();
                            modalView();
                            viewProduto();
                        } else {
                            $('.tbodyProd').html(`
                                <tr>
                                    <th colspan="5" class="thNoData">- NÃO HOUVE RESPOSTA -</th>
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
                }
            });
        } else {
            dataProds();
        }
    });
}

function viewProduto() {
    $(".btnViewProd").click(function(e) {
        e.preventDefault();
        var dado = "viewProd_id=" + $(this).attr("id-produto");
        $.ajax({
            dataType: 'json',
                type: 'post',
                data: dado,
                url: BASE_URL4 + 'functions/produto',
                beforeSend: function() {
                    $('.showViewModal').html(`
                        <p align="center"><i class='fa fa-circle-notch fa-spin'></i> &nbsp;Buscando dados...</p>
                    `);
                },
                success: function(json) {
                    $('.showViewModal').html(`
                        <div class="modalViewLeft">
                            <img class="imgProdModal" src="` + BASE_URL3 + json['produto']['produto_img'] + `"/>
                        </div>
                        <div class="modalViewRight">
                            <div class="infView">
                                <span class="marcaProdView">` + json['produto']['marca_nome'] + `</span>
                                <h2 class="nomeProdView">
                                    ` + json['produto']['produto_nome'] + `<br/>
                                    <span class="volProdView">` + json['produto']['produto_tamanho'] + `</span>
                                </h2>
                            </div>
                            <div class="categView">
                                <p class="categProdView">
                                    ` + json['produto']['depart_nome'] + ` / 
                                    ` + json['produto']['subcateg_nome'] + ` / 
                                    ` + json['produto']['categ_nome'] + `
                                </p>
                            </div>
                            <div class="descView">
                                <h4 class="descTitleView">Descrição:</h4>
                                <p>
                                    ` + json['produto']['produto_descricao'] + `
                                </p>
                            </div>
                        </div>
                    `);
                }
        });
    });
}

function insertProduto() {
    $('.formInserirProdutos').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/produto',
            type: 'POST',
            data: formData,
            beforeSend() {
                clearErrors();
                $("#btnInsertProduto").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                clearErrors();
                if(json['status']) {
                    alert("Cadastrado com sucesso");
                    carregar('inserir_produto');
                } else {
                    showErrorsAdmin(response["error_list"]);
                }
            },
            cache: false,
            contentType: false,
            processData: false,
            xhr: function() {  // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function () {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
            return myXhr;
            }
        });
    });
}

function updateProduto() {
    $('.formUpdateProdutos').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/produto',
            type: 'POST',
            data: formData,
            beforeSend() {
                clearErrors();
                $("#btnInsertProduto").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                clearErrors();
                if(json['status']) {
                    alert("Cadastrado com sucesso");
                    carregar('inserir_produto');
                } else {
                    showErrorsAdmin(response["error_list"]);
                }
            },
            cache: false,
            contentType: false,
            processData: false,
            xhr: function() {  // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function () {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
            return myXhr;
            }
        });
    });
}

function deleteProduto() {
    $('.btnDelProd').click(function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: "Deseja mesmo excuir este produto?",
            text: "Uma vez feito, não haverá volta! (Qualquer relação que há com esse produto, será também deletado)",
            type: "warning",
            showCancelButton: true,
            cancelButtonColor: "#494949",
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#A94442",
            confirmButtonText: "Sim, excluir"
        }).then((result) => {
            if(result.value) {
                var dado = "delProd_id=" + $(this).attr("id-produto");
                $.ajax({
                    dataType: 'json',
                    url: BASE_URL4 + 'functions/produto',
                    type: 'POST',
                    data: dado,
                    success: function(json) {
                        if(json['status']) {
                            Swal.fire({
                                title: "Produto excluido com sucesso!",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#494949",
                                confirmButtonText: "Ok"
                            });
                            dataProds();
                        } else {
                            Swal.fire({
                                title: "Ocorreu um erro ao excluir produto!",
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

dataProds();
searchProduto();