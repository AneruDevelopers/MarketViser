<?php 
	session_start();
	
	// Ajustando horário
	date_default_timezone_set("America/Sao_Paulo");
	setlocale(LC_ALL, 'pt_BR');

	// Padronizando a busca por arquivos via URL
	function base_url() {
		return "http://localhost/economize/__system__/";
	}
	function base_url_php() {
		return "http://localhost/economize/";
	}
	function base_url_adm() {
		return "http://localhost/economize/__system__/admin_area/";
	}
	function base_url_adm_php() {
		return "http://localhost/economize/admin_area/";
	}

	// FUNÇÃO VERIFICA SE A REQUISIÇÃO FEITA AO SERVIDOR É VIA AJAX
	function isXmlHttpRequest() {
    	$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? $_SERVER['HTTP_X_REQUESTED_WITH'] : null;
    	return (strtolower($isAjax) === 'xmlhttprequest');
	}

	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "economize";

	try {
    	$conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    	$conn->exec("SET CHARACTER SET utf8");
    	// set the PDO error mode to exception
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
    	die("Erro na conexão: " . $e->getCode());
    }
?>