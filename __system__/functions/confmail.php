<?php
    require_once 'connection/conn.php';

				$chave = isset($_GET['code'])?$_GET['code']:NULL;
		if($chave){		
				$id = isset($_SESSION["inf_usu"]['usu_id'])?$_SESSION["inf_usu"]['usu_id']:NULL;
			if($id){				
				$sel3 = $conn->prepare("SELECT usu_cstatus FROM usuario WHERE usu_id = :id ");
				$sel3->bindValue(":id", $id);
				$sel3->execute();
				if($sel3->rowCount() == 1) {
					$rows = $sel3->fetchAll();
					foreach($rows as $row) {
						if($row['usu_cstatus'] == 0){
							$sel = $conn->prepare("SELECT cf_expiracao,cf_status FROM conf_mail WHERE cf_link = :code AND usu_id = :id");
							$sel->bindvalue(":code",$chave);
							$sel->bindValue(":id", $id);
							$sel->execute();
							$res = $sel->fetchAll();
							 foreach($res as $row){
								   if($row['cf_status'] == 0){ 
									$inicio = $row['cf_expiracao'] ;
									$dataLimite = date_create($inicio);
									date_add($dataLimite, date_interval_create_from_date_string('1 hours'));
									$dataServ = date_create(date("Y-m-d H:i:s"));
									if($dataServ < $dataLimite){
										$up = $conn->prepare("UPDATE conf_mail SET cf_status=1   WHERE cf_link= :code");
										$up->bindValue(":code", $chave);
										if($up->execute()){
											$up2 = $conn->prepare("UPDATE usuario SET usu_cstatus=1   WHERE usu_id= :id");
											$up2->bindValue(":id", $id);
											if($up2->execute()){
												$del = $conn->prepare("DELETE FROM conf_mail WHERE usu_id = :id");
												$del->bindValue(":id", $id);
												if($del->execute()){
													$status = 2;
												}	  
											}												
										}										
									}else{
										$status = 1;
									}
								   }else{
										$status = 1;
								   }
								}	                         
						}else{
							header("Location:configurar");
						}
					}	
				}else{
					header("Location: ../");
				}
		
			}else{
				header("Location: ../");
			}
     	}else{
			header("Location: ../");
		 }
	  
?>