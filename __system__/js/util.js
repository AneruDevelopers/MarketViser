const BASE_URL = "http://localhost/economize/";
const BASE_URL2 = "http://localhost/economize/__system__/";
const BASE_URL3 = "http://localhost/economize/__system__/admin_area/imagens_produtos/";
const BASE_URL4 = "http://localhost/economize/admin_area/";

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1000
});

function loadingRes(message="") {
    return "<p class='p-loading'><i class='fa fa-circle-notch fa-spin'></i> &nbsp;"+message+"</p>";
}

function clearErrors() {
    $(".has-error").removeClass("has-error");
    $(".help-block").html("");
    $(".help-block-login").html("");
}

function showErrors(error_list) {
    clearErrors();
    $.each(error_list, function(id, message) {
        $(id).parent().siblings(".help-block").html(message);
    })
}

function showErrorsAdmin(error_list) {
    clearErrors();
    $.each(error_list, function(id, message) {
        $(id).siblings(".help-block").html(message);
    })
}

function messages() {
    $.ajax({
        dataType: 'json',
        url: 'functions/messages.php',
        success: function(json) {
            if(json["message"]) {
                Swal.fire({title: json["title"],
                    text: json["text"],
                    type: "warning",
                    showCancelButton: false,
                    confirmButtonColor: "#d9534f",
                    confirmButtonText: "Ok",
                });
            }
        }
    });
}

// function atualizaContador(YY, MM, DD, HH, MI, SS, campo) {
//     var hoje = new Date();
//     var futuro = new Date(YY, MM-1, DD, HH, MI, SS);
//     var ss = parseInt((futuro - hoje) / 1000);
//     var mm = parseInt(ss / 60);
//     var hh = parseInt(mm / 60);
//     var dd = parseInt(hh / 24);

//     ss = ss - (mm * 60);
//     mm = mm - (hh * 60);
//     hh = hh - (dd * 24);

//     var faltam = '';
//     faltam += (dd && dd > 1) ? dd + ' dias, ' : (dd == 1 ? '1 dia, ' : '');
//     faltam += (toString(hh).length) ? hh + ' hr, ' : '';
//     faltam += (toString(mm).length) ? mm + ' min e ' : '';
//     faltam += ss + ' seg';
 
//     if (dd+hh+mm+ss > 0) {
//         $("." + campo).html(faltam);
//         setTimeout(atualizaContador, 1000);
//     } else {
//         $("." + campo).html('Promoção expirada!');
//         setTimeout(atualizaContador, 1000);
//     }
// }