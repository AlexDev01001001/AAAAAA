<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>ANC Asistencia</title>
	<link rel="icon" href="https://i.ibb.co/5RR9P9b/faviconconfiguroweb.png">
	
  	<!-- Tell the browser to be responsive to screen width -->
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css"
        rel="stylesheet" />  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js">
    </script>  
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous">
    </script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js">
    </script>
    <?php include 'script/options.js.php'; ?>
</head>  
<body>
    <div style="padding-top:20px;"></div>
    <div class="ui centered cards">
        <div class="ui centered card">
            <div class="header"></div>
            <div class="image">
                <img src="https://i.ibb.co/YfmNGFw/1519906153915.png" style="object-fit:fill;">
            </div> 
        </div>
        <div class="ui card">

            <label class="ui label">Session activa =>  <?php
            $dtz = new DateTimeZone("America/Lima");
            $dt = new DateTime("now", $dtz);
            
            //Stores time as "2021-04-04T13:35:48":
            $currentTime = $dt->format("Y-m-d") . "T" . $dt->format("H:i:s");
            
            print $currentTime;
            ?></label>
        </div>
        <div class="card" style="box-shadow: -10px 10px 0px 0px #FF33D7;" id="options_personal">
            <div class="content">
            <div class="header">[Personas]</div>
            <div class="meta"></div>
            <div class="description">
                Mantenimiento de personal
            </div>
            </div>
        </div>
        <div class="card" style="box-shadow: -10px 10px 0px 0px #FF33D7;" id="options_plan">
            <div class="content">
            <div class="header">[Planeamiento semanal]</div>
            <div class="meta"></div>
            <div class="description">
                M&oacute;dulo para el registro de planeamiento horario
            </div>
            </div>
        </div>
        <div class="card">
            <div class="ui red button" id="options_cerrar">Cerrar Sesi&oacute;n</div>
        </div>
        
    </div>
</body>
</html>


