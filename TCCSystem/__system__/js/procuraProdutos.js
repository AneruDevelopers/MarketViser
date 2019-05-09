$(".categ").change(function() {
    if ($(this).prop("checked") == true) {
        var href = removeAcento($(this).val());
        var local = location;
        local = local + "";

        if(local.indexOf('#') != -1) {
            var local = local.substring(0, (local.length - 1));
        }

        window.location = local + '/' + href;
    }
});

$(".categ").trigger("change");

$('#tamanho_filtro').change(function() {
    var dado = "produto_tamanho=" + $(this).val();
    var url = BASE_URL + 'functions/filtroTamanho';
    $.ajax({
        type: 'post',
        dataType: 'json',
        data: dado,
        url: url,
        success: function(json) {
            var produtos = [];
            $('.produtos').html("");
            for(var i = 0; json.length > i; i++) {
                produtos[i] = `
                    <div class="prod">
                        <img src="` + BASE_URL + "admin_area/imagens_produtos/" + json[i].produto_img + `/> ` + json[i].produto_nome + ` - `  + json[i].produto_tamanho + `<br/>R$ ` + json[i].produto_preco + `
                    </div>
                `;
            }
            for(var i = 0; produtos.length > i; i++) {
                $('.produtos').append(produtos[i]);
            }
        }
    });
});

$('#marca_filtro').change(function() {
    var dado = "produto_marca=" + $(this).val();
    var url = BASE_URL + 'functions/filtroMarca';
    $.ajax({
        type: 'post',
        dataType: 'json',
        data: dado,
        url: url,
        success: function(json) {
            var produtos = [];
            $('.produtos').html("");
            for(var i = 0; json.length > i; i++) {
                produtos[i] = `
                    <div class="prod">
                        <img src="` + BASE_URL + "admin_area/imagens_produtos/" + json[i].produto_img + `/> ` + json[i].produto_nome + ` - `  + json[i].produto_tamanho + `<br/>R$ ` + json[i].produto_preco + `
                    </div>
                `;
            }
            for(var i = 0; produtos.length > i; i++) {
                $('.produtos').append(produtos[i]);
            }
        }
    });
});

$('#preco_filtro').change(function() {
    var dado = "produto_preco=" + $(this).val();
    var url = BASE_URL + 'functions/filtroPreco';
    $.ajax({
        type: 'post',
        dataType: 'json',
        data: dado,
        url: url,
        success: function(json) {
            var produtos = [];
            $('.produtos').html("");
            for(var i = 0; json.length > i; i++) {
                produtos[i] = `
                    <div class="prod">
                        <img src="` + BASE_URL + "admin_area/imagens_produtos/" + json[i].produto_img + `/> ` + json[i].produto_nome + ` - `  + json[i].produto_tamanho + `<br/>R$ ` + json[i].produto_preco + `
                    </div>
                `;
            }
            for(var i = 0; produtos.length > i; i++) {
                $('.produtos').append(produtos[i]);
            }
        }
    });
});