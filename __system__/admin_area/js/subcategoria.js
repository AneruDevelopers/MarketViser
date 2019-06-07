function insertSubcateg() {
    $('.formInserirSubcateg').submit(function(e) {
        e.preventDefault();

        $.ajax({
            dataType: 'json',
            url: BASE_URL4 + 'functions/subcategoria',
            type: 'POST',
            data: $(this).serialize(),
            beforeSend() {
                clearErrors();
                $("#btnInsertSubcateg").siblings(".help-block").html(loadingRes("Verificando..."));
            },
            success: function(json) {
                clearErrors();
                if(json['status']) {
                    Swal.fire({
                        title: "Subcategoria(s) cadastrada(s) com sucesso!",
                        text: "Deseja continuar cadastrando subcategoria(s)?",
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
                    $("#btnInsertSubcateg").siblings(".help-block").html(json['error']);
                }
            }
        });
        return false;
    });
}