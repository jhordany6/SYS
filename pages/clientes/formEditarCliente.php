<?php 
require "../../session.php";


$sqlCliente = "SELECT * FROM tbl_cliente WHERE id_cliente =". $_REQUEST["idu"];

$queryCliente = mysqli_query($conn, $sqlCliente);
$fetchCliente = mysqli_fetch_row($queryCliente);

?>
<form name="editarTarea" id="editarTarea" method="POST" onsubmit="return enviarRegistroClienteEditar(event);" action="procesarCliente.php?accion=actualizar&id=<?= $_REQUEST["idu"] ?>">
	<h4 class="text-center mb-4"> Tarea </h4>
	<div class="row">
		<div class="form-group col-md-6">
			<label for="message-text" class="form-control-label">Primer Nombre <i style="color: darkorange">*</i></label>
			<input type="text" class="form-control" name="primerNombre" id="primerNombre" required="true" value="<?= $fetchCliente[1] ?>"/>
		</div>
		<div class="form-group col-md-6">
			<label for="message-text" class="form-control-label">Segundo Nombre </label>
			<input type="text" class="form-control" name="segundoNombre" id="segundoNombre" value="<?= $fetchCliente[2] ?>"/>
		</div>
		<div class="form-group col-md-6">
			<label for="message-text" class="form-control-label">Primer Apellido <i style="color: darkorange">*</i></label>
			<input type="text" class="form-control" name="primerApellido" id="primerApellido" required="true" value="<?= $fetchCliente[3] ?>"/>
		</div>
		<div class="form-group col-md-6">
			<label for="message-text" class="form-control-label">Segundo Apellido </label>
			<input type="text" class="form-control" name="segundoApellido" id="segundoApellido" value="<?= $fetchCliente[4] ?>"/>
		</div>
    <div class="form-group col-md-6">
			<label for="message-text" class="form-control-label">Nombre de la empresa <i style="color: darkorange">*</i></label>
			<input type="text" class="form-control" name="nombreEmpresa" id="nombreEmpresa" value="<?= $fetchCliente[7] ?>"/>
		</div>
		<div class="form-group col-md-6">
			<label for="message-text" class="form-control-label">Email <i style="color: darkorange">*</i></label>
			<input type="email" class="form-control" name="email" id="email" required="true" value="<?= $fetchCliente[6] ?>"/>
		</div>
    <div class="form-group col-md-4">
			<label for="message-text" class="form-control-label">Documento <i style="color: darkorange">*</i></label>
			<input type="text" class="form-control" name="documento" id="documento" required="true" value="<?= $fetchCliente[5] ?>"/>
		</div>
		<div class="form-group col-md-4">
			<label for="recipient-name" class="form-control-label">Tipo de Documento <i style="color: darkorange">*</i></label>
			<select class="form-control" name="tipoDocumento" id="tipoDocumento" required="true">
				<option value="">Selecciona una opción</option>
				<?php
				$queryTipoDocumento = mysqli_query($conn, "SELECT id_tipo_documento,nombre FROM tbl_tipo_documento;");
				while ($TipoDocumento = mysqli_fetch_row($queryTipoDocumento)) {
					if ($TipoDocumento[0] == $fetchCliente[8]) {
						echo "<option selected value=" . $TipoDocumento[0] . ">" . $TipoDocumento[1] . "</option>";
					} else {
						echo "<option value=" . $TipoDocumento[0] . ">" . $TipoDocumento[1] . "</option>";
					}
				}
				?>
			</select>
		</div>
		<div class="form-group col-md-4">
			<label for="recipient-name" class="form-control-label">Tipo de Cliente <i style="color: darkorange">*</i></label>
			<select class="form-control" name="tipoCliente" id="tipoCliente" required="true">
				<option value="0">Selecciona una opción</option>
				<?php
				$queryTipoCliente = mysqli_query($conn, "SELECT id_tipo_cliente,nombre FROM tbl_tipo_cliente;");
				while ($TipoCliente = mysqli_fetch_row($queryTipoCliente)) {
					if ($TipoCliente[0] == $fetchCliente[9]) {
						echo "<option selected value=" . $TipoCliente[0] . ">" . $TipoCliente[1] . "</option>";
					} else {
						echo "<option value=" . $TipoCliente[0] . ">" . $TipoCliente[1] . "</option>";
					}
				}
				?>
			</select>
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
