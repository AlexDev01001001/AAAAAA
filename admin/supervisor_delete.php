<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM supervisor WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Supervisor deleted successfully';
            sleep(5);
            header('location: supervisor.php');
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	
	
?>