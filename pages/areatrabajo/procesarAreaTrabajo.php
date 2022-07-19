<?php 
require '../../session.php';

error_reporting(E_ALL);
ini_set("display_errors", 1);

$accion = $_REQUEST['accion'];
$idAreaTrabajo = $_REQUEST['id'];

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

switch ($accion) {
	case 'crear':
		$crearAreaTrabajo = $db->prepare("INSERT INTO tbl_area_trabajo (nombre,descripcion) VALUES(:nombre, :descripcion);");
		$crearAreaTrabajo->bindParam(':nombre', $nombre);
		$crearAreaTrabajo->bindParam(':descripcion', $descripcion);
		$crearAreaTrabajo->execute();
		header('location:'.$base_url.'pages/areatrabajo/indexAreaTrabajo.php?r=success');
		break;
	case 'actualizar':
		
		$sqlActualizar = "UPDATE tbl_area_trabajo SET  nombre=?, descripcion=? WHERE id_area_trabajo=?";
		$actualizarAreaTrabajo= $db->prepare($sqlActualizar);
		$actualizarAreaTrabajo->execute([$nombre, $descripcion, $idAreaTrabajo]);
		header('location:'.$base_url.'pages/areatrabajo/indexAreaTrabajo.php?r=editado');
		break;
	case 'eliminar':
		$sqlAreaTrabajo = "SELECT COUNT(*) total FROM tbl_estudiante WHERE fk_id_area_trabajo = ".$idAreaTrabajo;
    $queryAreaTrabajo = $db->query($sqlAreaTrabajo);
    $fetchAreaTrabajo = $queryAreaTrabajo->fetchAll(PDO::FETCH_OBJ);
    $registrosEncontrados = 0;
    foreach ($fetchAreaTrabajo as $fetch) {$registrosEncontrados = $fetch->total;}
    if($registrosEncontrados > 0){
      header('location:'.$base_url.'pages/areatrabajo/indexAreaTrabajo.php?r=noeliminado');
    }else{
      $eliminarAreaTrabajo = $db->prepare("DELETE FROM tbl_area_trabajo WHERE id_area_trabajo = :id_area_trabajo;");
      $eliminarAreaTrabajo->bindParam(':id_area_trabajo', $idAreaTrabajo);
      $eliminarAreaTrabajo->execute();
      header('location:'.$base_url.'pages/areatrabajo/indexAreaTrabajo.php?r=eliminado');
    }
		break;
	
	default:
		# code...
		break;
}


?>

