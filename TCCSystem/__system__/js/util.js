const BASE_URL = "http://192.168.10.193/BackupGit/economize/TCCSystem/";
const BASE_URL2 = "http://192.168.10.193/BackupGit/economize/TCCSystem/__system__/";
const BASE_URL3 = "http://192.168.10.193/BackupGit/economize/TCCSystem/__system__/admin_area/imagens_produtos/";

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