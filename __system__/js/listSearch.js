$(document).ready(function() {
    $('.pesquisaTxtHeader').keyup(function(e) {
        e.preventDefault();
        if($(this).val().length > 0) {
            var dado = "buscaBarra=" + $(this).val();
            $.ajax({
                dataType: 'json',
                url: BASE_URL + 'functions/listSearch',
                type: 'post',
                data: dado,
                beforeSend: function() {
                    $('.tituloOfertas').html(`Sua pesquisa sobre: ` + $('.pesquisaTxtHeader').val());
                    $('.divShowProdFav').html(loadingRes('Buscando produto(s)...'));
                },
                success: function(json) {
                    if(!json['empty']) {
                        $('.divShowProdFav').html(loadingRes("Importando produto(s)..."));
                        $('.divShowProdFav').html("");
                        for(var i = 0; json['prods'].length > i; i++) {
                            if(json['prods'][i].produto_desconto_porcent) {
                                $('.divShowProdFav').append(`
                                    <div class="prodFilter">
                                        <div class="btnFavoriteFilter btnFavorito` + json['prods'][i].produto_id + `">
                                            
                                        </div>
                                        <img src="` + BASE_URL2 + `admin_area/imagens_produtos/` + json['prods'][i].produto_img + `"/>
                                        <p class="divProdPromo">-` + json['prods'][i].produto_desconto_porcent + `%</p>
                                        <div class="divisorFilter"></div>
                                        <h5 class="titleProdFilter">` + json['prods'][i].produto_nome + ` - ` + json['prods'][i].produto_tamanho + `</h5>
                                        <p class="priceProdFilter">
                                            <span class="divProdPrice1">R$` + json['prods'][i].produto_preco + `</span> R$` + json['prods'][i].produto_desconto + `
                                        </p>
                                        <div>
                                            <button class="btnBuy">ADICIONAR</button>
                                            <form class="formBuy">
                                                <input type="hidden" value="` + json['prods'][i].produto_id + `" name="id_prod"/>
                                                <input type="number" min="0" max="20" value="` + json['prods'][i].carrinho + `" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                            </form>
                                        </div>
                                    </div>
                                `);
                            } else {
                                $('.divShowProdFav').append(`
                                    <div class="prodFilter">
                                        <div class="btnFavoriteFilter btnFavorito` + json['prods'][i].produto_id + `">
                                            
                                        </div>
                                        <img src="` + BASE_URL2 + `admin_area/imagens_produtos/` + json['prods'][i].produto_img + `"/>
                                        <div class="divisorFilter"></div>
                                        <h5 class="titleProdFilter">` + json['prods'][i].produto_nome + ` - ` + json['prods'][i].produto_tamanho + `</h5>
                                        <p class="priceProdFilter">R$ ` + json['prods'][i].produto_preco + `</p>
                                        <div>
                                            <button class="btnBuy">ADICIONAR</button>
                                            <form class="formBuy">
                                                <input type="hidden" value="` + json['prods'][i].produto_id + `" name="id_prod"/>
                                                <input type="number" min="0" max="20" value="` + json['prods'][i].carrinho + `" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                            </form>
                                        </div>
                                    </div>
                                `);
                            }
                        }
                        btnFavorito();
                        attCarrinho();
                    } else {
                        $('.divShowProdFav').html(`
                            <p>
                                Não houve resposta para o que pesquisou!<br/>
                                <b>Possíveis soluções:</b><br/>
                                1. Tente ser bem específico ao que está procurando;<br/>
                                2. Tente escrever pelo menos uma palavra inteira, por exemplo 'Refrigerante' ao invés de 'Refri';<br/>
                                3. Não use palavras tão comuns;<br/>
                                4. ...<br/>
                            </p>
                        `);
                    }
                }
            });
        } else {
            $('.tituloOfertas').html(`Pesquise seu produto no campo acima`);
            $('.divShowProdFav').html(``);
        }
    });

    $('.formPesquisaHeader').submit(function(e) {
        e.preventDefault();
        return false;
    })
});