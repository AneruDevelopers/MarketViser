<?php
    if(isXmlHttpRequest()) {
        $json['status'] = 1;
        $json['error'] = NULL;

        if(isset($_POST['subcateg_nome'])) {
            for($k=0; $k<count($_POST['subcateg_nome']); $k++) {
                $c = $k + 1;
                $subcateg_nome[$k] = $_POST['subcateg_nome'][$k];
                $depart_id[$k] = $_POST['depart_id'][$k];

                if(empty($subcateg_nome[$k])) {
                    $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Insira o nome da subcategoria na ' . $c . 'ª parte de cadastro</b></p>';
                } else {
                    if($depart_id[$k] == "*000*") {
                        $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Insira o departamento da subcategoria na ' . $c . 'ª parte de cadastro</b></p>';
                    } else {
                        $sel = $conn->prepare("SELECT s.subcateg_nome, d.depart_nome FROM subcateg AS s JOIN departamento AS d ON s.depart_id=d.depart_id WHERE s.subcateg_nome='{$subcateg_nome[$k]}' AND d.depart_id={$depart_id[$k]}");
                        $sel->execute();
                        if($sel->rowCount() > 0) {
                            $res = $sel->fetchAll();
                            $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>A subcategoria ' . $res[0]['depart_nome'] . ' / ' . $res[0]['subcateg_nome'] . ' que inseriu na ' . $c . 'ª parte já foi previamente cadastrada</b></p>';
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
                for($k=0; $k<count($subcateg_nome); $k++) {
                    $ins = $conn->prepare("INSERT INTO subcateg(subcateg_nome,depart_id) VALUES ('{$subcateg_nome[$k]}','{$depart_id[$k]}')");
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