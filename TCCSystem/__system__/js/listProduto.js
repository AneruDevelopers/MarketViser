$(function() {
    $.ajax({
        dataType: 'json',
        url: '__system__/functions/listProduto.php',
        success: function(response) {
            var produtos = [];
            for (var i = 0; response.length > i; i++) {
                produtos[i] = `
                    <div class="divProdCarousel">
                        <a class="linksProdCarousel" href="#">
                            <img class="divProdImg" src="` + response[i].produto_img + `">
                            <h4 class="divProdTitle">` + response[i].produto_nome + `</h4>
                            <p class="divProdPrice">R$` + response[i].produto_preco + `</p>
                        </a>
                    </div>
                `;
            }
            $('.l-prods').html(`<div class="loop owl-carousel">` + produtos + `</div>`);
            $('body').append('<script src="__system__/style/libraries/OwlCarousel2-2.3.4/dist/owl.carousel.js" type="text/javascript">\
            </script><script src="__system__/js/main.js"></script>\
            <script src="__system__/js/login.js"></script>');
        }
    });
});