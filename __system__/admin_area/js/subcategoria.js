function insertSubcateg() {
    $('.formInserirSubcateg').submit(function(e) {
        e.preventDefault();

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/subcategoria',
            type: 'POST',
            data: $(this).serialize(),
            beforeSend() {
                clearErrors();
                $("#btnInsertSubcateg").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                if(json['status']) {
                    alert("Cadastrado com sucesso");
                    carregar('inserir_subcateg');
                }
            }
        });
        return false;
    });
}