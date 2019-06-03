<?php
    if(isXmlHttpRequest()) {
        $json['status'] = 1;

        if(isset($_POST['categ_nome'])) {
            $json['error_list'] = array();

            for($k=0; $k<count($_POST['categ_nome']); $k++) {
                $categ_nome = $_POST['categ_nome'][$k];
                $subcateg_id = $_POST['subcateg_id'][$k];
                
                $ins = $conn->prepare("INSERT INTO categ(categ_nome, subcateg_id) VALUES ('$categ_nome', '$subcateg_id')");
                if(!$ins->execute()) {
                    $json['status'] = 0;
                }
            }
        }
        
        echo json_encode($json);
    }
?>