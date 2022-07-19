<?php 
require '../../session.php';

$accion = $_REQUEST['accion'];
$idContratista = $_REQUEST['id'];

$nombre = $_POST['nombre'];
$codigoIdentificacion = $_POST['codigoIdentificacion'];

switch ($accion) {
	case 'crear':
		$crearContratista = $db->prepare("INSERT INTO tbl_contratista (nombre,codigoIdentificacion) VALUES (:nombre, :codigoIdentificacion)");
		$crearContratista->bindParam(':nombre', $nombre);
		$crearContratista->bindParam(':codigoIdentificacion', $codigoIdentificacion);
		$crearContratista->execute();
		header('location:'.$base_url.'pages/contratistas/indexContratistas.php?r=success');
		break;
	case 'actualizar':
		
		$sqlActualizar = "UPDATE tbl_contratista SET nombre=?, codigoIdentificacion=? WHERE id_contratista=?";
		$actualizarContratista= $db->prepare($sqlActualizar);
		$actualizarContratista->execute([$nombre, $codigoIdentificacion, $idContratista]);
		header('location:'.$base_url.'pages/contratistas/indexContratistas.php?r=editado');
		break;
	case 'eliminar':
		$sqlCantidadContratista = "SELECT COUNT(*) total FROM tbl_obra WHERE fk_id_contratista = ".$idContratista;
    $queryCantidadContratista = $db->query($sqlCantidadContratista);
    $fetchCantidadContratista = $queryCantidadContratista->fetchAll(PDO::FETCH_OBJ);
    $registrosEncontrados = 0;
    foreach ($fetchCantidadContratista as $fetch) {$registrosEncontrados = $fetch->total;}
    if($registrosEncontrados > 0){
      header('location:'.$base_url.'pages/contratistas/indexContratistas.php?r=noeliminado');
    }else{
      $eliminarContratista = $db->prepare("DELETE FROM tbl_contratista WHERE id_contratista = :id_contratista;");
      $eliminarContratista->bindParam(':id_contratista', $idContratista);
      $eliminarContratista->execute();
      header('location:'.$base_url.'pages/contratistas/indexContratistas.php?r=eliminado');
    }

		break;
	
	default:
		# code...
		break;
}


?>

