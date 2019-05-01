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
                        <a class="linksProdCarousel" href="#">
                            <img class="divProdImg" src="` + url + response[i].produto_img + `">
                            <h4 class="divProdTitle">` + response[i].produto_nome + `</h4>
                            <p class="divProdPrice">R$` + response[i].produto_preco + `</p>
                        </a>
                    </div>
                `;
            }
            $('.l-prods').html(`<div class="loop owl-carousel">` + produtos + `</div>`);
        }
    });
});