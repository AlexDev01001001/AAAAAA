<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal">&times;</button>
            	<h4 class="modal-title"><b>Agregar Asistencia</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="attendance_add.php">
          		  <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">ID Empleado</label>
                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="employee" name="employee" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="datepicker_add" class="col-sm-3 control-label">Fecha</label>
                    <div class="col-sm-9"> 
                      <input type="date" class="form-control" id="datepicker_add" name="date" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="time_in" class="col-sm-3 control-label">Hora de Entrada</label>
                  	<div class="col-sm-9">
                  		<input type="time" class="form-control" id="time_in" name="time_in" required>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="time_out" class="col-sm-3 control-label">Hora de Salida</label>
                  	<div class="col-sm-9">
                    	<input type="time" class="form-control" id="time_out" name="time_out" required>
                  	</div>
                </div>

                <!-- Tienda -->
                <div class="form-group">
                  <label for="store" class="col-sm-3 control-label">Tienda</label>
                  <div class="col-sm-9">
                    <select class="form-control" id="store" name="storeid" required>
                      <option value="">- Seleccionar Tienda -</option>
                      <?php
                        $stores = $conn->query("SELECT * FROM store ORDER BY description ASC");
                        while($s = $stores->fetch_assoc()){
                          echo "<option value='".$s['id']."'>".$s['description']."</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>

          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Cerrar</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add">Guardar</button>
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
            	<button type="button" class="close" data-dismiss="modal">&times;</button>
            	<h4 class="modal-title"><b><span id="employee_name"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="attendance_edit.php">
            		<input type="hidden" id="attid" name="id">
                <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Fecha</label>
                    <div class="col-sm-9"> 
                      <input type="date" class="form-control" id="datepicker_edit" name="edit_date" required>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="edit_time_in" class="col-sm-3 control-label">Hora Entrada</label>
                  	<div class="col-sm-9">
                    	<input type="time" class="form-control" id="edit_time_in" name="edit_time_in" required>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="edit_time_out" class="col-sm-3 control-label">Hora Salida</label>
                  	<div class="col-sm-9">
                    	<input type="time" class="form-control" id="edit_time_out" name="edit_time_out" required>
                  	</div>
                </div>

                <!-- Tienda -->
                <div class="form-group">
                  <label for="edit_store" class="col-sm-3 control-label">Tienda</label>
                  <div class="col-sm-9">
                    <select class="form-control" id="edit_store" name="storeid" required>
                      <option value="">- Seleccionar Tienda -</option>
                      <?php
                        $stores = $conn->query("SELECT * FROM store ORDER BY description ASC");
                        while($s = $stores->fetch_assoc()){
                          echo "<option value='".$s['id']."'>".$s['description']."</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>

          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Cerrar</button>
            	<button type="submit" class="btn btn-success btn-flat" name="edit">Actualizar</button>
            	</form>
          	</div>
        </div>
    </div>
</div>
