// function attCamposCarrinho() {
//     $.ajax({
//         dataType: 'json',
//         url: BASE_URL + 'functions/verificaCarrinho',
//         success: function(json) {
//             if(json['status']) {
//                 for (var i = 1; json['prod_id'].length >= i; i++) {
//                     $('.inputBuy' + i).val(json['produtos'][i].produto_id);
//                 }
//             }
//         }
//     });
// }

$(document).ready(function() {
    $('.btnBuy').click(function(e) {
        e.preventDefault();
        var dado = $(this).siblings(".formBuy").serialize();

        $.ajax({
            dataType: 'json',
            type: 'post',
            data: dado,
            url: BASE_URL + 'functions/attCarrinho',
            success: function(json) {
                Toast.fire({
                    type: json['type'],
                    title: json['answer']
                });
                // attCamposCarrinho();
            }
        });
     
    });
});