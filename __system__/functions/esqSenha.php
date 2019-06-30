<?php
    require_once 'connection/conn.php';
    require_once '__system__/functions/email/recmail.php';

    function gerar_senha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos) {
        $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
        $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
        $nu = "0123456789"; // $nu contem os números
        $si = "!@#$&*_+="; // $si contem os símbolos
        $senha = "";
       
        if ($maiusculas) {
              // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
              $senha .= str_shuffle($ma);
        }
       
        if ($minusculas) {
            // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($mi);
        }
    
        if ($numeros) {
            // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($nu);
        }
    
        if ($simbolos) {
            // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($si);
        }
    
        // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
        return substr(str_shuffle($senha),0,$tamanho);
    }

    if(isXmlHttpRequest()) {
        if(isset($_POST["usu_email"])) {
            $json = array();
            $json["status"] = 1;
            $json["error"] = NULL;

            $verifica = $conn->prepare("SELECT usu_first_name FROM usuario WHERE usu_email=:email");
            $verifica->bindValue(":email", "{$_POST["usu_email"]}");
            $verifica->execute();
            if($verifica->rowCount() ==  0) {
                $json["status"] = 0;
                $json["error"] = "Esse email não existe em nossa base de dados";
            } else {
                while($row = $verifica->fetch( PDO::FETCH_ASSOC )) {
                    $name = $row['usu_first_name'];
                }
                $mail = $_POST["usu_email"];

                $new_password = gerar_senha(10, true, true, true, true);
                $hash_password = password_hash($new_password, PASSWORD_DEFAULT);

                $upd = $conn->prepare("UPDATE usuario SET usu_senha='{$hash_password}' WHERE usu_email='{$mail}'");
                if($upd->execute()) {
                    if(!env_email_rec($mail, $name, $new_password)) {
                        $json["status"] = 0;
                        $json["error"] = "Não conseguimos enviar o email, tente novamente, por favor!";
                    }
                } else {
                    $json["status"] = 0;
                    $json["error"] = "Não conseguimos mudar a senha, tente novamente, por favor!";
                }
            }
        }

        echo json_encode($json);
    }
?>