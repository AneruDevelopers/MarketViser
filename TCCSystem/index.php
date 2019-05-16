<?php
	require_once '__system__/functions/connection/conn.php';
	setcookie("inf_usu");

	if(isset($_COOKIE['arm_id'])):
		$sel = $conn->prepare("SELECT c.cid_nome,e.est_uf,a.armazem_nome,a.armazem_id FROM armazem AS a JOIN cidade AS c ON a.cidade_id=c.cid_id JOIN estado AS e ON c.est_id=e.est_id WHERE c.cid_nome={$_COOKIE['arm_id']}");
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
		if(!isset($_SESSION['arm'])) {
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
		}
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
	$URL[3] = ($URL[3] != '' ? $URL[3] : 'home');
	
	if(file_exists('__system__/' . $URL[3] . '.php')):
		if(isset($URL[4])):
			require '__system__/404.php';
		else:
			require '__system__/' . $URL[3] . '.php';
		endif;
	elseif(is_dir('__system__/' . $URL[3])):
		if(isset($URL[4]) && file_exists('__system__/' . $URL[3] . '/' . $URL[4] . '.php')):
			if(isset($URL[5])):
				require '__system__/404.php';
			else:
				require '__system__/' . $URL[3] . '/' . $URL[4] . '.php';
			endif;
		elseif(isset($URL[4]) && is_dir('__system__/' . $URL[3] . '/' . $URL[4])):
			if(isset($URL[5]) && file_exists('__system__/' . $URL[3] . '/' . $URL[4] . '/' . $URL[5] . '.php')):
				if(isset($URL[6])):
					require '__system__/404.php';
				else:
					require '__system__/' . $URL[3] . '/' . $URL[4] . '/' . $URL[5] . '.php';
				endif;
			elseif(isset($URL[5]) && is_dir('__system__/' . $URL[3] . '/' . $URL[4] . '/' . $URL[5])):
				if(isset($URL[6]) && file_exists('__system__/' . $URL[3] . '/' . $URL[4] . '/' . $URL[5] . '/' . $URL[6] . '.php')):
					if(isset($URL[7])):
						require '__system__/404.php';
					else:
						require '__system__/' . $URL[3] . '/' . $URL[4] . '/' . $URL[5] . '/' . $URL[6] . '.php';
					endif;
				elseif(isset($URL[6]) && is_dir('__system__/' . $URL[3] . '/' . $URL[4] . '/' . $URL[5] . '/' . $URL[6])):
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
		$URL[3] = str_replace("-", " ", $URL[3]);
		$sel = $conn->prepare("SELECT * FROM departamento WHERE depart_nome='$URL[3]'");
		$sel->execute();
		if($sel->rowCount() > 0):
			$result = $sel->fetchAll();
			if(isset($URL[4])):
				$URL[4] = str_replace("-", " ", $URL[4]);
				$_SESSION['depart_id'] = $result[0]["depart_id"];
				$sel2 = $conn->prepare("SELECT * FROM subcateg WHERE subcateg_nome='$URL[4]' AND depart_id={$_SESSION['depart_id']}");
				$sel2->execute();
				if($sel2->rowCount() > 0):
					$result2 = $sel2->fetchAll();
					$_SESSION['subcateg_id'] = $result2[0]["subcateg_id"];
					if(isset($URL[5])):
						$URL[5] = str_replace("-", " ", $URL[5]);
						$sel3 = $conn->prepare("SELECT * FROM categ WHERE categ_nome='$URL[5]' AND subcateg_id={$_SESSION['subcateg_id']}");
						$sel3->execute();
						if($sel3->rowCount() > 0):
							$result3 = $sel3->fetchAll();
							if(isset($URL[6])):
								require '__system__/404.php';
							else:
								$_SESSION['url5'] = $URL[5];
								$_SESSION['categ_id'] = $result3[0]["categ_id"];
								require '__system__/procuraProdutos.php';
							endif;
						else:
							require '__system__/404.php';
						endif;
					else:
						$_SESSION['url4'] = $URL[4];
						$_SESSION['subcateg_id'] = $result2[0]["subcateg_id"];
						if(isset($_SESSION['categ_id'])) {
							unset($_SESSION['categ_id']);
							unset($_SESSION['url5']);
						}
						require '__system__/procuraProdutos.php';
					endif;
				else:
					require '__system__/404.php';
				endif;
			else:
				$_SESSION['url3'] = $URL[3];
				$_SESSION['depart_id'] = $result[0]["depart_id"];
				if(isset($_SESSION['subcateg_id']) && isset($_SESSION['categ_id'])) {
					unset($_SESSION['subcateg_id']);
					unset($_SESSION['categ_id']);
					unset($_SESSION['url4']);
					unset($_SESSION['url5']);
				} else {
					if(isset($_SESSION['subcateg_id'])) {
						unset($_SESSION['subcateg_id']);
						unset($_SESSION['url4']);
					} elseif(isset($_SESSION['categ_id'])) {
						unset($_SESSION['categ_id']);
						unset($_SESSION['url5']);
					}
				}
				require '__system__/procuraProdutos.php';
			endif;
		else:
			require '__system__/404.php';
		endif;
	endif;
	
	//print_r($URL);
?>