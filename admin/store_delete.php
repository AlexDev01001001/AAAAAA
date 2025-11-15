<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['del_storeid'];
		$sql = "DELETE FROM store WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Store deleted successfully';
            sleep(5);
            header('location: store.php');
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	
	
?>