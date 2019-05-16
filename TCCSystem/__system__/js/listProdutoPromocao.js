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
                                <div class='divisorFilterCar'></div>
                                <p class="divProdPromo">-` + response['produtos'][i].produto_desconto_porcent + `%</p>
                                <h4 class="divProdTitle">` + response['produtos'][i].produto_nome + ` - ` + response['produtos'][i].produto_tamanho + `</h4>
                                <p class="divProdPrice"><span class="divProdPrice1">R$` + response['produtos'][i].produto_preco + `</span> R$` + response['produtos'][i].produto_desconto + `</p>
                                <div>
                                    <button class="btnBuy">COMPRAR</button>
                                    <form class="formBuy">
                                        <input type="hidden" value="` + response['produtos'][i].produto_id + `" name="id_prod"/>
                                        <input type="number" min="0" value="` + response['produtos'][i].carrinho + `" class="inputBuy` + response['produtos'][i].produto_id + `" name="qtd_prod"/>
                                    </form>
                                </div>
                            </a>
                        </div>
                    `;
                }
                $('.l-prods').html(`<div class="loop owl-carousel prodsCar"></div>`);
                for(var i = 0; produtos.length > i; i++) {
                    $('.prodsCar').append(produtos[i]);
                }
                attCarrinho();
                btnFavorito();
            } else {
                $('.l-prods').html(`<h2 class="sem_promo">Sem promoções hoje. Aproveite a barra de pesquisa</h2>`);
            }
        }
    });
});