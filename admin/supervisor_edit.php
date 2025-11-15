<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$description = $_POST['description'];	
        $mail = $_POST['mail']	;

		$sql = "UPDATE supervisor SET description = '$description', mail ='$mail' WHERE id = '$id'";
	
		if($conn->query($sql)){
			$_SESSION['success'] = 'Supervisor actualizado satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Rellene el formulario de edición primero';
	}

	header('location:supervisor.php');

?>