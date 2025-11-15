<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['del_status'];
		$sql = "DELETE FROM status WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Status deleted successfully';
            sleep(5);
            header('location: status.php');
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	
	
?>