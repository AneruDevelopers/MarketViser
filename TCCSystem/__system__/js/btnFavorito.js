function btnFavorito() {
    var base = "http://localhost/BackupGit/economize/TCCSystem/__system__/";
    var base2 = "http://localhost/BackupGit/economize/TCCSystem/";
    $.ajax({
        dataType: 'json',
        url: base2 + 'functions/verificaFavorito',
        success: function(json) {
            if(json['status']) {
                for (var i = 0; json['fav_id'].length > i; i++) {
                    if(json['fav_id'][i]) {
                        $('.btnFavorito' + json['prod_id'][i]).html(`<i class="fas fa-heart remFavorito" id="` + json['prod_id'][i] + `"></i>`);
                    } else {
                        $('.btnFavorito' + json['prod_id'][i]).html(`<i class="far fa-heart addFavorito" id="` + json['prod_id'][i] + `"></i>`);
                    }
                }
            } else {
                console.log('erro');
            }
            $('body').append('<script src="' + base + 'js/favoritar.js"></script>');
        }
    });
};

btnFavorito();