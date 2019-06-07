<?php 
   if(isXmlHttpRequest()) {
    
require_once 'connection/conn.php';
     
        $json['msg'] = array(); 
        $json['error'] = array();

        if (empty($_POST["name_usu"])) {
          $json['error']['name'] = "Você esqueceu de colocar seu nome";
        }      
       if (empty($_POST["email_usu"])) {
        $json['error']['name'] = "Você esqueceu de colocar seu Email";
       }
      
     if (empty($_POST["opt"])) {
       $json['error']['name'] = "Você esqueceu de escolher um tipo de problema";
     }  
      if (empty($_POST["txt_usu"])) {
       $json['error']['name'] = "Você esqueceu de descrever o problema";
      }                 
    if (!empty($json["error"])){
      $json["msg"] = "Existe algum erro";
     }
    else{
     $sql = "INSERT INTO atendimento(nome_usu,email_usu,tp_problema,desc_problema) VALUES('{$_POST["name_usu"]}','{$_POST["email_usu"]}','{$_POST["opt"]}','{$_POST["txt_usu"]}')";
   
 if ($conn->exec($sql)) {
        $json['msg'] = "Enviado com Sucesso";
      } 
      else{
       $json['msg'] = "Não foi Enviado";
      }
}


      echo json_encode($json);
    }
 ?>