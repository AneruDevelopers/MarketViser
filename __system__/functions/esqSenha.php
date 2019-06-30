<?php
require_once 'connection/conn.php';
require_once '__system__/functions/email/recmail.php';
	if(isset($_POST["usu_email"])) {
		$json = array();
        $verifica = $conn->prepare("SELECT usu_email FROM usuario WHERE usu_email=:email");
        $verifica->bindValue(":email", "{$_POST["usu_email"]}");
        $verifica->execute();
        if($verifica->rowCount() ==  0) {
            $json["error_list"]["#usu_email"] = "<p class='msgErrorCad'>Esse email já foi cadastrado anteriormente</p>";
        } 
        else{
            $rows = $sel->fetchAll();
            foreach($rows as $row) {
            $token = base_url_php()."usuario/esqueceu-senha?idtoken=".$row['usu_id'];
            $nome = $row['usu_first_name'];
            $email = $row['usu_email'];
            }
           if(env_email_rec($email,$nome,$token)){
            $json["status"] = 1;    
           }
           else{
            $json["status"] = 0;     
           }
            
           
        }


    }
 echo json_encode($json);
?>