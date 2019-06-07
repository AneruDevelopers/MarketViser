function insertMarca() {
    $('.formInserirMarca').submit(function(e) {
        e.preventDefault();

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/marca',
            type: 'POST',
            data: $(this).serialize(),
            beforeSend() {
                clearErrors();
                $("#btnInsertMarca").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                clearErrors();
                if(json['status']) {
                    Swal.fire({
                        title: "Marca(s) cadastrada(s) com sucesso!",
                        text: "Deseja continuar cadastrando marca(s)?",
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
                    $("#btnInsertMarca").siblings(".help-block").html(json['error']);
                }
            }
        });
        return false;
    });
}