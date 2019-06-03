<?php 
    require_once 'connection/conn.php';

    if(isXmlHttpRequest()) {
      function limpaCompra() {
          unset($_SESSION['carrinho']);
          unset($_SESSION['totCompra']);
          if(isset($_SESSION['totCompraCupom'])) {
              unset($_SESSION['totCompraCupom']);
          }
          if(isset($_SESSION['end_agend'])) {
              unset($_SESSION['end_agend']);
          }
          if(isset($_SESSION['agend_horario'])) {
              unset($_SESSION['agend_horario']);
          }
          if(isset($_SESSION['subcid_id'])) {
              unset($_SESSION['subcid_id']);
          }
      }

      if(isset($_POST['arm_id'])) {
        $sel = $conn->prepare("SELECT c.cid_nome,e.est_uf,a.armazem_nome,a.armazem_id FROM armazem AS a JOIN cidade AS c ON a.cidade_id=c.cid_id JOIN estado AS e ON c.est_id=e.est_id WHERE a.armazem_id={$_POST['arm_id']}");
        $sel->execute();

        $json['status'] = 1;
        if($sel->rowCount() > 0) {
          $result = $sel->fetchAll();
          foreach($result as $v) {
            setcookie("arm_id",$_POST['arm_id'],time()+(86400 * 1825));

            $_SESSION['arm'] = $v['cid_nome'] . " - " . $v['est_uf'];
            $array = explode(" ",$v['cid_nome']);
            if(count($array) > 1) {
              $qtd = strlen($v['cid_nome']) - (strlen($array[0]) + 1);
              $_SESSION['arm_cm'] = substr($v['cid_nome'],0,1) . " " . substr($v['cid_nome'],-$qtd) . " - " . $v['est_uf'];
            } else {
              if(isset($_SESSION['arm_cm'])) {
                unset($_SESSION['arm_cm']);
              }
            }
            $_SESSION['arm_nome'] = $v['armazem_nome'];
            $_SESSION['arm_id'] = $_POST['arm_id'];
          }
          
          limpaCompra();
        } else {
          $json['status'] = 0;
        }
        echo json_encode($json);
      }
    }
?>