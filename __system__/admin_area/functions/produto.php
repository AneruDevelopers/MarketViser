<?php
    if(isXmlHttpRequest()) {
        $json['status'] = 1;

        if(isset($_POST['nome_produto'])) {
            $json['error_list'] = array();

            for($k=0; $k<count($_POST['nome_produto']); $k++) {
                $nome_produto = trim($_POST['nome_produto'][$k]);
                $marca_produto = $_POST['marca_produto'][$k];
                $categoria_produto = $_POST['categoria_produto'][$k];
                $descricao_produto = $_POST['descricao_produto'][$k];
                $tamanho_produto = trim($_POST['produto_tamanho'][$k]);

                if(empty($nome_produto)) {
                    $json["error_list"]["#nome_produto"] = "<p class='msgErrorCad'>Por favor, insira o nome do produto neste campo</p>";
                }

                if($marca_produto == "*000*") {
                    $json["error_list"]["#marca_produto"] = "<p class='msgErrorCad'>Por favor, insira a marca do produto neste campo</p>";
                }

                if($categoria_produto == "*000*") {
                    $json["error_list"]["#categoria_produto"] = "<p class='msgErrorCad'>Por favor, insira a categoria do produto neste campo</p>";
                }

                if(empty($tamanho_produto)) {
                    $json["error_list"]["#tamanho_produto"] = "<p class='msgErrorCad'>Por favor, insira o volume do produto neste campo</p>";
                }

                if(!empty($json['error_list'])) {
                    $json['status'] = 0;
                } else {
                    $imagem_produto = $_FILES['imagem_produto']['name'];
                    $imagem_produto_tmp = $_FILES['imagem_produto']['tmp_name'];
                    move_uploaded_file($imagem_produto_tmp[$k], "__system__/admin_area/imagens_produtos/{$imagem_produto[$k]}");

                    $ins = $conn->prepare("INSERT INTO produto(produto_nome,produto_descricao,produto_img,produto_marca,produto_tamanho, produto_categ) VALUES ('$nome_produto', '$descricao_produto','{$imagem_produto[$k]}','$marca_produto','$tamanho_produto','$categoria_produto')");
                    if(!$ins->execute()) {
                        $json['status'] = 0;
                    }
                }
            }
        } else {
            $json['empty'] = true;
            $json['produtos'] = array();
            $sel = $conn->prepare("SELECT * FROM produto AS p JOIN marca_prod AS m ON p.produto_marca=m.marca_id LIMIT 4");
            $sel->execute();
            if($sel) {
                if($sel->rowCount() > 0) {
                    $json['empty'] = false;
                    $prods = $sel->fetchAll();
                    foreach($prods as $v) {
                        $json['produtos'][] = $v;
                    }
                }
            } else {
                $json['status'] = 0;
            }
        }

        echo json_encode($json);
    }
?>