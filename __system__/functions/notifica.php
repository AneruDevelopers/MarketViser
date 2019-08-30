<?php
    require_once 'connection/conn.php';

    if(isXmlHttpRequest()) {
        $json['status'] = 1;

        if(isset($_POST['searchPost'])) {
            $search = $_POST['searchPost'];
            $json['error'] = NULL;

            $sel = $conn->prepare("SELECT * FROM postagem WHERE post_title LIKE '%{$_POST['searchPost']}%' OR post_text LIKE '%{$_POST['searchPost']}%' OR post_registro LIKE '%{$_POST['searchPost']}%' ORDER BY post_registro DESC");
            $sel->execute();
            
            if($sel->rowCount() > 0) {
                while($v = $sel->fetch( PDO::FETCH_ASSOC )) {
                    $v['post_title'] = (strlen($v['post_title']) > 65) ? substr($v['post_title'],0,65) . "..." : $v['post_title'];
            
                    $exp = explode(" ", $v['post_registro']);
                    $day = explode("-", $exp[0]);
                    $v['post_registro'] = $day[2] . "/" . $day[1] . "/" . $day[0] . " às " . $exp[1];
            
                    $json['postagens'][] = $v;
                }
            } else {
                $json['status'] = 0;
                $json['error'] = "Não houve resposta para o que foi pesquisado!";
            }
        } elseif(isset($_POST['showPost'])) {
            $post_id = $_POST['showPost'];
            $json['error'] = NULL;

            $sel = $conn->prepare("SELECT * FROM postagem WHERE post_id=:id");
            $sel->bindValue(":id", "$post_id");
            $sel->execute();
            
            if($sel->rowCount() > 0) {
                while($v = $sel->fetch( PDO::FETCH_ASSOC )) {
                    $exp = explode(" ", $v['post_registro']);
                    $day = explode("-", $exp[0]);
                    $v['post_registro'] = $day[2] . "/" . $day[1] . "/" . $day[0] . " às " . $exp[1];

                    $json['postagem'] = $v;
                }
            } else {
                $json['status'] = 0;
                $json['error'] = "
                    Ocorreu um erro!<br/>
                    Notificação não encontrada.<br/>
                    <a href='" . base_url_php() . "suporte/atendimento'>Contate-nos, por favor.</a>
                ";
            }
        } else {
            $json['error'] = NULL;

            $sel = $conn->prepare("SELECT * FROM postagem ORDER BY post_registro DESC");
            $sel->execute();
            
            if($sel->rowCount() > 0) {
                while($v = $sel->fetch( PDO::FETCH_ASSOC )) {
                    $v['post_title'] = (strlen($v['post_title']) > 65) ? substr($v['post_title'],0,65) . "..." : $v['post_title'];
            
                    $exp = explode(" ", $v['post_registro']);
                    $day = explode("-", $exp[0]);
                    $v['post_registro'] = $day[2] . "/" . $day[1] . "/" . $day[0] . " às " . $exp[1];
            
                    $json['postagens'][] = $v;
                }
            } else {
                $json['status'] = 0;
                $json['error'] = "Não há notificações no momento!";
            }
        }

        echo json_encode($json);
    }
?>