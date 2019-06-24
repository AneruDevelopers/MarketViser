<?php
	require_once 'connection/conn.php';
    require_once '__system__/functions/email/novEmail.php';


								$valor_chave = md5(date('Y-m-d H:i'));
			                    $data = date('Y-m-d H:i:s', strtotime('+1 hour'));
								$link = base_url_php()."usuario/confirmar-email?code=".$valor_chave;
								$env = $conn->prepare("INSERT INTO conf_mail(cf_link,cf_expiracao,usu_id) VALUES(:l,:d,:u)");
								$env->bindvalue(":l", $valor_chave);
								$env->bindValue(":d",$data);
								$env->bindValue(":u", $_SESSION["inf_usu"]['usu_id']);
								
								
								$env->execute();
                                
                                renv_email($_SESSION["inf_usu"]['usu_email'],$_SESSION["inf_usu"]['usu_nome'],$link);

                               

                                echo json_encode($json);
                          ?>