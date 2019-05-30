function insertProdutoArmazem() {
    $('.formInserirProdutoArmazem').submit(function(e) {
        e.preventDefault();

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/armazem',
            type: 'POST',
            data: $(this).serialize(),
            beforeSend() {
                clearErrors();
                $("#btnInsertProdutoArmazem").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                if(json['status']) {
                    alert("Cadastrado com sucesso");
                    carregar('armazem/inserir_produto_armazem');
                }
            }
        });
        return false;
    });
}