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
    <?php include 'script/supervisor.js.php'; ?>
</head>  
<body>
    
    <div style="padding-top:20px;"></div>
   
    <div class="ui centered card" style="width:480px;">                     
        <div class="content" style="text-align:center;">
            <div class="header"> Programaci&oacute;n de personal</div>
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
            </div>
                <div class="ui dimmer" id="menu_loading">
                    <div class="ui massive text loader">
                        <h3>Cargando ... </h3>
                    </div>
                </div>               
                              
                <div class="ui form">                    
                    
                    <div class="field">                    
                        <div class="field">
                            <label>Personal </label>
                        </div>
                        <div class="field">
                        
                                <select id="listdni" class="ui search dropdown" >                        
                                </select>
                                
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <label>Puesto</label>
                                <select id="listpuesto" class="ui search dropdown" > 
                                                            
                                </select>
                            </div>
                            <div class="field">
                                <label>Modalidad</label>
                                <select id="listmode" class="ui search dropdown" >
                                    <option value="">Modalidad</option>
                                    <option value="FT">Full Time</option>
                                    <option value="PT">Part Time</option>
                                    <option value="NA">No asignado</option>
                                </select>
                            </div>
                        </div>                    
                        <div class="two fields">
                            <div class="field">
                                <label>Turno</label>
                                <select id="listturno" class="ui search dropdown">

                                </select>
                            </div>                    
                            <div class="field">
                                <label>Tienda</label>
                                <select id="listtienda" class="ui search dropdown">
                                </select>
                            </div>                        
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <label>Zona</label>
                                <select id="listzona" class="ui search dropdown">
                                </select>
                            </div>
                            <div class="field">
                                <label>Estado</label>
                                <select id="listestado" class="ui search dropdown" >
                                    <option value="">Estado</option>
                                    <option value="1">Activo</option>
                                    <option value="2">Vacante</option>
                                    <option value="3">Inactivo</option>
                                    <option value="0">Baja</option>
                                </select>
                            </div>
                        </div>
                        <div class="field">
                            <label id="message"></label>
                        </div>
                    <div class="field">
                        <div class="ui blue button" id="menu_save">Guardar</div>
                        <div class="ui red button" id="menu_logout">Men&uacute;</div>
                    </div>
                    </div>            
                
            </div>       
        </div>        
    </div>
</body>
  
</html>