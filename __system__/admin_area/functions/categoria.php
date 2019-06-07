<?php
    if(isXmlHttpRequest()) {
        $json['status'] = 1;
        $json['error'] = NULL;

        if(isset($_POST['categ_nome'])) {
            for($k=0; $k<count($_POST['categ_nome']); $k++) {
                $c = $k + 1;
                $categ_nome[$k] = $_POST['categ_nome'][$k];
                $subcateg_id[$k] = $_POST['subcateg_id'][$k];

                if(empty($categ_nome[$k])) {
                    $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Insira o nome da categoria na ' . $c . 'ª parte de cadastro</b></p>';
                } else {
                    if($subcateg_id[$k] == "*000*") {
                        $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Insira a subcategoria na ' . $c . 'ª parte de cadastro</b></p>';
                    } else {
                        $sel = $conn->prepare("SELECT c.categ_nome, s.subcateg_nome FROM categ AS c JOIN subcateg AS s ON c.subcateg_id=s.subcateg_id WHERE c.categ_nome='{$categ_nome[$k]}' AND c.subcateg_id={$subcateg_id[$k]}");
                        $sel->execute();
                        if($sel->rowCount() > 0) {
                            $res = $sel->fetchAll();
                            $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>A categoria ' . $res[0]['subcateg_nome'] . ' / ' . $res[0]['categ_nome'] . ' que inseriu na ' . $c . 'ª parte já foi previamente cadastrada</b></p>';
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
                for($k=0; $k<count($categ_nome); $k++) {
                    $ins = $conn->prepare("INSERT INTO categ(categ_nome, subcateg_id) VALUES ('{$categ_nome[$k]}', '{$subcateg_id[$k]}')");
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