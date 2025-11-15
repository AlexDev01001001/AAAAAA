<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['del_roleid'];
		$sql = "DELETE FROM role WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Role deleted successfully';
            sleep(5);
            header('location: role.php');
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	
	
?>