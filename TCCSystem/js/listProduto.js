$(function() {
    $.ajax({
        url: 'functions/listProduto.php',
        success: function(data) {
            $('.l-prods').html(data);
        }
    });
});