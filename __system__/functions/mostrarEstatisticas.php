<?php
require_once 'connection/conn.php';
header('Content-Type: application/json');

$sel = $conn->prepare("SELECT DISTINCT MONTH(compra_registro) AS mes, COUNT(compra_registro) as qtd FROM compra WHERE usu_id = '{$_SESSION["inf_usu"]['usu_id']}' GROUP BY compra_registro");
    if($sel->execute()) {
        if($sel->rowCount() > 0) {
            $array[] = array(
                "mes" => "Janeiro",
                "qtd" => 0,
            );  
            $array[] = array(
                "mes" => "Fevereiro",
                "qtd" => 0,
            ); 
            $array[] = array(
                "mes" => "Março",
                "qtd" => 0,
            ); 
            $array[] = array(
                "mes" => "Abril",
                "qtd" => 0,
            ); 
            $array[] = array(
                "mes" => "Maio",
                "qtd" => 0,
            );             
            $array[] = array(
                    "mes" => "Junho",
                    "qtd" => 0,
                );              
         while($row = $sel->fetch( PDO::FETCH_ASSOC )) {
         
           if($row['mes'] == 7){
            $array[] = array(
                "mes" => "Julho",
                "qtd" => $row['qtd'],
            );
             
           } 
        } 

        print json_encode($array);
        }
    }

?>