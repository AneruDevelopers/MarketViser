<?php 
	require_once 'connection/conn.php';
    require_once 'envmail.php';
	if(isset($_POST["usu_email"])) {
		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();
		$json["error_tel"] = "";

		$_POST["usu_nome"] = trim($_POST["usu_nome"]);

		foreach($_POST["tel_num"] as $k => $v) {
			$tel_num[] = $v;
			$tipo_tel[] = $_POST["tipo_tel"][$k];
		}

		if(empty($_POST["usu_nome"])) {
			$json["error_list"]["#usu_nome"] = "<p class='msgErrorCad'>Por favor, insira seu nome neste campo</p>";
		} else {
			if (!preg_match("/[\p{Latin}\d]+/i",$_POST["usu_nome"])) {
				$json["error_list"]["#usu_nome"] = "<p class='msgErrorCad'>Por favor, somente somente letras ou espaços neste campo</p>";
			} else {
				if(substr_count($_POST["usu_nome"], " ") > 1) {
					$json["error_list"]["#usu_nome"] = "<p class='msgErrorCad'>Por favor, somente nomes simples ou compostos neste campo</p>";
				}
			}
		}

		if(empty($_POST["usu_sobrenome"])) {
			$json["error_list"]["#usu_sobrenome"] = "<p class='msgErrorCad'>Por favor, insira seu sobrenome neste campo</p>";
		} else {
			if (!preg_match("/[\p{Latin}\d]+/i",$_POST["usu_sobrenome"])) {
				$json["error_list"]["#usu_sobrenome"] = "<p class='msgErrorCad'>Por favor, somente somente letras ou espaços neste campo</p>";
			}
		}

		if(empty($_POST["usu_cpf"])) {
			$json["error_list"]["#usu_cpf"] = "<p class='msgErrorCad'>Por favor, insira seu CPF neste campo</p>";
		} else {
			if(strlen($_POST["usu_cpf"]) < 14) {
				$json["error_list"]["#usu_cpf"] = "<p class='msgErrorCad'>Por favor, insira um CPF válido</p>";
			} else {
				$verifica = $conn->prepare("SELECT usu_cpf FROM usuario WHERE usu_cpf=:cpf");
				$verifica->bindValue(":cpf", "{$_POST["usu_cpf"]}");
				$verifica->execute();
				if($verifica->rowCount() > 0) {
					$json["error_list"]["#usu_cpf"] = "<p class='msgErrorCad'>Esse CPF já foi cadastrado anteriormente</p>";
				}
			}
		}

		if(empty($_POST["usu_email"])) {
			$json["error_list"]["#usu_email"] = "<p class='msgErrorCad'>Por favor, insira seu e-mail neste campo</p>";
		} else {
			if(!filter_var($_POST["usu_email"], FILTER_VALIDATE_EMAIL)) {
				$json["error_list"]["#usu_email"] = "<p class='msgErrorCad'>Por favor, insira um e-mail válido neste campo</p>";
			} else {
				$verifica = $conn->prepare("SELECT usu_email FROM usuario WHERE usu_email=:email");
				$verifica->bindValue(":email", "{$_POST["usu_email"]}");
				$verifica->execute();
				if($verifica->rowCount() > 0) {
					$json["error_list"]["#usu_email"] = "<p class='msgErrorCad'>Esse email já foi cadastrado anteriormente</p>";
				}
			}
		}

		if(empty($_POST["usu_senha"])) {
			$json["error_list"]["#usu_senha"] = "<p class='msgErrorCad'>Por favor, insira sua senha neste campo</p>";
		} else {
			if(strpos($_POST["usu_senha"], " ") != FALSE) {
				$json["error_list"]["#usu_senha"] = "<p class='msgErrorCad'>Não pode haver espaços, por favor!</p>";
			} else {
				if((strlen($_POST["usu_senha"]) < 6) || (strlen($_POST["usu_senha"]) > 14)) {
					$json["error_list"]["#usu_senha"] = "<p class='msgErrorCad'>Por favor, mínimo de 6 caracteres e máximo de 14!</p>";
				} else {
					if (!preg_match("(^[a-zA-Z0-9]+([a-zA-Z\_0-9\.-]*))", $_POST["usu_senha"]) ) {
						$json["error_list"]["#usu_senha"] = "<p class='msgErrorCad'>Apenas letras e números</p>";
					} else {
						if($_POST["usu_senha"] != $_POST["usu_senha2"]) {
							$json["error_list"]["#usu_senha"] = "";
							$json["error_list"]["#usu_senha2"] = "<p class='msgErrorCad'>Senhas não conferem!</p>";
						}
					}
				}
			}
		}

		foreach($tel_num as $k => $v) {
			$key = $k + 1;
			if(empty($v)) {
				$json["error_tel"] = "<p class='msgErrorCadTel'>Por favor, insira o(s) telefone(s) corretamente</p>";
			} else {
				if(strlen($v) < 14) {
					$json["error_tel"] = "<p class='msgErrorCadTel'>Por favor, insira o(s) telefone(s) corretamente</p>";
				} else {
					$verifica = $conn->prepare("SELECT tel_num FROM telefone WHERE tel_num='$v'");
					$verifica->execute();
					if($verifica->rowCount() > 0) {
						$json["error_tel"] = "<p class='msgErrorCadTel'>O {$key}º telefone já foi cadastrado anteriormente</p>";
					}
				}
			}
		}

		if(empty($_POST["usu_cep"])) {
			$json["error_list"]["#usu_cep"] = "<p class='msgErrorCad'>Por favor, insira o CEP do seu logradouro ou da sua cidade neste campo</p>";
		} else {
			if(strlen($_POST["usu_cep"]) < 9) {
				$json["error_list"]["#usu_cep"] = "<p class='msgErrorCad'>Por favor, insira seu CEP corretamente neste campo</p>";
			} else {
				if(empty($_POST["usu_uf"])) {
					$json["error_list"]["#usu_uf"] = "<p class='msgErrorCad'>Por favor, insira um <b>CEP</b> válido para que o endereço seja preenchido automaticamente</p>";
				} else {
					if(empty($_POST["usu_end"])) {
						$json["error_list"]["#usu_end"] = "<p class='msgErrorCad'>Por favor, insira um <b>CEP</b> válido para que o endereço seja preenchido automaticamente</p>";
					} else {
						if(empty($_POST["usu_bairro"])) {
							$json["error_list"]["#usu_bairro"] = "<p class='msgErrorCad'>Por favor, insira seu bairro neste campo</p>";
						} else {
							if(empty($_POST["usu_num"])) {
								$json["error_list"]["#usu_num"] = "<p class='msgErrorCad'>Por favor, insira o <b>número</b> de sua casa neste campo</p>";
							} else {
								if(!is_numeric($_POST["usu_num"])) {
									$json["error_list"]["#usu_num"] = "<p class='msgErrorCad'>Somente números neste campo</p>";
								}
								//else {
									// $cid = $_POST["usu_cidade"];
									// $verifica = $conn->prepare("SELECT * FROM cidade WHERE cid_nome='$cid'");
									// $verifica->execute();
									// if($verifica->rowCount() == 0) {
									// 	$_SESSION["msg"]["title"] = "E.conomize informa:";
									// 	$_SESSION["msg"]["text"] = "Não há nenhum armazém em sua cidade ainda, desculpe-nos!";
									// }
								//}
							}
						}
					}
				}
			}
		}

		if((!empty($json["error_list"])) || (!empty($json["error_tel"]))) {
			$json["status"] = 0;
		} else {
			$_POST["usu_senha"] = password_hash($_POST["usu_senha"], PASSWORD_DEFAULT);
			$ins = $conn->prepare("INSERT INTO usuario(usu_first_name,usu_last_name,usu_sexo,usu_cpf,usu_email,usu_senha,usu_cep,usu_end,usu_num,usu_complemento,usu_bairro,usu_cidade,usu_uf, usu_tipo) VALUES(:n,:l,:sx,:cpf,:e,:s,:ce,:en,:nu,:co,:b,:c,:u,1)");
			$ins->bindValue(":n", "{$_POST["usu_nome"]}");
			$ins->bindValue(":l", "{$_POST["usu_sobrenome"]}");
			$ins->bindValue(":sx", "{$_POST["usu_sexo"]}");
			$ins->bindValue(":cpf", "{$_POST["usu_cpf"]}");
			$ins->bindValue(":e", "{$_POST["usu_email"]}");
			$ins->bindValue(":s", "{$_POST["usu_senha"]}");
			$ins->bindValue(":en", "{$_POST["usu_end"]}");
			$ins->bindValue(":nu", "{$_POST["usu_num"]}");
			$ins->bindValue(":c", "{$_POST["usu_cidade"]}");
			$ins->bindValue(":u", "{$_POST["usu_uf"]}");
			$ins->bindValue(":co", "{$_POST["usu_complemento"]}");
			$ins->bindValue(":b", "{$_POST["usu_bairro"]}");
			$ins->bindValue(":ce", "{$_POST["usu_cep"]}");
			//$ins->bindValue(":t", "{$_POST["usu_tipo"]}");
			if($ins->execute()) {
				$sel = $conn->prepare("SELECT * FROM usuario WHERE usu_email=:email");
				$sel->bindValue(":email", "{$_POST["usu_email"]}");
				$sel->execute();
				if($sel->rowCount() > 0) {
					$rows = $sel->fetchAll();
					foreach($rows as $row) {
						$usu_id = $row['usu_id'];
					}
					foreach($tel_num as $k => $v) {
						$idtipo = intval($tipo_tel[$k]);
						$ins2 = $conn->prepare("INSERT INTO telefone(tel_num, tpu_tel, usu_id) VALUES('$v', $idtipo, $usu_id)");
						if(!$ins2->execute()) {
							$json["status"] = 0;
							$json["error_list"]["#btn-cad"] = "<p style='color:red;'>Erro ao cadastrar o(s) telefone(s)! Tente novamente, por favor</p>";
						}
					}
					if($json["status"]) {
						$sel = $conn->prepare("SELECT * FROM usuario AS u JOIN tipousu AS t ON u.usu_tipo=t.tpu_id WHERE usu_email=:email");
						$sel->bindValue(":email", "{$_POST["usu_email"]}");
						$sel->execute();
						if($sel->rowCount() > 0) {
							$rows = $sel->fetchAll();
							foreach($rows as $row) {
								if(isset($_POST['usu_cookie'])) {
									setcookie("inf_usu",$row['usu_id'],time()+(86400 * 1825));
								}

								$_SESSION["inf_usu"]['usu_id'] = $row['usu_id'];
								$_SESSION["inf_usu"]['usu_nome'] = $row['usu_first_name'];
								$_SESSION["inf_usu"]['usu_sobrenome'] = $row['usu_last_name'];
								$_SESSION["inf_usu"]['usu_email'] = $row['usu_email'];
								$_SESSION["inf_usu"]['usu_cpf'] = $row['usu_cpf'];
								$_SESSION["inf_usu"]['usu_cep'] = $row['usu_cep'];
								$_SESSION["inf_usu"]['usu_end'] = $row['usu_end'];
								$_SESSION["inf_usu"]['usu_senha'] = $row['usu_senha'];
								$_SESSION["inf_usu"]['usu_num'] = $row['usu_num'];
								$_SESSION["inf_usu"]['usu_cidade'] = $row['usu_cidade'];
								$_SESSION["inf_usu"]['usu_bairro'] = $row['usu_bairro'];
								$_SESSION["inf_usu"]['usu_complemento'] = $row['usu_complemento'];
								$_SESSION["inf_usu"]['usu_uf'] = $row['usu_uf'];
								

								$reg = $row['usu_registro'];
								$ano = substr($reg,0,4);
								$mes = substr($reg,5,2);
								$dia = substr($reg,8,2);
								$hora = substr($reg,11,2)."h".substr($reg,14,2);
								$_SESSION["inf_usu"]['usu_registro'] = $dia."/".$mes."/".$ano;
								$_SESSION["inf_usu"]['usu_registro_hora'] = $dia."/".$mes."/".$ano." às ".$hora;

								$_SESSION["inf_usu"]['usu_tipo'] = $row['tpu_usu_nome'];
								$_SESSION["inf_usu"]['usu_tipo_id'] = $row['tpu_id'];
								$nome = explode(" ", $_SESSION["inf_usu"]['usu_nome']);
								$json["nome_usuario"] = $nome[0];
								env_cad($_SESSION["inf_usu"]['usu_email'],$_SESSION["inf_usu"]['usu_nome']);
							}
						} else {

						}
					}
				} else {
					$json["status"] = 0;
					$json["error_list"]["#btn-cad"] = "<p style='color:red;'><b>Erro inesperado. Tente novamente mais tarde!</b></p>";
				}
			} else {
				$json["status"] = 0;
				$json["error_list"]["#btn-cad"] = "<p style='color:red;'><b>Erro inesperado. Tente novamente mais tarde!</b></p>";
			}
		}
		echo json_encode($json);
	}
?>