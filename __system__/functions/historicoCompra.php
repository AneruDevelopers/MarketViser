<?php
    require_once 'connection/conn.php';

    if(isXmlHttpRequest()) {
        $json['status'] = 1;

        if(isset($_POST['searchPurch'])) {
            $search = $_POST['searchPurch'];
            $json['error'] = NULL;

            $sel = $conn->prepare("SELECT c.compra_id, c.compra_registro, c.compra_total, s.status_nome, f.forma_nome FROM lista_compra AS l JOIN compra AS c ON c.compra_id=l.compra_id JOIN status_compra AS s ON c.status_id=s.status_id JOIN forma_pag AS f ON c.forma_id=f.forma_id JOIN produto AS p ON l.produto_id=p.produto_id WHERE c.usu_id=:id AND (c.compra_registro LIKE '%{$search}%' OR c.compra_total LIKE '%{$search}%' OR c.compra_hash LIKE '%{$search}%' OR f.forma_nome LIKE '%{$search}%' OR s.status_nome LIKE '%{$search}%' OR p.produto_nome LIKE '%{$search}%' OR p.produto_tamanho LIKE '%{$search}%')");
            $sel->bindValue(":id", "{$_SESSION['inf_usu']['usu_id']}");
            $sel->execute();
            
            if($sel->rowCount() > 0) {
                $c = 0;
                while($row = $sel->fetch( PDO::FETCH_ASSOC )) {
                    if($c != $row['compra_id']) {
                        $exp = explode(" ", $row['compra_registro']);
                        $day = explode("-", $exp[0]);
                        $hour = explode(":", $exp[1]);
                        $row['compra_registro'] = $day[2] . "/" . $day[1] . "/" . $day[0] . 
                        " às " . $hour['0'] . "h" . $hour[1];
    
                        $row['compra_total'] = number_format($row['compra_total'], 2, ',', '.');
    
                        $json['compra'][] = $row;
                        $c = $row['compra_id'];
                    }
                }
            } else {
                $json['status'] = 0;
                $json['error'] = "Não houve resposta para o que foi pesquisado!";
            }
        } elseif(isset($_POST['showPurch'])) {
            $compra_id = $_POST['showPurch'];
            $json['error'] = NULL;

            $sel = $conn->prepare("SELECT * FROM lista_compra AS l JOIN compra AS c ON c.compra_id=l.compra_id JOIN armazem AS a ON c.armazem_id=a.armazem_id JOIN cidade AS ci ON a.cidade_id=ci.cid_id JOIN estado AS es ON ci.est_id=es.est_id JOIN status_compra AS s ON c.status_id=s.status_id JOIN forma_pag AS f ON c.forma_id=f.forma_id JOIN entrega AS e ON e.compra_id=c.compra_id JOIN produto AS p ON l.produto_id=p.produto_id WHERE c.usu_id=:id AND c.compra_id=:c_id");
            $sel->bindValue(":id", "{$_SESSION['inf_usu']['usu_id']}");
            $sel->bindValue(":c_id", "{$compra_id}");
            $sel->execute();
            
            if($sel->rowCount() > 0) {
                $c = 0;
                while($row = $sel->fetch( PDO::FETCH_ASSOC )) {
                    $exp = explode(" ", $row['compra_registro']);
                    $day = explode("-", $exp[0]);
                    $row['compra_registro'] = $day[2] . "/" . $day[1] . "/" . $day[0] . 
                    " às " . $exp[1];
                    
                    $exp = explode(" ", $row['entrega_horario']);
                    $day = explode("-", $exp[0]);
                    $row['entrega_horario'] = $day[2] . "/" . $day[1] . "/" . $day[0] . 
                    " às " . $exp[1];

                    $row['compra_total'] = number_format($row['compra_total'], 2, ',', '.');

                    $json['compra']['id'] = $row['compra_id'];
                    $json['compra']['armazem'] = $row['armazem_nome'] . " &nbsp;| &nbsp;" . $row['cid_nome'] . " - " . $row['est_uf'];
                    $json['compra']['registro'] = $row['compra_registro'];
                    $json['compra']['hash'] = $row['compra_hash'];
                    $json['compra']['total'] = $row['compra_total'];
                    $json['compra']['status'] = $row['status_nome'];
                    $json['compra']['forma_pag'] = $row['forma_nome'];
                
                    $json['end']['horario'] = $row['entrega_horario'];
                    $json['end']['cep'] = $row['entrega_cep'];
                    $json['end']['log'] = $row['entrega_end'];
                    $json['end']['num'] = $row['entrega_num'];
                    $json['end']['complemento'] = $row['entrega_complemento'];
                    $json['end']['bairro'] = $row['entrega_bairro'];
                    $json['end']['cidade'] = $row['entrega_cidade'];
                    $json['end']['uf'] = $row['entrega_uf'];

                    $json['produto_id'][$c] = $row['produto_id'];
                    $json['produto_cript'][$c] = md5($row['produto_id']);
                    $json['produto_nome'][$c] = $row['produto_nome'];
                    $json['produto_qtd'][$c] = $row['produto_qtd'];
                    $c++;
                }
            } else {
                $json['status'] = 0;
                $json['error'] = "
                    Ocorreu um erro!<br/>
                    Compra não encontrada.<br/>
                    <a href='" . base_url_php() . "suporte/atendimento'>Contate-nos, por favor.</a>
                ";
            }
        } else {
            $json['error'] = NULL;

            $sel = $conn->prepare("SELECT c.compra_id, c.compra_registro, c.compra_total, s.status_nome, f.forma_nome FROM compra AS c JOIN status_compra AS s ON c.status_id=s.status_id JOIN forma_pag AS f ON c.forma_id=f.forma_id WHERE c.usu_id=:id");
            $sel->bindValue(":id", "{$_SESSION['inf_usu']['usu_id']}");
            $sel->execute();
            
            if($sel->rowCount() > 0) {
                while($row = $sel->fetch( PDO::FETCH_ASSOC )) {
                    $exp = explode(" ", $row['compra_registro']);
                    $day = explode("-", $exp[0]);
                    $hour = explode(":", $exp[1]);
                    $row['compra_registro'] = $day[2] . "/" . $day[1] . "/" . $day[0] . 
                    " às " . $hour['0'] . "h" . $hour[1];

                    $row['compra_total'] = number_format($row['compra_total'], 2, ',', '.');

                    $json['compra'][] = $row;
                }
            } else {
                $json['status'] = 0;
                $json['error'] = "Não há compras registradas!";
            }
        }

        echo json_encode($json);
    }
?>