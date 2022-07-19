<?php 
require '../../session.php';

$accion = $_REQUEST['accion'];
$idProducto = $_REQUEST['id'];

$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$costo = $_POST['costo'];
$unidadMedida = $_POST['unidadMedida'];
$categoriaProducto = $_POST['categoriaProducto'];

switch ($accion) {
	case 'crear':
		$crearProducto = $db->prepare("INSERT INTO tbl_producto (codigo,nombre,descripcion,costo,fk_id_unidad_medida,fk_id_categoria_producto) VALUES(:codigo, :nombre, :descripcion, :costo, :fk_id_unidad_medida, :fk_id_categoria_producto);");
		$crearProducto->bindParam(':codigo', $codigo);
		$crearProducto->bindParam(':nombre', $nombre);
		$crearProducto->bindParam(':descripcion', $descripcion);
		$crearProducto->bindParam(':costo', $costo);
		$crearProducto->bindParam(':fk_id_unidad_medida', $unidadMedida);
		$crearProducto->bindParam(':fk_id_categoria_producto', $categoriaProducto);
		$crearProducto->execute();
		header('location:'.$base_url.'pages/productos/indexProductos.php?r=success');
		break;
	case 'actualizar':
		$sqlActualizar = "UPDATE tbl_producto SET codigo=?, nombre=?, descripcion=?, costo=?, fk_id_unidad_medida=?, fk_id_categoria_producto=? WHERE id_producto=?";
		$actualizarProducto= $db->prepare($sqlActualizar);
		$actualizarProducto->execute([$codigo, $nombre, $descripcion, $costo, $unidadMedida, $categoriaProducto, $idProducto]);
		header('location:'.$base_url.'pages/productos/indexProductos.php?r=editado');
		break;
	case 'eliminar':
		$sqlProductoa = "SELECT COUNT(*) total FROM tbl_detalle_sub_obra_productos WHERE fk_id_producto =  ".$idProducto;
    $queryProducto = $db->query($sqlProductoa);
    $fetchProducto = $queryProducto->fetchAll(PDO::FETCH_OBJ);
    $registrosEncontrados = 0;
    foreach ($fetchProducto as $fetch) {$registrosEncontrados = $fetch->total;}
    if($registrosEncontrados > 0){
      header('location:'.$base_url.'pages/productos/indexProductos.php?r=noeliminado');
    }else{
      $eliminarProducto = $db->prepare("DELETE FROM tbl_producto WHERE id_producto = :idProducto;");
      $eliminarProducto->bindParam(':idProducto', $idProducto);
      $eliminarProducto->execute();
      header('location:'.$base_url.'pages/productos/indexProductos.php?r=eliminado');
    }
		break;
	default:
		# code...
		break;
}


?>

