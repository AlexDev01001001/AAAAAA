<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Agregar tienda</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="store_add.php">
          		  <div class="form-group">
                  	<label for="title" class="col-sm-3 control-label">Descrip&oacute;n</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="description" name="description" required>
                  	</div>
                </div>
				<form class="form-horizontal" method="POST" action="store_add.php">
          		  <div class="form-group">
                  	<label for="title" class="col-sm-3 control-label">GPS(Latitud,Longitud)</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="gps" name="gps" required>
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
    <div class="modal-dialog" >
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Actualizar Tienda</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="store_edit.php">
            		<input type="hidden" id="editid" name="editid">
                <div class="form-group">
                    <label for="edit_title" class="col-sm-3 control-label">Descripci&oacute;n</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="editdescription" name="editdescription">
                    </div>
                </div>
				<div class="form-group">
                    <label for="edit_title" class="col-sm-3 control-label">GPS</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="editgps" name="editgps">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_rate" class="col-sm-3 control-label">Cliente</label>

					<select class="selectpicker form-control " id="editcustomer" name="editcustomer" data-live-search-style="begins"
                        data-live-search="true" style="margin-top: 150px;">
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT id,description as customer FROM customer";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['id']."'>".$srow['customer']."</option>
                            ";
                          }
                          
                        ?>
                      </select>
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
            	<h4 class="modal-title"><b>Eliminando...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="store_delete.php">
            		<input type="hidden" id="del_storeid" name="del_storeid"/>
            		<div class="text-center">
	                	<p>Eliminar Tienda</p>
	                	<h2 id="del_store" class="bold"></h2>
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


     