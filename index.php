<?php session_start(); ?>
<?php date_default_timezone_set('America/Lima'); ?>
<?php include 'header.php'; ?>
<!-- modal activación de camara -->
<div class="modal" id="livestream_scanner">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ANC Selfie</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="position: static">
               <!--  <video autoplay="true" id="interactive-video" style="width:100%;"></video> -->
            </div>
            <div class="modal-footer">
             <!-- <button type="button" class="btn btn-primary" data-dismiss="modal" id="live_btnmarcar">Tomar Foto</button> -->
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->
<!-- -->
<body class="hold-transition login-page" style="background-color:white;">
<div class="login-box">
  	<div class="login-logo">
      <div class="login-box-body" style="box-shadow: 10px -10px 0px 0px #FF33D7;">
      <img src="images/logo1.png" style="width:128px;height:128px; text-align:left;">
      </div>
  		<p id="date" style="font-size:18px;"></p>
      <p id="time" class="bold" style="font-size:16px;color:#FF33D7;"></p>
  	</div>
  
  	<div class="login-box-body" style="box-shadow: -10px 10px 0px 0px #FF33D7;">
    	<h4 class="login-box-msg">Ingrese su ID de Empleado</h4>

    	<form id="attendance">
          <div class="form-group">            
            <select class="form-control" name="status" id="cbotype">
              <option value="in">Hora de Entrada</option>
              <option value="out">Hora de Salida</option>
              <!-- <option value="none">Inasistencia</option> -->
              <!-- <option value="replace">Reemplazo de :</option> -->
            </select>

          </div>
          
          <div class="form-group" id="form_motivo" hidden>
            <select class="form-control" name="motivo" id="cbomotivo">
              
            </select>
          </div>
      		<div class="form-group has-feedback employee">
        		<input type="text" class="form-control input-lg" id="employee" name="employee" required>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
            <input type="text" id="gps" name="gps" hidden/>
      		</div>
          <div class="form-group">
            <select class="form-control" name="cbostores" id="cbostores">
            
            </select>
          </div>
          <div class="form-group has-feedback supervisor">
        		<input type="password" class="form-control input-lg" id="supervisor" name="supervisor">
        		<span class="glyphicon glyphicon-lock form-control-feedback"></span>            
      		</div>
          <div class="form-group has-feedback replace_employee">
        		<input type="text" class="form-control input-lg" id="replace_employee" name="replace_employee">
        		<span class="glyphicon glyphicon-random form-control-feedback"></span>            
      		</div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="signin"><i class="fa fa-sign-in"></i> Login</button><br/>
               <!--<button type="button" class="btn btn-info btn--block btn-flat" name="btnsupervisor" id="btnsupervisor"><i class="fa fa-sign in"></i>¿Eres supervisor?</button>-->
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
$(".replace_employee").hide();
$(".supervisor").hide();
$(function() {
  var interval = setInterval(function() {	
  var momentNow = moment();		
	var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
	var f=new Date();
	//alert();
    $('#date').html(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear()); 
    $('#time').html(momentNow.format('hh:mm:ss A'));
  }, 100);


  $("#employee").click(function(){
    getLocation();
    
  });
  function getstores(){
    $.ajax({
        type:"GET",
        url:"attendance.php",
        data:{
          option: 1,
          gps: $("#gps").val()
        
        },
        cache:false,
        before: function(before){
          console.log("procesando");
        },
        success: function(response){            
            var json =$.parseJSON(response);       
            
            var html="<option value='-1' selected>Seleccionar Tienda</option>";
            $(json).each(function(i, val){

                html+="<option value='" + val.id + "'>" + val.description +"</option>";
              
              $("#cbostores").html(html);
            });
        }
      });
  }
 $("#cbostores").click(function(e){
    //e.preventDefault();
    
 })

  $("#btnsupervisor").click(function(e){
    location.href= "supervisor/login.php";
  })
  $("#attendance").submit(function(e){    
    e.preventDefault();   
    if(($("#cbostores").val()==-1 || $("#cbostores").val()==null) & $("#cbotype").val()=="in"){
      $(".alert").hide();
      $(".alert-danger").show();
      $(".message").html("Usted se encuentra fuera del rango de marcaci&oacute;n");
      return false;
    }

    var attendance = $(this).serialize();
    
    $.ajax({
      type: 'GET',
      url: 'attendance.php',
      data: attendance,
      dataType: 'json',
      success: function(response){
        if(response.error){
          $(".alert").hide();
          $(".alert-danger").show();
          $(".message").html(response.message);
        }else{
          $(".alert").hide();
          $(".alert-success").show();
          $(".message").html(response.message);
        }
      },
      error:function(error){
        console.log(error);
      }
    });
  });

  $('#employee').focusout(function(e){
    getstores();
    /*
    if($("#cbotype").val()=="in"){
      $("#livestream_scanner").modal("show");
      var video = document.querySelector("#interactive-video");
      if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true })
          .then(function (stream) {
            video.srcObject = stream;
          })
          .catch(function (error) {
            console.log("Something went wrong!");
          });
      }
    }
    */
  });
  $("#cbotype").change(function(){
    
    if($("#cbotype").val()=="out"){
      $("#cbostores").hide();
    }else{
      $("#cbostores").show();
    }

    if($("#cbotype").val()=="none"){
      $("#form_motivo").show();
    }else{
      $("#form_motivo").hide();
    }
    if($("#cbotype").val()=="replace"){
      $(".supervisor").show();
    }else{
      $(".supervisor").hide();
    }
    
  });
  $("#supervisor").focusout(function(){
    if($("#supervisor").val()=="4nc2021"){      
      $(".replace_employee").show();
    }else{
      $(".replace_employee").hide();
    }
  });
 
});
</script>
</body>
</html>