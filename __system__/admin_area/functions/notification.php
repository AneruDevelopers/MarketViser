<?php
    if(isXmlHttpRequest()) {
        $json['status'] = 1;
        if(isset($_POST['id_atd'])) {
            $sel = $conn->prepare("SELECT * FROM dados_atend_func WHERE atendimento_id={$_POST['id_atd']} AND funcionario_id={$_SESSION['inf_func']['funcionario_id']}");
            $sel->execute();
            if($sel->rowCount() == 0) {
                $ins = $conn->prepare("INSERT INTO dados_atend_func(atendimento_id, funcionario_id) 
                    VALUES({$_POST['id_atd']}, {$_SESSION['inf_func']['funcionario_id']})");
                if(!$ins->execute()) {
                    $json['status'] = 0;
                }
            } else {
                $json['status'] = 0;
            }
        } elseif(isset($_POST['id_func'])) {
            $sel = $conn->prepare("SELECT id_atd FROM atendimento");
            $sel->execute();
            if($sel->rowCount() > 0) {
                $res = $sel->fetchAll();
                foreach($res as $v) {
                    $sel2 = $conn->prepare("SELECT dados_id FROM dados_atend_func WHERE atendimento_id={$v['id_atd']} AND funcionario_id={$_SESSION['inf_func']['funcionario_id']}");
                    $sel2->execute();
                    if($sel2->rowCount() == 0) {
                        $ins = $conn->prepare("INSERT INTO dados_atend_func(atendimento_id, funcionario_id) VALUES({$v['id_atd']}, {$_SESSION['inf_func']['funcionario_id']})");
                        if(!$ins->execute()) {
                            $json['status'] = 1;
                            break;
                        }
                    }
                }
            }
        } else {
            // Saída Datetime
            // object(DateInterval)[3]
            //     public 'y' => int 1
            //     public 'm' => int 0
            //     public 'd' => int 0
            //     public 'h' => int 0
            //     public 'i' => int 0
            //     public 's' => int 0
            //     public 'weekday' => int 0
            //     public 'weekday_behavior' => int 0
            //     public 'first_last_day_of' => int 0
            //     public 'invert' => int 0
            //     public 'days' => int 365
            //     public 'special_type' => int 0
            //     public 'special_amount' => int 0
            //     public 'have_weekday_relative' => int 0
            //     public 'have_special_relative' => int 0

            $json['noVisu'] = 0;
            $json['notificationVisu'] = array();
            $json['notificationNoVisu'] = array();

            $sel = $conn->prepare("SELECT a.id_atd, a.nome_usu, a.dataenv_pro, ar.resp_id FROM dados_atend_func AS d JOIN atendimento AS a ON d.atendimento_id=a.id_atd LEFT JOIN atend_resposta AS ar ON ar.id_atd=a.id_atd WHERE d.funcionario_id={$_SESSION['inf_func']['funcionario_id']} ORDER BY a.dataenv_pro DESC");
            $sel->execute();
            if($sel->rowCount() > 0) {
                $res = $sel->fetchAll();
                foreach($res as $v) {
                    $now = new DateTime();
                    $data_registro = new DateTime($v['dataenv_pro']);
                    $intervalo = $now->diff($data_registro);

                    if($intervalo->d > 0) {
                        if($intervalo->d == 1) {
                            $v['dataenv_pro'] = "Ontem às " . substr($v['dataenv_pro'],11,2) . "h" . substr($v['dataenv_pro'],14,2);
                        } else {
                            $v['dataenv_pro'] = substr($v['dataenv_pro'],8,2) . "/" . substr($v['dataenv_pro'],5,2) . "/" . substr($v['dataenv_pro'],0,4) . " às " . substr($v['dataenv_pro'],11,2) . "h" . substr($v['dataenv_pro'],-2);
                        }
                    } else {
                        if($intervalo->h > 0) {
                            if($intervalo->h == 1) {
                                $v['dataenv_pro'] = "Há " . $intervalo->h . " hora";
                            } else {
                                $v['dataenv_pro'] = "Há " . $intervalo->h . " horas";
                            }
                        } else {
                            if($intervalo->i > 0) {
                                if($intervalo->i == 1) {
                                    $v['dataenv_pro'] = "Há " . $intervalo->i . " minuto";
                                } else {
                                    $v['dataenv_pro'] = "Há " . $intervalo->i . " minutos";
                                }
                            } else {
                                if($intervalo->s <= 15) {
                                    $v['dataenv_pro'] = "Agora mesmo";
                                } else {
                                    $v['dataenv_pro'] = "Há alguns instantes";
                                }
                            }
                        }
                    }

                    $json['notificationVisu'][] = $v;
                }
            }
            
            $sel = $conn->prepare("SELECT a.id_atd, a.nome_usu, a.dataenv_pro, ar.resp_id FROM atendimento AS a LEFT JOIN atend_resposta AS ar ON ar.id_atd=a.id_atd ORDER BY a.dataenv_pro DESC");
            $sel->execute();
            if($sel->rowCount() > 0) {
                $res = $sel->fetchAll();
                foreach($res as $v) {
                    $sel2 = $conn->prepare("SELECT dados_id FROM dados_atend_func WHERE atendimento_id={$v['id_atd']} AND funcionario_id={$_SESSION['inf_func']['funcionario_id']}");
                    $sel2->execute();
                    if($sel2->rowCount() == 0) {
                        $now = new DateTime();
                        $data_registro = new DateTime($v['dataenv_pro']);
                        $intervalo = $now->diff($data_registro);
        
                        if($intervalo->d > 0) {
                            if($intervalo->d == 1) {
                                $v['dataenv_pro'] = "Ontem às " . substr($v['dataenv_pro'],11,2) . "h" . substr($v['dataenv_pro'],14,2);
                            } else {
                                $v['dataenv_pro'] = substr($v['dataenv_pro'],8,2) . "/" . substr($v['dataenv_pro'],5,2) . "/" . substr($v['dataenv_pro'],0,4) . " às " . substr($v['dataenv_pro'],11,2) . "h" . substr($v['dataenv_pro'],-2);
                            }
                        } else {
                            if($intervalo->h > 0) {
                                if($intervalo->h == 1) {
                                    $v['dataenv_pro'] = "Há " . $intervalo->h . " hora";
                                } else {
                                    $v['dataenv_pro'] = "Há " . $intervalo->h . " horas";
                                }
                            } else {
                                if($intervalo->i > 0) {
                                    if($intervalo->i == 1) {
                                        $v['dataenv_pro'] = "Há " . $intervalo->i . " minuto";
                                    } else {
                                        $v['dataenv_pro'] = "Há " . $intervalo->i . " minutos";
                                    }
                                } else {
                                    if($intervalo->s <= 15) {
                                        $v['dataenv_pro'] = "Agora mesmo";
                                    } else {
                                        $v['dataenv_pro'] = "Há alguns instantes";
                                    }
                                }
                            }
                        }
        
                        $json['noVisu']++;
                        $json['notificationNoVisu'][] = $v;
                    }
                }
            }
        }

        echo json_encode($json);
    }
?>