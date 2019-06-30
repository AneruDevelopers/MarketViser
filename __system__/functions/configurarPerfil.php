<?php
    require_once 'connection/conn.php';

    if(isXmlHttpRequest()) {
        $json = array();
        if(isset($_POST["senha_atual"])) {
            $json["status"] = 1;
            $json["error_list"] = array();

            if(empty($_POST["senha_atual"])) {
                $json["error_list"]["#senha_atual"] = "<p style='width=100%;text-align:center;margin-bottom:-20px;color#333;'>Insira sua senha atual neste campo</p>";
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
                            $json["error_list"]["#senha_nova"] = "<p style='width=100%;text-align:center;margin-bottom:-20px;color#333;'>Insira uma nova senha neste campo</p>";
                        } else {
                            if(strpos($_POST["senha_nova"], " ") != FALSE) {
                                $json["error_list"]["#senha_nova"] = "<p style='width=100%;text-align:center;margin-bottom:-20px;color#333;'>Não pode haver espaços, por favor!</p>";
                            } else {
                                if((strlen($_POST["senha_nova"]) < 6) || (strlen($_POST["senha_nova"]) > 14)) {
                                    $json["error_list"]["#senha_nova"] = "<p style='width=100%;text-align:center;margin-bottom:-20px;color#333;'>Por favor, mínimo de 6 caracteres e máximo de 14!</p>";
                                } else {
                                    if (!preg_match("(^[a-zA-Z0-9]+([a-zA-Z\_0-9\.-]*))", $_POST["senha_nova"]) ) {
                                        $json["error_list"]["#senha_nova"] = "<p style='width=100%;text-align:center;margin-bottom:-20px;color#333;'>Apenas letras e números</p>";
                                    } else {
                                        if($_POST["senha_nova"] != $_POST["senha_nova_confirme"]) {
                                            $json["error_list"]["#senha_nova"] = "";
                                            $json["error_list"]["#senha_nova_confirme"] = "<p style='width=100%;text-align:center;margin-bottom:-20px;color#333;'>Senhas não conferem!</p>";
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        $json["error_list"]["#senha_atual"] = "<p style='width=100%;text-align:center;margin-bottom:-20px;color#333;'>Senha atual incorreta</p>";
                    }
                } else {
                    $json["error_list"]["#senha_atual"] = "<p style='width=100%;text-align:center;margin-bottom:-20px;color#333;'>Senha atual incorreta</p>";
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
            while($v = $sel->fetch( PDO::FETCH_ASSOC )) {
                $json['tipo_tel'][] = $v;
            }
        } elseif(isset($_POST['deletaTel'])) {
            $json["status"] = 1;
            $json["error"] = NULL;

            $sel = $conn->prepare("SELECT tel_id FROM telefone WHERE usu_id=:id");
            $sel->bindValue(":id", "{$_SESSION['inf_usu']['usu_id']}");
            $sel->execute();
            if($sel->rowCount() == 1) {
                $json['status'] = 0;
                $json["error"] = "Obrigatório ter pelo menos um telefone!";
            } else {
                $del = $conn->prepare("DELETE FROM telefone WHERE tel_id=:id");
                $del->bindValue(":id", "{$_POST['deletaTel']}");
                if(!$del->execute()) {
                    $json['status'] = 0;
                    $json["error"] = "Ocorreu um erro ao deletar!";
                }
            }
        } elseif(isset($_POST['add_tel'])) {
            $json["status"] = 1;

            $sel = $conn->prepare("SELECT COUNT(tel_id) AS qtd_tel FROM telefone WHERE usu_id=:id");
            $sel->bindValue(":id", "{$_SESSION['inf_usu']['usu_id']}");
            $sel->execute();
            $row = $sel->fetch( PDO::FETCH_ASSOC );
            if($row['qtd_tel'] == 5) {
                $json['status'] = 0;
            } else {
                $sel = $conn->prepare("SELECT * FROM tipo_tel");
                $sel->execute();
                while($v = $sel->fetch( PDO::FETCH_ASSOC )) {
                    $json['tipo_tel'][] = $v;
                }
            }
        } elseif(isset($_POST['telefone'])) {
            $json["status"] = 1;
            $json["error"] = NULL;

            $count_tel = count($_POST['telefone']);

            for($c = 0; $c < $count_tel; $c++) {
                $tel_id[$c] = $_POST['tel_id'][$c];
                $telefone[$c] = $_POST['telefone'][$c];
                $tipo_tel[$c] = $_POST['tipo_tel'][$c];

                if(empty($telefone[$c]) || empty($tipo_tel[$c])) {
                    $json["error"] = "<p>Não pode haver campos vazios</p>";
                } else {
                    if(strlen($telefone[$c]) < 14) {
                        $json["error"] = "<p>Informe o(s) telefone(s) corretamente, por favor!</p>";
                    } else {
                        $sel = $conn->prepare("SELECT * FROM telefone WHERE tel_id=:id");;
                        $sel->bindValue(":id", $tel_id[$c]);
                        $sel->execute();
                        $row = $sel->fetch( PDO::FETCH_ASSOC );

                        if(($row['tel_num'] != $telefone[$c]) || 
                        ($row['tpu_tel'] != $tipo_tel[$c])) {
                            $changes[$c] = $_POST['tel_id'][$c];
                        }
                    }
                }

                if($json['error']) {
                    break;
                }
            }

            if($json['error']) {
                $json['status'] = 0;
            } else {
                if(!isset($changes)) {
                    $json['status'] = 0;
                    $json["error"] = "<p>Não houve alterações</p>";
                } else {
                    foreach($changes as $k => $v) {
                        $upd = $conn->prepare("UPDATE telefone SET tel_num='{$telefone[$k]}', tpu_tel={$tipo_tel[$k]} WHERE tel_id={$tel_id[$k]}");

                        if(!$upd->execute()) {
                            $json['status'] = 0;
                            $json["error"] = "<p>Ocorreu um erro ao alterar</p>";

                            break;
                        }
                    }
                }
            }
        } elseif(isset($_POST['tel_num'])) {
            $json["status"] = 1;
            $json["error"] = NULL;

            if(empty($_POST['tel_num'])) {
                $json["status"] = 0;
                $json["error"] = "<p>Não pode ser vazio</p>";
            } else {
                if(strlen($_POST['tel_num']) < 14) {
                    $json["status"] = 0;
                    $json["error"] = "<p>Informe o telefone corretamente, por favor!</p>";
                } else {
                    $sel = $conn->prepare("SELECT * FROM telefone WHERE usu_id=:id AND tel_num='{$_POST['tel_num']}'");
                    $sel->bindValue(":id", "{$_SESSION['inf_usu']['usu_id']}");
                    $sel->execute();
                    if($sel->rowCount() > 0) {
                        $json["status"] = 0;
                        $json["error"] = "<p>Este telefone já está cadastrado</p>";
                    } else {
                        $ins = $conn->prepare("INSERT INTO telefone(tel_num, tpu_tel, usu_id) VALUE('{$_POST['tel_num']}', {$_POST['tipo_tel']}, {$_SESSION['inf_usu']['usu_id']})");

                        if(!$ins->execute()) {
                            $json["status"] = 0;
                            $json["error"] = "<p>Ocorreu um erro ao inserir telefone</p>";
                        }
                    }
                }
            }
        } elseif(isset($_POST['mudarEnd'])) {
            $json['end'][0] = $_SESSION["inf_usu"]['usu_cep'];
            $json['end'][1] = $_SESSION["inf_usu"]['usu_end'];
            $json['end'][2] = $_SESSION["inf_usu"]['usu_num'];
            $json['end'][3] = $_SESSION["inf_usu"]['usu_complemento'];
            $json['end'][4] = $_SESSION["inf_usu"]['usu_bairro'];
            $json['end'][5] = $_SESSION["inf_usu"]['usu_cidade'];
            $json['end'][6] = $_SESSION["inf_usu"]['usu_uf'];
        } elseif(isset($_POST['end_cep'])) {
            $json["status"] = 1;
            $json["error_list"] = array();

            if(empty($_POST["end_cep"])) {
                $json["error_list"]["#end_cep"] = "<p>Por favor, insira o CEP do seu logradouro ou da sua cidade neste campo</p>";
            } else {
                if(strlen($_POST["end_cep"]) < 9) {
                    $json["error_list"]["#end_cep"] = "<p>Por favor, insira seu CEP corretamente neste campo</p>";
                } else {
                    if(empty($_POST["end_uf"])) {
                        $json["error_list"]["#end_uf"] = "<p>Por favor, insira um <b>CEP</b> válido para que o endereço seja preenchido automaticamente</p>";
                    } else {
                        if(empty($_POST["end_log"])) {
                            $json["error_list"]["#end_log"] = "<p>Por favor, insira um <b>CEP</b> válido para que o endereço seja preenchido automaticamente</p>";
                        } else {
                            if(empty($_POST["end_bairro"])) {
                                $json["error_list"]["#end_bairro"] = "<p>Por favor, insira seu bairro neste campo</p>";
                            } else {
                                if(empty($_POST["end_num"])) {
                                    $json["error_list"]["#end_num"] = "<p>Por favor, insira o <b>número</b> de sua casa neste campo</p>";
                                } else {
                                    if(!is_numeric($_POST["end_num"])) {
                                        $json["error_list"]["#end_num"] = "<p>Somente números neste campo</p>";
                                    } else {
                                        if(($_SESSION["inf_usu"]['usu_cep'] == $_POST["end_cep"]) && 
                                            ($_SESSION["inf_usu"]['usu_end'] == $_POST["end_log"]) && 
                                            ($_SESSION["inf_usu"]['usu_num'] == $_POST["end_num"]) && 
                                            ($_SESSION["inf_usu"]['usu_complemento'] == $_POST["end_comp"]) && 
                                            ($_SESSION["inf_usu"]['usu_bairro'] == $_POST["end_bairro"]) && 
                                            ($_SESSION["inf_usu"]['usu_cidade'] == $_POST["end_cid"]) && 
                                            ($_SESSION["inf_usu"]['usu_uf'] == $_POST["end_uf"])) {
                                                $json["error_list"]["#btnSaveMudarEndereco"] = "<p>Não houve alterações</p>";
                                        } else {
                                            $upd = $conn->prepare("UPDATE usuario SET usu_cep='{$_POST["end_cep"]}', usu_end='{$_POST["end_log"]}', usu_num={$_POST["end_num"]}, usu_complemento='{$_POST["end_comp"]}', usu_bairro='{$_POST["end_bairro"]}', usu_cidade='{$_POST["end_cid"]}', usu_uf='{$_POST["end_uf"]}' WHERE usu_id={$_SESSION['inf_usu']['usu_id']}");
                                            if($upd->execute()) {
                                                $_SESSION["inf_usu"]['usu_cep'] = $_POST["end_cep"];
                                                $_SESSION["inf_usu"]['usu_end'] = $_POST["end_log"];
                                                $_SESSION["inf_usu"]['usu_num'] = $_POST["end_num"];
                                                $_SESSION["inf_usu"]['usu_complemento'] = $_POST["end_comp"];
                                                $_SESSION["inf_usu"]['usu_bairro'] = $_POST["end_bairro"];
                                                $_SESSION["inf_usu"]['usu_cidade'] = $_POST["end_cid"];
                                                $_SESSION["inf_usu"]['usu_uf'] = $_POST["end_uf"];
                                            } else {
                                                $json['status'] = 0;
                                                $json["error_list"]["#btnSaveMudarEndereco"] = "<p>Ocorreu um erro ao alterar</p>";
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        echo json_encode($json);
    }
?>