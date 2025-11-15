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
    <?php include 'script/login.js.php'; ?>
</head>  
<body>
    
    <div class="ui middle aligned center aligned grid">
        <div class="column">
            <div class="ui form">
                <div class="ui segment">
                    <div class="image">
                        <img src="https://i.ibb.co/YfmNGFw/1519906153915.png" style="object-fit:fill;">
                    </div>
                    <h2>Control de supervisor</h2>
                    <div class="ui center aligned basic segment">
                        <div class="ui form">
                            <div class="field">
                                <div class="ui left input">
                                    <input type="text" id="supervisor_user" placeholder="Ingresar usuario"/>
                                </div>
                            </div>
                            <div class="field">
                                <div clasS="ui left input">
                                    <input type="password" id="supervisor_pwd" placeholder="Contraseña"/>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui gray button" id="supervisor_marcaciones"><< Marcaciones</div>
                                <div class="ui blue button" id="supervisor_ingresar">Ingresar</div>
                               
                            </div>
                            <div class="field">
                                
                                
                            </div>
                        </div>
                        <div class="ui divider"></div>                        
                       
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>