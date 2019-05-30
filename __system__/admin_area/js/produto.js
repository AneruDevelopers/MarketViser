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
                if(json['status']) {
                    alert("Cadastrado com sucesso");
                    carregar('produto/inserir_produto');
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

function insertMarca() {
    $('.formInserirMarca').submit(function(e) {
        e.preventDefault();

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/produto',
            type: 'POST',
            data: $(this).serialize(),
            beforeSend() {
                clearErrors();
                $("#btnInsertMarca").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                if(json['status']) {
                    alert("Cadastrado com sucesso");
                    carregar('produto/inserir_marca');
                }
            }
        });
        return false;
    });
}

function insertDep() {
    $('.formInserirDep').submit(function(e) {
        e.preventDefault();

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/produto',
            type: 'POST',
            data: $(this).serialize(),
            beforeSend() {
                clearErrors();
                $("#btnInsertDep").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                if(json['status']) {
                    alert("Cadastrado com sucesso");
                    carregar('produto/inserir_dep');
                }
            }
        });
        return false;
    });
}

function insertSubcateg() {
    $('.formInserirSubcateg').submit(function(e) {
        e.preventDefault();

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/produto',
            type: 'POST',
            data: $(this).serialize(),
            beforeSend() {
                clearErrors();
                $("#btnInsertSubcateg").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                if(json['status']) {
                    alert("Cadastrado com sucesso");
                    carregar('produto/inserir_subcateg');
                }
            }
        });
        return false;
    });
}

function insertCateg() {
    $('.formInserirCateg').submit(function(e) {
        e.preventDefault();

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/produto',
            type: 'POST',
            data: $(this).serialize(),
            beforeSend() {
                clearErrors();
                $("#btnInsertCateg").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                if(json['status']) {
                    alert("Cadastrado com sucesso");
                    carregar('produto/inserir_categ');
                }
            }
        });
        return false;
    });
}