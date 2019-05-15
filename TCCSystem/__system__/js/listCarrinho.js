function listCarrinho() {
    $.ajax({
        url: BASE_URL + 'functions/listCarrinho',
        dataType: 'json',
        beforeSend: function() {
            $('.divShowProdFav').html(loadingRes("Verificando carrinho..."));
        },
        success: function(json) {
            if(!json['empty']) {
                $('.divShowProdFav').html(loadingRes("Importando carrinho..."));
                $('.divShowProdFav').html("");
                for(var i = 0; json['prods'].length > i; i++) {
                    if(json['prods'][i].produto_desconto_porcent) {
                        $('.divShowProdFav').append(`
                            <div class="prod">
                                <div class="btnFavoriteFilter btnFavorito` + json['prods'][i].produto_id + `">
                                    
                                </div>
                                <img src="` + BASE_URL2 + `admin_area/imagens_produtos/` + json['prods'][i].produto_img + `"/>
                                <p class="divProdPromo">-` + json['prods'][i].produto_desconto_porcent + `%</p>
                                <div class="divisorFilter"></div>
                                <h3>` + json['prods'][i].carrinho + ` - R$` + json['prods'][i].subtotal + `</h3>
                                <h5 class="titleProdFilter">` + json['prods'][i].produto_nome + ` - ` + json['prods'][i].produto_tamanho + `</h5>
                                <p class="priceProdFilter">
                                    <span class="divProdPrice1">R$` + json['prods'][i].produto_preco + `</span> R$` + json['prods'][i].produto_desconto + `
                                </p>
                            </div>
                        `);
                    } else {
                        $('.divShowProdFav').append(`
                            <div class="prod">
                                <div class="btnFavoriteFilter btnFavorito` + json['prods'][i].produto_id + `">
                                    
                                </div>
                                <img src="` + BASE_URL2 + `admin_area/imagens_produtos/` + json['prods'][i].produto_img + `"/>
                                <div class="divisorFilter"></div>
                                <h3>` +json['prods'][i].carrinho + ` - R$` + json['prods'][i].subtotal + `</h3>
                                <h5 class="titleProdFilter">` + json['prods'][i].produto_nome + ` - ` + json['prods'][i].produto_tamanho + `</h5>
                                <p class="priceProdFilter">R$ ` + json['prods'][i].produto_preco + `</p>
                            </div>
                        `);
                    }
                }
                $('.divShowTot').html(`<h2>Total da compra: R$` + json['totCompra'] + `</h2>`);
                $('body').append('<script src="' + BASE_URL2 + 'js/attCarrinho.js"></script>\
                <script src="' + BASE_URL2 + 'js/btnFavorito.js"></script>');
            } else {
                $('.divShowProdFav').html("Sem produtos no carrinho!");
            }
        }
    });
}

listCarrinho();