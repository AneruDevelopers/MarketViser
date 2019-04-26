<?php

    include("includes/conexao.php");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Teste</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
	<script src="../js/jquery-3.3.1.min.js" type="text/javascript"></script>
   <select name="esc_est" tabindex="1">
                   <optgroup label="Escolha um Estado">
                     <?php
                                
                            $buscar_est = "SELECT * FROM estado";

                            $run_est = mysqli_query($con, $buscar_est);

                            while ($row_est = mysqli_fetch_array($run_est)) {

                                $est_id = $row_est['id_est'];
                                $est_nome = $row_est['nome_est'];

                                echo "<option data-cid='$est_id' value='$est_id'>$est_nome</option>";
                            }

                        ?></optgroup>
</select>


<select name="esc_cid"   tabindex="1">
                    <optgroup label="Escolha uma Cidade">
                     <?php
                                
                            $buscar_cid = "SELECT * FROM cidade";

                            $run_cid = mysqli_query($con, $buscar_cid);

                            while ($row_cid = mysqli_fetch_array($run_cid)) {

                                $cid_id = $row_cid['id_cid'];
                                $cid_nome = $row_cid['nome_cid'];
                                $cid_est = $row_cid['id_est'];
                                echo "<option  data-estado= '$cid_est' value='$cid_id'>$cid_nome</option>";
                            }

                        ?></optgroup>
                </select>
</select>
 


    <script type="text/javascript">
    	var concelhos = $('select[name="esc_cid"] option');
$('select[name="esc_est"]').on('change', function () {
    var Estado = this.value;
    var novoSelect = concelhos.filter(function () {
        return $(this).data('estado') ==Estado;
    });
    $('select[name="esc_cid"]').html(novoSelect);
});


    </script>
</body>
</html>