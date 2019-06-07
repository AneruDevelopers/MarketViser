<?php
    if(isXmlHttpRequest()) {
        $json['status'] = 1;

        if(isset($_POST['nome_produto'])) {
            $json['error'] = NULL;

            for($k=0; $k<count($_POST['nome_produto']); $k++) {
                $c = $k + 1;
                $nome_produto[$k] = trim($_POST['nome_produto'][$k]);
                $marca_produto[$k] = $_POST['marca_produto'][$k];
                $categoria_produto[$k] = $_POST['categoria_produto'][$k];
                $descricao_produto[$k] = $_POST['descricao_produto'][$k];
                $tamanho_produto[$k] = trim($_POST['produto_tamanho'][$k]);

                $imagem_produto = $_FILES['imagem_produto']['name'];
                $imagem_produto_tmp = $_FILES['imagem_produto']['tmp_name'];

                if(empty($nome_produto[$k])) {
                    $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Insira o nome do produto na ' . $c . 'ª parte de cadastro</b></p>';
                } else {
                    if($marca_produto[$k] == "*000*") {
                        $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Insira a marca do produto na ' . $c . 'ª parte de cadastro</b></p>';
                    } else {
                        if($categoria_produto[$k] == "*000*") {
                            $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Insira a categoria do produto na ' . $c . 'ª parte de cadastro</b></p>';
                        } else {
                            if(empty($tamanho_produto[$k])) {
                                $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Insira o volume do produto na ' . $c . 'ª parte de cadastro</b></p>';
                            } else {
                                $sel = $conn->prepare("SELECT produto_nome, produto_tamanho FROM produto WHERE produto_nome='{$nome_produto[$k]}' AND produto_tamanho='{$tamanho_produto[$k]}'");
                                $sel->execute();
                                if($sel->rowCount() > 0) {
                                    $res = $sel->fetchAll();
                                    $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>O produto ' . $res[0]['produto_nome'] . ' - ' . $res[0]['produto_tamanho'] . ' que inseriu na ' . $c . 'ª parte já foi previamente cadastrado</b></p>';
                                }
                            }
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
                for($k=0; $k<count($nome_produto); $k++) {
                    if(empty($imagem_produto[$k])) {
                        $imagem_produto[$k] = "img_default.png";
                    } else {
                        move_uploaded_file($imagem_produto_tmp[$k], "__system__/admin_area/imagens_produtos/{$imagem_produto[$k]}");
                    }
                    $ins = $conn->prepare("INSERT INTO produto(produto_nome,produto_descricao,produto_img,produto_marca,produto_tamanho, produto_categ) VALUES ('{$nome_produto[$k]}', '{$descricao_produto[$k]}','{$imagem_produto[$k]}','{$marca_produto[$k]}','{$tamanho_produto[$k]}','{$categoria_produto[$k]}')");

                    if(!$ins->execute()) {
                        $json['status'] = 0;
                        $json['error'] = '<p style="padding-bottom:10px;color:red;text-align:center;"><b>Um erro inesperado aconteceu. Tente novamente!</b></p>';
                        break;
                    }
                }
            }
        } elseif(isset($_POST['delProd_id'])) {
            $del = $conn->prepare("DELETE FROM produto WHERE produto_id=:id");
            $del->bindValue(":id", "{$_POST['delProd_id']}");
            if(!$del->execute()) {
                $json['status'] = 0;
                $json['error_del'] = "Código erro: " . $del->errorCode();
            }
        } elseif(isset($_POST['viewProd_id'])) {
            $json['produto'] = NULL;
            $sel = $conn->prepare("SELECT c.categ_nome, s.subcateg_nome, d.depart_nome, p.produto_id, p.produto_img, p.produto_descricao, p.produto_nome, p.produto_tamanho, m.marca_nome FROM produto AS p JOIN categ AS c ON c.categ_id=p.produto_categ JOIN subcateg AS s ON c.subcateg_id=s.subcateg_id JOIN departamento AS d ON s.depart_id=d.depart_id JOIN marca_prod AS m ON p.produto_marca=m.marca_id WHERE p.produto_id={$_POST['viewProd_id']}");
            $sel->execute();
            if($sel) {
                if($sel->rowCount() > 0) {
                    $prods = $sel->fetchAll();
                    foreach($prods as $v) {
                        $json['produto'] = $v;
                    }
                }
            } else {
                $json['status'] = 0;
            }
        } elseif(isset($_POST['searchProd'])) {
            $json['empty'] = TRUE;
            $json['produtos'] = array();
            $json['registrosTotal'] = 0;
            $json['registrosMostra'] = 0;
            $sel = $conn->prepare("SELECT p.produto_id, p.produto_img, p.produto_nome, p.produto_tamanho, m.marca_nome FROM produto AS p JOIN categ AS c ON c.categ_id=p.produto_categ JOIN subcateg AS s ON c.subcateg_id=s.subcateg_id JOIN departamento AS d ON s.depart_id=d.depart_id JOIN marca_prod AS m ON p.produto_marca=m.marca_id WHERE p.produto_nome LIKE '%{$_POST['searchProd']}%' OR p.produto_descricao LIKE '%{$_POST['searchProd']}%' OR p.produto_tamanho LIKE '%{$_POST['searchProd']}%' OR m.marca_nome LIKE '%{$_POST['searchProd']}%' OR c.categ_nome LIKE '%{$_POST['searchProd']}%' OR s.subcateg_nome LIKE '%{$_POST['searchProd']}%' OR d.depart_nome LIKE '%{$_POST['searchProd']}%'");
            $sel->execute();
            if($sel) {
                if($sel->rowCount() > 0) {
                    $json['empty'] = FALSE;
                    $prods = $sel->fetchAll();
                    foreach($prods as $v) {
                        $json['produtos'][] = $v;
                        $json['registrosTotal']++;
                        $json['registrosMostra']++;
                    }
                }
            } else {
                $json['status'] = 0;
            }
        } else {
            $json['empty'] = TRUE;
            $json['produtos'] = array();
            $json['registrosTotal'] = 0;
            $json['registrosMostra'] = 0;
            $sel = $conn->prepare("SELECT p.produto_id, p.produto_img, p.produto_nome, p.produto_tamanho, m.marca_nome FROM produto AS p JOIN marca_prod AS m ON p.produto_marca=m.marca_id");
            $sel->execute();
            if($sel) {
                if($sel->rowCount() > 0) {
                    $json['empty'] = FALSE;
                    $prods = $sel->fetchAll();
                    foreach($prods as $v) {
                        $json['produtos'][] = $v;
                        $json['registrosTotal']++;
                        $json['registrosMostra']++;
                    }
                }
            } else {
                $json['status'] = 0;
            }
        }

        echo json_encode($json);
    }
?>