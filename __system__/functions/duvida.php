<?php
    require_once 'connection/conn.php';

    if(isXmlHttpRequest()) {
        $json['status'] = 1;

        if(isset($_POST['duvida_id'])) {
            $sel = $conn->prepare("SELECT duvida_resposta FROM duvida_frequente WHERE duvida_id={$_POST['duvida_id']}");
            if($sel->execute()) {
                if($sel->rowCount() > 0) {
                    $resp = $sel->fetch( PDO::FETCH_ASSOC );
                    $json['duvida_resposta'] = $resp['duvida_resposta'];
                } else {
                    $json['status'] = 0;
                }
            } else {
                $json['status'] = 0;
            }
        } elseif(isset($_POST['searchDuvida'])) {
            $json['empty'] = TRUE;
            $sel = $conn->prepare("SELECT duvida_id, duvida_pergunta FROM duvida_frequente WHERE duvida_pergunta LIKE '%{$_POST['searchDuvida']}%' OR duvida_resposta LIKE '%{$_POST['searchDuvida']}%' ORDER BY duvida_pergunta");
            if($sel->execute()) {
                if($sel->rowCount() > 0) {
                    $json['empty'] = FALSE;
                    while($row = $sel->fetch( PDO::FETCH_ASSOC )) {
                        $json['duvidas'][] = $row;
                    }
                }
            } else {
                $json['status'] = 0;
            }
        } else {
            $json['empty'] = TRUE;
            $sel = $conn->prepare("SELECT duvida_id, duvida_pergunta FROM duvida_frequente ORDER BY duvida_pergunta");
            if($sel->execute()) {
                if($sel->rowCount() > 0) {
                    $json['empty'] = FALSE;
                    while($row = $sel->fetch( PDO::FETCH_ASSOC )) {
                        $json['duvidas'][] = $row;
                    }
                }
            } else {
                $json['status'] = 0;
            }
        }

        echo json_encode($json);
    }
?>