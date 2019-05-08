function btnFavorito() {
    $.ajax({
        dataType: 'json',
        url: BASE_URL + 'functions/verificaFavorito',
        success: function(json) {
            if(json['status']) {
                for (var i = 0; json['fav_id'].length > i; i++) {
                    if(json['fav_id'][i]) {
                        $('.btnFavorito' + json['prod_id'][i]).html(`<i class="fas fa-heart remFavorito" id="` + json['prod_id'][i] + `"></i>`);
                    } else {
                        $('.btnFavorito' + json['prod_id'][i]).html(`<i class="far fa-heart addFavorito" id="` + json['prod_id'][i] + `"></i>`);
                    }
                }
            }
            $('body').append('<script src="' + BASE_URL2 + 'js/favoritar.js"></script>');
        }
    });
};

btnFavorito();