<?php
date_default_timezone_set('America/Sao_Paulo');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
function env_email($email,$nome,$link){
	 
	$mail = new PHPMailer(true);

	try {
		//Server settings
		$mail->SMTPDebug = 0;                                       // Enable verbose debug output
		$mail->isSMTP();                                            // Set mailer to use SMTP
		$mail->Host       = 'host.sdserver18.com ';  // Specify main and backup SMTP servers
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = 'accounts@economize.top';                     // SMTP username
		$mail->Password   = 'i&dd)mx#6m)2';                               // SMTP password
		$mail->SMTPSecure = "ssl";                                  // Enable TLS encryption, `ssl` also accepted
		$mail->Port       = 465;                                    // TCP port to connect to
		$mail->setLanguage('pt-br', '/optional/path/to/language/directory/');
		$mail->CharSet = 'UTF-8';
		//Recipients
		$mail->setFrom('accounts@economize.top', 'e.conomize');
		$mail->addAddress($email, $nome);     // Add a recipient

		// Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'Olá '.$nome.', Bem-Vindo ao e.conomize';
		$mail->Body    = 'Por-Favor verifique sua conta.<a href="'.$link.'">Clique aqui para confirmar seu e-mail</a><br> <br>';
		$mail->AltBody = 'e.conomize confirme seu e-mail.';
	
		$mail->send();
		
	} catch (Exception $e) {
		//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
 }
?>
