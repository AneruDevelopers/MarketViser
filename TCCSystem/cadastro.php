<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>e.conomize - Cadastre-se</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style\css\main.css">
    <link href="style\libraries\fontawesome-free-5.8.0-web\css\all.css" rel="stylesheet">
    <link rel="stylesheet" href="style\libraries\OwlCarousel2-2.3.4\dist\assets\owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="style\libraries\OwlCarousel2-2.3.4\dist\assets\owl.theme.default.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="style\fonts\Icons\icons_pack\font\flaticon.css">
</head>
<body>
    <div>
		<form id="form-cadastro">
        	<h2>Cadastre-se</h2>
        	<div>
        		<input type="text" placeholder="Nome Completo" id="usu_nome" maxlength="150" name="usu_nome"/>
        		<div class="help-block"></div><br/>
        	</div>
    	    <div>
    	    	<input type="text" placeholder="E-mail" id="usu_email" name="usu_email"/>
    	    	<div class="help-block"></div><br/>
    	    </div>
    	    <div>
    	    	<input type="password" placeholder="Senha" id="usu_senha" name="usu_senha"/>
    	    	<div class="help-block"></div><br/>
    	    </div>
    	    <div>
    	    	<input type="password" placeholder="Confirme a senha" id="usu_senha2" name="usu_senha2"/>
    	    	<div class="help-block"></div><br/>
    	    </div>
    	    <div>
    	    	<input type="text" placeholder="CEP" class="form-control cep" id="usu_cep" name="usu_cep"/>
    	    	<div class="help-block"></div><br/>
    	    </div>
    	    <div>
    	    	<input type="text" placeholder="Logradouro" readonly id="usu_end" name="usu_end"/>
    	    	<div class="help-block"></div><br/>
    	    </div>
    	    <div>
    	    	<input type="text" placeholder="Número" id="usu_num" name="usu_num"/>
    	    	<div class="help-block"></div><br/>
    	    </div>
    	    <div>
    	    	<input type="text" placeholder="Complemento" id="usu_complemento" name="usu_complemento"/>
    	    	<div class="help-block"></div><br/>
    	    </div>
    	    <div>
    	    	<input type="text" placeholder="Bairro" readonly id="usu_bairro" name="usu_bairro"/>
    	    	<div class="help-block"></div><br/>
    	    </div>
    	    <div>
    	    	<input type="text" placeholder="Cidade" readonly id="usu_cidade" name="usu_cidade"/>
    	    	<div class="help-block"></div><br/>
    	    </div>
    	    <div>
    	    	<input type="text" placeholder="Estado" readonly id="usu_uf" name="usu_uf"/>
    	    	<div class="help-block"></div><br/>
    	    </div>
    	    <div>
	    	    <input type="submit" id="btn-cad" value="Cadastrar"/>
	    	    <div class="help-block"></div>
    	    </div>
    	</form>
    </div>

    <script src="js\JQuery\jquery-3.3.1.min.js"></script>
    <script src="style\libraries\bootstrap\js\bootstrap.js"></script>
    <script src="style\libraries\sweetalert2.all.min.js"></script>
    <script src="js\JQuery\jquery-mask.js"></script>
    <script src="js\mask.js" async></script>
    <script src="js\main.js" async></script>
    <script src="js\cadastro_usuario.js" async></script>
</body>
</html>