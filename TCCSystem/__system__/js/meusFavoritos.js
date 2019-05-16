function meusFavoritos() {
    $.ajax({
        dataType: 'json',
        url: BASE_URL + 'functions/meusFavoritos',
        success: function(json) {
            if(json['logado']) {
                if(json['tem_favorito']) {
                    var produtos = [];
                    for (var i = 0; json['produtos'].length > i; i++) {
                        if(json['produtos'][i].produto_desconto_porcent) {
                            produtos[i] = `
                                <div class="divProdCarousel">
                                    <div class="btnFavoriteFilter btnFavorito` + json['produtos'][i].produto_id + `">
                                        
                                    </div>
                                    <img src="` + BASE_URL2 + `admin_area/imagens_produtos/` + json['produtos'][i].produto_img + `"/>
                                    <p class="divProdPromo">-` + json['produtos'][i].produto_desconto_porcent + `%</p>
                                    <div class='divisorFilter'></div>
                                    <h5 class='titleProdFilter'>` + json['produtos'][i].produto_nome + ` - ` + json['produtos'][i].produto_tamanho + `</h5>
                                    <p class='priceProdFilter'>
                                        <span class="divProdPrice1">R$` + json['produtos'][i].produto_preco + `</span> R$` + json['produtos'][i].produto_desconto + `
                                    </p>
                                    <div>
                                        <button class="btnBuy">COMPRAR</button>
                                        <form class="formBuy">
                                            <input type="hidden" value="` + json['produtos'][i].produto_id + `" name="id_prod"/>
                                            <input type="number" min="0" value="` + json['produtos'][i].carrinho + `" class="inputBuy" name="qtd_prod"/>
                                        </form>
                                    </div>
                                </div>
                            `;
                        } else {
                            produtos[i] = `
                                <div class="divProdCarousel">
                                    <div class='btnFavoriteFilter btnFavorito` + json['produtos'][i].produto_id + `'>
                                        
                                    </div>
                                    <img src='` + BASE_URL2 + `admin_area/imagens_produtos/` + json['produtos'][i].produto_img + `'/>
                                    <div class='divisorFilter'></div>
                                    <h5 class='titleProdFilter'>` + json['produtos'][i].produto_nome + ` - `  + json['produtos'][i].produto_tamanho + `</h5>
                                    <p class='priceProdFilter'>R$ ` + json['produtos'][i].produto_preco + `</p>
                                    <div>
                                        <button class="btnBuy">COMPRAR</button>
                                        <form class="formBuy">
                                            <input type="hidden" value="` + json['produtos'][i].produto_id + `" name="id_prod"/>
                                            <input type="number" min="0" value="` + json['produtos'][i].carrinho + `" class="inputBuy" name="qtd_prod"/>
                                        </form>
                                    </div>
                                </div>
                            `;
                        }
                    }
                    $('.l-favoritos').html(`<h2 class="tituloOfertas">MEUS FAVORITOS</h2>\
                    <div class="favoritos owl-carousel">\
                    ` + produtos + `\
                    </div>`);
                } else {
                    $('.l-favoritos').html(`<h2 class="tituloOfertas">MEUS FAVORITOS</h2>
                    <h2 class="sem_fav">Ao favoritar produtos, eles aparecerão aqui</h2>`);
                }
            }
            btnFavorito();
        }
    });
}

meusFavoritos();