<?php
	$conn = new mysqli('MYSQL5044.site4now.net', 'db_a6f79d_app', 'Tf4vMPQscjVn39X', 'db_a6f79d_apsys');
	//$conn = new mysqli('localhost', 'root', '', 'db_a6f79d_apsys');
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>