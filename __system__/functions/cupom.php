<?php
    require_once 'connection/conn.php';

    if(isXmlHttpRequest()) {
        $json = array();
        $json['new_total_price'] = NULL;
        $json['cupom'] = NULL;
        if(isset($_POST['addCupom'])) {
            $json['status'] = 1;
            $json['answer'] = NULL;

            $sel = $conn->prepare("SELECT * FROM cupom WHERE cupom_codigo=:cod");
            $sel->bindValue(":cod", "{$_POST['addCupom']}");
            $sel->execute();

            if($sel->rowCount() > 0) {
                $res = $sel->fetchAll();
                foreach($res as $v) {
                    $totCupomPorc = $_SESSION['totCompra']*($_SESSION['cupom_compra']['cupom_desconto_porcent']/100);
                    $totCupomPorc = number_format($totCupomPorc, 2, '.', '');
                    $_SESSION['totCompraCupom'] = $_SESSION['totCompra'];
                    $_SESSION['totCompra'] -= $totCupomPorc;
                    $json['new_total_price'] = number_format($_SESSION['totCompra'], 2, ',', '.');
                    $_SESSION['cupom_compra'] = $v;
                    $json['cupom'] = $v;
                }
            } else {
                $json['status'] = 0;
                $json['answer'] = "Cupom expirado ou inexistente";
            }
        } elseif(isset($_POST['remCupom'])) {
            if(isset($_SESSION['cupom_compra'])) {
                $totCupomPorc = $_SESSION['totCompraCupom']*($_SESSION['cupom_compra']['cupom_desconto_porcent']/100);
                $totCupomPorc = number_format($totCupomPorc, 2, '.', '');
                $_SESSION['totCompra'] += $totCupomPorc;
                unset($_SESSION['cupom_compra']);
                unset($_SESSION['totCompraCupom']);
            }
            $json['new_total_price'] = number_format($_SESSION['totCompra'], 2, ',', '.');
        } else {
            $json['empty'] = TRUE;

            if(isset($_SESSION['cupom_compra'])) {
                $json['empty'] = FALSE;

                $sel = $conn->prepare("SELECT * FROM cupom WHERE cupom_codigo=:cod");
                $sel->bindValue(":cod", "{$_SESSION['cupom_compra']['cupom_codigo']}");
                $sel->execute();
                $res = $sel->fetchAll();
                foreach($res as $v) {
                    $json['new_total_price'] = number_format($_SESSION['totCompra'], 2, ',', '.');
                    $_SESSION['cupom_compra'] = $v;
                    $json['cupom'] = $v;
                }
            }
        }

        echo json_encode($json);
    }
?>