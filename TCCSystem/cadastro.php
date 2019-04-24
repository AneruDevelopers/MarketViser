<?php
	session_start();
	if(isset($_SESSION["inf_usu"])) {
		header("Location: index.php");
	}
?>
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
	<div class="l-wrapper_cadastro">
		<div class="l-topNavCad" id="topNav">
		<?php
			include('functions\includes\topNav.html');
		?>    
		</div>
		<div class="l-mainCad">
		<div class="circleCad">
			<p>Junte-se a família e.conomize!</p>
		</div>
			<div class="divCad">
				<form id="form-cadastro">
				<h2>Cadastre-se</h2>
				<div class="divisorTitle">
					<h5>Dados Pessoais</h5>
				</div>
					<div class="divisor"></div>
					<div class="outsideSecInputCad">
						<div class="sectionInputCad">
							<strong><label class="labelInputCad" for="usu_nome">PRIMEIRO NOME</label></strong><br>
							<input type="text" placeholder=" Primeiro Nome" id="usu_nome" maxlength="150" name="usu_nome"/>
						</div>
						<div class="help-block"></div><br/>
					</div>
					<div class="outsideSecInputCad">
						<div class="sectionInputCad">
							<strong><label class="labelInputCad" for="usu_sobrenome">SOBRENOME</label></strong><br>
							<input type="text" placeholder=" Sobrenome" id="usu_sobrenome" name="usu_sobrenome"/>
						</div>
						<div class="help-block"></div><br/>
					</div>
					<div class="outsideSecInputCad">
						<div class="sectionInputCad">
							<strong><label class="labelInputCad" for="usu_cpf">CPF</label></strong><br>
							<input type="text" placeholder=" CPF" class="cpf" id="usu_cpf" name="usu_cpf"/>
						</div>
						<div class="help-block"></div><br/>
					</div>
					<div class="outsideSecInputCad">
						<div class="sectionInputCad">
							<strong><label class="labelInputCad" for="usu_email">E-MAIL</label></strong><br>
							<input type="text" placeholder=" E-mail" id="usu_email" name="usu_email"/>
						</div>
						<div class="help-block"></div><br/>
					</div>
					<div class="outsideSecInputCad">
						<div class="sectionInputCad">
							<strong><label class="labelInputCad" for="usu_senha">SENHA</label></strong><br>
							<input type="password" placeholder=" Senha" id="usu_senha" name="usu_senha"/>
						</div>
						<div class="help-block"></div><br/>
					</div>
					<div class="outsideSecInputCad">
						<div class="sectionInputCad inputConfirm">
							<input type="password" placeholder=" Confirme a senha" id="usu_senha2" name="usu_senha2"/>
						</div>
						<div class="help-block"></div><br/>
					</div>
					<div class="divisorTitle">
						<h5>Dados Residenciais</h5>
					</div>
					<div class="divisor"></div>
					<div class="outsideSecInputCad">
						<div class="sectionInputCad">
							<strong><label class="labelInputCad" for="usu_cep">CEP</label></strong><br>
							<input type="text" placeholder=" CEP" class="form-control cep" id="usu_cep" name="usu_cep"/>
						</div>
						<div class="help-block"></div><br/>
					</div>
					<div class="outsideSecInputCad">
						<div class="sectionInputCad">
							<strong><label class="labelInputCad" for="usu_end">LOGRADOURO</label></strong><br>
							<input type="text" placeholder=" Logradouro" readonly id="usu_end" name="usu_end"/>
						</div>
						<div class="help-block"></div><br/>
					</div>
					<div class="outsideSecInputCad">
						<div class="sectionInputCad">
							<strong><label class="labelInputCad" for="usu_num">NÚMERO</label></strong><br>
							<input type="text" placeholder=" Número" id="usu_num" name="usu_num"/>
						</div>
						<div class="help-block"></div><br/>
					</div>
					<div class="outsideSecInputCad">
						<div class="sectionInputCad">
							<strong><label class="labelInputCad" for="usu_complemento"> COMPLEMENTO</label></strong><br>
							<input type="text" placeholder=" Complemento" id="usu_complemento" name="usu_complemento"/>
						</div>
						<div class="help-block"></div><br/>
					</div>
					<div class="outsideSecInputCad">
						<div class="sectionInputCad">
							<strong><label class="labelInputCad" for="usu_bairro"> BAIRRO</label></strong><br>
							<input type="text" placeholder=" Bairro" readonly id="usu_bairro" name="usu_bairro"/>
						</div>
						<div class="help-block"></div><br/>
					</div>
					<div class="outsideSecInputCad">
						<div class="sectionInputCad">
							<strong><label class="labelInputCad" for="usu_cidade"> CIDADE</label></strong><br>
							<input type="text" placeholder=" Cidade" readonly id="usu_cidade" name="usu_cidade"/>
						</div>
						<div class="help-block"></div><br/>
					</div>
					<div class="outsideSecInputCad">
						<div class="sectionInputCad">
							<strong><label class="labelInputCad" for="usu_uf"> ESTADO</label></strong><br>
							<input type="text" placeholder=" Estado" readonly id="usu_uf" name="usu_uf"/>
						</div>
						<div class="help-block"></div><br/>
					</div>
					<div class="btnSendCad">
						<input class="btnSubCad" type="submit" id="btn-cad" value="Cadastrar"/>
						<div class="help-block"></div>
					</div>
				</form>
			</div>
		</div>
		<div id="myModal" class="modal">
            <div class="modal-content">
                <form id="form-login">
                    <span class="close">&times;</span>
                    <!-- <i class="far fa-check-circle"></i> -->
                    <h4 class="titleModalLogin"><i class="fas fa-grip-lines"></i><i class="fas fa-grip-lines"></i><i class="fas fa-grip-lines"></i> LOG IN <i class="fas fa-grip-lines"></i><i class="fas fa-grip-lines"></i><i class="fas fa-grip-lines"></i></h4>
                    <strong><label class="labelInput">E-MAIL</label></strong>
                    <input class="inputModal" type="email" placeholder=" E-mail" name="usu_email" id="usu_email"/><br/>
                    <strong><label class="labelInput">SENHA</label></strong>
                    <input class="inputModal" type="password" placeholder=" Senha" name="usu_senha" id="usu_senha"/><br/>
                    <p class="textModal">Ainda não é cadastrado?<br>
                    <a class="linkCadModal" href="cadastro.php">Cadastre-se já</a></p><br/>
                    <div class="help-block"></div>
                    <input class="btnSend" type="submit" id="btn-login" value="Entrar"/>
                </form>
            </div>
        </div>
		<div class="l-footerCad" id="footer"></div>
        <div class="l-footerBottomCad" id="footerBottom"></div>
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