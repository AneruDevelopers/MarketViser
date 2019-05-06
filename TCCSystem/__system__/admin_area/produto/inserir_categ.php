<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Insrir Subcategoria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../style/css/admin.css"/>
</head>
<body>

    <form class="formInserirProdutos" action="inserir_categ.php" method="post" enctype="multipart/form-data">

        <table width="auto" align="center" border="2">
            <tr align="center">
                <td colspan="8"><h2>Insira os dados aqui</h2></td>
            </tr>
            <tr>
                <td align="center"><b>Nome da Categoria:</b></td>
                <td><input type="text" name="nome_categ" size="60" required></td>
            </tr>
            <tr>
                <td align="center"><b>Subcategoria:</b></td>
                <td>
                    <select name="nome_sub" id="">
                        <option>Selecione a Subcategoria:</option>
                        <?php
                                
                            $buscar_categ = "SELECT * FROM subcateg";

                            $run_categ = mysqli_query($con, $buscar_categ);

                            while ($row_categ = mysqli_fetch_array($run_categ)) {

                                $categ_id = $row_categ['subcateg_id'];
                                $categ_titulo = $row_categ['subcateg_nome'];

                                echo "<option value='$categ_id'>$categ_titulo</option>";
                            }

                        ?>
                    </select>
                </td>
                <tr align="center">
                    <td colspan="8"><input type="submit" name="cadastrar_categ" value="Cadastrar"></td>
                </tr>
            </tr>
        </table>

    </form>

</body>
</html>
<?php

        if(isset($_POST['cadastrar_categ'])) {
        
            $nome_categ = $_POST['nome_categ'];
            $nome_sub = $_POST['nome_sub'];

            $inserir_subcategoria = "INSERT INTO categ (categ_nome, subcateg_id) VALUES ('$nome_categ', '$nome_sub')";
        
            $inserir_subcateg = mysqli_query($con, $inserir_subcategoria);

                if($inserir_subcateg) {
                    echo "<script>alert('A subcategoria foi inserida com sucesso!')</script>";
                    echo "<script>window.open('admin_center.php','_self')</script>";
                }
        }

?>