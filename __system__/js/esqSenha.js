
    $("#form-esqsenha").submit(function() {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: BASE_URL + 'functions/esqSenha',
            data: $(this).serialize(),
            beforeSend: function () {
                Toast.fire({
                    type: 'success',
                    title: 'Email está sendo enviado'
                }); 
                 
            },
            success: function (json) {
                if(json['status'] == 1){
              
                Toast.fire({
                    type: 'success',
                    title: 'Email enviado com sucesso'
                });
                }

            }
                            });
    });

