$(function() {
    $.ajax({
        url: '__system__/functions/listProduto.php',
        success: function(data) {
            $('.l-prods').html(data);
        }
    });
});