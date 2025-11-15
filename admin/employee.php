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
        Lista de Empleados
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Empleados</li>
        <li class="active">Lista de Empleados</li>
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
              <table id="example1" class="table table-bordered"> <!-- class=""> -->
                <thead>
                  <th>ID Empleado</th>                  
                  <th>Nombre</th>
                  <th>Posición</th>
                  <th>Horarios</th>
                  <th>Tienda</th>
                  <th>Zona</th>
                  <th>Modalidad</th>
                  <th>Rol</th>
                  <th>Cliente</th>
                  <th>Estado</th>
                  <th style='display:none;'>Estado_Cod</th>
                  <th>Miembro Desde</th>
                  <th>Acción</th>
                </thead>
                <tbody>
                  <?php
                    //$sql = "SELECT *, employees.id AS empid FROM employees LEFT JOIN position ON position.id=employees.position_id LEFT JOIN schedules ON schedules.id=employees.schedule_id";
                    $sql = "SELECT *,a.id as empid FROM employees a left join position b on a.position_id=b.id left join schedules c on a.schedule_id=c.id"; //WHERE a.employee_id='$id'";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?php echo $row['employee_id']; ?></td>                          
                          <td><?php echo $row['firstname'].' '.$row['lastname']; ?></td>
                          <td><?php echo $row['description']; ?></td>
                          <td><?php echo date('h:i A', strtotime($row['time_in'])).' - '.date('h:i A', strtotime($row['time_out'])); ?></td>

                          <td><?php echo $row['store'];?></td>
                          <td><?php echo $row['zone'];?></td>
                          <td><?php echo $row['mode'];?></td>
                          <td><?php echo $row['role'];?></td>
                          <td><?php echo $row['customer'];?></td>
                          <td><?php if($row['status']==2){ echo 'VACANTE'; }else if ($row['status']==1){ echo 'ACTIVO'; }else if($row['status']==0){ echo 'BAJA';}else if($row['status']==3){echo 'INACTIVO';};?></td>
                          <td style='display:none;'><?php echo $row['status'];?></td>
                          <td><?php echo date('M d, Y', strtotime($row['created_on'])) ?></td>
                          <td>
                            <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $row['empid']; ?>"><i class="fa fa-edit"></i> Editar</button>
                            <button class="btn btn-danger btn-sm delete btn-flat" data-id="<?php echo $row['empid']; ?>"><i class="fa fa-trash"></i> Eliminar</button>
                          </td>
                        </tr>
                      <?php
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
  <?php include 'includes/employee_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" />  
<script>
  
$(function(){
  $("#position").selectpicker({
    liveSearchStyle: 'contains'
  });
  $("#schedule").selectpicker({
    liveSearchStyle: 'contains'
  });//"val",response.schedule_id).trigger("change");
      $("#zone").selectpicker({
    liveSearchStyle: 'contains'
  });//"val",response.zone).trigger("change");
      $("#store").selectpicker({
    liveSearchStyle: 'contains'
  });//"val",response.store).trigger("change");
      $("#customer").selectpicker({
    liveSearchStyle: 'contains'
  });//"val",response.customer).trigger("change");
      $("#supervisor").selectpicker({
    liveSearchStyle: 'contains'
  });//"val",response.supervisor).trigger("change");
  $("#edit #edit_position").selectpicker({
    liveSearchStyle: 'contains'
  });
      $("#edit #edit_schedule").selectpicker({
    liveSearchStyle: 'contains'
  });
      $("#edit #zone").selectpicker({
    liveSearchStyle: 'contains'
  });
      $("#edit #store").selectpicker({
    liveSearchStyle: 'contains'
  });
      $("#edit #customer").selectpicker({
    liveSearchStyle: 'contains'
  });
      $("#edit #supervisor").selectpicker({
    liveSearchStyle: 'contains'
  });
  $('#example1').on("click",".edit",function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');   
    getRow(id);
  });

  $('#example1').on("click",".delete",function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.photo').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');  
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'employee_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
     console.log(response);
      $('.empid').val(response.empid);
      $('.employee_id').html(response.employee_id);
      $('.del_employee_name').html(response.firstname+' '+response.lastname);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_address').val(response.address);
      $('#datepicker_edit').val(response.birthdate);
      $('#edit_contact').val(response.contact_info);
      $('#gender_val').val(response.gender).html(response.gender);
      $('#position_val').val(response.position_id).html(response.description);
      $('#schedule_val').val(response.schedule_id).html(response.time_in+' - '+response.time_out);
      $("#edit #zone").val(response.zone).change();
      $("#edit #store").val(response.store).change();
      $("#edit #mode").val(response.mode).change();
      $("#edit #role").val(response.role).change();
      $("#edit #customer").val(response.customer).change();
      $("#edit #supervisor").val(response.supervisor).change();
      $("#edit #status").val(response.status).change();
      $("#edit #edit_position").selectpicker("val",response.position_id).trigger("change");
      $("#edit #edit_schedule").selectpicker("val",response.schedule_id).trigger("change");
      $("#edit #zone").selectpicker("val",response.zone).trigger("change");
      $("#edit #store").selectpicker("val",response.store).trigger("change");
      $("#edit #customer").selectpicker("val",response.customer).trigger("change");
      $("#edit #supervisor").selectpicker("val",response.supervisor).trigger("change");
      // New 
     
     
    }
  });
}
</script>
</body>
</html>
