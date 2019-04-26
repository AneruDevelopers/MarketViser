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