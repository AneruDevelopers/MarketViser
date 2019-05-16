<?php 
    require_once 'connection/conn.php';

    if ( isset($_POST['arm_id'])) {
      $sel = $conn->prepare("SELECT c.cid_nome,e.est_uf,a.armazem_nome,a.armazem_id FROM armazem AS a JOIN cidade AS c ON a.cidade_id=c.cid_id JOIN estado AS e ON c.est_id=e.est_id WHERE a.armazem_id={$_POST['arm_id']}");
      $sel->execute();
      if($sel->rowCount() > 0) {
        $result = $sel->fetchAll();
        foreach($result as $v) {
          $_SESSION['arm'] = $v['cid_nome'] . " - " . $v['est_uf'];
          $_SESSION['arm_nome'] = $v['armazem_nome'];
          $_SESSION['arm_id'] = $_POST['arm_id'];
        }
    }
?>