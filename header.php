<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>ANC Asistencia</title>
	<link rel="icon" href="https://i.ibb.co/5RR9P9b/faviconconfiguroweb.png">
	
  	<!-- Tell the browser to be responsive to screen width -->
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  	<!-- Bootstrap 3.3.7 -->
  	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  	<!-- Font Awesome -->
  	<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  	<!-- Theme style -->
  	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	
  	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  	<!--[if lt IE 9]>
  	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  	<![endif]-->

  	<!-- Google Font -->
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  	<style type="text/css">
  		.mt20{
  			margin-top:20px;
  		}
  		.result{
  			font-size:20px;
  		}
      .bold{
        font-weight: bold;
      }
  	</style>
<script>
var x = document.getElementById("gps");
localStorage.setItem("statusgps",1);
function getLocation() {
  if (navigator.geolocation) {
	
    navigator.geolocation.getCurrentPosition(showPosition,showError);
	
  } else { 
    
  }
}

function showPosition(position) { 
	$("#gps").val(position.coords.latitude + "," + position.coords.longitude);
}
function showError(error){
	localStorage.setItem("statusgps",0);
	switch(error.code) {
		case error.PERMISSION_DENIED:
			// alert( "No debe bloquear el acceso al GPS, en caso sea un error favor de contactar con TI");
                        // location.reload();
		break;
		case error.POSITION_UNAVAILABLE:
			// alert(  "Location information is unavailable.");
                        // location.reload();
		break;
		case error.TIMEOUT:
			// alert( "The request to get user location timed out.");
                        // location.reload();
		break;
		case error.UNKNOWN_ERROR:
			// alert(  "An unknown error occurred.");
                        // location.reload();
		break;
	}
}
</script>
</head>