function insertDep() {
    $('.formInserirDep').submit(function(e) {
        e.preventDefault();

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/departamento',
            type: 'POST',
            data: $(this).serialize(),
            beforeSend() {
                clearErrors();
                $("#btnInsertDep").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                if(json['status']) {
                    alert("Cadastrado com sucesso");
                    carregar('inserir_dep');
                }
            }
        });
        return false;
    });
}