<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['editid'];
		$description = $_POST['editdescription'];	
		$gps =$_POST['editgps'];
    $customerid=$_POST['editcustomer'];

		$sql = "UPDATE store SET description = '$description', customerid='$customerid',gps='$gps' WHERE id = '$id'";
		
		if($conn->query($sql)){
			$_SESSION['success'] = 'Tienda actualizada satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Rellene el formulario de edición primero';
	}

	header('location:store.php');

?>