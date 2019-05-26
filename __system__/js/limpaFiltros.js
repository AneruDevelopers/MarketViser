function limpaVol() {
    $('.FilterVol').html('<i class="fas fa-weight-hanging"></i> VOLUME');
    var url = BASE_URL + 'functions/filtroTamanho';
    $.ajax({
        dataType: 'json',
        url: url,
        beforeSend: function() {
            $('.divShowProdFilter').html(loadingRes(" Carregando..."));
        },
        success: function(json) {
            if(json['empty']) {
                $('.divShowProdFilter').html("<h3>Não houve resposta</h3>");
            } else {
                var produtos = [];
                for(var i = 0; json['produtos'].length > i; i++) {
                    if(json['produtos'][i].produto_desconto_porcent) {
                        produtos[i] = `
                            <div class="prodFilter">
                                <div class='btnFavoriteFilter btnFavorito` + json['produtos'][i].produto_id + `'>
                                    
                                </div>
                                <img src='` + BASE_URL2 + `admin_area/imagens_produtos/` + json['produtos'][i].produto_img + `'/>
                                <p class="divProdPromo">-` + json['produtos'][i].produto_desconto_porcent + `%</p>
                                <div class='divisorFilter'></div>
                                <h5 class='titleProdFilter'>` + json['produtos'][i].produto_nome + ` - `  + json['produtos'][i].produto_tamanho + `</h5>
                                <p class='priceProdFilter'><span class="divProdPrice1">R$` + json['produtos'][i].produto_preco + `</span> R$` + json['produtos'][i].produto_desconto + `</p>
                                <div>
                                    <form class="formBuy">
                                        <input type="hidden" value="` + json['produtos'][i].produto_id + `" name="id_prod"/>
                                        <input type="number" min="0" max="20" value="` + json['produtos'][i].carrinho + `" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                        <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                    </form>
                                </div>
                            </div>
                        `;
                    } else {
                        produtos[i] = `
                            <div class="prodFilter">
                                <div class='btnFavoriteFilter btnFavorito` + json['produtos'][i].produto_id + `'>
                                    
                                </div>
                                <img src='` + BASE_URL2 + `admin_area/imagens_produtos/` + json['produtos'][i].produto_img + `'/>
                                <div class='divisorFilter'></div>
                                <h5 class='titleProdFilter'>` + json['produtos'][i].produto_nome + ` - `  + json['produtos'][i].produto_tamanho + `</h5>
                                <p class='priceProdFilter'>R$ ` + json['produtos'][i].produto_preco + `</p>
                                <div>
                                    <form class="formBuy">
                                        <input type="hidden" value="` + json['produtos'][i].produto_id + `" name="id_prod"/>
                                        <input type="number" min="0" max="20" value="` + json['produtos'][i].carrinho + `" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                        <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                    </form>
                                </div>
                            </div>
                        `;
                    }
                }
                $('.divShowProdFilter').html("");
                for(var i = 0; produtos.length > i; i++) {
                    $('.divShowProdFilter').append(produtos[i]);
                }
                attCarrinho();
                btnFavorito();
            }
        }
    });
    
    var tam = document.getElementsByClassName('produto_tamanho');
    for(i = 0; tam.length > i; i++) {
        tam[i].checked = false;
    }
    $(".produto_tamanho option[value='*000*']").removeAttr("disabled");
    $(".produto_tamanho option[value='*000*']").removeAttr("selected");
    $(".produto_tamanho option[value='*000*']").attr("selected", true);
    $(".produto_tamanho option[value='*000*']").attr("disabled", true);
}

function limpaMarca() {
    $('.FilterMarca').html('<i class="fas fa-copyright"></i> MARCA');
    var url = BASE_URL + 'functions/filtroMarca';
    $.ajax({
        dataType: 'json',
        url: url,
        success: function(json) {
            if(json['empty']) {
                $('.divShowProdFilter').html("<h3>Não houve resposta</h3>");
            } else {
                var produtos = [];
                for(var i = 0; json['produtos'].length > i; i++) {
                    if(json['produtos'][i].produto_desconto_porcent) {
                        produtos[i] = `
                            <div class="prodFilter">
                                <div class='btnFavoriteFilter btnFavorito` + json['produtos'][i].produto_id + `'>
                                    
                                </div>
                                <img src='` + BASE_URL2 + `admin_area/imagens_produtos/` + json['produtos'][i].produto_img + `'/>
                                <p class="divProdPromo">-` + json['produtos'][i].produto_desconto_porcent + `%</p>
                                <div class='divisorFilter'></div>
                                <h5 class='titleProdFilter'>` + json['produtos'][i].produto_nome + ` - `  + json['produtos'][i].produto_tamanho + `</h5>
                                <p class='priceProdFilter'><span class="divProdPrice1">R$` + json['produtos'][i].produto_preco + `</span> R$` + json['produtos'][i].produto_desconto + `</p>
                                <div>
                                    <form class="formBuy">
                                        <input type="hidden" value="` + json['produtos'][i].produto_id + `" name="id_prod"/>
                                        <input type="number" min="0" max="20" value="` + json['produtos'][i].carrinho + `" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                        <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                    </form>
                                </div>
                            </div>
                        `;
                    } else {
                        produtos[i] = `
                            <div class="prodFilter">
                                <div class='btnFavoriteFilter btnFavorito` + json['produtos'][i].produto_id + `'>
                                    
                                </div>
                                <img src='` + BASE_URL2 + `admin_area/imagens_produtos/` + json['produtos'][i].produto_img + `'/>
                                <div class='divisorFilter'></div>
                                <h5 class='titleProdFilter'>` + json['produtos'][i].produto_nome + ` - `  + json['produtos'][i].produto_tamanho + `</h5>
                                <p class='priceProdFilter'>R$ ` + json['produtos'][i].produto_preco + `</p>
                                <div>
                                    <form class="formBuy">
                                        <input type="hidden" value="` + json['produtos'][i].produto_id + `" name="id_prod"/>
                                        <input type="number" min="0" max="20" value="` + json['produtos'][i].carrinho + `" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                        <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                    </form>
                                </div>
                            </div>
                        `;
                    }
                }
                $('.divShowProdFilter').html("");
                for(var i = 0; produtos.length > i; i++) {
                    $('.divShowProdFilter').append(produtos[i]);
                }
                attCarrinho();
                btnFavorito();
            }
        }
    });
    
    var marca = document.getElementsByClassName('prod_marca');
    for(i = 0; marca.length > i; i++) {
        marca[i].checked = false;
    }
    $(".prod_marca option[value='*000*']").removeAttr("disabled");
    $(".prod_marca option[value='*000*']").removeAttr("selected");
    $(".prod_marca option[value='*000*']").attr("selected", true);
    $(".prod_marca option[value='*000*']").attr("disabled", true);
}

function limpaPreco() {
    $('.filterPreco').html('&nbsp<i class="fas fa-dollar-sign"></i> &nbspPREÇO');
    var url = BASE_URL + 'functions/filtroPreco';
    $.ajax({
        dataType: 'json',
        url: url,
        success: function(json) {
            if(json['empty']) {
                $('.divShowProdFilter').html("<h3>Não houve resposta</h3>");
            } else {
                var produtos = [];
                for(var i = 0; json['produtos'].length > i; i++) {
                    if(json['produtos'][i].produto_desconto_porcent) {
                        produtos[i] = `
                            <div class="prodFilter">
                                <div class='btnFavoriteFilter btnFavorito` + json['produtos'][i].produto_id + `'>
                                    
                                </div>
                                <img src='` + BASE_URL2 + `admin_area/imagens_produtos/` + json['produtos'][i].produto_img + `'/>
                                <p class="divProdPromo">-` + json['produtos'][i].produto_desconto_porcent + `%</p>
                                <div class='divisorFilter'></div>
                                <h5 class='titleProdFilter'>` + json['produtos'][i].produto_nome + ` - `  + json['produtos'][i].produto_tamanho + `</h5>
                                <p class='priceProdFilter'><span class="divProdPrice1">R$` + json['produtos'][i].produto_preco + `</span> R$` + json['produtos'][i].produto_desconto + `</p>
                                <div>
                                    <form class="formBuy">
                                        <input type="hidden" value="` + json['produtos'][i].produto_id + `" name="id_prod"/>
                                        <input type="number" min="0" max="20" value="` + json['produtos'][i].carrinho + `" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                        <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                    </form>
                                </div>
                            </div>
                        `;
                    } else {
                        produtos[i] = `
                            <div class="prodFilter">
                                <div class='btnFavoriteFilter btnFavorito` + json['produtos'][i].produto_id + `'>
                                    
                                </div>
                                <img src='` + BASE_URL2 + `admin_area/imagens_produtos/` + json['produtos'][i].produto_img + `'/>
                                <div class='divisorFilter'></div>
                                <h5 class='titleProdFilter'>` + json['produtos'][i].produto_nome + ` - `  + json['produtos'][i].produto_tamanho + `</h5>
                                <p class='priceProdFilter'>R$ ` + json['produtos'][i].produto_preco + `</p>
                                <div>
                                    <form class="formBuy">
                                        <input type="hidden" value="` + json['produtos'][i].produto_id + `" name="id_prod"/>
                                        <input type="number" min="0" max="20" value="` + json['produtos'][i].carrinho + `" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                        <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                    </form>
                                </div>
                            </div>
                        `;
                    }
                }
                $('.divShowProdFilter').html("");
                for(var i = 0; produtos.length > i; i++) {
                    $('.divShowProdFilter').append(produtos[i]);
                }
                attCarrinho();
                btnFavorito();
            }
        }
    });
    
    var preco = document.getElementsByClassName('prod_preco');
    for(i = 0; preco.length > i; i++) {
        preco[i].checked = false;
    }
    $(".prod_preco option[value='*000*']").removeAttr("disabled");
    $(".prod_preco option[value='*000*']").removeAttr("selected");
    $(".prod_preco option[value='*000*']").attr("selected", true);
    $(".prod_preco option[value='*000*']").attr("disabled", true);
}


function limpaFav() {
    $('.filterFav').html('<i class="fas fa-heart"></i> FAVORITOS');
    var dado = "prod_fav=1";
    var url = BASE_URL + 'functions/filtroFavorito';
    $.ajax({
        type: 'post',
        dataType: 'json',
        data: dado,
        url: url,
        success: function(json) {
            if(json['logado']) {
                if(json['empty']) {
                    $('.divShowProdFilter').html("<h3>Não houve resposta</h3>");
                } else {
                    var produtos = [];
                    for(var i = 0; json['produtos'].length > i; i++) {
                        if(json['produtos'][i].produto_desconto_porcent) {
                            produtos[i] = `
                                <div class="prodFilter">
                                    <div class='btnFavoriteFilter btnFavorito` + json['produtos'][i].produto_id + `'>
                                        
                                    </div>
                                    <img src='` + BASE_URL2 + `admin_area/imagens_produtos/` + json['produtos'][i].produto_img + `'/>
                                    <p class="divProdPromo">-` + json['produtos'][i].produto_desconto_porcent + `%</p>
                                    <div class='divisorFilter'></div>
                                    <h5 class='titleProdFilter'>` + json['produtos'][i].produto_nome + ` - `  + json['produtos'][i].produto_tamanho + `</h5>
                                    <p class='priceProdFilter'><span class="divProdPrice1">R$` + json['produtos'][i].produto_preco + `</span> R$` + json['produtos'][i].produto_desconto + `</p>
                                    <div>
                                        <form class="formBuy">
                                            <input type="hidden" value="` + json['produtos'][i].produto_id + `" name="id_prod"/>
                                            <input type="number" min="0" max="20" value="` + json['produtos'][i].carrinho + `" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                            <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                        </form>
                                    </div>
                                </div>
                            `;
                        } else {
                            produtos[i] = `
                                <div class="prodFilter">
                                    <div class='btnFavoriteFilter btnFavorito` + json['produtos'][i].produto_id + `'>
                                        
                                    </div>
                                    <img src='` + BASE_URL2 + `admin_area/imagens_produtos/` + json['produtos'][i].produto_img + `'/>
                                    <div class='divisorFilter'></div>
                                    <h5 class='titleProdFilter'>` + json['produtos'][i].produto_nome + ` - `  + json['produtos'][i].produto_tamanho + `</h5>
                                    <p class='priceProdFilter'>R$ ` + json['produtos'][i].produto_preco + `</p>
                                    <div>
                                        <form class="formBuy">
                                            <input type="hidden" value="` + json['produtos'][i].produto_id + `" name="id_prod"/>
                                            <input type="number" min="0" max="20" value="` + json['produtos'][i].carrinho + `" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                            <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                        </form>
                                    </div>
                                </div>
                            `;
                        }
                    }
                    $('.divShowProdFilter').html("");
                    for(var i = 0; produtos.length > i; i++) {
                        $('.divShowProdFilter').append(produtos[i]);
                    }
                    attCarrinho();
                    btnFavorito();
                }
            } else {
                Toast.fire({
                    type: 'error',
                    title: 'Você precisa estar logado'
                });
                $("#usu_email_login").val("");
                $("#usu_senha_login").val("");
                $(".help-block-login").html("");
                var favMobile = document.getElementById('fav_radio');
                var fav = document.getElementById('fav_rad');
                favMobile.checked = false;
                fav.checked = false;
                modal.style.display = "block";
            }
        }
    });
    
    var fav = document.getElementsByClassName('prod_fav');
    for(i = 0; fav.length > i; i++) {
        fav[i].checked = false;
    }
}