<?php
    if(isXmlHttpRequest()) {
        $json['status'] = 1;
        
        if(isset($_POST['marca_nome'])) {
            $json['error_list'] = array();

            for($k=0; $k<count($_POST['marca_nome']); $k++) {
                $marca_nome = $_POST['marca_nome'][$k];

                $ins = $conn->prepare("INSERT INTO marca_prod(marca_nome) VALUES ('$marca_nome')");
                if(!$ins->execute()) {
                    $json['status'] = 0;
                }
            }
        }

        echo json_encode($json);
    }
?>