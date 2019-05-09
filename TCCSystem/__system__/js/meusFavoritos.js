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
                                    <div class="btnFavorito` + json['produtos'][i].produto_id + `"></div>
                                    <a class="linksProdCarousel">
                                        <img class="divProdImg" src="` + BASE_URL3 + json['produtos'][i].produto_img + `">
                                        <p class="divProdPromo">-` + json['produtos'][i].produto_desconto_porcent + `%</p>
                                        <h4 class="divProdTitle">` + json['produtos'][i].produto_nome + `</h4>
                                        <p class="divProdPrice"><span class="divProdPrice1">R$` + json['produtos'][i].produto_preco + `</span> R$` + json['produtos'][i].produto_desconto + `</p>
                                        <button class="btnBuy">COMPRAR</button>
                                    </a>
                                </div>
                            `;
                        } else {
                            produtos[i] = `
                                <div class="divProdCarousel">
                                    <div class="btnFavorito` + json['produtos'][i].produto_id + `"></div>
                                    <a class="linksProdCarousel">
                                        <img class="divProdImg" src="` + BASE_URL3 + json['produtos'][i].produto_img + `">
                                        <h4 class="divProdTitle">` + json['produtos'][i].produto_nome + `</h4>
                                        <p class="divProdPrice">R$` + json['produtos'][i].produto_preco + `</p>
                                        <button class="btnBuy">COMPRAR</button>
                                    </a>
                                </div>
                            `;
                        }
                    }
                    $('.l-favoritos').html(`<h2 class="tituloOfertas">MEUS FAVORITOS</h2>
                    <div class="loop owl-carousel">` + produtos + `</div>`);
                } else {
                    $('.l-favoritos').html(`<h2 class="tituloOfertas">MEUS FAVORITOS</h2>
                    <h2 class="sem_fav">Ao favoritar produtos, eles aparecerão aqui</h2>`);
                }
            }
            $('body').append('<script src="' + BASE_URL2 + 'js/btnFavorito.js"></script>\
            <script src="' + BASE_URL2 + 'js/main.js"></script>');
        }
    });
}

meusFavoritos();