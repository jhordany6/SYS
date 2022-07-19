<?php 
require "../../session.php";


$sqlUsuario = "SELECT * FROM tbl_tipo_estudiante WHERE id_tipo_estudiante =". $_REQUEST["idu"];

$queryUsuario = mysqli_query($conn, $sqlUsuario);
$fetchUsuario = mysqli_fetch_row($queryUsuario);

?>
<form name="editarTipoEstudiante" id="editarTipoEstudiante" method="POST" action="procesarTipoEstudiante.php?accion=actualizar&id=<?= $_REQUEST["idu"] ?>" onsubmit="return enviarRegistroTipoEstudianteEditar(event);">
	<h4 class="text-center mb-4"> GRADO DE ESTUDIANTES </h4>
	<div class="row">
		<div class="form-group col-md-8">
			<label for="message-text" class="form-control-label">Nombre <i style="color: darkorange">*</i></label>
			<input type="text" class="form-control" name="nombre" id="nombreEditar" required value="<?= $fetchUsuario[1] ?>"/>
		</div>
		<div class="form-group col-md-12">
			<label for="message-text" class="form-control-label">Descripcion <i style="color: darkorange">*</i></label>
			<input type="text" class="form-control" name="descripcion" id="descripcionEditar" value="<?= $fetchUsuario[2] ?>"/>
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
