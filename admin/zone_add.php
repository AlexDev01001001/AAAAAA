<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$description = $_POST['description'];
		//$rate = $_POST['rate'];

		$sql = "INSERT INTO zone (description) VALUES ('$description')";
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

	header('location: store.php');

?>