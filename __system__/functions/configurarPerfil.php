<?php
    require_once 'connection/conn.php';

    if(isXmlHttpRequest()) {
        $json = array();
        if(isset($_POST["senha_atual"])) {
            $json["status"] = 1;
            $json["error_list"] = array();

            if(empty($_POST["senha_atual"])) {
                $json["error_list"]["#senha_atual"] = "<p class='msgErrorCad'>Por favor, insira sua senha atual neste campo</p>";
            } else {
                $sel = $conn->prepare("SELECT usu_senha FROM usuario WHERE usu_id=:id");
                $sel->bindValue(":id", "{$_SESSION['inf_usu']['usu_id']}");
                $sel->execute();
                
                if($sel->rowCount() > 0) {
                    $rows = $sel->fetchAll();
                    foreach($rows as $row) {
                        $senha = $row["usu_senha"];
                    }
                    if(password_verify($_POST["senha_atual"], $senha)) {
                        if(empty($_POST["senha_nova"])) {
                            $json["error_list"]["#senha_nova"] = "<p class='msgErrorCad'>Por favor, insira uma nova senha neste campo</p>";
                        } else {
                            if(strpos($_POST["senha_nova"], " ") != FALSE) {
                                $json["error_list"]["#senha_nova"] = "<p class='msgErrorCad'>Não pode haver espaços, por favor!</p>";
                            } else {
                                if((strlen($_POST["senha_nova"]) < 6) || (strlen($_POST["senha_nova"]) > 14)) {
                                    $json["error_list"]["#senha_nova"] = "<p class='msgErrorCad'>Por favor, mínimo de 6 caracteres e máximo de 14!</p>";
                                } else {
                                    if (!preg_match("(^[a-zA-Z0-9]+([a-zA-Z\_0-9\.-]*))", $_POST["senha_nova"]) ) {
                                        $json["error_list"]["#senha_nova"] = "<p class='msgErrorCad'>Apenas letras e números</p>";
                                    } else {
                                        if($_POST["senha_nova"] != $_POST["senha_nova_confirme"]) {
                                            $json["error_list"]["#senha_nova"] = "";
                                            $json["error_list"]["#senha_nova_confirme"] = "<p class='msgErrorCad'>Senhas não conferem!</p>";
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        $json["error_list"]["#senha_atual"] = "<p class='msgErrorCad'>Senha atual incorreta</p>";
                    }
                } else {
                    $json["error_list"]["#senha_atual"] = "<p class='msgErrorCad'>Senha atual incorreta</p>";
                }
            }

            if(!empty($json['error_list'])) {
                $json['status'] = 0;
            } else {
                $_POST["senha_nova"] = password_hash($_POST["senha_nova"], PASSWORD_DEFAULT);
                $up = $conn->prepare("UPDATE usuario SET usu_senha=:ns");
                $up->bindValue(":ns", "{$_POST["senha_nova"]}");
                if(!$up->execute()) {
                    $json["error_list"]["#btnSaveMudarSenha"] = "<p style='color: red;'>Erro ao mudar senha, tente novamente.</p>";
                }
            }
        } elseif(isset($_POST['show_tel'])) {
            $sel = $conn->prepare("SELECT * FROM telefone AS t JOIN tipo_tel AS tt ON t.tpu_tel=tt.tpu_tel_id WHERE t.usu_id=:id");
            $sel->bindValue(":id", "{$_SESSION['inf_usu']['usu_id']}");
            $sel->execute();
            $res = $sel->fetchAll();

            foreach($res as $v) {
                $json['tel'][] = $v;
            }

            $sel = $conn->prepare("SELECT * FROM tipo_tel");
            $sel->execute();
            $res = $sel->fetchAll();
            foreach($res as $v) {
                $json['tipo_tel'][] = $v;
            }
        }

        echo json_encode($json);
    }
?>