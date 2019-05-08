<?php
    require_once 'connection/conn.php';

    if(isXmlHttpRequest()) {
        $json['status'] = 1;

        $sel = $conn->prepare("SELECT * FROM produto AS p JOIN marca_prod AS m ON p.produto_marca=m.marca_id WHERE p.produto_desconto_porcent <> ''");
        $sel->execute();
        
        if($sel->rowCount() > 0) {
            $result = $sel->fetchAll();
            foreach($result as $row) {
                $row["produto_desconto"] = $row["produto_preco"]*($row["produto_desconto_porcent"]/100);
                $row["produto_desconto"] = $row["produto_preco"]-$row["produto_desconto"];
                
                $row["produto_preco"] = number_format($row["produto_preco"], 2, ',', '.');
                $row["produto_desconto"] = number_format($row["produto_desconto"], 2, ',', '.');
                $json['produtos'][] = $row;
            }
        } else {
            $json['status'] = 0;
        }

        echo json_encode($json);
    } else {
        header('Location: ../');
    }
?>