<?php
include 'includes/session.php';

if(isset($_POST['add'])){
  $employee = $_POST['employee'];
  $date = $_POST['date'];
  $time_in = $_POST['time_in'];
  $time_out = $_POST['time_out'] ?? '00:00:00';
  $storeid = $_POST['storeid'];

  $sql = "INSERT INTO attendance (employee_id, date, time_in, time_out, store, status)
          VALUES ('$employee', '$date', '$time_in', '$time_out', '$storeid', 0)";

  if($conn->query($sql)){
    $_SESSION['success'] = 'Asistencia registrada correctamente';
  }
  else{
    $_SESSION['error'] = $conn->error;
  }
}
else{
  $_SESSION['error'] = 'Formulario no enviado';
}

header('location: attendance.php');
?>
