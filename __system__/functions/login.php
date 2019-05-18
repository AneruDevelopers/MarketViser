<?php 
	require_once 'connection/conn.php';

	if(isset($_POST["usu_email_login"])) {
		$json = array();
		$json["status"] = 1;
		$json["error"] = NULL;

		//$sel = $conn->query("");
		
		$sel = $conn->prepare("SELECT * FROM usuario WHERE usu_email=:email");
		$sel->bindValue(":email", "{$_POST["usu_email_login"]}");
		$sel->execute();

		if($sel) {
			if($sel->rowCount() > 0) {
				$rows = $sel->fetchAll();
				foreach($rows as $row) {
					$senha = $row["usu_senha"];
				}
				if(password_verify($_POST["usu_senha_login"], $senha)) {
					$sel2 = $conn->prepare("SELECT * FROM usuario AS u JOIN tipousu AS t ON u.usu_tipo=t.tpu_id WHERE usu_email=:email");
					$sel2->bindValue(":email", "{$_POST["usu_email_login"]}");
					$sel2->execute();
					$rows = $sel2->fetchAll();
					foreach($rows as $row) {
						setcookie("inf_usu",$row['usu_id'],time()+(86400 * 1825));

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
						$nome = explode(" ", $_SESSION["inf_usu"]['usu_nome']);
						$json["nome_usuario"] = $nome[0];
					}
				} else {
					$json["status"] = 0;
					$json["error"] = "<p style='color:red;'><b>E-mail e/ou senha inválido(s)!</b></p>";
				}
			} else {
				$json["status"] = 0;
				$json["error"] = "<p style='color:red;'><b>E-mail e/ou senha inválido(s)!</b></p>";
			}
		} else {
			$json["status"] = 0;
			$json["error"] = "<p style='color:red;'><b>Erro inesperado. Tente novamente mais tarde!</b></p>";
		}
		
    	echo json_encode($json);
	}
?>