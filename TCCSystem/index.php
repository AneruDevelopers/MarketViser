<?php
	require_once '__system__/functions/connection/conn.php';

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
			require '__system__/404.php';
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