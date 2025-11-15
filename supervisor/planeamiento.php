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
    <?php include 'script/plan.js.php';?>
</head>  
<body>
<div style="padding-top:20px;"></div>
    <div class="ui centered cards"> 
        <div class="ui centered card" style="width:100%;">
           <div class="content" style="text-align:center;">
                <div class="header"> Planificación de turnos</div>
                <div class="image">
                    <img src="https://i.ibb.co/YfmNGFw/1519906153915.png" style="object-fit:fill;">
                </div>
           </div>
           <div class="content">
            <div class="ui placeholder" id="loader">
            <div class="image header">
            <div class="line"></div>
            <div class="line"></div>
            </div>
            <div class="paragraph">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div> 
            <div class="ui dimmer" id="menu_loading">
                <div class="ui massive text loader">
                    <h3>Cargando ...</h3>
                </div>
            </div>   
            <div class="ui form">
                <div class="field">
                    <label>Empleado</label>
                    <select id="listdni" class="ui search dropdown">

                    </select>
                </div>
               
                <div class="field">
                    <label>Turno</label>
                    <select id="listturno" class="ui search dropdown">

                    </select>
                </div>
                <div class="field" id="grpdias">                    
                    <label> D&iacute;a</label>
                    <div class="ui checkbox">
                        <input type="checkbox" value="lunes" name="chkdias"/>
                        <label>Lunes</label>
                    </div>
                    <div class="ui checkbox">
                        <input type="checkbox" value="martes" name="chkdias"/>
                        <label>Martes</label>
                    </div>
                    <div class="ui checkbox">
                        <input type="checkbox" value="miercoles" name="chkdias"/>
                        <label>Miercoles</label>
                    </div>
                    <div class="ui checkbox">
                        <input type="checkbox" value="jueves" name="chkdias"/>
                        <label>Jueves</label>
                    </div>
                    <div class="ui checkbox">
                        <input type="checkbox" value="viernes" name="chkdias"/>
                        <label>Viernes</label>
                    </div>
                    <div class="ui checkbox">
                        <input type="checkbox" value="sabado" name="chkdias"/>
                        <label>Sabado</label>
                    </div>
                    <div class="ui checkbox">
                        <input type="checkbox" value="domingo" name="chkdias"/>
                        <label>Domingo</label>
                    </div>
                   
                </div>
                <div class="field">
                    <label id="message"></label>
                </div>
                <div class="field">
                    <div class="ui blue button" id="plan_save">Guardar</div>
                    <div class="ui red button" id="plan_menu">Men&uacute;</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>