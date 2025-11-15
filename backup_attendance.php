<?php
	function twopoints_on_earth($latitudeFrom, $longitudeFrom,
	$latitudeTo,  $longitudeTo)
	{
		$long1 = deg2rad($longitudeFrom);
		$long2 = deg2rad($longitudeTo);
		$lat1 = deg2rad($latitudeFrom);
		$lat2 = deg2rad($latitudeTo);

		//Haversine Formula
		$dlong = $long2 - $long1;
		$dlati = $lat2 - $lat1;

		$val = pow(sin($dlati/2),2)+cos($lat1)*cos($lat2)*pow(sin($dlong/2),2);

		$res = 2 * asin(sqrt($val));

		$radius = 3958.756;

		return ($res*$radius*1.609344*1000);
	}
	$output = array('error'=>false);
	
	if(isset($_GET['employee'])){
		

		include 'conn.php';
		include 'timezone.php';

		$employee = $_GET['employee'];		
		$status = $_GET['status'];
		$gps = $_GET['gps'];
		/*
		$value_gps = explode(",",$gps);
		$latitude = $value_gps[0];
		$longitude = $value_gps[1];
		*/

		$motivo=$_GET['motivo'];
		$sql = "SELECT * FROM employees WHERE employee_id = '$employee'";
		$query = $conn->query($sql);
		$date_now = date('Y-m-d');
		//código de usuario reemplazo
		//$replace_employee=$_GET['replace_employee'];
		
		if($query->num_rows > 0){
			$row = $query->fetch_assoc();
			$id = $row['id'];
			/*
			$global_gps = explode(",",$row['gps']);
			$global_latitude = $global_gps[0];
			$global_longitude = $global_gps[1];
			*/
			

			if($status == 'in'){
				//activación de gps
				/*
				$metros = twopoints_on_earth($global_latitude,$global_longitude,$latitude,$longitude);
				if(round($metros)>100){
					$output['error'] = true;
					$output['message'] = 'Usted no se encuentra dentro del rango de la zona de marcación';
					echo json_encode($output);
					return;
				}*/
				//desactivar validación única de marcación por día - 26/02/2021
				$sql = "SELECT * FROM attendance WHERE employee_id = '$id' AND date = '$date_now' AND time_in IS NOT NULL and status not in ('4','5','6','7') and idreplace=0";
				$query = $conn->query($sql);
				if($query->num_rows > 0){
						
						// Agregar validación si existe en tabla 'employees_replace'
						$sql = "select * from employees_replace where replace_date='$date_now' and replace_employee_id='$employee' limit 1";
						$query = $conn->query($sql);						
						if($query && $query->num_rows>0){							
							$sched = $row['schedule_id'];
							$lognow = date('H:i:s');
							$sql = "SELECT * FROM schedules WHERE id = '$sched'";
							$squery = $conn->query($sql);
							$srow = $squery->fetch_assoc();
							$logstatus =($lognow > $srow['time_in']) ? 0 : 1;							
							
							//Buscar registro de reemplazo status in (6,7) para relacionarlo en idreplace
							/*
							$search_idreplace  = "select a.id from attendance a left join employees b on a.employee_id=b.id where a.date='$date_now' and b.employee_id='$employee' and a.status in (6,7)";
							$result_idreplace = $conn->query($search_idreplace);
							$value_idreplace = 0;
							$search_idreplace_bool = false;
							if($result_idreplace->num_rows>0){
								$search_idreplace_bool=true;								
								$row_idreplace = $result_idreplace -> fetch_assoc();
								$value_idreplace = $row_idreplace['id'];
							}
							*/
							//

							$sql = "INSERT INTO attendance (employee_id, date, time_in, status,gps,motivo,idreplace) VALUES ('$id', '$date_now', NOW(), '$logstatus','$gps','')";
							if($conn->query($sql)){
								if($search_idreplace_bool==true){
									// Actualizando attendance
									/*
									$attendance_id = $conn->insert_id;
									$attendance_idreplace = 0;
									if($attendance_id > $value_idreplace){
										$attendance_idreplace = $value_idreplace;
									}								
									$update_attendance = "update attendance set idreplace='$attendance_idreplace' where id='$attendance_id'";
									$exec_attendance = $conn->query($update_attendance);
									*/	
								}
								$output['message'] = 'Entrada: '.$row['firstname'].' '.$row['lastname'];
								$sql = "update employees_replace set status='1' where replace_date='$date_now' and replace_employee_id='$employee'";
								$query = $conn->query($sql);
							}
							else{
								$output['error'] = true;
								$output['message'] = $conn->error;
							}							
					   }else{				
							$output['error'] = true;                    
							$output['message'] = 'Has registrado tu entrada por hoy';
					   }
					
				}
				else{
					//updates
					$sched = $row['schedule_id'];
					$lognow = date('H:i:s');
					$sql = "SELECT * FROM schedules WHERE id = '$sched'";
					$squery = $conn->query($sql);
					$srow = $squery->fetch_assoc();
					$logstatus = ($lognow > $srow['time_in']) ? 0 : 1;
					//
				
					//Buscar registro de reemplazo status in (6,7) para relacionarlo en idreplace
					
					$search_idreplace  = "select a.id from attendance a left join employees b on a.employee_id=b.id where a.date='$date_now' and b.employee_id='$employee' and a.status in (6,7)";
					$result_idreplace = $conn->query($search_idreplace);
					$value_idreplace = 0;
					$search_idreplace_bool = false;
					if($result_idreplace->num_rows>0){
						$search_idreplace_bool=true;
						$row_idreplace = $result_idreplace -> fetch_assoc();
						$value_idreplace = $row_idreplace['id'];
					}
					

					$sql = "INSERT INTO attendance (employee_id, date, time_in, status,gps,motivo) VALUES ('$id', '$date_now', NOW(), '$logstatus','$gps','')";
					if($conn->query($sql)){
						
						// Actualizando attendance
						
						if($search_idreplace_bool==true){
							
							$attendance_id = $conn->insert_id;
							$attendance_idreplace = 0;
							if($attendance_id > $value_idreplace){
								$attendance_idreplace = $value_idreplace;
							}								
							$update_attendance = "update attendance set idreplace='$attendance_idreplace' where id='$attendance_id'";
							$exec_attendance = $conn->query($update_attendance);
						}
							
						
						 // Agregar validación si existe en tabla 'employees_replace'
						 $sql = "select * from employees_replace where replace_date='$date_now' and replace_employee_id='$employee' and status='0' limit 1";
						 $query = $conn->query($sql);
						 if($query && $query->num_rows>0){							
							 $sched = $row['schedule_id'];
							 $lognow = date('H:i:s');
							 $sql = "SELECT * FROM schedules WHERE id = '$sched'";
							 $squery = $conn->query($sql);
							 $srow = $squery->fetch_assoc();
							 $logstatus = ($lognow > $srow['time_in']) ? 0 : 1;
							 //
							 //$sql = "INSERT INTO attendance (employee_id, date, time_in, status,gps,motivo) VALUES ('$id', '$date_now', NOW(), '$logstatus','$gps','')";
							 if($conn->query($sql)){
								 $output['message'] = 'Entrada: '.$row['firstname'].' '.$row['lastname'];
								 $sql = "update employees_replace set status='1' where replace_date='$date_now' and replace_employee_id='$employee'";
								 $query = $conn->query($sql);
							 }
							 else{
								 $output['error'] = true;
								 $output['message'] = $conn->error;
							 }							
						}	 
					}
					else{
						$output['error'] = true;
						$output['message'] = $conn->error;
					}
				}
			}
			else if ($status == 'out') {
				
				$sql = "SELECT *, attendance.id AS uid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id WHERE attendance.employee_id = '$id' AND time_in IS NOT NULL and (hour(time_out)=0 and minute(time_out)=0 and second(time_out)=0) and attendance.status not in (4,5,6,7)  order by attendance.id desc LIMIT 1";
				$query = $conn->query($sql);
				if($query->num_rows < 1){
					$output['error'] = true;
					$output['message'] = 'No se puede registrar tu salida, sin previamente registrar tu entrada.';
				}
				else{
					$row = $query->fetch_assoc();
					if($row['time_out'] != '00:00:00'){
						$output['error'] = true;
						$output['message'] = 'Has registrado tu salida satisfactoriamente por el día de hoy';
					}
					else{
						
						$sql = "UPDATE attendance SET time_out = NOW() WHERE id = '".$row['uid']."'";
						if($conn->query($sql)){
							$output['message'] = 'Salida: '.$row['firstname'].' '.$row['lastname'];

							$sql = "SELECT * FROM attendance WHERE id = '".$row['uid']."'";
							$query = $conn->query($sql);
							$urow = $query->fetch_assoc();

							$time_in = $urow['time_in'];
							$time_out = $urow['time_out'];

							$sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$id'";
							$query = $conn->query($sql);
							$srow = $query->fetch_assoc();

							if($srow['time_in'] > $urow['time_in']){
								$time_in = $srow['time_in'];
							}

							if($srow['time_out'] < $urow['time_in']){
								$time_out = $srow['time_out'];
							}

							$time_in = new DateTime($time_in);
							$time_out = new DateTime($time_out);
							$interval = $time_in->diff($time_out);
							$hrs = $interval->format('%h');
							$mins = $interval->format('%i');
							$mins = $mins/60;
							$int = $hrs + $mins;
							if($int > 4){
								$int = $int - 1;
							}

							$sql = "UPDATE attendance SET num_hr = '$int' WHERE id = '".$row['uid']."'";
							$conn->query($sql);
						}
						else{
							$output['error'] = true;
							$output['message'] = $conn->error;
						}
					}
					
				}
			}else if($status == "replace"){
				
				if($conn->query($sql)){					
					$output['message'] = 'Entrada de reemplazo : '.$row['firstname'].' '.$row['lastname'];	
						
				}else{
					$output['error'] = true;
					$output['message'] = "El reemplazo ya fue asignado por el día de hoy";
				}
			
			}else{
				$Fquery = "select a.*,b.employee_id from attendance a left join employees b on a.employee_id=b.id where b.employee_id='$employee' and a.date=date(now())";
				$Fresult = $conn->query($Fquery);
				if($Fresult->num_rows < 1){
					$sched = $row['schedule_id'];
					$lognow = date('H:i:s');
					$sql = "SELECT * FROM schedules WHERE id = '$sched'";
					$squery = $conn->query($sql);
					$srow = $squery->fetch_assoc();
					$logstatus = 4;
					//
					$sql = "INSERT INTO attendance (employee_id, date, time_in, status,gps,motivo) VALUES ('$id', '$date_now', NOW(), '$logstatus','$gps','$motivo')";
					if($conn->query($sql)){
						
						$output['message'] = 'Se informará de tu inasistencia  '.$row['firstname'].' '.$row['lastname'];
					}
					else{
						$output['error'] = true;
						$output['message'] = $conn->error;
					}
				}else{
					$output['error'] = true;
					$output['message'] = 'Has registrado tu inasistencia satisfactoriamente por el día de hoy';
				}
			}
		}
		else{
			$output['error'] = true;
			$output['message'] = 'ID de empleado no encontrado';
		}
		
	}
	
	echo json_encode($output);

?>