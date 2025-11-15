<!DOCTYPE html>
<html>
<header class="ui header">
    <meta http-equiv="Content-Type" content="text/html" charset="ISO-8859-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">	
    <link rel="stylesheet" type="text/css" href="semantic.min.css">
    <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
    <script src="semantic.min.js"></script>  
    <?php include "scripts/visit.js.php";?>
    <h3 class="ui block header" style="background-color:#FF33D7;color:white;">
        Reporte ANC
    </h3>   
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.semanticui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.semanticui.min.css">
    <script src="cdn.datatables.net/plug-ins/1.10.15/api/fnReloadAjax.js"></script>
</header>

<body>
    <div class="ui form">
        <div class="two fields">
            <div class="field">
                Clientes
                <select class="ui search dropdown" id="cbocustomers">

                </select>
            </div>
            <!-- 
            <div class="field">
                Tiendas
                <select class="ui search dropdown"  id="cbostores">

                </select>
            </div>
            -->
        </div>     
    </div>
    <br/> 
    <div id="master">
      
    </div>
    <table id="test" class="ui celled table">
      <thead>
        <tr>
          <th>Tienda</th>
          <th>Requerimiento</th>
          <th>Marcaciones</th>
        </tr>
      </thead>
    </table>
</body>