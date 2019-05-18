    <form class="formInserirProdutos" action="inserir_produto.php" method="post" enctype="multipart/form-data">
        <table width="auto" align="center" border="2">
            <tr align="center">
                <td colspan="8"><h2>Insira os dados aqui</h2></td>
            </tr>
            <tr>
                <td align="center"><b>Nome do produto:</b></td>
                <td><input type="text" name="nome_produto" size="60" required></td>
            </tr>
            <!-- <tr>
                <td align="center"><b>Escolha o Armazém:</b></td>
                <td>
                    <select name="esc_arm" tabindex="1">
                        <optgroup label="Escolha um Armazém">
                            <?php
                                // $buscar_arm = "SELECT * FROM armazem";
                                // $run_arm = mysqli_query($con, $buscar_arm);
                                // while ($row_arm = mysqli_fetch_array($run_arm)) {
                                //     $arm_id = $row_arm['armazem_id'];
                                //     $arm_nome = $row_arm['armazem_nome'];
                                //     echo "<option  value='$arm_id'>$arm_nome</option>";
                                // }
                            ?>
                        </optgroup>
                    </select>                            
                </td>
            </tr> -->
            <tr>
                <td align="center"><b>Marca do produto:</b></td>
                <td>
                    <select name="marca_produto">
                        <option value="*000*">--- Selecione a marca: ---</option>
                        <?php
                            $sel = $conn->prepare("SELECT * FROM marca_prod");
                            $sel->execute();
                            if($sel->rowCount() > 0):
                                $results = $sel->fetchAll();
                                foreach($results as $k => $v):?>
                                    <option value="<?= $v['marca_id'] ?>"><?= $v['marca_nome']; ?></option>
                                    <?php
                                endforeach;
                            endif;
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="center"><b>Categoria do produto:</b></td>
                <td>
                    <select name="categoria_produto">
                        <option>--- Selecione a categoria: ---</option>
                        <?php
                            $sel = $conn->prepare("SELECT * FROM categ AS c JOIN subcateg AS s ON c.subcateg_id=s.subcateg_id JOIN departamento AS d ON s.depart_id=d.depart_id");
                            $sel->execute();
                            if($sel->rowCount() > 0):
                                $results = $sel->fetchAll();
                                foreach($results as $k => $v):?>
                                    <option value="<?= $v['categ_id'] ?>"><?= $v['depart_nome'] . " / " . $v['subcateg_nome'] . " / " . $v['categ_nome']; ?></option>
                                    <?php
                                endforeach;
                            endif;
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="center"><b>Imagem do produto:</b></td>
                <td><input type="file" name="imagem_produto" required></td>
            </tr>
            <tr>
                <td align="center"><b>Preço do produto:</b></td>
                <td><input type="text" class="money" name="preco_produto" size="60" required></td>
            </tr>
            <tr>
                <td align="center"><b>Descrição do produto:</b></td>
                <td><textarea name="descricao_produto" cols="30" rows="10"></textarea></td>
            </tr>
            <tr>
                <td align="center"><b>Volume do produto:</b></td>
                <td><input type="text" name="produto_tamanho" size="60" required></td>
            </tr>
            <tr align="center">
                <td colspan="8"><input type="submit" name="cadastrar_produto" value="Cadastrar"></td>
            </tr>
        </table>
    </form>
<?php

    if(isset($_POST['cadastrar_produto'])) {

        $nome_produto = $_POST['nome_produto'];
        $marca_produto = $_POST['marca_produto'];
        $categoria_produto = $_POST['categoria_produto'];
       
    
        $preco_produto = $_POST['preco_produto'];
        $descricao_produto = $_POST['descricao_produto'];
        $keywords_produto = $_POST['keywords_produto'];
      
       
        $imagem_produto = $_FILES['imagem_produto']['name'];
        $imagem_produto_tmp = $_FILES['imagem_produto']['tmp_name'];
 
        
        

        move_uploaded_file($imagem_produto_tmp, "imagens_produtos/$imagem_produto");

        $inserir_produto = "INSERT INTO produto(produto_nome,produto_keywords ,produto_descricao,produto_img,produto_marca,produto_preco, produto_categ ) 
        VALUES ('$nome_produto', '$keywords_produto','$descricao_produto','$imagem_produto','$marca_produto','$preco_produto','$categoria_produto')";

        $inserir_pro = mysqli_query($con, $inserir_produto);

            if($inserir_pro) {
                echo "<script>alert('O produto foi inserido com sucesso!')</script>";
                echo "<script>window.open('admin_center.php','_self')</script>";
            }
}

?>