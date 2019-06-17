function removeAcento (text) {
    text = text.toLowerCase();
    for(var i = 0; text.length > i; i++) {
        if(text[i] == " ") {
            text= text.replace(" ", "-");
        }
    }
    text = text.replace(new RegExp('[ÁÀÂÃ]','gi'), 'a');
    text = text.replace(new RegExp('[ÉÈÊ]','gi'), 'e');
    text = text.replace(new RegExp('[ÍÌÎ]','gi'), 'i');
    text = text.replace(new RegExp('[ÓÒÔÕ]','gi'), 'o');
    text = text.replace(new RegExp('[ÚÙÛ]','gi'), 'u');
    text = text.replace(new RegExp('[Ç]','gi'), 'c');
    return text;
}

$(document).ready(function() {
    $(".categ").change(function() {
        var href = removeAcento($(this).val());
        var local = location;
        local = local + "";

        if(local.indexOf('#') != -1) {
            var local = local.substring(0, (local.length - 1));
        }

        window.location = local + '/' + href;
    });


    $('.produto_tamanho').change(function(e) {
        e.preventDefault();
        var dado = "produto_tamanho=" + $(this).val();
        var url = BASE_URL + 'functions/filtroTamanho';
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: dado,
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
                        if(json['produtos'][i].produto_desconto_porcent || json['produtos'][i].promo_desconto) {
                            produtos[i] = `
                                <div class="prodFilter">
                                    <div class='btnFavoriteFilter btnFavorito` + json['produtos'][i].produto_id + `'>
                                        
                                    </div>
                                    <a class="linksProdCarousel" id-produto="` + json['produtos'][i].produto_id + `">
                                        <img src='` + BASE_URL2 + `admin_area/imagens_produtos/` + json['produtos'][i].produto_img + `'/>
                                        <p class="divProdPromo">-` + ((json['produtos'][i].promo_desconto != null) ? json['produtos'][i].promo_desconto : json['produtos'][i].produto_desconto_porcent) + `%</p>
                                        <div class='divisorFilter'></div>
                                        <h5 class='titleProdFilter'>` + json['produtos'][i].produto_nome + ` - `  + json['produtos'][i].produto_tamanho + `</h5>
                                        <p class='priceProdFilter'><span class="divProdPrice1">R$` + json['produtos'][i].produto_preco + `</span> R$` + json['produtos'][i].produto_desconto + `</p>
                                    </a>
                                    <div>
                            `;
                            if(!json['produtos'][i].empty) {
                                produtos[i] += `
                                            <form class="formBuy">
                                                <input type="hidden" value="` + json['produtos'][i].produto_id + `" name="id_prod"/>
                                                <input type="number" min="0" max="20" value="` + json['produtos'][i].carrinho + `" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                                <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                            </form>
                                        </div>
                                    </div>
                                `;
                            } else {
                                produtos[i] += `
                                            <span class="esgotQtd">ESGOTADO</span>
                                            <form class="formBuy">
                                                <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                            </form>
                                        </div>
                                    </div>
                                `;
                            }
                        } else {
                            produtos[i] = `
                                <div class="prodFilter">
                                    <div class='btnFavoriteFilter btnFavorito` + json['produtos'][i].produto_id + `'>
                                        
                                    </div>
                                    <a class="linksProdCarousel" id-produto="` + json['produtos'][i].produto_id + `">
                                        <img src='` + BASE_URL2 + `admin_area/imagens_produtos/` + json['produtos'][i].produto_img + `'/>
                                        <div class='divisorFilter'></div>
                                        <h5 class='titleProdFilter'>` + json['produtos'][i].produto_nome + ` - `  + json['produtos'][i].produto_tamanho + `</h5>
                                        <p class='priceProdFilter'>R$ ` + json['produtos'][i].produto_preco + `</p>
                                    </a>
                                    <div>
                            `;
                            if(!json['produtos'][i].empty) {
                                produtos[i] += `
                                            <form class="formBuy">
                                                <input type="hidden" value="` + json['produtos'][i].produto_id + `" name="id_prod"/>
                                                <input type="number" min="0" max="20" value="` + json['produtos'][i].carrinho + `" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                                <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                            </form>
                                        </div>
                                    </div>
                                `;
                            } else {
                                produtos[i] += `
                                            <span class="esgotQtd">ESGOTADO</span>
                                            <form class="formBuy">
                                                <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                            </form>
                                        </div>
                                    </div>
                                `;
                            }
                        }
                    }
                    $('.divShowProdFilter').html("");
                    for(var i = 0; produtos.length > i; i++) {
                        $('.divShowProdFilter').append(produtos[i]);
                    }
                    attCarrinho();
                    btnFavorito();
                    abrirModal();
                }
                if(json['first']) {
                    $('.FilterVol').append(' &nbsp;&nbsp;&nbsp;<span class="limpaVol limpaBusca"><i class="fas fa-minus-square"></i></span>');
                    $('.limpaVol').click(function(e) {
                        e.preventDefault();
                        limpaVol();
                    });
                }
            }
        });
    });

    $('.prod_marca').change(function(e) {
        e.preventDefault();
        var dado = "produto_marca=" + $(this).val();
        var url = BASE_URL + 'functions/filtroMarca';
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: dado,
            url: url,
            success: function(json) {
                if(json['empty']) {
                    $('.divShowProdFilter').html("<h3>Não houve resposta</h3>");
                } else {
                    var produtos = [];
                    for(var i = 0; json['produtos'].length > i; i++) {
                        if(json['produtos'][i].produto_desconto_porcent || json['produtos'][i].promo_desconto) {
                            produtos[i] = `
                                <div class="prodFilter">
                                    <div class='btnFavoriteFilter btnFavorito` + json['produtos'][i].produto_id + `'>
                                        
                                    </div>
                                    <a class="linksProdCarousel" id-produto="` + json['produtos'][i].produto_id + `">
                                        <img src='` + BASE_URL2 + `admin_area/imagens_produtos/` + json['produtos'][i].produto_img + `'/>
                                        <p class="divProdPromo">-` + ((json['produtos'][i].promo_desconto != null) ? json['produtos'][i].promo_desconto : json['produtos'][i].produto_desconto_porcent) + `%</p>
                                        <div class='divisorFilter'></div>
                                        <h5 class='titleProdFilter'>` + json['produtos'][i].produto_nome + ` - `  + json['produtos'][i].produto_tamanho + `</h5>
                                        <p class='priceProdFilter'><span class="divProdPrice1">R$` + json['produtos'][i].produto_preco + `</span> R$` + json['produtos'][i].produto_desconto + `</p>
                                    </a>
                                    <div>
                            `;
                            if(!json['produtos'][i].empty) {
                                produtos[i] += `
                                            <form class="formBuy">
                                                <input type="hidden" value="` + json['produtos'][i].produto_id + `" name="id_prod"/>
                                                <input type="number" min="0" max="20" value="` + json['produtos'][i].carrinho + `" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                                <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                            </form>
                                        </div>
                                    </div>
                                `;
                            } else {
                                produtos[i] += `
                                            <span class="esgotQtd">ESGOTADO</span>
                                            <form class="formBuy">
                                                <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                            </form>
                                        </div>
                                    </div>
                                `;
                            }
                        } else {
                            produtos[i] = `
                                <div class="prodFilter">
                                    <div class='btnFavoriteFilter btnFavorito` + json['produtos'][i].produto_id + `'>
                                        
                                    </div>
                                    <a class="linksProdCarousel" id-produto="` + json['produtos'][i].produto_id + `">
                                        <img src='` + BASE_URL2 + `admin_area/imagens_produtos/` + json['produtos'][i].produto_img + `'/>
                                        <div class='divisorFilter'></div>
                                        <h5 class='titleProdFilter'>` + json['produtos'][i].produto_nome + ` - `  + json['produtos'][i].produto_tamanho + `</h5>
                                        <p class='priceProdFilter'>R$ ` + json['produtos'][i].produto_preco + `</p>
                                    </a>
                                    <div>
                            `;
                            if(!json['produtos'][i].empty) {
                                produtos[i] += `
                                            <form class="formBuy">
                                                <input type="hidden" value="` + json['produtos'][i].produto_id + `" name="id_prod"/>
                                                <input type="number" min="0" max="20" value="` + json['produtos'][i].carrinho + `" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                                <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                            </form>
                                        </div>
                                    </div>
                                `;
                            } else {
                                produtos[i] += `
                                            <span class="esgotQtd">ESGOTADO</span>
                                            <form class="formBuy">
                                                <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                            </form>
                                        </div>
                                    </div>
                                `;
                            }
                        }
                    }
                    $('.divShowProdFilter').html("");
                    for(var i = 0; produtos.length > i; i++) {
                        $('.divShowProdFilter').append(produtos[i]);
                    }
                    attCarrinho();
                    btnFavorito();
                    abrirModal();
                }
                if(json['first']) {
                    $('.FilterMarca').append(' &nbsp;&nbsp;&nbsp;<span class="limpaMarca limpaBusca"><i class="fas fa-minus-square"></i></span>');
                    $('.limpaMarca').click(function(e) {
                        e.preventDefault();
                        limpaMarca();
                    });
                }
            }
        });
    });

    $('.prod_preco').change(function(e) {
        e.preventDefault();
        var dado = "produto_preco=" + $(this).val();
        var url = BASE_URL + 'functions/filtroPreco';
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: dado,
            url: url,
            success: function(json) {
                if(json['empty']) {
                    $('.divShowProdFilter').html("<h3>Não houve resposta</h3>");
                } else {
                    var produtos = [];
                    for(var i = 0; json['produtos'].length > i; i++) {
                        if(json['produtos'][i].produto_desconto_porcent || json['produtos'][i].promo_desconto) {
                            produtos[i] = `
                                <div class="prodFilter">
                                    <div class='btnFavoriteFilter btnFavorito` + json['produtos'][i].produto_id + `'>
                                        
                                    </div>
                                    <a class="linksProdCarousel" id-produto="` + json['produtos'][i].produto_id + `">
                                        <img src='` + BASE_URL2 + `admin_area/imagens_produtos/` + json['produtos'][i].produto_img + `'/>
                                        <p class="divProdPromo">-` + ((json['produtos'][i].promo_desconto != null) ? json['produtos'][i].promo_desconto : json['produtos'][i].produto_desconto_porcent) + `%</p>
                                        <div class='divisorFilter'></div>
                                        <h5 class='titleProdFilter'>` + json['produtos'][i].produto_nome + ` - `  + json['produtos'][i].produto_tamanho + `</h5>
                                        <p class='priceProdFilter'><span class="divProdPrice1">R$` + json['produtos'][i].produto_preco + `</span> R$` + json['produtos'][i].produto_desconto + `</p>
                                    </a>
                                    <div>
                            `;
                            if(!json['produtos'][i].empty) {
                                produtos[i] += `
                                            <form class="formBuy">
                                                <input type="hidden" value="` + json['produtos'][i].produto_id + `" name="id_prod"/>
                                                <input type="number" min="0" max="20" value="` + json['produtos'][i].carrinho + `" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                                <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                            </form>
                                        </div>
                                    </div>
                                `;
                            } else {
                                produtos[i] += `
                                            <span class="esgotQtd">ESGOTADO</span>
                                            <form class="formBuy">
                                                <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                            </form>
                                        </div>
                                    </div>
                                `;
                            }
                        } else {
                            produtos[i] = `
                                <div class="prodFilter">
                                    <div class='btnFavoriteFilter btnFavorito` + json['produtos'][i].produto_id + `'>
                                        
                                    </div>
                                    <a class="linksProdCarousel" id-produto="` + json['produtos'][i].produto_id + `">
                                        <img src='` + BASE_URL2 + `admin_area/imagens_produtos/` + json['produtos'][i].produto_img + `'/>
                                        <div class='divisorFilter'></div>
                                        <h5 class='titleProdFilter'>` + json['produtos'][i].produto_nome + ` - `  + json['produtos'][i].produto_tamanho + `</h5>
                                        <p class='priceProdFilter'>R$ ` + json['produtos'][i].produto_preco + `</p>
                                    </a>
                                    <div>
                            `;
                            if(!json['produtos'][i].empty) {
                                produtos[i] += `
                                            <form class="formBuy">
                                                <input type="hidden" value="` + json['produtos'][i].produto_id + `" name="id_prod"/>
                                                <input type="number" min="0" max="20" value="` + json['produtos'][i].carrinho + `" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                                <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                            </form>
                                        </div>
                                    </div>
                                `;
                            } else {
                                produtos[i] += `
                                            <span class="esgotQtd">ESGOTADO</span>
                                            <form class="formBuy">
                                                <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                            </form>
                                        </div>
                                    </div>
                                `;
                            }
                        }
                    }
                    $('.divShowProdFilter').html("");
                    for(var i = 0; produtos.length > i; i++) {
                        $('.divShowProdFilter').append(produtos[i]);
                    }
                    attCarrinho();
                    btnFavorito();
                    abrirModal();
                }
                if(json['first']) {
                    $('.filterPreco').append(' &nbsp;&nbsp;&nbsp;<span class="limpaPreco limpaBusca"><i class="fas fa-minus-square"></i></span>');
                    $('.limpaPreco').click(function(e) {
                        e.preventDefault();
                        limpaPreco();
                    });
                }
            }
        });
    });

    $('.prod_fav').change(function(e) {
        e.preventDefault();
        var dado = "produto_fav=" + $(this).val();
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
                            if(json['produtos'][i].produto_desconto_porcent || json['produtos'][i].promo_desconto) {
                                produtos[i] = `
                                    <div class="prodFilter">
                                        <div class='btnFavoriteFilter btnFavorito` + json['produtos'][i].produto_id + `'>
                                            
                                        </div>
                                        <a class="linksProdCarousel" id-produto="` + json['produtos'][i].produto_id + `">
                                            <img src='` + BASE_URL2 + `admin_area/imagens_produtos/` + json['produtos'][i].produto_img + `'/>
                                            <p class="divProdPromo">-` + ((json['produtos'][i].promo_desconto != null) ? json['produtos'][i].promo_desconto : json['produtos'][i].produto_desconto_porcent) + `%</p>
                                            <div class='divisorFilter'></div>
                                            <h5 class='titleProdFilter'>` + json['produtos'][i].produto_nome + ` - `  + json['produtos'][i].produto_tamanho + `</h5>
                                            <p class='priceProdFilter'><span class="divProdPrice1">R$` + json['produtos'][i].produto_preco + `</span> R$` + json['produtos'][i].produto_desconto + `</p>
                                        </a>
                                        <div>
                                `;
                                if(!json['produtos'][i].empty) {
                                    produtos[i] += `
                                                <form class="formBuy">
                                                    <input type="hidden" value="` + json['produtos'][i].produto_id + `" name="id_prod"/>
                                                    <input type="number" min="0" max="20" value="` + json['produtos'][i].carrinho + `" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                                    <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                                </form>
                                            </div>
                                        </div>
                                    `;
                                } else {
                                    produtos[i] += `
                                                <span class="esgotQtd">ESGOTADO</span>
                                                <form class="formBuy">
                                                    <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                                </form>
                                            </div>
                                        </div>
                                    `;
                                }
                            } else {
                                produtos[i] = `
                                    <div class="prodFilter">
                                        <div class='btnFavoriteFilter btnFavorito` + json['produtos'][i].produto_id + `'>
                                            
                                        </div>
                                        <a class="linksProdCarousel" id-produto="` + json['produtos'][i].produto_id + `">
                                            <img src='` + BASE_URL2 + `admin_area/imagens_produtos/` + json['produtos'][i].produto_img + `'/>
                                            <div class='divisorFilter'></div>
                                            <h5 class='titleProdFilter'>` + json['produtos'][i].produto_nome + ` - `  + json['produtos'][i].produto_tamanho + `</h5>
                                            <p class='priceProdFilter'>R$ ` + json['produtos'][i].produto_preco + `</p>
                                        </a>
                                        <div>
                                `;
                                if(!json['produtos'][i].empty) {
                                    produtos[i] += `
                                                <form class="formBuy">
                                                    <input type="hidden" value="` + json['produtos'][i].produto_id + `" name="id_prod"/>
                                                    <input type="number" min="0" max="20" value="` + json['produtos'][i].carrinho + `" class="inputBuy inputQtdFiltro" name="qtd_prod"/>
                                                    <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                                </form>
                                            </div>
                                        </div>
                                    `;
                                } else {
                                    produtos[i] += `
                                                <span class="esgotQtd">ESGOTADO</span>
                                                <form class="formBuy">
                                                    <button class="btnBuyFilter btnBuy" type="submit">ADICIONAR</button>
                                                </form>
                                            </div>
                                        </div>
                                    `;
                                }
                            }
                        }
                        $('.divShowProdFilter').html("");
                        for(var i = 0; produtos.length > i; i++) {
                            $('.divShowProdFilter').append(produtos[i]);
                        }
                        attCarrinho();
                        btnFavorito();
                        abrirModal();
                    }
                    $('.filterFav').append(' &nbsp;&nbsp;&nbsp;<span class="limpaFav limpaBusca"><i class="fas fa-minus-square"></i></span>');
                    $('.limpaFav').click(function(e) {
                        e.preventDefault();
                        limpaFav();
                    });
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
    });

    $('body').append('<script src="' + BASE_URL2 + 'js/limpaFiltros.js"></script>');
});