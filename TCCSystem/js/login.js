$(document).ready(function() {

	$('#btn-login').click(function() {
		var campo_vazio = false;
		if(($('#usu_email').val() == '') && ($('#usu_senha').val() == '')) {
			$('#usu_email').css({'border-color':'#A94442'});
			$('#usu_senha').css({'border-color':'#A94442'});
			$('#usu_email').focus();
			var campo_vazio = true;
		} else {
			if($('#usu_email').val() == '') {
			    $('#usu_email').css({'border-color':'#A94442'});
			    $('#usu_senha').css({'border-color':'#ccc'});
			    $('#usu_email').focus();
			    var campo_vazio = true;
			    // alert('Campo de usuário está vazio!');
			}
			if($('#usu_senha').val() == '') {
				$('#usu_senha').css({'border-color':'#A94442'});
				$('#usu_email').css({'border-color':'#ccc'});
				$('#usu_senha').focus();
				var campo_vazio = true;
				// alert('Campo de senha está vazio!');
			}
			else {
				$('#usu_senha').css({'border-color':'#ccc'});
				$('#usu_email').css({'border-color':'#ccc'});
			}
		}
		if(campo_vazio) return false;
	});


	$("#form-login").submit(function() {
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: 'functions/login.php',
			data: $(this).serialize(),
			beforeSend: function() {
				$(".help-block").html(loadingRes("Verificando..."));
			},
			success: function(response) {
				if(response["status"]) {
					clearErrors();
					$(".help-block").html(loadingRes("Logando..."));
					Swal.fire({
			            title: "Bem vindo(a)!",
			            text: "Olá novamente, "+response["nome_usuario"]+"!!",
			            type: "success",
			            showCancelButton: false,
			            confirmButtonColor: "#5FBA7D",
			            confirmButtonText: "Ok"
			        }).then((result) => {
			            if(result.value) {
			            	//location.reload();
	    					$("#form-login")[0].reset();
							$(".help-block").html("");
			            }
			        });
			        //+response["nome_usuario"]+
				} else {
					$(".help-block").html(response["error"]);
				}
			}
		});
		return false;
	});
});