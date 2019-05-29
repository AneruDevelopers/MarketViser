$(document).ready(function() {

	$('#btn-login').click(function() {
		var campo_vazio = false;
		if(($('#usu_email_login').val() == '') && ($('#usu_senha_login').val() == '')) {
			$('#usu_email_login').css({'border-color':'#A94442'});
			$('#usu_senha_login').css({'border-color':'#A94442'});
			$('#usu_email_login').focus();
			var campo_vazio = true;
		} else {
			if($('#usu_email_login').val() == '') {
			    $('#usu_email_login').css({'border-color':'#A94442'});
			    $('#usu_senha_login').css({'border-color':'#ccc'});
			    $('#usu_email_login').focus();
			    var campo_vazio = true;
			    // alert('Campo de usuário está vazio!');
			}
			if($('#usu_senha_login').val() == '') {
				$('#usu_senha_login').css({'border-color':'#A94442'});
				$('#usu_email_login').css({'border-color':'#ccc'});
				$('#usu_senha_login').focus();
				var campo_vazio = true;
				// alert('Campo de senha está vazio!');
			}
			else {
				$('#usu_senha_login').css({'border-color':'#ccc'});
				$('#usu_email_login').css({'border-color':'#ccc'});
			}
		}
		if(campo_vazio) return false;
	});


	$("#form-login").submit(function() {
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: BASE_URL + 'functions/login',
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
			        }).then((result) => {
			            if(result.value) {
							verificaLogin();
							btnFavorito();

							var local = location;
							if(local == BASE_URL + 'compra/etapas_compra') {
								listCarrinho();
							}
			            } else {
							verificaLogin();
							btnFavorito();
							
							var local = location;
							if(local == BASE_URL + 'compra/etapas_compra') {
								listCarrinho();
							}
						}
			        });
				} else {
					$(".help-block-login").html(response["error"]);
				}
			}
		});
		return false;
	});
});