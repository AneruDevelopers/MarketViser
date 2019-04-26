<?php
    require_once 'connection/conn.php';

    $sel = $conn->prepare("SELECT * FROM produto AS p JOIN marca_prod AS m ON p.produto_marca=m.marca_id");
    $sel->execute();
    
    $result = $sel->fetchAll();
    foreach($result as $row) {
        $produtos[] = $row;
    }

    echo json_encode($produtos);
?>