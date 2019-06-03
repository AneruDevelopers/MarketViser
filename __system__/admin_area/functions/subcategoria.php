<?php
    if(isXmlHttpRequest()) {
        $json['status'] = 1;

        if(isset($_POST['subcateg_nome'])) {
            $json['error_list'] = array();

            for($k=0; $k<count($_POST['subcateg_nome']); $k++) {
                $subcateg_nome = $_POST['subcateg_nome'][$k];
                $depart_id = $_POST['depart_id'][$k];
                
                $ins = $conn->prepare("INSERT INTO subcateg(subcateg_nome,depart_id) VALUES ('$subcateg_nome','$depart_id')");
                if(!$ins->execute()) {
                    $json['status'] = 0;
                }
            }
        }
        
        echo json_encode($json);
    }
?>