<?php 
    // if(isXmlHttpRequest()) {
     echo "<pre>";
        if(isset($_POST['name_usu'])) {
            $json = array();
            $json['email'] = $_POST['email_usu'];
            $json['nome'] = $_POST['name_usu'];
            $json['tipo_problema'] = $_POST['opt'];
            $json['imagem'] =  $_FILES['arquivo_img'];
            $json['descricao'] = $_POST['txt_usu'];
            print_r($json);
            
    } echo "</pre>";

 ?>