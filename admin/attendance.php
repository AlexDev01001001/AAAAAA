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
      <h1>Asistencia</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Asistencia</li>
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
                  <th class="hidden"></th>
                  <th>Fecha</th>
                  <th>ID Empleado</th>
                  <th>Nombre</th>
                  <th>Hora Entrada</th>
                  <th>Hora Salida</th>
                  <th>Acción</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid 
                            FROM attendance 
                            LEFT JOIN employees ON employees.id=attendance.employee_id 
                            WHERE month(attendance.date)=month(now()) 
                            ORDER BY attendance.date DESC, attendance.time_in DESC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $status = ($row['status'])?'<span class="label label-warning pull-right">a tiempo</span>':'<span class="label label-danger pull-right">tarde</span>';
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".date('M d, Y', strtotime($row['date']))."</td>
                          <td>".$row['empid']."</td>
                          <td>".$row['firstname'].' '.$row['lastname']."</td>
                          <td>".date('h:i A', strtotime($row['time_in'])).$status."</td>
                          <td>".date('h:i A', strtotime($row['time_out']))."</td>
                          <td>
                            <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['attid']."'><i class='fa fa-edit'></i> Editar</button>
                            <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['attid']."'><i class='fa fa-trash'></i> Eliminar</button>
                          </td>
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

  <!-- Modal de asistencia modificado para tienda fija -->
  <div class="modal fade" id="addnew">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title"><b>Registrar Asistencia</b></h4>
              </div>
              <div class="modal-body">
                  <form class="form-horizontal" method="POST" action="attendance_add.php">

                      <!-- Seleccionar empleado -->
                      <div class="form-group">
                          <label for="employee" class="col-sm-3 control-label">Empleado</label>
                          <div class="col-sm-9">
                              <select class="form-control selectpicker" name="employee" id="employee" data-live-search="true" required>
                                  <option value="" selected>- Seleccionar empleado -</option>
                                  <?php
                                      $sql = "SELECT id, employee_id, firstname, lastname FROM employees";
                                      $query = $conn->query($sql);
                                      while($erow = $query->fetch_assoc()){
                                          echo "<option value='".$erow['employee_id']."'>".$erow['firstname'].' '.$erow['lastname']." (".$erow['employee_id'].")</option>";
                                      }
                                  ?>
                              </select>
                          </div>
                      </div>

                      <!-- Fecha -->
                      <div class="form-group">
                          <label for="date" class="col-sm-3 control-label">Fecha</label>
                          <div class="col-sm-9">
                              <input type="date" class="form-control" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" required>
                          </div>
                      </div>

                      <!-- Hora de entrada -->
                      <div class="form-group">
                          <label for="time_in" class="col-sm-3 control-label">Hora Entrada</label>
                          <div class="col-sm-9">
                              <input type="time" class="form-control" name="time_in" id="time_in" required>
                          </div>
                      </div>

                      <!-- Hora de salida -->
                      <div class="form-group">
                          <label for="time_out" class="col-sm-3 control-label">Hora Salida</label>
                          <div class="col-sm-9">
                              <input type="time" class="form-control" name="time_out" id="time_out" required>
                          </div>
                      </div>

                      <!-- Tienda fija -->
                      <div class="form-group">
                          <label for="store" class="col-sm-3 control-label">Tienda</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control" value="Tienda 1" disabled>
                              <input type="hidden" name="storeid" value="1">
                          </div>
                      </div>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">
                      <i class="fa fa-close"></i> Cerrar
                  </button>
                  <button type="submit" class="btn btn-primary btn-flat" name="add">
                      <i class="fa fa-save"></i> Registrar
                  </button>
                  </form>
              </div>
          </div>
      </div>
  </div>

</div>

<?php include 'includes/scripts.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
<script>
$(function(){
  $("#example1").on("click",".edit",function(e){
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

  $('.selectpicker').selectpicker('refresh');
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'attendance_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#datepicker_edit').val(response.date);
      $('#attendance_date').html(response.date);
      $('#edit_time_in').val(response.time_in);
      $('#edit_time_out').val(response.time_out);
      $('#attid').val(response.attid);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#del_attid').val(response.attid);
      $('#del_employee_name').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>
