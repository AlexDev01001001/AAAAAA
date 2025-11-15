<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$description = $_POST['description'];		

		$sql = "UPDATE customer SET description = '$description' WHERE id = '$id'";
		//var_dump($sql);
		if($conn->query($sql)){
			$_SESSION['success'] = 'Cliente actualizado satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Rellene el formulario de edición primero';
	}

	header('location:customer.php');

?>