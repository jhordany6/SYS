<?php 
require "../../session.php";


$sqlUsuario = "SELECT * FROM tbl_estudiante WHERE id_estudiante =". $_REQUEST["idu"];

$queryUsuario = mysqli_query($conn, $sqlUsuario);
$fetchUsuario = mysqli_fetch_row($queryUsuario);

?>
<form name="editarEstudiante" id="editarEstudiante" method="POST" action="procesarEstudiantes.php?accion=actualizar&id=<?= $_REQUEST["idu"] ?>">
	<h4 class="text-center mb-4"> Estudiante </h4>
	<div class="row">
		<div class="form-group col-md-4">
			<label for="message-text" class="form-control-label">Salario <i style="color: darkorange">*</i></label>
			<input type="number" class="form-control" name="salario" id="salario" required value="<?= $fetchUsuario[1] ?>"/>
		</div>
		<div class="form-group col-md-4">
			<label for="recipient-name" class="form-control-label">Tipo de estudiante <i style="color: darkorange">*</i></label>
			<select class="form-control" name="tipoEstudiante" id="tipoEstudianteEditar" >
				<option value="">Selecciona una opción</option>
				<?php
				$queryTipoEstudiante = mysqli_query($conn, "SELECT id_tipo_estudiante, nombre FROM tbl_tipo_estudiante;");
				while ($Estudiante = mysqli_fetch_row($queryTipoEstudiante)) {
					if ($Estudiante[0] == $fetchUsuario[2]) {
						echo "<option selected value=" . $Estudiante[0] . ">" . $Estudiante[1] . "</option>";
					} else {
						echo "<option value=" . $Estudiante[0] . ">" . $Estudiante[1] . "</option>";
					}
				}
				?>
			</select>
		</div>
		<div class="form-group col-md-4">
			<label for="recipient-name" class="form-control-label">Area de trabajo <i style="color: darkorange">*</i></label>
			<select class="form-control" name="areaTrabajo" id="areaTrabajoEditar" >
				<option value="">Selecciona una opción</option>
				<?php
				$queryAreaTrabajo = mysqli_query($conn, "SELECT id_area_trabajo, nombre FROM tbl_area_trabajo;");
				while ($AreaTrabajo = mysqli_fetch_row($queryAreaTrabajo)) {
					if ($AreaTrabajo[0] == $fetchUsuario[3]) {
						echo "<option selected value=" . $AreaTrabajo[0] . ">" . $AreaTrabajo[1] . "</option>";
					} else {
						echo "<option value=" . $AreaTrabajo[0] . ">" . $AreaTrabajo[1] . "</option>";
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
