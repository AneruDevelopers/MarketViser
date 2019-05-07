<?php
    require_once 'connection/conn.php';

    $sel = $conn->prepare("SELECT * FROM departamento");
    $sel->execute();
    
    $result = $sel->fetchAll();
    foreach($result as $row) {
        $depart[] = $row;
    }

    echo json_encode($depart);
?>