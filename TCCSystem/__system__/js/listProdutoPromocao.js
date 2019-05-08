$(function() {
    $.ajax({
        dataType: 'json',
        url: BASE_URL + 'functions/listProdutoPromocao',
        success: function(response) {
            if(response['status']) {
                var produtos = [];
                for (var i = 0; response['produtos'].length > i; i++) {
                    produtos[i] = `
                        <div class="divProdCarousel">
                            <div class="btnFavorito` + response['produtos'][i].produto_id + `"></div>
                            <a class="linksProdCarousel">
                                <img class="divProdImg" src="` + BASE_URL3 + response['produtos'][i].produto_img + `">
                                <p class="divProdPromo">-` + response['produtos'][i].produto_desconto_porcent + `%</p>
                                <h4 class="divProdTitle">` + response['produtos'][i].produto_nome + `</h4>
                                <p class="divProdPrice"><span class="divProdPrice1">R$` + response['produtos'][i].produto_preco + `</span> R$` + response['produtos'][i].produto_desconto + `</p>
                                <button class="btnBuy">COMPRAR</button>
                            </a>
                        </div>
                    `;
                }
                $('.l-prods').html(`<div class="loop owl-carousel">` + produtos + `</div>`);
                $('body').append('<script src="' + BASE_URL2 + 'js/btnFavorito.js"></script>');
            } else {
                $('.l-prods').html(`<h2 class="sem_promo">Sem promoções hoje. Aproveite a barra de pesquisa</h2>`);
            }
        }
    });
});