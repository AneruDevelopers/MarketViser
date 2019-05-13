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
		<!-- <div class="circleCad">
			<p>Junte-se a família e.conomize!</p>
		</div> -->
		<div class="zigzag">&#10650</div>
		<div class="zigzag2">&#10650</div>
		<div class="zigzag3">&#10650</div>
				<form id="form-cadastro" class="formCad">
					<div class="divBehindCad">
						<div class="divListaOnCad">
							<label for="">VANTAGENS</label>
							<ul class="listaOnCad">
								<li class="linkListaOnCad"><i class="far fa-check-circle"></i> Acesso às compras</li>
								<li class="linkListaOnCad"><i class="far fa-check-circle"></i> Receba notícias</li>
								<li class="linkListaOnCad"><i class="far fa-check-circle"></i> Promoções</li>
								<li class="linkListaOnCad"><i class="far fa-check-circle"></i> Devoluções</li>
								<li class="linkListaOnCad"><i class="far fa-check-circle"></i> Central de atendimento</li>
								<li class="linkListaOnCad"><i class="far fa-check-circle"></i> Cupons de desconto</li>
							</ul>
						</div>
						<div class="arrowCadTop"><img src="__system__\img\whitearrow.png" alt=""></div>
						<div class="divCadTop">
							<h2>Cadastre-se</h2>
							<div class="divCadLeft">
								<div class="divisorTitle">
									<h6>Dados Pessoais</h6>
								</div>
								<div class="divisorData"></div>
								<div class="outsideSecInputCad">
									<div class="field -md">
										<input type="text" id="usu_nome" maxlength="150" name="usu_nome" class="placeholder-shown" placeholder="Some placeholder"/>
										<label for="usu_nome" class="labelFieldCad"><strong>NOME</strong></label>
									</div>
									<div class="help-block"></div><br/>
								</div>
								<div class="outsideSecInputCad">
									<div class="field -md">
										<input type="text" id="usu_sobrenome" name="usu_sobrenome" class="placeholder-shown" placeholder="Some placeholder"/>
										<label class="labelFieldCad"><strong>SOBRENOME</strong></label>
									</div>
									<div class="help-block"></div><br/>
								</div>
								<div class="outsideSecInputCad">
									<div class="field -md">
										<input type="text" class="cpf placeholder-shown" id="usu_cpf" name="usu_cpf" placeholder="Some placeholder"/>
										<label class="labelFieldCad"><strong>CPF</strong></label>
									</div>
									<div class="help-block"></div><br/>
								</div>
								<div class="outsideSecInputCad">
									<div class="field -md">
										<input type="text" id="usu_email" name="usu_email" class="placeholder-shown" placeholder="Some placeholder"/>
										<label class="labelFieldCad"><strong>EMAIL</strong></label>
									</div>
									<div class="help-block"></div><br/>
								</div>
								<div class="outsideSecInputCad">
									<div class="field -md">
										<input type="password" id="usu_senha" name="usu_senha" class="placeholder-shown" placeholder="Some placeholder"/>
										<label class="labelFieldCad"><strong>SENHA</strong></label>
									</div>
									<div class="help-block"></div><br/>
								</div>
								<div class="outsideSecInputCad">
									<div class="field -md">
										<input type="password" id="usu_senha2" name="usu_senha2" class="placeholder-shown" placeholder="Some placeholder"/>
										<label class="labelFieldCad"><strong>CONFIRMAR SENHA</strong></label>
									</div>
									<div class="help-block"></div><br/>
								</div>
								<div class="outsideSecInputCad">
									<div class="field -md" id="telefone">
										<input type="text" class="sp_celphones placeholder-shown" placeholder="Some placeholder" name="tel_num[]"/>
										<label class="labelFieldCad"><strong>TELEFONE(S)</strong></label>
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
							</div>
						</div>
						<div class="divCadBottom">
							<div class="divCadRight">
								<div class="divisorTitle divisorMargin">
									<h6>Dados Residenciais</h6>
								</div>
								<div class="divisorData"></div>
								<div class="outsideSecInputCad">
									<div class="field -md">
										<input type="text" placeholder=" CEP" class="form-control cep placeholder-shown" id="usu_cep" name="usu_cep"/>
										<label class="labelFieldCad"><strong>CEP</strong></label>
									</div>
									<div class="help-block"></div><br/>
								</div>
								<div class="outsideSecInputCad">
									<div class="field -md">
										<input type="text" placeholder=" Logradouro" class="placeholder-shown" readonly id="usu_end" name="usu_end"/>
										<label class="labelFieldCad"><strong>LOGRADOURO</strong></label>
									</div>
									<div class="help-block"></div><br/>
								</div>
								<div class="outsideSecInputCad">
									<div class="field -md">
										<input type="text" placeholder=" Número" class="placeholder-shown" id="usu_num" name="usu_num"/>
										<label class="labelFieldCad"><strong>NÚMERO</strong></label>
									</div>
									<div class="help-block"></div><br/>
								</div>
								<div class="outsideSecInputCad">
									<div class="field -md">
										<input type="text" placeholder=" Complemento" class="placeholder-shown" id="usu_complemento" name="usu_complemento"/>
										<label class="labelFieldCad"><strong>COMPLEMENTO</strong></label>
									</div>
									<div class="help-block"></div><br/>
								</div>
								<div class="outsideSecInputCad">
									<div class="field -md">
										<input type="text" placeholder=" Bairro" class="placeholder-shown" readonly id="usu_bairro" name="usu_bairro"/>
										<label class="labelFieldCad"><strong>BAIRRO</strong></label>
									</div>
									<div class="help-block"></div><br/>
								</div>
								<div class="outsideSecInputCad">
									<div class="field -md">
										<input type="text" placeholder=" Cidade" class="placeholder-shown" readonly id="usu_cidade" name="usu_cidade"/>
										<label class="labelFieldCad"><strong>CIDADE</strong></label>
									</div>
									<div class="help-block"></div><br/>
								</div>
								<div class="outsideSecInputCad">
									<div class="field -md">
										<input type="text" placeholder=" Estado" class="placeholder-shown" readonly id="usu_uf" name="usu_uf"/>
										<label class="labelFieldCad"><strong>ESTADO</strong></label>
									</div>
									<div class="help-block"></div><br/>
								</div>
								<div class="btnSendCad">
									<button class="btnSubCad" type="submit" id="btn-cad" value="Cadastrar"/>CADASTRAR</button>
									<div class="help-block"></div>
								</div>
							</div>
						</div>
					</div>
				</form>		
		</div>
		<div class="myModalArmazem" id="myModalArmazem">
			<div class="modalArmazemContent">
				Teste modal
				<span class="closeModalArmazem">&times;</span>							
			</div>
		</div>
		<div id="myModal" class="modal">
            <div class="modal-content">
                <div class="modalLeftContent">
                    <form id="form-login">
                        <!-- <i class="far fa-check-circle"></i> -->
                        <h4 class="titleModalLogin">LOG IN</h4>
                        <div class="outsideSecInputCad">
                            <div class="field -md">
                                <input type="text" name="usu_email_login" id="usu_email_login" class="placeholder-shown" placeholder="Some placeholder"/>
                                <label class="labelFieldCad"><strong>EMAIL</strong></label>
                            </div>
                            <div class="help-block"></div><br/>
                        </div>
                        <div class="outsideSecInputCad">
                            <div class="field -md">
                                <input type="password" name="usu_senha_login" id="usu_senha_login" class="placeholder-shown" placeholder="Some placeholder"/>
                                <label class="labelFieldCad"><strong>SENHA</strong></label>
                            </div>
                            <div class="help-block"></div><br/>
                        </div>
                        <button class="btnSend" type="submit" id="btn-login" value="Entrar"/>ENTRAR</button>
                        <div class="help-block-login"></div>
                    </form>
                </div>
                <div class="modalRightContent">
                    <span class="close">&times;</span>
                    <p class="textModal">Olá, amigo!</p>
                    <p class="textModalBottom">Entre com seus detalhes pessoais e comece sua jornada conosco</p>
                    <div class="divLinkCad">    
                        <a class="linkCadModal" href="<?php echo base_url_php(); ?>cadastro">Cadastre-se já</a>
                    </div>    
                </div>
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
						$('#telefone').append('<div class="telPlus">\
						<div class="outsideSecInputCadPlus">\
							<div class="field -md">\
								<input type="text" placeholder=" Número Tel" class="sp_celphones placeholder-shown" name="tel_num[]"/>\
								<label class="labelFieldCad"><strong>TELEFONE</strong></label>\
							</div>\
							<?php
								$sel = $conn->prepare("SELECT * FROM tipo_tel");
								$sel->execute();
								if($sel->rowCount() > 0):
									$rows = $sel->fetchAll();?>
										<div class="field -md">\
											<select class="selectTypeTel" name="tipo_tel[]">\
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
						</div>\
						<div>');
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