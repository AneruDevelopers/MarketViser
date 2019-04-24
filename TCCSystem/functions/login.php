<?php 
	require_once 'connection/conn.php';

	if(isset($_POST["usu_email"])) {
		$json = array();
		$json["status"] = 1;
		$json["error"] = NULL;

		//$sel = $conn->query("");
		
		$sel = $conn->prepare("SELECT * FROM usuario AS u JOIN tipousu AS t ON u.usu_tipo=t.tpu_id WHERE usu_email=:email");
		$sel->bindValue(":email", "{$_POST["usu_email"]}");
		$sel->execute();

		if($sel) {
			if($sel->rowCount() > 0) {
				$rows = $sel->fetchAll();
				foreach($rows as $row) {
					$senha = $row["usu_senha"];
				}
				if(password_verify($_POST["usu_senha"], $senha)) {
					$sel2 = $conn->prepare("SELECT * FROM usuario AS u JOIN tipousu AS t ON u.usu_tipo=t.tpu_id WHERE usu_email=:email");
					$sel2->bindValue(":email", "{$_POST["usu_email"]}");
					$sel2->execute();
					$rows = $sel2->fetchAll();
					foreach($rows as $row) {
						$_SESSION['usu_id'] = $row['usu_id'];
						$_SESSION['usu_nome'] = $row['usu_nome'];
						$_SESSION['usu_email'] = $row['usu_email'];
						$_SESSION['usu_end'] = $row['usu_end'];
						$_SESSION['usu_num'] = $row['usu_num'];
						$_SESSION['usu_bairro'] = $row['usu_bairro'];
						$_SESSION['usu_cidade'] = $row['usu_cidade'];
						$_SESSION['usu_uf'] = $row['usu_uf'];
						$_SESSION['usu_complemento'] = $row['usu_complemento'];

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
				} else {
					$json["status"] = 0;
					$json["error"] = "<p style='color:red;'><b>E-mail ou senha inválido(s)!</b></p>";
				}
			} else {
				$json["status"] = 0;
				$json["error"] = "<p style='color:red;'><b>E-mail ou senha inválido(s)!</b></p>";
			}
		} else {
			$json["status"] = 0;
			$json["error"] = "<p style='color:red;'><b>Erro inesperado. Tente novamente mais tarde!</b></p>";
		}
		
    	echo json_encode($json);
	}
?>