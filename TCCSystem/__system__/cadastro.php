<?php
	require_once 'functions/connection/conn.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
    <title>e.conomize - Cadastre-se</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo base_url(); ?>img/e_icon.png"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>style/css/main.css">
    <link href="<?php echo base_url(); ?>style/libraries/fontawesome-free-5.8.0-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/fonts/Icons/icons_pack/font/flaticon.css">
	
	<script src="<?php echo base_url(); ?>js/JQuery/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>js/JQuery/jquery-mask.js"></script>
    <script src="<?php echo base_url(); ?>js/mask.js"></script>
</head>
<body>
	<div class="l-wrapper_cadastro">
		<div class="l-topNavCad" id="topNav">
		<?php
			include('functions/includes/topNav.php');
		?>    
		</div>
		<div class="l-headerNavMobile" id="headerNav">
		<?php
			include('functions/includes/header.html');
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
						<div class="sectionInputCadPassword inputConfirm">
							<input type="password" placeholder=" Confirme a senha" id="usu_senha2" name="usu_senha2"/>
						</div>
						<div class="help-block"></div><br/>
					</div>
					
					<div class="">
						<div class="sectionInputCad" id="telefone">
							<strong><label class="labelInputCad" for="">TELEFONE(S)</label></strong><br>
							
								<div class="workAsInput">
									<input type="text" placeholder=" Número Tel" class="sp_celphones" name="tel_num[]"/>
								</div>
								<?php
									$sel = $conn->prepare("SELECT * FROM tipo_tel");
									$sel->execute();
									if($sel->rowCount() > 0):
										$rows = $sel->fetchAll();?>
										<div class="">
											<select class="selectTypeTel" name="tipo_tel[]">
												<optgroup label=" TIPO DE TELEFONE">
													<?php
														foreach($rows as $row):?>
															<option value="<?php echo $row['tpu_tel_id']; ?>">
																<?php echo $row['tpu_tel_nome']; ?>
															</option>
															<?php
														endforeach;
													?>
												</optgroup>
											</select>
										</div>
										<?php
									endif;?>
									<button type="button" class="btnAddTel" id="add_telefone"><i class="fas fa-plus-circle"></i></button>
							</div>
						<div class="help-block-tel"></div>
					</div>

					<div class="divisorTitle divisorMargin">
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
                    <input class="inputModal" type="text" placeholder=" E-mail" name="usu_email_login" id="usu_email_login"/><br/>
                    <strong><label class="labelInput">SENHA</label></strong>
                    <input class="inputModal" type="password" placeholder=" Senha" name="usu_senha_login" id="usu_senha_login"/><br/>
                    <p class="textModal">Ainda não é cadastrado?<br/>
                    <a class="linkCadModal" href="<?php echo base_url_php(); ?>cadastro">Cadastre-se já</a></p>
                    <input class="btnSend" type="submit" id="btn-login" value="Entrar"/>
                    <div class="help-block-login"></div>
                </form>
            </div>
        </div>
		<div class="l-footer" id="footer">
        <?php
            include('functions/includes/footer.html');
		?>
		</div>
        <div class="l-footerBottomCad" id="footerBottom">
		<?php
            include('functions/includes/bottomFooter.html');
        ?>
		</div>
    </div>

	<script src="<?php echo base_url(); ?>js/JQuery/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>js/util.js"></script>
	<script src="<?php echo base_url(); ?>style/libraries/OwlCarousel2-2.3.4/dist/owl.carousel.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>style/libraries/sweetalert2.all.min.js"></script>
    <script src="<?php echo base_url(); ?>js/JQuery/jquery-mask.js"></script>
    <script src="<?php echo base_url(); ?>js/mask.js"></script>
    <script src="<?php echo base_url(); ?>js/verificaLogin.js"></script>
    <script src="<?php echo base_url(); ?>js/main.js"></script>
    <script src="<?php echo base_url(); ?>js/login.js"></script>
    <script src="<?php echo base_url(); ?>js/cadastro_usuario.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var campos_max = 4;
			var x = 0;
			$('#add_telefone').click(function(e) {
				e.preventDefault();
				if (x < campos_max) {
						$('#telefone').append('<div class="outsideSecInputCad">\
							<div class="sectionInputCadPlus">\
								<input type="text" placeholder=" Número Tel" class="sp_celphones" name="tel_num[]"/>\
							</div>\
							<?php
								$sel = $conn->prepare("SELECT * FROM tipo_tel");
								$sel->execute();
								if($sel->rowCount() > 0):
									$rows = $sel->fetchAll();?>
									<div class="sectionInputCadPlus">\
										<select class="selectTypeTelPlus" name="tipo_tel[]">\
											<optgroup label="TIPO DO TELEFONE">\
												<?php
													foreach($rows as $row):?>
														<option value="<?php echo $row['tpu_tel_id']; ?>">\
															<?php echo $row['tpu_tel_nome']; ?>
														</option>\
														<?php
													endforeach;
												?>
											</optgroup>\
										</select>\
									</div>\
									<?php
								endif;
							?>
						<div class="btnRemove">\
							<a href="#" class="remover_campo"><i class="fas fa-times"></i></a>\
						</div>\
						</div>');
					x++;
				}
			});
	
			// Remover o div anterior
			$('#telefone').on("click",".remover_campo",function(e) {
					e.preventDefault();
					$(this).parent().parent('div').remove();
					$(this).parent('div').remove();
					x--;
			});
		});
	</script>
	<?php
		if(isset($_SESSION["inf_usu"])):?>
			<script>
				Swal.fire({
					title: "e.conomize informa:",
					text: "Você já está logado! Por favor, primeiramente faça logout.",
					type: "warning",
					showCancelButton: true,
					cancelButtonColor: "#494949",
					cancelButtonText: "Cancelar",
					confirmButtonColor: "#A94442",
					confirmButtonText: "Ok, logout"
				}).then((result) => {
					if(result.value) {
						<?php $_SESSION["url_sair"] = "../cadastro"; ?>
						window.location.href = "functions/sair";
					} else {
						window.location.href = "home";
					}
				});
			</script>
			<?php
		endif;
	?>
</body>
</html>