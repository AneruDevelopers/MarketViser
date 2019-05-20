<?php 
	require_once 'connection/conn.php';

    if(isXmlHttpRequest()) {
        if(isset($_POST["usu_cep"])) {
            $json = array();
            $json["status"] = 1;
            $json["error_list"] = array();
            $json['armazem'] = 1;
            
            if(empty($_POST["usu_cep"])) {
                $json["error_list"]["#usu_cep"] = "<p class='msgErrorCad'>Por favor, insira seu CEP neste campo</p>";
            } else {
                if(strlen($_POST['usu_cep']) < 9) {
                    $json["error_list"]["#usu_cep"] = "<p class='msgErrorCad'>Por favor, insira seu CEP corretamente neste campo</p>";
                } else {
                    if(empty($_POST["usu_end"])) {
                        $json["error_list"]["#usu_end"] = "<p class='msgErrorCad'>Por favor, insira um <b>CEP</b> válido para que o endereço seja preenchido automaticamente</p>";
                    } else {
                        if(empty($_POST["usu_num"])) {
                            $json["error_list"]["#usu_num"] = "<p class='msgErrorCad'>Por favor, insira o <b>número</b> de sua casa neste campo</p>";
                        } else {
                            if(!is_numeric($_POST["usu_num"])) {
                                $json["error_list"]["#usu_num"] = "<p class='msgErrorCad'>Somente números neste campo</p>";
                            } else {
                                $cid = $_POST["usu_cidade"];
                                $verifica = $conn->prepare("SELECT * FROM cidade AS c JOIN armazem AS a ON a.cidade_id=c.cid_id WHERE a.armazem_id={$_SESSION['arm_id']}");
                                $verifica->execute();
                                if($verifica->rowCount() > 0) {
                                    $permition = array();
                                    $res = $verifica->fetchAll();
                                    foreach($res as $v) {
                                        if($cid != $v['cid_nome']) {
                                            $regiao = explode(" - ", $v['cid_regiao']);
                                            foreach($regiao as $val) {
                                                if($cid == $val) {
                                                    $permition[] = 1;
                                                }
                                            }
                                        } else {
                                            $permition[] = 1;
                                        }
                                    }
        
                                    if(empty($permition)) {
                                        $json['status'] = 0;
                                        $json['armazem'] = 0;
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if((!empty($json['error_list'])) && ($json['armazem'])) {
                $json['status'] = 0;
            } else {
                $_SESSION['end_cep'] = $_POST['usu_cep'];
                $_SESSION['end_end'] = $_POST['usu_end'];
                $_SESSION['end_num'] = $_POST['usu_num'];
                $_SESSION['end_complemento'] = $_POST['usu_complemento'];
                $_SESSION['end_bairro'] = $_POST['usu_bairro'];
                $_SESSION['end_cidade'] = $_POST['usu_cidade'];
                $_SESSION['end_uf'] = $_POST['usu_uf'];
                
                if(strlen(trim($_POST['usu_complemento'])) > 0) {
                    $json['agend_end'] = $_POST['usu_cep'] . ", " . $_POST['usu_end'] . " nº " . $_POST['usu_num'] . " - " . $_POST['usu_complemento'] . ", " . $_POST['usu_bairro'] . ", ". $_POST['usu_cidade'] . " - " . $_POST['usu_uf'];
                } else {
                    $json['agend_end'] = $_POST['usu_cep'] . ", " . $_POST['usu_end'] . " nº " . $_POST['usu_num'] . ", " . $_POST['usu_bairro'] . ", ". $_POST['usu_cidade'] . " - " . $_POST['usu_uf'];
                }
            }
            
            echo json_encode($json);
        } elseif(isset($_POST['entrega_horario'])) {
            $json['recebeu'] = $_POST['entrega_horario'];
            $_SESSION['agend_horario'] = $_POST['entrega_horario'];
            echo json_encode($json);
        } else {
            $sel = $conn->prepare("SELECT * FROM dados_horario_entrega AS d JOIN horarios_entrega AS h ON d.dados_horario=h.hora_id JOIN armazem AS a ON d.dados_armazem=a.armazem_id WHERE a.armazem_id={$_SESSION['arm_id']} AND h.dia=" . Date('N') . " ORDER BY h.hora");
            $sel->execute();
            $res = $sel->fetchAll();
            $i = 1;
            foreach($res as $k => $v) {
                if(Date("H") < $v['hora']) {
                    $hora = substr($v['hora'],0,2) . "h" . substr($v['hora'],3,2);
                    if($i==1) {
                        $hora_disp[] = '<input type="radio" checked name="entrega_horario" id="hora' . $v['hora_id'] . '" value="' . $v['hora'] . '"/> <label for="hora' . $v['hora_id'] . '">' . $hora . "</label><br/>";
                    } else {
                        $hora_disp[] = '<input type="radio" name="entrega_horario" id="hora' . $v['hora_id'] . '" value="' . $v['hora'] . '"/> <label for="hora' . $v['hora_id'] . '">' . $hora . "</label><br/>";
                    }
                }
                $i++;
            }
            if(!empty($hora_disp)) {
                echo '<form id="hora_agend">';
                foreach($hora_disp as $v) {
                    echo $v;
                }
                echo '
                        <button class="btnAgenda" type="submit"><i class="far fa-clock"></i> AGENDAR</button>
                    </form>
                ';
            } else {
                echo 'Não há mais horários disponíveis para entrega hoje. Volte amanhã, por favor!! <a href="#">Veja os horários</a>';
            }
        }
    } else {
        header('Location: ../');
    }
?>