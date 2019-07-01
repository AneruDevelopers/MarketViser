<?php
    if(isXmlHttpRequest()) {
        $json['status'] = 1;

        if(isset($_POST['searchEntrega'])) {

        } else {
            $page = filter_input(INPUT_POST, 'page', FILTER_SANITIZE_NUMBER_INT);
            $qtd_result = filter_input(INPUT_POST, 'qtd_result', FILTER_SANITIZE_NUMBER_INT);

            $begin = ($page * $qtd_result) - $qtd_result; // Calcula o início da visualização


            $json['empty'] = TRUE;
            $json['entregas'] = array();
            $json['registrosMostra'] = 0;

            $sel = $conn->prepare("SELECT COUNT(entrega_id) AS qtd FROM entrega");
            $sel->execute();
            $row = $sel->fetch( PDO::FETCH_ASSOC );
            $json['registrosTotal'] = $row['qtd'];

            $sel = $conn->prepare("SELECT e.entrega_id, c.compra_hash, e.entrega_horario, e.entrega_cidade, e.entrega_uf, e.entrega_cidade, a.armazem_nome FROM entrega AS e JOIN compra AS c ON e.compra_id=c.compra_id JOIN armazem AS a ON c.armazem_id=a.armazem_id LIMIT $begin, $qtd_result");
            $sel->execute();
            if($sel) {
                if($sel->rowCount() > 0) {
                    $json['empty'] = FALSE;
                    while($v = $sel->fetch( PDO::FETCH_ASSOC )) {
                        $exp = explode(" ", $v['entrega_horario']);
                        $day = explode("-", $exp[0]);
                        $v['entrega_horario'] = $day[2] . "/" . $day[1] . "/" . $day[0] . " às " . $exp[1];

                        $json['entregas'][] = $v;
                        $json['registrosMostra']++;
                    }
                }
            } else {
                $json['status'] = 0;
            }
        }

        echo json_encode($json);
    }
?>