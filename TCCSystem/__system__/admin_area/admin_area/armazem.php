<!DOCTYPE>
<?php

    include("includes/conexao.php");

?>
<html>
<head>
<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Insrir Armazém</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../style/css/admin.css"/>
     <script src="../js/jquery-3.3.1.min.js" type="text/javascript"></script>
     <script type="text/javascript" src="../js/admin.js" async></script>
</head>
<body>

    <form class="formInserirProdutos" action="armazem.php" method="post" enctype="multipart/form-data">

        <table width="auto" align="center" border="2">
            <tr align="center">
                <td colspan="8"><h2>Insira os dados aqui</h2></td>
            </tr>
            <tr>
                <td align="center"><b>Nome do armazém:</b></td>
                <td><input type="text" name="nm_arm" placeholder="Nome do armazem...."></td>
            </tr>
            <tr>

                
               
       <td align="center"><b>Nome do Supervisor:</b></td>
              <td><input type="text" name="sup_arm" placeholder="Nome do Supervisor...."></td>  
                </td>
            </tr>
            <tr>
                <td align="center"><b>Estado do armazém:</b></td>
                <td><select name="esc_cid"   tabindex="1">
                    <optgroup label="Escolha uma Cidade">
                     <?php
                                
                            $buscar_cid = "SELECT * FROM cidade";

                            $run_cid = mysqli_query($con, $buscar_cid);

                            while ($row_cid = mysqli_fetch_array($run_cid)) {

                                $cid_id = $row_cid['cid_id'];
                                $cid_nome = $row_cid['cid_nome'];
                                
                                echo "<option  data-estado= '$cid_est' value='$cid_id'>$cid_nome</option>";
                            }

                        ?></optgroup>
                </select>
                </td>
            </tr>
                <tr align="center">
                    <td colspan="8"><input type="submit" name="cadastrar_armazem" value="Cadastrar"></td>
                </tr>
        </table>

    </form>
    
</body>
</html>
<?php

        if(isset($_POST['cadastrar_armazem'])) {
        
            $cidade_arm = $_POST['esc_cid'];

            $nomesup_arm = $_POST['sup_arm'];

            $nome_arm =$_POST['nm_arm'];
            $inserir_arm = "INSERT INTO armazem (armazem_nome, armazem_supervisor,cidade_id) VALUES ('$nome_arm','$nomesup_arm', '$cidade_arm')";
        
            $inserir_armazem = mysqli_query($con, $inserir_arm);

                if($inserir_armazem) {
                    echo "<script>alert('O armazem foi inserida com sucesso!')</script>";
                    echo "<script>window.open('admin_center.php','_self')</script>";
                }
        }

?>

