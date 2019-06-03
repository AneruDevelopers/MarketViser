function insertCateg() {
    $('.formInserirCateg').submit(function(e) {
        e.preventDefault();

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/categoria',
            type: 'POST',
            data: $(this).serialize(),
            beforeSend() {
                clearErrors();
                $("#btnInsertCateg").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                if(json['status']) {
                    alert("Cadastrado com sucesso");
                    carregar('inserir_categ');
                }
            }
        });
        return false;
    });
}