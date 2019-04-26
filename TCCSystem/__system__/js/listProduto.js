$(function() {
    $.ajax({
        dataType: 'json',
        url: '__system__/functions/listProduto.php',
        success: function(response) {
            var produtos = [];
            for (var i = 0; response.length > i; i++) {
                produtos[i] = `
                    <div class="celulaMenuCarousel">
                        <a class="linkBtnMenu" href="#">
                            ` + response[i].produto_nome + `<br/>
                            ` + response[i].produto_img + `<br/>
                            ` + response[i].produto_preco + `
                        </a>
                    </div>
                `;
            }
            $('.l-prods').html(`<div class="menuCarousel owl-one owl-carousel">` + produtos + `</div>`);
            $('body').append('<script src="__system__/style/libraries/OwlCarousel2-2.3.4/dist/owl.carousel.js" type="text/javascript">\
            </script><script src="__system__/js/main.js"></script>\
            <script src="__system__/js/login.js"></script>');
        }
    });
});