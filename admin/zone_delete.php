<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['del_zoneid'];
		$sql = "DELETE FROM zone WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Zone deleted successfully';
            sleep(5);
            header('location: zone.php');
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	
	
?>