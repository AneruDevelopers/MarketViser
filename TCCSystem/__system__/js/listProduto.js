$(function() {
    var url = "http://localhost/BackupGit/economize/TCCSystem/__system__/admin_area/imagens_produtos/";
    $.ajax({
        dataType: 'json',
        url: 'functions/listProduto',
        success: function(response) {
            var produtos = [];
            for (var i = 0; response.length > i; i++) {
                produtos[i] = `
                    <div class="divProdCarousel">
                        <i class="far fa-heart"></i>
                        <a class="linksProdCarousel" href="#">
<<<<<<< HEAD
                            <img class="divProdImg" src="__system__/admin_area/imagens_produtos/feijao-preto-urbano-alimentos.png">
=======
                            <img class="divProdImg" src="` + url + response[i].produto_img + `">
>>>>>>> ad36057a14430fe42c9dcb53d3c87f80fd00a2b9
                            <h4 class="divProdTitle">` + response[i].produto_nome + `</h4>
                            <p class="divProdPrice">R$` + response[i].produto_preco + `</p>
                            <button class="btnBuy" href="#">COMPRAR</button>
                        </a>
                    </div>
                `;
            }
            $('.l-prods').html(`<div class="loop owl-carousel">` + produtos + `</div>`);
        }
    });
});