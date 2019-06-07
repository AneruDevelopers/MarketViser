function insertCateg() {
    $('.formInserirCateg').submit(function(e) {
        e.preventDefault();

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/categoria',
            type: 'POST',
            data: $(this).serialize(),
            beforeSend() {
                clearErrors();
                $("#btnInsertCateg").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                clearErrors();
                if(json['status']) {
                    Swal.fire({
                        title: "Categoria(s) cadastrada(s) com sucesso!",
                        text: "Deseja continuar cadastrando categoria(s)?",
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
                    $("#btnInsertCateg").siblings(".help-block").html(json['error']);
                }
            }
        });
        return false;
    });
}