<?php
include 'includes/session.php';
include 'includes/header.php';
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>Tienda</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Tienda</li>
      </ol>
    </section>

    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "<div class='alert alert-danger'>".$_SESSION['error']."</div>";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";
          unset($_SESSION['success']);
        }
      ?>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat">
                <i class="fa fa-plus"></i> Nueva Tienda
              </a>
            </div>

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Zona</th>
                    <th>GPS</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM store ORDER BY id ASC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td>".$row['id']."</td>
                          <td>".$row['description']."</td>
                          <td>".$row['idzone']."</td>
                          <td>".$row['gps']."</td>
                          <td>
                            <button class='btn btn-success btn-sm edit' data-id='".$row['id']."'><i class='fa fa-edit'></i></button>
                            <button class='btn btn-danger btn-sm delete' data-id='".$row['id']."'><i class='fa fa-trash'></i></button>
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
  <?php include 'includes/store_modal.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $("#example1").on("click",".edit",function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getStore(id);
  });

  $("#example1").on("click",".delete",function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getStore(id);
  });
});

function getStore(id){
  $.ajax({
    type: 'POST',
    url: 'store_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#editid').val(response.id);
      $('#editdescription').val(response.description);
      $('#editidzone').val(response.idzone);
      $('#editgps').val(response.gps);

      $('#del_storeid').val(response.id);
      $('#del_store').html(response.description);
    }
  });
}
</script>
</body>
</html>
