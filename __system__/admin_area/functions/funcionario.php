<?php
    if(isXmlHttpRequest()) {
        $json['status'] = 1;
        $json['error'] = NULL;

        if(isset($_POST['funcionario_nome'])) {
            function validaData($dat) {
                $ret = TRUE;
                $data = explode("/","$dat");
                $d = $data[0];
                $m = $data[1];
                $y = $data[2];

                $res = checkdate($m,$d,$y);
                if(!$res) {
                   $ret = FALSE;
                }

                return $ret;
            }
            for($k=0; $k<count($_POST['funcionario_nome']); $k++) {
                $c = $k + 1;
                $funcionario_nome[$k] = $_POST['funcionario_nome'][$k];
                $funcionario_email[$k] = $_POST['funcionario_email'][$k];
                $funcionario_senha[$k] = $_POST['funcionario_senha'][$k];
                $funcionario_cpf[$k] = $_POST['funcionario_cpf'][$k];
                $funcionario_datanasc[$k] = $_POST['funcionario_datanasc'][$k];
                $funcionario_setor[$k] = $_POST['funcionario_setor'][$k];

                if(empty($funcionario_nome[$k])) {
                    $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Insira o nome do funcionário na ' . $c . 'ª parte de cadastro</b></p>';
                } else {
                    if(empty($funcionario_email[$k])) {
                        $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Insira o email do funcionário na ' . $c . 'ª parte de cadastro</b></p>';
                    } else {
                        if(!filter_var($funcionario_email[$k], FILTER_VALIDATE_EMAIL)) {
                            $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Insira um email válido do funcionário na ' . $c . 'ª parte de cadastro</b></p>';
                        } else {
                            $verifica = $conn->prepare("SELECT funcionario_email FROM funcionario WHERE funcionario_email=:email");
                            $verifica->bindValue(":email", "{$funcionario_email[$k]}");
                            $verifica->execute();
                            if($verifica->rowCount() > 0) {
                                $res = $verifica->fetchAll();
                                $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>O email ' . $res[0]['funcionario_email'] . ' que inseriu na ' . $c . 'ª parte já foi previamente cadastrado</b></p>';
                            } else {
                                if(empty($funcionario_cpf[$k])) {
                                    $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Insira o CPF do funcionário na ' . $c . 'ª parte de cadastro</b></p>';
                                } else {
                                    if(strlen($funcionario_cpf[$k]) < 14) {
                                        $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Insira um CPF válido pro funcionário na ' . $c . 'ª parte de cadastro</b></p>';
                                    } else {
                                        $verifica = $conn->prepare("SELECT funcionario_cpf FROM funcionario WHERE funcionario_cpf=:cpf");
                                        $verifica->bindValue(":cpf", "{$funcionario_cpf[$k]}");
                                        $verifica->execute();
                                        if($verifica->rowCount() > 0) {
                                            $res = $sel->fetchAll();
                                            $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>O CPF ' . $res[0]['funcionario_cpf'] . ' que inseriu na ' . $c . 'ª parte já foi previamente cadastrado</b></p>';
                                        } else {
                                            if(empty($funcionario_datanasc[$k])) {
                                                $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Insira a data de nascimento do funcionário na ' . $c . 'ª parte de cadastro</b></p>';
                                            } else {
                                                if(strlen($funcionario_datanasc[$k]) < 10) {
                                                    $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Insira uma data de nascimento válida pro funcionário na ' . $c . 'ª parte de cadastro</b></p>';
                                                } else {
                                                    $valida_data = validaData($funcionario_datanasc[$k]);
                                                    if(!$valida_data) {
                                                        $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Insira uma data de nascimento válida pro funcionário na ' . $c . 'ª parte de cadastro</b></p>';
                                                    } else {
                                                        if($funcionario_setor[$k] == "*000*") {
                                                            $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Escolha um setor pro funcionário na ' . $c . 'ª parte de cadastro</b></p>';
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
                }
                if($json['error']) {
                    break;
                }
            }

            if($json['error'] != NULL) {
                $json['status'] = 0;
            } else {
                for($k = 0; $k < count($funcionario_nome); $k++) {
                    $funcionario_senha[$k] = password_hash($funcionario_senha[$k], PASSWORD_DEFAULT);
                    $funcionario_datanasc[$k] = substr($funcionario_datanasc[$k],-4) . "-" . substr($funcionario_datanasc[$k],3,2) . "-" . substr($funcionario_datanasc[$k],0,2);
                    $json['data'] = $funcionario_datanasc[$k];
                    
                    $ins = $conn->prepare("INSERT INTO funcionario(funcionario_nome, funcionario_email, funcionario_senha, funcionario_cpf, funcionario_datanasc, funcionario_setor) VALUES ('{$funcionario_nome[$k]}', '{$funcionario_email[$k]}', '{$funcionario_senha[$k]}', '{$funcionario_cpf[$k]}', '{$funcionario_datanasc[$k]}', {$funcionario_setor[$k]})");
                
                    if(!$ins->execute()) {
                        $json['status'] = 0;
                        $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Um erro inesperado aconteceu. Tente novamente!</b></p>';
                        break;
                    }
                }
            }

        }
        echo json_encode($json);
    }
?>