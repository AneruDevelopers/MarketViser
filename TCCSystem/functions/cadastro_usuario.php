<?php 
	require_once 'connection/conn.php';

	if(isset($_POST["usu_email"])) {
		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$_POST["usu_nome"] = trim($_POST["usu_nome"]);

		if(empty($_POST["usu_nome"])) {
			$json["error_list"]["#usu_nome"] = "<span style='color:red;'>Por favor, insira seu nome neste campo</span>";
		} else {
			if(strlen($_POST["usu_nome"]) < 5) {
				$json["error_list"]["#usu_nome"] = "<span style='color:red;'>Por favor, insira seu nome completo neste campo</span>";
			}
		}

		if(empty($_POST["usu_email"])) {
			$json["error_list"]["#usu_email"] = "<span style='color:red;'>Por favor, insira seu e-mail neste campo</span>";
		} else {
			if(!filter_var($_POST["usu_email"], FILTER_VALIDATE_EMAIL)) {
				$json["error_list"]["#usu_email"] = "<span style='color:red;'>Por favor, insira um e-mail válido neste campo</span>";
			} else {
				$verifica = $conn->prepare("SELECT usu_email FROM usuario WHERE usu_email=:email");
				$verifica->bindValue(":email", "{$_POST["usu_email"]}");
				$verifica->execute();
				if($verifica->rowCount() > 0) {
					$json["error_list"]["#usu_email"] = "<span style='color:red;'>Esse email já foi cadastrado anteriormente</span>";
				}
			}
		}

		if(empty($_POST["usu_senha"])) {
			$json["error_list"]["#usu_senha"] = "<span style='color:red;'>Por favor, insira sua senha neste campo</span>";
		} else {
			if(strpos($_POST["usu_senha"], " ") != FALSE) {
				$json["error_list"]["#usu_senha"] = "<span style='color:red;'>Não pode haver espaços, por favor!</span>";
			} else {
				if((strlen($_POST["usu_senha"]) < 6) || (strlen($_POST["usu_senha"]) > 14)) {
					$json["error_list"]["#usu_senha"] = "<span style='color:red;'>Por favor, mínimo de 6 caracteres e máximo de 14!</span>";
				} else {
					if (!preg_match("(^[a-zA-Z0-9]+([a-zA-Z\_0-9\.-]*))", $_POST["usu_senha"]) ) {
						$json["error_list"]["#usu_senha"] = "<span style='color:red;'>Apenas letras e números</span>";
					} else {
						if($_POST["usu_senha"] != $_POST["usu_senha2"]) {
							$json["error_list"]["#usu_senha"] = "";
							$json["error_list"]["#usu_senha2"] = "<span style='color:red;'>Senhas não conferem!</span>";
						}
					}
				}
			}
		}

		if(empty($_POST["usu_cep"])) {
			$json["error_list"]["#usu_cep"] = "<span style='color:red;'>Por favor, insira seu CEP neste campo</span>";
		} else {
			if(empty($_POST["usu_uf"])) {
				$json["error_list"]["#usu_uf"] = "<span style='color:red;'>Por favor, insira um <b>CEP</b> válido para que o endereço seja preenchido automaticamente</span>";
			} else {
				if(empty($_POST["usu_num"])) {
					$json["error_list"]["#usu_num"] = "<span style='color:red;'>Por favor, insira o <b>número</b> de sua casa neste campo</span>";
				} else {
					if(!is_numeric($_POST["usu_num"])) {
						$json["error_list"]["#usu_num"] = "<span style='color:red;'>Somente números neste campo</span>";
					} else {
						$cid = $_POST["usu_cidade"];
						$verifica = $conn->prepare("SELECT * FROM cidade WHERE cid_nome='$cid'");
						$verifica->execute();
						if($verifica->rowCount() == 0) {
							$_SESSION["msg"]["title"] = "E.conomize informa:";
							$_SESSION["msg"]["text"] = "Não há nenhum armazém em sua cidade ainda, desculpe-nos!";
						}
					}
				}
			}
		}

		if(!empty($json["error_list"])) {
			$json["status"] = 0;
		} else {
			$_POST["usu_senha"] = password_hash($_POST["usu_senha"], PASSWORD_DEFAULT);
			$ins = $conn->prepare("INSERT INTO usuario(usu_nome,usu_email,usu_senha,usu_cep,usu_end,usu_num,
				usu_complemento,usu_bairro,usu_cidade,usu_uf, usu_tipo) VALUES(:n,:e,:s,:ce,:en,:nu,:co,:b,:c,:u,1)");
			$ins->bindValue(":n", "{$_POST["usu_nome"]}");
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
				$sel = $conn->prepare("SELECT * FROM usuario AS u JOIN tipousu AS t ON u.usu_tipo=t.tpu_id 
					WHERE usu_email=:email");
				$sel->bindValue(":email", "{$_POST["usu_email"]}");
				$sel->execute();
				if($sel->rowCount() > 0) {
					$rows = $sel->fetchAll();
					foreach($rows as $row) {
						$_SESSION['usu_id'] = $row['usu_id'];
						$_SESSION['usu_nome'] = $row['usu_nome'];
						$_SESSION['usu_email'] = $row['usu_email'];
						$_SESSION['usu_cep'] = $row['usu_cep'];
						$_SESSION['usu_end'] = $row['usu_end'];
						$_SESSION['usu_num'] = $row['usu_num'];
						$_SESSION['usu_complemento'] = $row['usu_complemento'];
						$_SESSION['usu_bairro'] = $row['usu_bairro'];
						$_SESSION['usu_cidade'] = $row['usu_cidade'];
						$_SESSION['usu_uf'] = $row['usu_uf'];

						$reg = $row['usu_registro'];
						$ano = substr($reg,0,4);
						$mes = substr($reg,5,2);
						$dia = substr($reg,8,2);
						$hora = substr($reg,11,2)."h".substr($reg,14,2);
						$_SESSION['usu_registro'] = $dia."/".$mes."/".$ano." às ".$hora;

						$_SESSION['usu_tipo'] = $row['tpu_nome'];
						$nome = explode(" ", $_SESSION['usu_nome']);
						$json["nome_usuario"] = $nome[0];
					}
				}
			} else {
				$json["status"] = 0;
				$json["error_list"]["#btn-login"] = "<p style='color:red;text-align:center;'><b>Erro inesperado. Tente novamente mais tarde!</b></p>";
			}
		}
		echo json_encode($json);
	}
?>