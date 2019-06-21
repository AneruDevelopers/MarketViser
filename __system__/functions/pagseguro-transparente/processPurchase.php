<?php
    require_once 'configuration.php';

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    $json = ['erro' => TRUE, 'dados' => $dados];

    echo json_encode($json);
?>