<?php
    if(isXmlHttpRequest()) {
        $json['status'] = 1;
        $json['error'] = NULL;
        
        if(isset($_POST['duvida_pergunta'])) {
            for($k=0; $k<count($_POST['duvida_pergunta']); $k++) {
                $c = $k + 1;
                $duvida_pergunta[$k] = $_POST['duvida_pergunta'][$k];
                $duvida_resposta[$k] = $_POST['duvida_resposta'][$k];

                if(empty($duvida_pergunta[$k])) {
                    $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Insira a pergunta da dúvida na ' . $c . 'ª parte de cadastro</b></p>';
                } else {
                    if(empty($duvida_resposta[$k])) {
                        $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Insira a resposta da dúvida na ' . $c . 'ª parte de cadastro</b></p>';
                    } else {
                        $sel = $conn->prepare("SELECT duvida_pergunta FROM duvida_frequente WHERE duvida_pergunta='{$duvida_pergunta[$k]}'");
                        $sel->execute();
                        if($sel->rowCount() > 0) {
                            $res = $sel->fetchAll();
                            $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>A dúvida ' . $res[0]['duvida_pergunta'] . ' que inseriu na ' . $c . 'ª parte já foi previamente cadastrada</b></p>';
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
                for($k=0; $k<count($duvida_pergunta); $k++) {
                    $ins = $conn->prepare("INSERT INTO duvida_frequente(duvida_pergunta, duvida_resposta) VALUES ('{$duvida_pergunta[$k]}', '{$duvida_resposta[$k]}')");
                    
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