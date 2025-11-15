<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$description = $_POST['description'];
        $mail = $_POST['mail'];
		//$rate = $_POST['rate'];

		$sql = "INSERT INTO supervisor (description,mail) VALUES ('$description','$mail')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Description added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: supervisor.php');

?>