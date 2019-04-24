$(function() {
    $.ajax({
        url: 'functions/getProdutos.php',
        success: function(data) {
            $('.l-prods').html(data);
        }
    });
});