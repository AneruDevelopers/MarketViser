<?php
	$REQUEST_URI = filter_input(INPUT_SERVER, 'REQUEST_URI');
	$INITE = strpos($REQUEST_URI, '?');
	if($INITE):
		$REQUEST_URI = substr($REQUEST_URI, 0, $INITE);
	endif;
	$REQUEST_URI_PASTA = substr($REQUEST_URI, 1);
	$URL = explode('/', $REQUEST_URI_PASTA);
	$URL[3] = ($URL[3] != '' ? $URL[3] : 'home');
	if(file_exists('__system__/' . $URL[3] . '.php')):
		require '__system__/' . $URL[3] . '.php';
	elseif(is_dir('__system__/' . $URL[3])):
		if(isset($URL[4]) && file_exists('__system__/' . $URL[3] . '/' . $URL[4] . '.php')):
			require '__system__/' . $URL[3] . '/' . $URL[4] . '.php';
		else:
			require '__system__/404.php';
		endif;
	else:
		require '__system__/404.php';
	endif;
	
	//print_r($URL);
?>