<?php
	if(isset($_POST['employee'])){
		$output = array('error'=>false);

		include 'conn.php';
		include 'timezone.php';

		$employee = $_POST['employee'];
		$status = $_POST['status'];
		$gps = $_POST['gps'];
		$motivo=$_POST['motivo'];
		$sql = "SELECT * FROM employees WHERE employee_id = '$employee'";
		$query = $conn->query($sql);
		$date_now = date('Y-m-d');
		if($query->num_rows > 0){
			$row = $query->fetch_assoc();
			$id = $row['id'];

			//$date_now = date('2021-02-08');
			//$date_now = date('Y-m-d');
			
			if($status == 'in'){
				//desactivar validación única de marcación por día - 26/02/2021
				
				$sql = "SELECT * FROM attendance WHERE employee_id = '$id' AND date = date(date_add(UTC_TIMESTAMP(),interval -5 hour)) AND time_in IS NOT NULL and status<>'6'";
				$query = $conn->query($sql);
				if($query->num_rows > 0){
                    // Agregar validación si existe en tabla 'employees_replace'
                    $sql = "select * from employees_replace where date=date(date_add(UTC_TIMESTAMP(),interval -5 hour)) and replace_employee_id='$replace_id'";
                    $query = $conn->query($sql);
                    if($query->num_rows > 0){
                        $sched = $row['schedule_id'];
                        $lognow = date('H:i:s');
                        $sql = "SELECT * FROM schedules WHERE id = '$sched'";
                        $squery = $conn->query($sql);
                        $srow = $squery->fetch_assoc();
                        $logstatus = ($lognow > $srow['time_in']) ? 0 : 1;
                        //
                        $sql = "INSERT INTO attendance (employee_id, date, time_in, status,gps,motivo) VALUES ('$id', date(date_add(UTC_TIMESTAMP(),interval -5 hour)),date_add(UTC_TIMESTAMP(),interval -5 hour),  '$logstatus','$gps','')";
                        if($conn->query($sql)){
                            $output['message'] = 'Entrada: '.$row['firstname'].' '.$row['lastname'];
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
					$sql = "INSERT INTO attendance (employee_id, date, time_in, status,gps,motivo) VALUES ('$id', date(date_add(UTC_TIMESTAMP(),interval -5 hour)), date_add(UTC_TIMESTAMP(),interval -5 hour), '$logstatus','$gps','')";
					if($conn->query($sql)){
						$output['message'] = 'Entrada: '.$row['firstname'].' '.$row['lastname'];
					}
					else{
						$output['error'] = true;
						$output['message'] = $conn->error;
					}
				}
			}
			else if ($status == 'out') {
				
				$sql = "SELECT *, attendance.id AS uid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id WHERE attendance.employee_id = '$id' AND time_in IS NOT NULL and (hour(time_out)=0 and minute(time_out)=0 and second(time_out)=0) and attendance.status not in (4,5,6)  order by attendance.id desc LIMIT 1";
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
					$sql = "INSERT INTO attendance (employee_id, date, time_in, status,gps,motivo) VALUES ('$id', date(date_add(UTC_TIMESTAMP(),interval -5 hour)), date_add(UTC_TIMESTAMP(),interval -5 hour), '$logstatus','$gps','$motivo')";
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