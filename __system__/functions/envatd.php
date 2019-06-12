<?php 
  require_once 'connection/conn.php';
  if(isXmlHttpRequest()) {
    $json['status'] = 1;
    $json['error_list'] = array();

    if(empty($_POST["name_usu"])) {
      $json['error_list']['#name_usu'] = "<p class='msgErrorCad'>Por favor, insira seu nome neste campo</p>";
    } else {
      if (!preg_match("/[\p{Latin}\d]+/i",$_POST["name_usu"])) {
        $json["error_list"]["#name_usu"] = "<p class='msgErrorCad'>Por favor, somente somente letras ou espaços neste campo</p>";
      }
    }

    if(empty($_POST["email_usu"])) {
      $json['error_list']['#email_usu'] = "<p class='msgErrorCad'>Por favor, insira seu e-mail neste campo</p>";
    } else {
      if(!filter_var($_POST["email_usu"], FILTER_VALIDATE_EMAIL)) {
				$json["error_list"]["#email_usu"] = "<p class='msgErrorCad'>Por favor, insira um e-mail válido neste campo</p>";
			}
    }

    if(empty($_POST["opt"])) {
      $json['error_list']['#opt'] = "<p class='msgErrorCad'>Por favor, escolha o conteúdo da mensagem</p>";
    }

    if(empty($_POST["txt_usu"])) {
      $json['error_list']['#txt_usu'] = "<p class='msgErrorCad'>Por favor, comente sua mensagem neste campo</p>";
    }

    if(!empty($json["error_list"])){
      $json["status"] = 0;
    } else{
      $sql = "INSERT INTO atendimento(nome_usu,email_usu,tp_problema,desc_problema) VALUES('{$_POST["name_usu"]}','{$_POST["email_usu"]}','{$_POST["opt"]}','{$_POST["txt_usu"]}')";

      if(!$conn->exec($sql)) {
        $json['status'] = 0;
        $json['error_list']['#btnAtend'] = "Um erro inesperado ocorreu! Estamos trabalhando para corrigí-lo";
      }
    }

    echo json_encode($json);
  }
?>