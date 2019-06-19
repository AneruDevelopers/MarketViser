function insertDuvida() {
    $('.formInserirDuvida').submit(function(e) {
        e.preventDefault();

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/duvida',
            type: 'POST',
            data: $(this).serialize(),
            beforeSend() {
                clearErrors();
                $("#btnInsertDuvida").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                clearErrors();
                if(json['status']) {
                    Swal.fire({
                        title: "Dúvida(s) cadastrada(s) com sucesso!",
                        text: "Deseja continuar cadastrando dúvidas(s)?",
                        type: "success",
                        showCancelButton: true,
                        confirmButtonColor: "#333",
                        confirmButtonText: "Continuar",
                        cancelButtonColor: "#999",
                        cancelButtonText: "Sair"
                    }).then((result) => {
                        if(result.value) {
                            mostraModalAdd();
                        } else {
                            modalAdd.style.display = "none";
                        }
                    });
                } else {
                    $("#btnInsertDuvida").siblings(".help-block").html(json['error']);
                }
            }
        });
        return false;
    });
}