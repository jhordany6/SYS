<?php 
require '../../session.php';

error_reporting(E_ALL);
ini_set("display_errors", 1);

$accion = $_REQUEST['accion'];
$idTipoEstudiante = $_REQUEST['id'];

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

switch ($accion) {
	case 'crear':
		$crearTipoEstudiante = $db->prepare("INSERT INTO tbl_tipo_estudiante (nombre,descripcion) VALUES(:nombre, :descripcion);");
		$crearTipoEstudiante->bindParam(':nombre', $nombre);
		$crearTipoEstudiante->bindParam(':descripcion', $descripcion);
		$crearTipoEstudiante->execute();
		header('location:'.$base_url.'pages/tipoestudiante/indexTipoEstudiante.php?r=success');
		break;
	case 'actualizar':
		
		$sqlActualizar = "UPDATE tbl_tipo_estudiante SET  nombre=?, descripcion=? WHERE id_tipo_estudiante=?";
		$actualizarTipoEstudiante= $db->prepare($sqlActualizar);
		$actualizarTipoEstudiante->execute([$nombre, $descripcion, $idTipoEstudiante]);
		header('location:'.$base_url.'pages/tipoestudiante/indexTipoEstudiante.php?r=editado');
		break;
	case 'eliminar':
		$sqlTipoEstudiante = "SELECT COUNT(*) total FROM tbl_estudiante WHERE fk_id_tipo_estudiante = ".$idTipoEstudiante;
    $queryTipoEstudiante = $db->query($sqlTipoEstudiante);
    $fetchTipoEstudiante = $queryTipoEstudiante->fetchAll(PDO::FETCH_OBJ);
    $registrosEncontrados = 0;
    foreach ($fetchTipoEstudiante as $fetch) {$registrosEncontrados = $fetch->total;}
    if($registrosEncontrados > 0){
      header('location:'.$base_url.'pages/tipoestudiante/indexTipoEstudiante.php?r=noeliminado');
    }else{
      $eliminarTipoEstudiante = $db->prepare("DELETE FROM tbl_tipo_estudiante WHERE id_tipo_estudiante = :id_tipo_estudiante;");
      $eliminarTipoEstudiante->bindParam(':id_tipo_estudiante', $idTipoEstudiante);
      $eliminarTipoEstudiante->execute();
      header('location:'.$base_url.'pages/tipoestudiante/indexTipoEstudiante.php?r=eliminado');
    }

		break;
	
	default:
		# code...
		break;
}


?>

