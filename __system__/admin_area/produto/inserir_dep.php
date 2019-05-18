<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Insrir Categoria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../style/css/admin.css"/>
</head>
<body>

    <form class="formInserirProdutos" action="inserir_dep.php" method="post" enctype="multipart/form-data">

        <table width="auto" align="center" border="2">
            <tr align="center">
                <td colspan="8"><h2>Insira os dados aqui</h2></td>
            </tr>
            <tr>
                <td align="center"><b>Nome da departamento:</b></td>
                <td><input type="text" name="nome_dep" size="60" required></td>
            </tr>
            <tr>
                <td align="center"><b>Icone do departamento:</b></td>
                <td><input type="text" name="icon" size="60" required></td>
            </tr>
                <tr align="center">
                    <td colspan="8"><input type="submit" name="cadastrar_dep" value="Cadastrar"></td>
                </tr>
        </table>

    </form>
    
</body>
</html>
<?php

        if(isset($_POST['cadastrar_dep'])) {
        
            $nome_depart = $_POST['nome_dep'];
            $icon = $_POST['icon'];
            $inserir_categoria = "INSERT INTO departamento (depart_nome, depart_icon) VALUES ('$nome_depart','$icon')";
        
            $inserir_categ = mysqli_query($con, $inserir_categoria);

                if($inserir_categ) {
                    echo "<script>alert('A categoria foi inserida com sucesso!')</script>";
                    echo "<script>window.open('admin_center.php','_self')</script>";
                }
        }

?>