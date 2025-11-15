<script src="../bower_components/jquery/dist/jquery.min.js"></script>
  
<!-- Add -->
<div class="modal fade" id="addnew" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Agregar Empleado</b></h4>
          	</div>
          	<div class="modal-body" style="font-size:14px;">
            	<form class="form-horizontal" method="POST" action="employee_add.php" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="empid" class="col-sm-3 control-label">DNI</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="empid" name="empid"  >
                  </div>
                </div>
          		  <div class="form-group">
                  	<label for="firstname" class="col-sm-3 control-label">Nombre</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="firstname" name="firstname"  >
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="lastname" class="col-sm-3 control-label">Apellido</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="lastname" name="lastname"  >
                  	</div>
                </div>
  <!-- 
                <div class="form-group">
                  	<label for="address" class="col-sm-3 control-label">Dirección</label>

                  	<div class="col-sm-9">
                      <textarea class="form-control" name="address" id="address"></textarea>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="datepicker_add" class="col-sm-3 control-label">Fecha de Nacimiento</label>

                  	<div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_add" name="birthdate">
                      </div>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Información de Contacto</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="contact" name="contact">
                    </div>
                </div>
                <div class="form-group">
                    <label for="gender" class="col-sm-3 control-label">Género</label>

                    <div class="col-sm-9"> 
                      <select class="form-control" name="gender" id="gender"  >
                        <option value="" selected>- Seleccionar -</option>
                        <option value="Male">Hombre</option>
                        <option value="Female">Mujer</option>
                      </select>
                    </div>
                </div>
-->
                <div class="form-group">
                    <label for="position" class="col-sm-3 control-label">Cargo</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="position" id="position"  data-live-search-style="begins"
                        data-live-search="true" >
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT * FROM position";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['description']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="schedule" class="col-sm-3 control-label">Horario</label>

                    <div class="col-sm-9">
                      <select class="selectpicker form-control " id="schedule" name="schedule" data-live-search-style="begins"
                        data-live-search="true"   >
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT * FROM schedules";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['id']."'>".$srow['time_in'].' - '.$srow['time_out']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="zone" class="col-sm-3 control-label">Zona</label>

                    <div class="col-sm-9">
                      <select class="selectpicker form-control " id="zone" name="zone" data-live-search-style="begins"
                        data-live-search="true"  >
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT description FROM zone";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['description']."'>".$srow['description']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="store" class="col-sm-3 control-label">Tienda</label>

                    <div class="col-sm-9">
                      <select class="selectpicker form-control " id="store" name="store" data-live-search-style="begins"
                        data-live-search="true"  >
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT description FROM store";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['description']."'>".$srow['description']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="store" class="col-sm-3 control-label">Modalidad</label>

                    <div class="col-sm-9">
                      <select class="form-control " id="mode" name="mode" data-live-search-style="begins"
                        data-live-search="true"  >
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT distinct mode FROM employees where mode<>''";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['mode']."'>".$srow['mode']."</option>
                            ";
                          }
                          
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="role" class="col-sm-3 control-label">Rol</label>

                    <div class="col-sm-9">
                      <select class="form-control " id="role" name="role"  data-live-search-style="begins"
                        data-live-search="true" >
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT description from role";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['description']."'>".$srow['description']."</option>
                            ";
                          }
                          
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="customer" class="col-sm-3 control-label">Cliente</label>

                    <div class="col-sm-9">
                      <select class="selectpicker form-control " id="customer" name="customer" data-live-search-style="begins"
                        data-live-search="true"  >
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT description as customer FROM customer";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['customer']."'>".$srow['customer']."</option>
                            ";
                          }
                          
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="supervisor" class="col-sm-3 control-label">Email Supervisor </label>

                    <div class="col-sm-9">
                      <select class="form-control " id="supervisor" name="supervisor" data-live-search-style="begins"
                        data-live-search="true"  >
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT mail as supervisor FROM supervisor";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['supervisor']."'>".$srow['supervisor']."</option>
                            ";
                          }
                          
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-3 control-label">Estado </label>

                    <div class="col-sm-9">
                      <select class="form-control " id="status" name="status" data-live-search-style="begins"
                        data-live-search="true">
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT id,description from status";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['id']."'>".$srow['description']."</option>
                            ";
                          }
                          
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Foto</label>

                    <div class="col-sm-9">
                      <input type="file" name="photo" id="photo">
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Guardar</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="employee_id"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="employee_edit.php">
            		<input type="hidden" class="empid" name="id">
                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Nombre</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_firstname" name="firstname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_lastname" class="col-sm-3 control-label">Apellido</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_lastname" name="lastname">
                    </div>
                </div>
<!-- 
                <div class="form-group">
                    <label for="edit_address" class="col-sm-3 control-label">Dirección</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="address" id="edit_address"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Fecha de Nacimiento</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit" name="birthdate">
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_contact" class="col-sm-3 control-label">Información de Contacto</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_contact" name="contact">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_gender" class="col-sm-3 control-label">Género</label>

                    <div class="col-sm-9"> 
                      <select class="form-control" name="gender" id="edit_gender">
                        <option selected id="gender_val"></option>
                        <option value="Male">Hombre</option>
                        <option value="Female">Mujer</option>
                      </select>
                    </div>
                </div>
-->
                <div class="form-group">
                    <label for="edit_position" class="col-sm-3 control-label">Cargo</label>

                    <div class="col-sm-9">
                      <select class="form-control " name="position" id="edit_position" data-live-search-style="begins"
                        data-live-search="true" >
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT * FROM position";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['description']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_schedule" class="col-sm-3 control-label">Horario</label>

                    <div class="col-sm-9">
                      <select class="form-control " id="edit_schedule" name="schedule" data-live-search-style="begins"
                        data-live-search="true" >
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT * FROM schedules";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['id']."'>".$srow['time_in'].' - '.$srow['time_out']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                
               
                <div class="form-group">
                    <label for="zone" class="col-sm-3 control-label">Zona</label>

                    <div class="col-sm-9">
                      <select class="form-control " id="zone" name="zone" data-live-search-style="begins"
                        data-live-search="true"   >
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT description as zone from zone";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['zone']."'>".$srow['zone']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="store" class="col-sm-3 control-label">Tienda</label>

                    <div class="col-sm-9">
                      <select class="form-control " id="store" name="store" data-live-search-style="begins"
                        data-live-search="true"  >
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT description as store FROM store";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['store']."'>".$srow['store']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="store" class="col-sm-3 control-label">Modalidad</label>

                    <div class="col-sm-9">
                      <select class="form-control " id="mode" name="mode" data-live-search-style="begins"
                        data-live-search="true"  >
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT distinct mode FROM employees where mode<>''";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['mode']."'>".$srow['mode']."</option>
                            ";
                          }
                          
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="role" class="col-sm-3 control-label">Rol</label>

                    <div class="col-sm-9">
                      <select class="form-control " id="role" name="role" data-live-search-style="begins"
                        data-live-search="true"  >
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT distinct role FROM employees where role<>''";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['role']."'>".$srow['role']."</option>
                            ";
                          }
                          
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="customer" class="col-sm-3 control-label">Cliente</label>

                    <div class="col-sm-9">
                      <select class="form-control " id="customer" name="customer" data-live-search-style="begins"
                        data-live-search="true"  >
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT description as customer FROM customer";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['customer']."'>".$srow['customer']."</option>
                            ";
                          }
                          
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="supervisor" class="col-sm-3 control-label">Email Supervisor </label>

                    <div class="col-sm-9">
                      <select class="form-control " id="supervisor" name="supervisor"  data-live-search-style="begins"
                        data-live-search="true" >
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT mail as supervisor FROM supervisor";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['supervisor']."'>".$srow['supervisor']."</option>
                            ";
                          }
                          
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-3 control-label">Estado </label>

                    <div class="col-sm-9">
                      <select class="form-control " id="status" name="status" 
                        data-live-search="true" >
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT id,description from status";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['id']."'>".$srow['description']."</option>
                            ";
                          }
                          
                        ?>
                      </select>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            	<button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Actualizar</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="employee_id"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="employee_delete.php">
            		<input type="hidden" class="empid" name="id">
            		<div class="text-center">
	                	<p>ELIMINAR EMPLEADO</p>
	                	<h2 class="bold del_employee_name"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Eliminar</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="del_employee_name"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="employee_edit_photo.php" enctype="multipart/form-data">
                <input type="hidden" class="empid" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Foto</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo"  >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Actualizar</button>
              </form>
            </div>
        </div>
    </div>
</div>    
<script type="text/javascript">

</script>