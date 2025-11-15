<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Listado de personal con GPS desactivado
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Cargos</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i>¡Proceso Exitoso!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Nuevo</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Puesto</th>
                  <th>Zona</th>
                  <th>Tienda</th>
                  <th>Turno</th>
                  <th>Fecha</th>
                  <th>Hr. Ingreso</th>
                  <th>Hr. Salida</th>
                  <th>Supervisor</th>                  
                </thead>
                <tbody>
                  <?php
                    $sql = "select t.* from ("

                    . "        select a.employee_id,concat(a.firstname,' ',a.lastname) as nombre,(select position.description from position where position.id=a.position_id) as puesto,a.zone,a.store,"
                
                    . "        (select concat(schedules.time_in,'-',schedules.time_out) from schedules where schedules.id=a.schedule_id) as turno,b.date,date_add(b.time_in,interval 3 hour) as horaingreso,"
                
                    . "        date_add(b.time_out, interval 3 hour) as horasalida,supervisor"
                
                    . "        from employees a"
                
                    . "        left join attendance b on a.id=b.employee_id"
                
                    . "        where "
                
                    . "        1=1 "
                
                    . "        and b.gps=''"
                
                    . "        and b.date between DATE(DATE_ADD(UTC_TIMESTAMP(), interval -1 month)) and DATE(DATE_ADD(UTC_TIMESTAMP(),interval -5 hour))"
                
                    . "    ) t order by date desc";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                        <td>".$row['employee_id']."</td>
                          <td>".$row['nombre']."</td> 
                          <td>".$row['puesto']."</td> 
                          <td>".$row["zone"]."</td>
                          <td>".$row["store"]."</td>
                          <td>".$row["turno"]."</td>
                          <td>".$row["date"]."</td>
                          <td>".$row["horaingreso"]."</td>
                          <td>".$row["horasalida"]."</td>
                          <td>".$row["supervisor"]."</td>
                         
                          
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/store_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $("#example1").on("click",".delete",function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');    
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'store_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){       
/*
      $('#posid').val(response.id);
      $('#edit_title').val(response.description);
      $('#edit_rate').val(response.rate);
      $('#del_storeid').val(response.id);
      $('#del_position').html(response.description);
*/
        $("#description").val(response.description);        
        $("#del_store").html(response.description);     
        $("#del_storeid") .val(response.id);
    }
  });
}
</script>
</body>
</html>
