$(document).ready(function() {
  $("#usu_cep").focusout(function(){
    if($(this).val().length == 9) {
      $.ajax({
        url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
        dataType: 'json',
        success: function(resposta){
          $("#usu_end").val(resposta.logradouro);
          $("#usu_complemento").val(resposta.complemento);
          $("#usu_bairro").val(resposta.bairro);
          $("#usu_uf").val(resposta.uf);
          $("#usu_cidade").val(resposta.localidade);
          $("#usu_num").focus();
        }
      });
    }
  });

  $("#form-cadastro").submit(function() {
    $.ajax({
      type: 'POST',
      dataType: 'json',
      data: $(this).serialize(),
      url: BASE_URL + 'functions/cadastro_usuario',
      beforeSend: function() {
        clearErrors();
        $("#btn-cad").siblings(".help-block").html(loadingRes("Verificando..."));
      },
      success: function(response) {
        if(response["status"]) {
          $("#btn-cad").siblings(".help-block").html(loadingRes("Cadastrando..."));
          clearErrors();
          Swal.fire({
            title: "Cadastrado(a) com sucesso!",
            text: "Bem vindo(a), "+response["nome_usuario"]+"!!",
            type: "success",
            showCancelButton: false,
            confirmButtonColor: "#5FBA7D",
            confirmButtonText: "Ok"
          }).then((result) => {
            if(result.value) {
              window.location.href = "../home";
            } else {
              window.location.href = "../home";
            }
          });
        } else {
          showErrors(response["error_list"]);
          $("#telefone").siblings(".help-block-tel").html(response["error_tel"]);
        }
      }
    });
    return false;
  });
});