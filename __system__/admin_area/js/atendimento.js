function enviaRespAtend() {
    $('.respAtendOnline').submit(function(e) {
        e.preventDefault();
        var dado = $(this).serialize();

        $.ajax({
            dataType: 'json',
            type: 'post',
            data: dado,
            url: BASE_URL4 + 'functions/atendimento',
            beforeSend: function() {
                $(".respAtendOnline .help-block").html(`
                    <p style="color:#333;text-align:center;">
                        <i class='fa fa-circle-notch fa-spin'></i> &nbsp; Verificando...
                    </p>
                `);
            },
            success: function(json) {
                clearErrors();
                if(json['status']) {
                    Toast.fire({
                        type: "success",
                        title: "Resposta enviada com sucesso"
                    });
                    mostraModalAdd();
                    // modalAdd.style.display = "none";
                } else {
                    $(".respAtendOnline .help-block").html(json['error']);
                }
            }
        });
        return false;
    });
}

enviaRespAtend();