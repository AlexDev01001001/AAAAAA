<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		// 10.03.2021 - se adiciona campo DNI para usarlo como usuario
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
		$status =$_POST['status'];
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		//creating employeeid
		$letters = '';
		$numbers = '';
		foreach (range('A', 'Z') as $char) {
		    $letters .= $char;
		}
		for($i = 0; $i < 10; $i++){
			$numbers .= $i;
		}
		//$employee_id = strtoupper(substr($firstname,0,1).explode(" ",$lastname)[0]); //substr(str_shuffle($letters), 0, 3).substr(str_shuffle($numbers), 0, 9);
		//
		//$sql = "INSERT INTO employees (employee_id, firstname, lastname, address, birthdate, contact_info, gender, position_id, schedule_id, photo, created_on) VALUES ('$employee_id', '$firstname', '$lastname', '$address', '$birthdate', '$contact', '$gender', '$position', '$schedule', '$filename', NOW())";
		$sql = "INSERT INTO employees (employee_id, firstname, lastname, position_id, schedule_id, created_on,store,supervisor,mode,zone,role,customer,status) VALUES ('$employee_id', '$firstname', '$lastname', '$position', '$schedule',  NOW(),'$store','$supervisor','$mode','$zone','$role','$customer','$status')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Empleado añadido satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: employee.php');
?>