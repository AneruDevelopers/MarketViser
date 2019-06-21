<?php
    if(isXmlHttpRequest()) {
        $json = array();
        $json['status'] = 1;
        $json['error'] = NULL;

        if(isset($_SESSION['inf_usu']['usu_id'])) {
            //BUSCANDO OS TELEFONES DO CLIENTE
            $tel = $conn->prepare("SELECT tel_num FROM telefone WHERE usu_id=:id LIMIT 1");
            $tel->bindValue(":id", "{$_SESSION['inf_usu']['usu_id']}");
            $tel->execute();
            $v = $tel->fetch( PDO::FETCH_ASSOC );
            $v['ddd'] = substr($v['tel_num'],1,2);
            $v['num'] = substr($v['tel_num'],-10);
            $pos = strpos($v['num']," ");
            if($pos) {
                $v['num'] = str_replace(" ", "", $v['num']);
            }
            $v['num'] = str_replace("-", "", $v['num']);

            $json['client'] = $_SESSION['inf_usu'];
            $json['client']['tel_ddd'] = $v['ddd'];
            $json['client']['tel_num'] = $v['num'];

            if(isset($_SESSION['end_agend'])) {
                $json['end_entrega'] = $_SESSION['end_agend'];
            } else {
                $json['status'] = 0;
                $json['error'] = "Voçê precisa informar o endereço de entrega para efetuar o pagamento!";
            }

            if(isset($_SESSION['agend_horario'])) {
                $json['agend_horario'] = $_SESSION['agend_horario'];
            } else {
                $json['status'] = 0;
                $json['error'] = "Voçê precisa agendar a entrega para efetuar o pagamento!";
            }
        } else {
            $json['status'] = 0;
            $json['error'] = "Voçê precisa estar logado para efetuar o pagamento!";
        }

        echo json_encode($json);
    }
?>