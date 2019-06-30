$("#form-esqsenha").submit(function() {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: BASE_URL + 'functions/esqSenha',
        data: $(this).serialize(),
        beforeSend: function () {
            Swal.fire({
                title: "<h1><i class='fa fa-circle-notch fa-spin'></i></h1>",
                showCancelButton: false,
                showConfirmButton: false
            });
        },
        success: function (json) {
            if(json['status'] == 1) {
                Swal.fire({
                    title: "Nova senha gerada!",
                    text: "Enviamos sua nova senha em seu email. Fique à vontade para mudá-la quando quiser!",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#9C45EB",
                    confirmButtonText: "Ok",
                });
            } else {
                Swal.fire({
                    title: "Ocorreu um erro",
                    text: json['error'],
                    type: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#9C45EB",
                    confirmButtonText: "Ok",
                });
            }
        }
    });
    
    return false;
});