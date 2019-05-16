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

function attCarrinho() {
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

    $('.tirarProd').click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: "Deseja mesmo excuir o produto do carrinho?",
            type: "warning",
            showCancelButton: true,
            cancelButtonColor: "#494949",
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#A94442",
            confirmButtonText: "Sim, excluir"
        }).then((result) => {
            if(result.value) {
                var dado = "produto_id=" + $(this).attr("id-prod");
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
                        listCarrinho();
                    }
                });
            }
        });
    });

    $('.limparCart').click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: "Deseja mesmo limpar o carrinho?",
            text: "Uma vez limpando o carrinho, será perdido permanentemente!",
            type: "warning",
            showCancelButton: true,
            cancelButtonColor: "#494949",
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#A94442",
            confirmButtonText: "Sim, limpe"
        }).then((result) => {
            if(result.value) {
                var dado = "limpaCart=1";
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
                        listCarrinho();
                    }
                });
            }
        });
    });
}

attCarrinho();