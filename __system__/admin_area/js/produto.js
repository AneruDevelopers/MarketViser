function dataProds() {
    $.ajax({
        dataType: 'json',
        url: BASE_URL4 + 'functions/produto',
        beforeSend: function() {
            $('.dataProds').html(loadingRes("Processando..."));
        },
        success: function(json) {
            if(json['status']) {
                if(!json['empty']) {
                    $('.dataProds').html(`
                        <table border="1" width="80%">
                            <thead>
                                <th width="10%">Imagem</th>
                                <th width="30%">Nome</th>
                                <th width="25%">Volume</th>
                                <th width="25%">Marca</th>
                                <th width="10%">Ações</th>
                            </thead>
                            <tbody class="tbodyProd">

                            </tbody>
                        </table>
                    `);
                    for(var i = 0; json['produtos'].length > i; i++) {
                        $('.tbodyProd').append(`
                            <tr>
                                <td><img class="imgProd" style="width:100%;" src="` + BASE_URL3 + json['produtos'][i].produto_img + `"/></td>
                                <td>` + json['produtos'][i].produto_nome + `</td>
                                <td>` + json['produtos'][i].produto_tamanho + `</td>
                                <td>` + json['produtos'][i].marca_nome + `</td>
                                <td>
                                    <button><i class="fa fa-edit"></i></button>
                                    <button><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        `);
                    }
                } else {

                }
            } else {

            }
        }
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

dataProds();