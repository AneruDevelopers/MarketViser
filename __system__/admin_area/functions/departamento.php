<?php
    if(isXmlHttpRequest()) {
        $json['status'] = 1;

        if(isset($_POST['depart_nome'])) {
            $json['error_list'] = array();

            for($k=0; $k<count($_POST['depart_nome']); $k++) {
                $depart_nome = $_POST['depart_nome'][$k];
                $depart_icon = $_POST['depart_icon'][$k];
                $depart_desc = $_POST['depart_desc'][$k];

                if($depart_desc != "") {
                    $ins = $conn->prepare("INSERT INTO departamento(depart_nome,depart_icon,depart_desc) VALUES ('$depart_nome','$depart_icon','$depart_desc')");
                } else {
                    $ins = $conn->prepare("INSERT INTO departamento(depart_nome,depart_icon) VALUES ('$depart_nome','$depart_icon')");
                }
                if(!$ins->execute()) {
                    $json['status'] = 0;
                }
            }
        }
        
        echo json_encode($json);
    }
?>