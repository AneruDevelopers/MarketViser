$(document).ready(function() {
    $('.addFavorito').click(function(e) {
        e.preventDefault();
        var dado = 'add_prod_id=' + $(this).attr('id');

        $.ajax({
            dataType: 'json',
            type: 'post',
            data: dado,
            url: BASE_URL + 'functions/favoritar',
            success: function(json) {
                if(json['error']) {
                    Toast.fire({
                        type: 'error',
                        title: json["error"]
                    });
                    if(json['modal']) {
                        $("#usu_email_login").val("");
                        $("#usu_senha_login").val("");
                        $(".help-block-login").html("");
                        modal.style.display = "block";
                    }
                } else {
                    Toast.fire({
                        type: 'success',
                        title: 'Produto adicionado aos favoritos'
                    });
                }
            }
        });
        btnFavorito();
        meusFavoritos();
    });

    $('.remFavorito').click(function(e) {
        e.preventDefault();
        var dado = 'rem_prod_id=' + $(this).attr('id');

        $.ajax({
            dataType: 'json',
            type: 'post',
            data: dado,
            url: BASE_URL + 'functions/favoritar',
            success: function(json) {
                if(json['error']) {
                    Toast.fire({
                        type: 'error',
                        title: json["error"]
                    });
                } else {
                    Toast.fire({
                        type: 'success',
                        title: 'Produto removido dos favoritos'
                    });
                }
            }
        });
        btnFavorito();
        meusFavoritos();
    });
});