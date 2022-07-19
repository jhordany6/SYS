<?php 
require '../../session.php';

error_reporting(E_ALL);
ini_set("display_errors", 1);

$accion = $_REQUEST['accion'];
$idUnidadMedida = $_REQUEST['id'];

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

switch ($accion) {
	case 'crear':
		$crearUnidadMedida = $db->prepare("INSERT INTO tbl_unidad_medida (nombre,descripcion) VALUES(:nombre, :descripcion);");
		$crearUnidadMedida->bindParam(':nombre', $nombre);
		$crearUnidadMedida->bindParam(':descripcion', $descripcion);
		$crearUnidadMedida->execute();
		header('location:'.$base_url.'pages/unidadmedida/indexUnidadMedida.php?r=success');
		break;
	case 'actualizar':
		
		$sqlActualizar = "UPDATE tbl_unidad_medida SET  nombre=?, descripcion=? WHERE id_unidad_medida=?";
		$actualizarUnidadMedida= $db->prepare($sqlActualizar);
		$actualizarUnidadMedida->execute([$nombre, $descripcion, $idUnidadMedida]);
		header('location:'.$base_url.'pages/unidadmedida/indexUnidadMedida.php?r=editado');
		break;
	case 'eliminar':
		$sqlUnidadMedida = "SELECT COUNT(*) total FROM tbl_sub_obra WHERE fk_id_unidad_medida = ".$idUnidadMedida;
    $queryUnidadMedida = $db->query($sqlUnidadMedida);
    $fetchUnidadMedida = $queryUnidadMedida->fetchAll(PDO::FETCH_OBJ);
    $registrosEncontrados = 0;
    foreach ($fetchUnidadMedida as $fetch) {$registrosEncontrados = $fetch->total;}
    if($registrosEncontrados > 0){
      header('location:'.$base_url.'pages/unidadmedida/indexUnidadMedida.php?r=noeliminado');
    }else{
      $eliminarUnidadMedida = $db->prepare("DELETE FROM tbl_unidad_medida WHERE id_unidad_medida = :id_unidad_medida;");
      $eliminarUnidadMedida->bindParam(':id_unidad_medida', $idUnidadMedida);
      $eliminarUnidadMedida->execute();
      header('location:'.$base_url.'pages/unidadmedida/indexUnidadMedida.php?r=eliminado');
    }

		break;
	
	default:
		# code...
		break;
}


?>

