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

    <form class="formInserirProdutos" action="inserir_subcateg.php" method="post" enctype="multipart/form-data">

        <table width="auto" align="center" border="2">
            <tr align="center">
                <td colspan="8"><h2>Insira os dados aqui</h2></td>
            </tr>
            <tr>
                <td align="center"><b>Nome da Subcategoria:</b></td>
                <td><input type="text" name="nome_subcategoria" size="60" required></td>
            </tr>
            <tr>
                <td align="center"><b>Departamento:</b></td>
                <td>
                    <select name="nome_dep" id="">
                        <option>Selecione a categoria:</option>
                        <?php
                                
                            $buscar_categ = "SELECT * FROM departamento";

                            $run_categ = mysqli_query($con, $buscar_categ);

                            while ($row_categ = mysqli_fetch_array($run_categ)) {

                                $categ_id = $row_categ['depart_id'];
                                $categ_titulo = $row_categ['depart_nome'];

                                echo "<option value='$categ_id'>$categ_titulo</option>";
                            }

                        ?>
                    </select>
                </td>
                <tr align="center">
                    <td colspan="8"><input type="submit" name="cadastrar_subcateg" value="Cadastrar"></td>
                </tr>
            </tr>
        </table>

    </form>

</body>
</html>
<?php

        if(isset($_POST['cadastrar_subcateg'])) {
        
            $nome_subcategoria = $_POST['nome_subcategoria'];
            $nome_dep = $_POST['nome_dep'];

            $inserir_subcategoria = "INSERT INTO subcateg (subcateg_nome, depart_id) VALUES ('$nome_subcategoria', '$nome_dep')";
        
            $inserir_subcateg = mysqli_query($con, $inserir_subcategoria);

                if($inserir_subcateg) {
                    echo "<script>alert('A subcategoria foi inserida com sucesso!')</script>";
                    echo "<script>window.open('admin_center.php','_self')</script>";
                }
        }

?>