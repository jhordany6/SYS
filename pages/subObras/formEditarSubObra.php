<?php 
require "../../session.php";


$sqlUsuario = "SELECT * FROM tbl_sub_obra WHERE codigo ='". $_REQUEST["idu"]."'";

$queryUsuario = mysqli_query($conn, $sqlUsuario);
$fetchUsuario = mysqli_fetch_row($queryUsuario);

?>
<form name="editarSubObra" id="editarSubObra" method="POST" onsubmit="return enviarRegistroSubObraEditar(event);" action="procesarSubObra.php?accion=actualizar&codigoViejo=<?= $_REQUEST["idu"] ?>">
	<div class="form-group col-md-12 border-top">
		<h4 class="modal-title " style="text-align: center; color: black">ENCABEZADO</h4>                
	</div>
	<div class="row">
		<div class="form-group col-md-4">
			<label for="message-text" class="form-control-label">Codigo <i style="color: darkorange">*</i></label>
			<input type="text" class="form-control" name="codigo" id="codigoEditar" required value="<?= $fetchUsuario[1] ?>"/>
		</div>
		<div class="form-group col-md-8">
			<label for="message-text" class="form-control-label">Nombre <i style="color: darkorange">*</i></label>
			<input type="text" class="form-control" name="nombre" id="nombreEditar" required value="<?= $fetchUsuario[2] ?>"/>
		</div>
		<div class="form-group col-md-12">
			<label for="message-text" class="form-control-label">Descripcion <i style="color: darkorange">*</i></label>
			<input type="text" class="form-control" name="descripcion" id="descripcionEditar" value="<?= $fetchUsuario[3] ?>"/>
		</div>
		<div class="form-group col-md-6">
			<label for="message-text" class="form-control-label">costo <i style="color: darkorange">*</i></label>
			<input type="number" class="form-control" name="costo" id="costoEditar" required value="<?= $fetchUsuario[4] ?>"/>
		</div>
		<div class="form-group col-md-6">
			<label for="recipient-name" class="form-control-label">Unidad de medida <i style="color: darkorange">*</i></label>
			<select class="form-control" name="unidadMedida" id="unidadMedidaEditar" >
				<option value="0">Selecciona una opción</option>
				<?php
				$queryUnidadMedida = mysqli_query($conn, "SELECT id_unidad_medida,nombre FROM tbl_unidad_medida;");
				while ($UnidadMedida = mysqli_fetch_row($queryUnidadMedida)) {
					if ($UnidadMedida[0] == $fetchUsuario[5]) {
						echo "<option selected value=" . $UnidadMedida[0] . ">" . $UnidadMedida[1] . "</option>";
					} else {
						echo "<option value=" . $UnidadMedida[0] . ">" . $UnidadMedida[1] . "</option>";
					}
				}
				?>
			</select>
		</div>
		<div class="form-group col-md-12 border-top">
			<h4 class="modal-title " style="text-align: center; color: black">DETALLE</h4>                
		</div>
		<div class="form-group col-md-12">
			<div class="col-sm-1 col-sm-offset-10 ml-auto float-right" style="margin-right: 15px">
				<a class="btn btn-success btn-block" onclick="agregarDetalleEditar()"><i class="fas fa-plus"></i></a>
			</div>
		</div>
		<div class="form-group col-md-12">
			<div class="row" id="detalleEditar">
				<?php 
				$sqlDetalles = "SELECT id_detalle_sub_obra_productos,codigo_sub_obra,fk_id_producto,cantidad_producto FROM tbl_detalle_sub_obra_productos WHERE codigo_sub_obra ='". $_REQUEST["idu"]."';";
				$queryDetalles = $db->query($sqlDetalles);
				$fetchDetalles = $queryDetalles->fetchAll(PDO::FETCH_OBJ);
				$contador = 1;
				foreach ($fetchDetalles as $fetchDetalle) {
					echo '<div class="form-group col-md-6" id="divProductoEditar'.$contador.'">';
					if($contador < 2){
						echo '<label for="recipient-name" class="form-control-label">Tarea <i style="color: darkorange">*</i></label>';
					}
					echo '<select class="form-control" name="tarea[]" id="productoEditar'.$contador.'" required="true">';
					echo '<option value="">Selecciona una opción</option>';
					$sqlProductos = "SELECT id_producto,codigo,nombre FROM tbl_producto;";
					$queryProductos = $db->query($sqlProductos);
					$fetchProductos = $queryProductos->fetchAll(PDO::FETCH_OBJ);
					foreach ($fetchProductos as $fetchProducto) {
						if($fetchProducto->id_producto == $fetchDetalle->fk_id_producto){
							echo '<option selected value="'.$fetchProducto->id_producto.'">'.$fetchProducto->codigo.' - '.$fetchProducto->nombre.'</option>';
						}else{
							echo '<option value="'.$fetchProducto->id_producto.'">'.$fetchProducto->codigo.' - '.$fetchProducto->nombre.'</option>';
						}
					}
					echo '</select>';
					echo '</div>';
					echo '<div class="form-group col-md-5" id="divCantidadEditar'.$contador.'">';
					if($contador < 2){
						echo '<label for="recipient-name" class="form-control-label">Cantidad <i style="color: darkorange">*</i></label>';
					}
					echo '<input  type="number" class="form-control" name="cantidad[]" id="cantidadEditar'.$contador.'" required="true"  maxlength="20" step="0.0001" autocomplete="off" value="'.$fetchDetalle->cantidad_producto.'"/>';
					echo '</div>';
					echo '<div class="form-group col-md-1" id="divEliminarEditar'.$contador.'">';
					if($contador < 2){
						echo '<label for="recipient-name" class="form-control-label" id="lblCantidad">Eliminar</label>';
					}
					echo '<a class="btn btn-danger" id="eliminarEditar'.$contador.'" onclick="eliminarDetalleEditar('.$contador.')"><i class="fas fa-trash-alt"></i></a>';
					echo '</div>';
					$contador++;
				}
				?>
			</div>
		</div>
	</div>
	<!-- End Row -->
	<!-- Modal Footer -->
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">
			Cancelar
		</button>
		<button type="submit" class="btn btn-purple" name="Actualizar">
			Actualizar
		</button>
	</div>
</div>    
</form>
<script type="text/javascript" defer>
	var contadorDetalleEditar = <?= $contador-1 ?>; 
	var copiaSelect = document.getElementById("productoEditar1");
	var divCantidad = document.getElementById("cantidadEditar1");
	var btnEliminarBase = document.getElementById("eliminarEditar1");

	var copiadivSelectProducto = copiaSelect.cloneNode(true);
	var copiadivInputCantidad = divCantidad.cloneNode(true);
	var copiadivButtonEliminar = btnEliminarBase.cloneNode(true);

	function agregarDetalleEditar(){
		contadorDetalleEditar++;
		
		let divPadre = document.getElementById("detalleEditar");

		let divProducto = document.createElement("div");
		divProducto.className = "form-group col-md-6";
		divProducto.setAttribute("id", "divProductoEditar"+contadorDetalleEditar);

		let divCantidad = document.createElement("div");
		divCantidad.className = "form-group col-md-5";
		divCantidad.setAttribute("id", "divCantidadEditar"+contadorDetalleEditar);

		let divEliminar = document.createElement("div");
		divEliminar.className = "form-group col-md-1";
		divEliminar.setAttribute("id", "divEliminarEditar"+contadorDetalleEditar);


		let selectTareaCrear = copiadivSelectProducto.cloneNode(true);
		selectTareaCrear.setAttribute("id", "productoEditar"+contadorDetalleEditar);
		selectTareaCrear.setAttribute("name", "tarea[]");
		selectTareaCrear.value = "";

		let inputCantidadCrear = copiadivInputCantidad.cloneNode(true);
		inputCantidadCrear.setAttribute("id", "cantidadEditar"+contadorDetalleEditar);
		inputCantidadCrear.setAttribute("name", "cantidad[]");
		inputCantidadCrear.value = "";

		let btnEliminarCrear = copiadivButtonEliminar.cloneNode(true);
		btnEliminarCrear.setAttribute("id", "btncantidadEditar"+contadorDetalleEditar);
		btnEliminarCrear.setAttribute("name", "btncantidad");
		btnEliminarCrear.setAttribute("onclick", "eliminarDetalleEditar("+contadorDetalleEditar+")");

		divPadre.appendChild(divProducto);
		divProducto.appendChild(selectTareaCrear);

		divPadre.appendChild(divCantidad);
		divCantidad.appendChild(inputCantidadCrear);

		divPadre.appendChild(divEliminar);
		divEliminar.appendChild(btnEliminarCrear);

		

	}
	function eliminarDetalleEditar(posicion){

		let divPadre = document.getElementById("detalleEditar");
		let divProducto = document.getElementById('divProductoEditar'+posicion);
		let divCantidad = document.getElementById('divCantidadEditar'+posicion);
		let divEliminar = document.getElementById('divEliminarEditar'+posicion);

		divPadre.removeChild(divProducto);
		divPadre.removeChild(divCantidad);
		divPadre.removeChild(divEliminar);
	}
	function editarSubObra(){
		if (request) {
			request.abort();
		}
		var $form = $(this);
		var serializedData = $form.serialize();
		request = $.ajax({
			url: "procesarSubObra.php?accion=actualizar&codigoViejo=<?= $_REQUEST["idu"] ?>",
			type: "post",
			data: serializedData
		});
		request.done(function (response, textStatus, jqXHR){
			swal("Excelente!", "Sub-Obra editado correctamente!", "success");
			setTimeout(function(){ location.reload(true);; }, 1000);
		});
		request.fail(function (jqXHR, textStatus, errorThrown){
			console.error("The following error occurred: "+textStatus, errorThrown);
		});
	}
</script>