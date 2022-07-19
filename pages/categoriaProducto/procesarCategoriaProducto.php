<?php 
require '../../session.php';

error_reporting(E_ALL);
ini_set("display_errors", 1);

$accion = $_REQUEST['accion'];
$idCategoriaProducto = $_REQUEST['id'];

$nombre = $_POST['nombre'];

switch ($accion) {
	case 'crear':
		$crearCategoriaProducto = $db->prepare("INSERT INTO tbl_categoria_producto (nombre) VALUES(:nombre);");
		$crearCategoriaProducto->bindParam(':nombre', $nombre);
		$crearCategoriaProducto->execute();
		header('location:'.$base_url.'pages/categoriaProducto/indexCategoriaProducto.php?r=success');
		break;
	case 'actualizar':
    $sqlActualizar = "UPDATE tbl_categoria_producto SET  nombre=? WHERE id_categoria_producto=?";
		$actualizarCategoriaProducto= $db->prepare($sqlActualizar);
		$actualizarCategoriaProducto->execute([$nombre, $idCategoriaProducto]);
		header('location:'.$base_url.'pages/categoriaProducto/indexCategoriaProducto.php?r=editado');
		break;
	case 'eliminar':
		$sqlCategoriaProducto = "SELECT COUNT(*) total FROM tbl_producto WHERE fk_id_categoria_producto = ".$idCategoriaProducto;
    $queryCategoriaProducto = $db->query($sqlCategoriaProducto);
    $fetchCategoriaProducto = $queryCategoriaProducto->fetchAll(PDO::FETCH_OBJ);
    $registrosEncontrados = 0;
    foreach ($fetchCategoriaProducto as $fetch) {$registrosEncontrados = $fetch->total;}
    if($registrosEncontrados > 0){
      header('location:'.$base_url.'pages/categoriaProducto/indexCategoriaProducto.php?r=noeliminado');
    }else{
      $eliminarCategoriaProducto = $db->prepare("DELETE FROM tbl_categoria_producto WHERE id_categoria_producto = :id_categoria_producto;");
		  $eliminarCategoriaProducto->bindParam(':id_categoria_producto', $idCategoriaProducto);
		  $eliminarCategoriaProducto->execute();
		  header('location:'.$base_url.'pages/categoriaProducto/indexCategoriaProducto.php?r=eliminado');
    }
		break;
	
	default:
		# code...
		break;
}


?>

