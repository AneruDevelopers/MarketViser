<?php
    require_once 'connection/conn.php';
		
	$chave = isset($_GET['code'])?$_GET['code']:NULL;
	
	if($chave){
	 $id = isset($_SESSION["inf_usu"]['usu_id'])?$_SESSION["inf_usu"]['usu_id']:NULL;
	  if($id){
    		$sel = $conn->prepare("SELECT * FROM conf_mail WHERE cf_link= :code AND usu_id= :id");
			$sel->bindValue(":code", $chave);
			$sel->bindValue(":id", $id);
			$sel->execute();
			if($sel->rowCount() > 0) {
				while($row = $sel->fetch(PDO::FETCH_ASSOC)) {
				 if($row['cf_status'] == 0){ 
				 
				}else{
					$sel2 = $conn->prepare("SELECT usu_cstatus FROM usuario WHERE usu_id =:id ");
					$sel2->bindValue(":id", $id);
					$sel2->execute();
					$rows = $sel2->fetchAll();	
					foreach($rows as $usu){
						print_r($usu); 
					}	
				}
			}
			}
			else{
						
				$_SESSION['conf_status']['vr'] = "Email Já Verificado";
			}	    
	  }
	  else{
		$_SESSION['conf_status']['vr'] = "Você não esta Logado";
	  }
	}
	else{
		$_SESSION['conf_status']['vr'] = "ERROR";
	}
	
	//print_r($_SESSION['conf_status']);
		/*
				
			
				//colocar toda estrutura aqui		

				

							$dateStart = date('Y-m-d H:i:s');
							$dateEnd = $row['cf_expiracao'];
							$hora = substr($row['cf_expiracao'],-8);
							$dia = substr($row['cf_expiracao'],0,10);
							if(Date("Y-m-d") == $dia) {
								if(Date("H:i:s") >= $hora) {
									$_SESSION['conf_status']['vr'] = "Codigo Expirado";
								}else{
									$_SESSION['conf_status']['vr'] = "Email Confirmado Com Sucesso";	
									$sel2 = $conn->prepare("UPDATE conf_mail SET cf_status=1   WHERE cf_link= :code");
								   	$sel2->bindValue(":code", $chave);
									$sel2->execute(); 
									
									$sel3 = $conn->prepare("UPDATE usuario SET usu_cstatus=1   WHERE usu_id= :id");
									$sel3->bindValue(":id", $id);
					
									if($sel3->execute()){
										$del = $conn->prepare("DELETE FROM conf_mail WHERE usu_id = :id");
										$del->bindValue(":id", $id);
									    $del->execute(); 
									}
								}
							}elseif(Date("Y-m-d") == $dia and Date("H:i:s") >= $hora){

								$_SESSION['conf_status']['vr'] = "Codigo Expirado";
							}		
						}else{
							$_SESSION['conf_status']['vr'] = "Você já verificou a Conta";
						}
					}	
				}else{
					$_SESSION['conf_status']['vr'] = "Este codigo não existe ou esta expirado";
				}	

			}
			else{
				$_SESSION['conf_status']['vr'] = "Você não esta Logado";
			
			}
		}

*/
   
?>