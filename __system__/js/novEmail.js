
/*
$(document).ready(function(){
$("#env").click(function() {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: BASE_URL + 'functions/novEmail',
        data: $(this).serialize(),
        beforeSend: function() {
            $(".help-block-login").html(loadingRes("Verificando..."));
        },
        success: function(response) {
            if(response["status"]) {
                clearErrors();
                modal.style.display = "none";
                $(".help-block-login").html(loadingRes("Logando..."));
                Swal.fire({
                    title: "Bem vindo(a)!",
                    text: "Olá novamente, "+response["nome_usuario"]+"!!",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#5FBA7D",
                    confirmButtonText: "Ok"
                });
 
        }
    });
    return false;
});
});
});
*/
$(document).ready(function(){
 $('#submit1').on('click',function(){    
       ajax();
    });
});
   
  
  

                function ajax() {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: BASE_URL + 'functions/novEmail',
                        data: $(this).serialize(),
                        beforeSend: function () {
                         
                        },
                        success: function (response) {
                            if (response["env"] == 1) {
                                Swal.fire({
                                    title: "Email enviado Com sucesso",
                                    text: "Verifique seu email",
                                    type: "success",
                                    showCancelButton: true,
                                    cancelButtonColor: "#494949",
                                    cancelButtonText: "Cancelar",
                                    confirmButtonColor: "#A94442",
                                    confirmButtonText: "Voltar para Home"
                                }).then((result) => {
                                    if(result.value) {
                                        window.location.href = BASE_URL;
                                    } else {
                                        window.location.href = BASE_URL;
                                    }
                                });
                            }
                        }
                    



      
      

});
                }

