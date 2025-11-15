<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$empid = $_POST['id'];
		$employee_id=$_POST['empid']; //DNI
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		//$address = $_POST['address'];
		//$birthdate = $_POST['birthdate'];
		//$contact = $_POST['contact'];
		//$gender = $_POST['gender'];
		$position = $_POST['position'];
		$schedule = $_POST['schedule'];
		$store = $_POST['store'];
		$supervisor = $_POST['supervisor'];
		$mode = $_POST['mode'];
		$zone = $_POST['zone'];
		$role = $_POST['role'];
		$customer = $_POST['customer'];
		$status = $_POST['status'];
		$sql = "UPDATE employees SET status='$status', firstname = '$firstname', lastname = '$lastname', position_id = '$position', schedule_id = '$schedule',store='$store',supervisor='$supervisor',mode='$mode',zone='$zone',role='$role',customer='$customer' WHERE id = '$empid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Empleado actualizado con éxito';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Seleccionar empleado para editar primero';
	}

	header('location: employee.php');
?>