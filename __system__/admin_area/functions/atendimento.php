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
                }
            }
        }

        echo json_encode($json);
    }
?>