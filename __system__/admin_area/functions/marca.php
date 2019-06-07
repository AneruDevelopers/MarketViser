<?php
    if(isXmlHttpRequest()) {
        $json['status'] = 1;
        $json['error'] = NULL;
        
        if(isset($_POST['marca_nome'])) {
            for($k=0; $k<count($_POST['marca_nome']); $k++) {
                $c = $k + 1;
                $marca_nome[$k] = $_POST['marca_nome'][$k];

                if(empty($marca_nome[$k])) {
                    $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Insira o nome da marca na ' . $c . 'ª parte de cadastro</b></p>';
                } else {
                    $sel = $conn->prepare("SELECT marca_nome FROM marca_prod WHERE marca_nome='{$marca_nome[$k]}'");
                    $sel->execute();
                    if($sel->rowCount() > 0) {
                        $res = $sel->fetchAll();
                        $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>A marca ' . $res[0]['marca_nome'] . ' que inseriu na ' . $c . 'ª parte já foi previamente cadastrada</b></p>';
                    }
                }

                if($json['error']) {
                    break;
                }
            }

            if($json['error']) {
                $json['status'] = 0;
            } else {
                for($k=0; $k<count($marca_nome); $k++) {
                    $ins = $conn->prepare("INSERT INTO marca_prod(marca_nome) VALUES ('{$marca_nome[$k]}')");
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