<?php
	require_once '__system__/functions/connection/conn.php';

	if((isset($_COOKIE['arm_id'])) && (!isset($_SESSION['arm_id']))):
		$sel = $conn->prepare("SELECT c.cid_nome,e.est_uf,a.armazem_nome,a.armazem_id FROM armazem AS a JOIN cidade AS c ON a.cidade_id=c.cid_id JOIN estado AS e ON c.est_id=e.est_id WHERE a.armazem_id={$_COOKIE['arm_id']}");
		$sel->execute();
		if($sel->rowCount() > 0):
			$result = $sel->fetchAll();
			foreach($result as $v):
				$_SESSION['arm'] = $v['cid_nome'] . " - " . $v['est_uf'];
				$_SESSION['arm_nome'] = $v['armazem_nome'];
				$_SESSION['arm_id'] = $v['armazem_id'];
			endforeach;
		endif;
	else:
		if(!isset($_SESSION['arm'])):
			$sel = $conn->prepare("SELECT c.cid_nome,e.est_uf,a.armazem_nome,a.armazem_id FROM armazem AS a JOIN cidade AS c ON a.cidade_id=c.cid_id JOIN estado AS e ON c.est_id=e.est_id WHERE c.cid_nome='LINS'");
			$sel->execute();
			if($sel->rowCount() > 0):
				$result = $sel->fetchAll();
				foreach($result as $v):
					$_SESSION['arm'] = $v['cid_nome'] . " - " . $v['est_uf'];
					$_SESSION['arm_nome'] = $v['armazem_nome'];
					$_SESSION['arm_id'] = $v['armazem_id'];
				endforeach;
			endif;
		endif;
	endif;

	if((isset($_COOKIE['inf_usu'])) && (!isset($_SESSION['inf_usu']))):
		$sel = $conn->prepare("SELECT * FROM usuario AS u JOIN tipousu AS t ON u.usu_tipo=t.tpu_id WHERE u.usu_id=:id");
		$sel->bindValue(":id", "{$_COOKIE["inf_usu"]}");
		$sel->execute();
		$rows = $sel->fetchAll();
		foreach($rows as $row):
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
		endforeach;
	endif;

	$REQUEST_URI = filter_input(INPUT_SERVER, 'REQUEST_URI');
	
	$INITE = strpos($REQUEST_URI, '?');
	if($INITE):
		$REQUEST_URI = substr($REQUEST_URI, 0, $INITE);
	endif;
	
	$REQUEST_URI_PASTA = substr($REQUEST_URI, 1);
	
	$URL = explode('/', $REQUEST_URI_PASTA);
	$URL[1] = ($URL[1] != '' ? $URL[1] : 'home');
	
	if(file_exists('__system__/' . $URL[1] . '.php')):
		if(isset($URL[2])):
			require '__system__/404.php';
		else:
			require '__system__/' . $URL[1] . '.php';
		endif;
	elseif(is_dir('__system__/' . $URL[1])):
		if(isset($URL[2]) && file_exists('__system__/' . $URL[1] . '/' . $URL[2] . '.php')):
			if(isset($URL[3])):
				require '__system__/404.php';
			else:
				require '__system__/' . $URL[1] . '/' . $URL[2] . '.php';
			endif;
		elseif(isset($URL[2]) && is_dir('__system__/' . $URL[1] . '/' . $URL[2])):
			if(isset($URL[3]) && file_exists('__system__/' . $URL[1] . '/' . $URL[2] . '/' . $URL[3] . '.php')):
				if(isset($URL[4])):
					require '__system__/404.php';
				else:
					require '__system__/' . $URL[1] . '/' . $URL[2] . '/' . $URL[3] . '.php';
				endif;
			elseif(isset($URL[3]) && is_dir('__system__/' . $URL[1] . '/' . $URL[2] . '/' . $URL[3])):
				if(isset($URL[4]) && file_exists('__system__/' . $URL[1] . '/' . $URL[2] . '/' . $URL[3] . '/' . $URL[4] . '.php')):
					if(isset($URL[7])):
						require '__system__/404.php';
					else:
						require '__system__/' . $URL[1] . '/' . $URL[2] . '/' . $URL[3] . '/' . $URL[4] . '.php';
					endif;
				elseif(isset($URL[4]) && is_dir('__system__/' . $URL[1] . '/' . $URL[2] . '/' . $URL[3] . '/' . $URL[4])):
					require '__system__/404.php';
				else:
					require '__system__/404.php';
				endif;
			else:
				require '__system__/404.php';
			endif;
		else:
			require '__system__/404.php';
		endif;
	else:
		$URL[1] = str_replace("-", " ", $URL[1]);
		$sel = $conn->prepare("SELECT * FROM departamento WHERE depart_nome='$URL[1]'");
		$sel->execute();
		if($sel->rowCount() > 0):
			$result = $sel->fetchAll();
			if(isset($URL[2])):
				$URL[2] = str_replace("-", " ", $URL[2]);
				$_SESSION['depart_id'] = $result[0]["depart_id"];
				$sel2 = $conn->prepare("SELECT * FROM subcateg WHERE subcateg_nome='$URL[2]' AND depart_id={$_SESSION['depart_id']}");
				$sel2->execute();
				if($sel2->rowCount() > 0):
					$result2 = $sel2->fetchAll();
					$_SESSION['subcateg_id'] = $result2[0]["subcateg_id"];
					if(isset($URL[3])):
						$URL[3] = str_replace("-", " ", $URL[3]);
						$sel3 = $conn->prepare("SELECT * FROM categ WHERE categ_nome='$URL[3]' AND subcateg_id={$_SESSION['subcateg_id']}");
						$sel3->execute();
						if($sel3->rowCount() > 0):
							$result3 = $sel3->fetchAll();
							if(isset($URL[4])):
								require '__system__/404.php';
							else:
								$_SESSION['url3'] = $URL[3];
								$_SESSION['categ_id'] = $result3[0]["categ_id"];
								require '__system__/procuraProdutos.php';
							endif;
						else:
							require '__system__/404.php';
						endif;
					else:
						$_SESSION['url2'] = $URL[2];
						$_SESSION['subcateg_id'] = $result2[0]["subcateg_id"];
						if(isset($_SESSION['categ_id'])):
							unset($_SESSION['categ_id']);
							unset($_SESSION['url3']);
						endif;
						require '__system__/procuraProdutos.php';
					endif;
				else:
					require '__system__/404.php';
				endif;
			else:
				$_SESSION['url1'] = $URL[1];
				$_SESSION['depart_id'] = $result[0]["depart_id"];
				if(isset($_SESSION['subcateg_id']) && isset($_SESSION['categ_id'])):
					unset($_SESSION['subcateg_id']);
					unset($_SESSION['categ_id']);
					unset($_SESSION['url2']);
					unset($_SESSION['url3']);
				else:
					if(isset($_SESSION['subcateg_id'])):
						unset($_SESSION['subcateg_id']);
						unset($_SESSION['url2']);
					elseif(isset($_SESSION['categ_id'])):
						unset($_SESSION['categ_id']);
						unset($_SESSION['url3']);
					endif;
				endif;
				require '__system__/procuraProdutos.php';
			endif;
		else:
			require '__system__/404.php';
		endif;
	endif;
	
	//print_r($URL);
?>