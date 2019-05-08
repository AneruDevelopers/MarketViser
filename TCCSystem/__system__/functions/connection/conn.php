<?php 
	session_start();

	// Padronizando a busca por arquivos via URL
	function base_url() {
		return "http://localhost/BackupGit/economize/TCCSystem/__system__/";
	}
	function base_url_php() {
		return "http://localhost/BackupGit/economize/TCCSystem/";
	}
	function base_url_adm() {
		return "http://localhost/BackupGit/economize/TCCSystem/__system__/admin_area/";
	}

	$servername = "localhost";
	$username = "root";
	$password = "senhadopedro";
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