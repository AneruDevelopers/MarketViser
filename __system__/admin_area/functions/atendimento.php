<?php
    if(isXmlHttpRequest()) {
        $json['status'] = 1;
        $json['error'] = NULL;

        if(isset($_POST['resp_atd'])) {
            $id_atd = $_POST['id_atd'];
            $resp_atd = trim($_POST['resp_atd']);
            $func_id = $_SESSION['inf_func']['funcionario_id'];

            if(empty($id_atd)) {
                $json['error'] = '<p style="color:red;text-align:center;"><b>Ocorreu u erro. Não encontramos a identificação da mensagem</b></p>';
            } else {
                if(empty($resp_atd)) {
                    $json['error'] = '<p style="color:red;text-align:center;"><b>Preencha o campo de resposta para enviá-la</b></p>';
                } else {
                    $sel = $conn->prepare("SELECT s.setor_permicao FROM funcionario AS f JOIN setor AS s ON f.funcionario_setor=s.setor_id WHERE f.funcionario_id=$func_id");
                    $sel->execute();
                    $res = $sel->fetchAll();
                    $permicoes = explode("-", $res[0]['setor_permicao']);
                    if(!in_array("r", $permicoes)) {
                        $json['error'] = '<p style="color:red;text-align:center;"><b>Você não tem permição para responder</b></p>';
                    } else {
                        $sel = $conn->prepare("SELECT f.funcionario_nome, a.registro_resp FROM atend_resposta AS a JOIN funcionario AS f ON a.funcionario_id=f.funcionario_id WHERE id_atd=$id_atd");
                        $sel->execute();
                        if($sel->rowCount() > 0) {
                            $res = $sel->fetchAll();
                            $data = substr($res[0]['registro_resp'],8,2) . "/" . substr($res[0]['registro_resp'],5,2) . "/" . substr($res[0]['registro_resp'],0,4) . " às " . substr($res[0]['registro_resp'],-8);
                            $json['error'] = '<p style="color:red;text-align:center;"><b>Esta mensagem já foi respondida pelo(a) ' . $res[0]['funcionario_nome'] . ' em ' . $data . '</b></p>';
                        }
                    }
                }
            }

            if($json['error']) {
                $json['status'] = 0;
            } else {
                $ins = $conn->prepare("INSERT INTO atend_resposta(id_atd, funcionario_id, resp_atend) 
                    VALUES($id_atd, $func_id, '$resp_atd')");
                if(!$ins->execute()) {
                    $json['status'] = 0;
                    $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Um erro inesperado aconteceu. Tente novamente!</b></p>';
                } else {
                    require_once '__system__/functions/email/envmailAtend.php';

                    $sel = $conn->prepare("SELECT a.nome_usu, a.dataenv_pro, a.desc_problema, a.email_usu, ar.resp_atend, ar.registro_resp, f.funcionario_nome FROM atendimento AS a JOIN atend_resposta AS ar ON ar.id_atd=a.id_atd JOIN funcionario AS f ON ar.funcionario_id=f.funcionario_id WHERE a.id_atd=$id_atd");
                    $sel->execute();
                    $row = $sel->fetch( PDO::FETCH_ASSOC );

                    $exp = explode(" ", $row['dataenv_pro']);
                    $dia = explode("-", $exp[0]);
                    $row['dataenv_pro'] = $dia[2] . "/" . $dia[1] . "/" . $dia[0] . " às " . $exp[1];

                    $exp = explode(" ", $row['registro_resp']);
                    $dia = explode("-", $exp[0]);
                    $row['registro_resp'] = $dia[2] . "/" . $dia[1] . "/" . $dia[0] . " às " . $exp[1];

                    if(!envmailAtend($row['email_usu'], $row['nome_usu'], $row['funcionario_nome'], $row['desc_problema'], $row['dataenv_pro'], $row['resp_atend'], $row['registro_resp'])) {
                        $json['status'] = 0;
                        $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Um erro inesperado aconteceu ao enviar email!</b></p>';
                    }
                }
            }
        } else {
            $page = filter_input(INPUT_POST, 'page', FILTER_SANITIZE_NUMBER_INT);
            $qtd_result = filter_input(INPUT_POST, 'qtd_result', FILTER_SANITIZE_NUMBER_INT);

            $begin = ($page * $qtd_result) - $qtd_result; // Calcula o início da visualização

            $json['empty'] = TRUE;
            $json['atendimentos'] = array();
            $json['registrosMostra'] = 0;

            $sel = $conn->prepare("SELECT COUNT(id_atd) AS qtd FROM atendimento");
            $sel->execute();
            $row = $sel->fetch( PDO::FETCH_ASSOC );
            $json['registrosTotal'] = $row['qtd'];

            $sel = $conn->prepare("SELECT a.id_atd, a.nome_usu, a.tp_problema, ar.resp_id, a.dataenv_pro FROM atendimento AS a LEFT JOIN atend_resposta AS ar ON a.id_atd=ar.id_atd LIMIT $begin, $qtd_result");
            $sel->execute();
            if($sel) {
                if($sel->rowCount() > 0) {
                    $json['empty'] = FALSE;
                    while($v = $sel->fetch( PDO::FETCH_ASSOC )) {
                        $exp = explode(" ", $v['dataenv_pro']);
                        $day = explode("-", $exp[0]);
                        $v['dataenv_pro'] = $day[2] . "/" . $day[1] . "/" . $day[0] . " às " . $exp[1];

                        if($v['resp_id'] == '')
                            $v['resp_id'] = "<span class='noVisuAtend'>ESPERANDO RESPOSTA</span>";
                        else
                            $v['resp_id'] = "<span class='noVisuAtend'>ESPERANDO RESPOSTA</span>";

                        $json['atendimentos'][] = $v;
                        $json['registrosMostra']++;
                    }
                }
            } else {
                $json['status'] = 0;
            }
        }

        echo json_encode($json);
    }
?>