<?php
    if(isXmlHttpRequest()) {
        $json['status'] = 1;
        $json['error_list'] = array();

        if(isset($_POST['nome_produto'])) {
            for($k=0; $k<count($_POST['nome_produto']); $k++) {
                $nome_produto = $_POST['nome_produto'][$k];
                $marca_produto = $_POST['marca_produto'][$k];
                $categoria_produto = $_POST['categoria_produto'][$k];
    
                $descricao_produto = $_POST['descricao_produto'][$k];
                $tamanho_produto = $_POST['produto_tamanho'][$k];
            
                $imagem_produto = $_FILES['imagem_produto']['name'];
                $imagem_produto_tmp = $_FILES['imagem_produto']['tmp_name'];

                move_uploaded_file($imagem_produto_tmp[$k], "__system__/admin_area/imagens_produtos/{$imagem_produto[$k]}");

                $ins = $conn->prepare("INSERT INTO produto(produto_nome,produto_descricao,produto_img,produto_marca,produto_tamanho, produto_categ) VALUES ('$nome_produto', '$descricao_produto','{$imagem_produto[$k]}','$marca_produto','$tamanho_produto','$categoria_produto')");
                if(!$ins->execute()) {
                    $json['status'] = 0;
                }
            }
        } elseif(isset($_POST['marca_nome'])) {
            for($k=0; $k<count($_POST['marca_nome']); $k++) {
                $marca_nome = $_POST['marca_nome'][$k];

                $ins = $conn->prepare("INSERT INTO marca_prod(marca_nome) VALUES ('$marca_nome')");
                if(!$ins->execute()) {
                    $json['status'] = 0;
                }
            }
        } elseif(isset($_POST['depart_nome'])) {
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
        } elseif(isset($_POST['subcateg_nome'])) {
            for($k=0; $k<count($_POST['subcateg_nome']); $k++) {
                $subcateg_nome = $_POST['subcateg_nome'][$k];
                $depart_id = $_POST['depart_id'][$k];
                
                $ins = $conn->prepare("INSERT INTO subcateg(subcateg_nome,depart_id) VALUES ('$subcateg_nome','$depart_id')");
                if(!$ins->execute()) {
                    $json['status'] = 0;
                }
            }
        } elseif(isset($_POST['categ_nome'])) {
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