<?php 
require '../../session.php';

$accion = $_REQUEST['accion'];
$idEstudiante = $_REQUEST['id'];

$salario = $_POST['salario'];
$tipoEstudiante = $_POST['tipoEstudiante'];
$areaTrabajo = $_POST['areaTrabajo'];

switch ($accion) {
	case 'crear':
		$crearEstudiante = $db->prepare("INSERT INTO tbl_estudiante (salario,fk_id_tipo_estudiante,fk_id_area_trabajo) VALUES (:salario, :fk_id_tipo_estudiante, :fk_id_area_trabajo)");
		$crearEstudiante->bindParam(':salario', $salario);
		$crearEstudiante->bindParam(':fk_id_tipo_estudiante', $tipoEstudiante);
		$crearEstudiante->bindParam(':fk_id_area_trabajo', $areaTrabajo);
		$crearEstudiante->execute();
		header('location:'.$base_url.'pages/estudiantes/indexEstudiantes.php?r=success');
		break;
	case 'actualizar':
		
		$sqlActualizar = "UPDATE tbl_estudiante SET salario=?, fk_id_tipo_estudiante=?, fk_id_area_trabajo=? WHERE id_estudiante=?";
		$actualizarEstudiante= $db->prepare($sqlActualizar);
		$actualizarEstudiante->execute([$salario, $tipoEstudiante, $areaTrabajo, $idEstudiante]);
		header('location:'.$base_url.'pages/estudiantes/indexEstudiantes.php?r=editado');
		break;
	case 'eliminar':
		$sqlCantidadEstudiante = "SELECT COUNT(*) total FROM tbl_detalle_estudiante WHERE fk_id_estudiante = ".$idEstudiante;
    $queryCantidadEstudiante = $db->query($sqlCantidadEstudiante);
    $fetchCantidadEstudiante = $queryCantidadEstudiante->fetchAll(PDO::FETCH_OBJ);
    $registrosEncontrados = 0;
    foreach ($fetchCantidadEstudiante as $fetch) {$registrosEncontrados = $fetch->total;}
    if($registrosEncontrados > 0){
      header('location:'.$base_url.'pages/estudiantes/indexEstudiantes.php?r=noeliminado');
    }else{
      $eliminarProducto = $db->prepare("DELETE FROM tbl_estudiante WHERE id_estudiante = :id_estudiante;");
      $eliminarProducto->bindParam(':id_estudiante', $idEstudiante);
      $eliminarProducto->execute();
      header('location:'.$base_url.'pages/estudiantes/indexEstudiantes.php?r=eliminado');
    }

		break;
	
	default:
		# code...
		break;
}


?>

