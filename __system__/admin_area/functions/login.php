<?php
    if(isXmlHttpRequest()) {
        $json['status'] = 1;
        $json['error'] = NULL;

        $sel = $conn->prepare("SELECT funcionario_senha FROM funcionario WHERE funcionario_cpf=:cpf");
		$sel->bindValue(":cpf", "{$_POST["funcionario_cpf"]}");
		$sel->execute();

		if($sel) {
			if($sel->rowCount() > 0) {
				$rows = $sel->fetchAll();
				foreach($rows as $row) {
					$senha = $row["funcionario_senha"];
				}
				if(password_verify($_POST["funcionario_senha"], $senha)) {
					$sel2 = $conn->prepare("SELECT * FROM funcionario AS f JOIN setor AS s ON f.funcionario_setor=s.setor_id WHERE f.funcionario_cpf=:cpf");
					$sel2->bindValue(":cpf", "{$_POST["funcionario_cpf"]}");
					$sel2->execute();
					$rows = $sel2->fetchAll();
					foreach($rows[0] as $k => $row) {
						$_SESSION['inf_func'][$k] = $row;
					}
				} else {
					$json["status"] = 0;
					$json["error"] = "<p style='text-align:center;color:red;'><b>E-mail e/ou senha inválido(s)!</b></p>";
				}
			} else {
				$json["status"] = 0;
				$json["error"] = "<p style='text-align:center;color:red;'><b>E-mail e/ou senha inválido(s)!</b></p>";
			}
		} else {
			$json["status"] = 0;
			$json["error"] = "<p style='text-align:center;color:red;'><b>Erro inesperado. Tente novamente mais tarde!</b></p>";
		}
		
    	echo json_encode($json);
    }
?>