<?php session_start(); ?>
<?php date_default_timezone_set('America/Lima'); ?>
<?php include 'header.php'; ?>
<body class="hold-transition login-page" >
<div class="login-box">
  	<div class="login-logo">
  		<p id="date"></p>
      <p id="time" class="bold"></p>
  	</div>
   
  	<div class="login-box-body">
    	<h4 class="login-box-msg">Ingrese su ID de Brigada</h4>
        Reemplazo de : 
        <input style="background-color:lightgreen;" type="text" class="form-control" id="txtreemplazo" value="<?php echo $_GET['nombre'];?>"/>
        <input type="hidden" id="txtdni" value="<?php echo $_GET['dni'];?>"/>
        <br/>
    	<form id="attendanceb">
          <div class="form-group">
            <select class="form-control" name="status" id="cbotype">
              <option value="in">Hora de Entrada</option>
              <option value="out">Hora de Salida</option>              
            </select>
          </div>
    
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control input-lg" id="txtemployee" name="employee" required>
        		<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
            <input type="text" id="txtgps" name="gps" hidden/>
      		</div>
          
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="button" id="btnlogin" class="btn btn-primary btn-block btn-flat" name="signin"><i class="fa fa-sign-in"></i> Login</button>
        		</div>
      		</div>
    	</form>
  	</div>
	<div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
    </div>
	  <div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
    </div>
  	<div class="alert alert-warning alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
    </div>
</div>
<?php include 'scripts.php' ?>
<script type="text/javascript">
$(function() {
    $("#btnlogin").click(function(e){
      $('.alert').hide();
      $('.alert-warning').show();
      $('.message').html("Generando registro de brigada, espere ...");
      $('#employee').val('');

    $.ajax({      
      url: 'attendanceb.php',
      data: {
        employee: $("#txtemployee").val(),
        status:$("#cbotype").val(),
        gps:$("#txtgps").val(),
        motivo:"",
        brigada:"true",
        dni: $("#txtdni").val()
      },      
      cache:false,
      success: function(response){     
        
        if($("#cbotype").val()=="none"){
            $('.alert').hide();
            $('.alert-warning').show();
            $('.message').html(response);
            $('#employee').val('');
        }else{
          if(response.includes("Has")){
            $('.alert').hide();
            $('.alert-danger').show();
            $('.message').html(response);
          }
          else{
            $('.alert').hide();
            $('.alert-success').show();
            $('.message').html(response);
            $('#employee').val('');
            
            setTimeout(() => {
              location.href="index.php";
            }, 2000);
            
            //location.href="index.php";
          }
        }
      }
    });
  });
});
</script>