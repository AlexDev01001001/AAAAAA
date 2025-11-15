<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>ANC Asistencia</title>
	<link rel="icon" href="https://i.ibb.co/5RR9P9b/faviconconfiguroweb.png">
	
  	<!-- Tell the browser to be responsive to screen width -->
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous">
    </script>  
      <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css"
        rel="stylesheet" />  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js">
    </script>     
    <!-- 
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/dataTables.semanticui.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>
    <link rel="stylesheet" type="text/css" src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css"></link>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-datatables-checkboxes@1.2.12/js/dataTables.checkboxes.min.js"></script>
    <link rel="stylesheet" type="text/css" src="https://cdn.jsdelivr.net/npm/jquery-datatables-checkboxes@1.2.12/js/dataTables.checkboxes.min.js"></link>
    -->
    <?php include 'script/supervisorcd.js.php'; ?>
    <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>  
<body>
    
    <div style="padding-top:20px;"></div>
   
    <div class="ui centered card" style="width:auto;">                     
        <div class="content" style="text-align:center;">
            <div class="header"> Programaci&oacute;n de personal</div>
            <div class="image">
                <img src="https://i.ibb.co/YfmNGFw/1519906153915.png" style="object-fit:fill;">
            </div>
        </div>    
        
        <div class="ui dimmer" id="menu_loading">
            <div class="ui massive text loader">
                <h3>Cargando ... </h3>
            </div>
        </div>
        <div class="ui form">
            <div class="field">
                <label>Filtrar :</label>
                <input type="text" placeholder="Ingresar nombre" id="menucd_txtsearch" style="width:250px;"/>
            </div>
            <div class="field">
                <button class="ui inverted green button" id="menucd_save">Guardar cambios</button>
                <button class="ui inverted red button" id="menucd_logout" style="position:relative;float:right">Men&uacute;</button>
            </div>
            <div class="field">
                <label>Leyenda : </label>
                <label><input type="checkbox" class="ui checkbox" onclick="return false;" checked/> ACTIVO </label>
                <label><input type="checkbox" class="ui checkbox" onclick="return false;"/> INACTIVO </label>
            </div>
            <div class="field" style='width:480;height: 720px;'>
               <div id="table_content" style="overflow:auto;"></div>
            </div>
        </div>
       
               
    </div>
</body>
  
</html>