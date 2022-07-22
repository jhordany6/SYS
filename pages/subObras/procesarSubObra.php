<?php 
require '../../session.php';

$accion = $_REQUEST['accion'];


$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$costo = $_POST['costo'];
$unidadMedida = $_POST['unidadMedida'];

switch ($accion) {
	case 'crear':
	$sqlUsuario = "SELECT * FROM tbl_sub_obra WHERE codigo='".$codigo."'";
	$queryUsuario = mysqli_query($conn, $sqlUsuario);
	$fetchUsuario = mysqli_fetch_row($queryUsuario);
	$rows = mysqli_num_rows($queryUsuario);
	if($rows == 0){
		$crearSubObraEncabezado = $db->prepare("INSERT INTO tbl_sub_obra (codigo,nombre,descripcion,costo,fk_id_unidad_medida) VALUES(:codigo, :nombre, :descripcion, :costo, :fk_id_unidad_medida);");
		$crearSubObraEncabezado->bindParam(':codigo', $codigo);
		$crearSubObraEncabezado->bindParam(':nombre', $nombre);
		$crearSubObraEncabezado->bindParam(':descripcion', $descripcion);
		$crearSubObraEncabezado->bindParam(':costo', $costo);
		$crearSubObraEncabezado->bindParam(':fk_id_unidad_medida', $unidadMedida);
		$crearSubObraEncabezado->execute();

		$arrayProducto = array();
		$arrayProducto = $_POST["tarea"];
		$arraycantidad = array();
		$arraycantidad = $_POST["cantidad"];
		$sizeArray = sizeof($arrayProducto);
		$i = 0;
		while($i < $sizeArray){
			$crearSubObraDetalle = $db->prepare("INSERT INTO tbl_detalle_sub_obra_productos (codigo_sub_obra,fk_id_producto,cantidad_producto) VALUES(:codigo_sub_obra,:fk_id_producto,:cantidad_producto);");
			$crearSubObraDetalle->bindParam(':codigo_sub_obra', $codigo);
			$crearSubObraDetalle->bindParam(':fk_id_producto', $arrayProducto[$i]);
			$crearSubObraDetalle->bindParam(':cantidad_producto', $arraycantidad[$i]);
			$crearSubObraDetalle->execute();
			$i++;
		}
		header('location:'.$base_url.'pages/subObras/indexSubObras.php?r=success');
	}else{
		header('location:'.$base_url.'pages/subObras/indexSubObras.php?r=existe');
	}




	break;
	case 'actualizar':
	$codigoViejo = $_REQUEST['codigoViejo'];

	if($codigo == $codigoViejo){
		$eliminarSubObraDetalle = $db->prepare("DELETE FROM tbl_detalle_sub_obra_productos WHERE codigo_sub_obra = :codigo_sub_obra ;");
		$eliminarSubObraDetalle->bindParam(':codigo_sub_obra', $codigoViejo);
		$eliminarSubObraDetalle->execute();

		$sqlActualizar = "UPDATE tbl_sub_obra SET codigo=?, nombre=?, descripcion=?, costo=?, fk_id_unidad_medida=? WHERE codigo =?";
		$actualizarSubObra= $db->prepare($sqlActualizar);
		$actualizarSubObra->execute([$codigo, $nombre, $descripcion, $costo, $unidadMedida, $codigoViejo]);

		$arrayProducto = array();
		$arrayProducto = $_POST["tarea"];
		$arraycantidad = array();
		$arraycantidad = $_POST["cantidad"];
		$sizeArray = sizeof($arrayProducto);
		$i = 0;
		while($i < $sizeArray){
			$crearSubObraDetalle = $db->prepare("INSERT INTO tbl_detalle_sub_obra_productos (codigo_sub_obra,fk_id_producto,cantidad_producto) VALUES(:codigo_sub_obra,:fk_id_producto,:cantidad_producto);");
			$crearSubObraDetalle->bindParam(':codigo_sub_obra', $codigo);
			$crearSubObraDetalle->bindParam(':fk_id_producto', $arrayProducto[$i]);
			$crearSubObraDetalle->bindParam(':cantidad_producto', $arraycantidad[$i]);
			$crearSubObraDetalle->execute();
			$i++;
		}
		header('location:'.$base_url.'pages/subObras/indexSubObras.php?r=editado');
	}else{
		$sqlUsuario = "SELECT * FROM tbl_sub_obra WHERE codigo='".$codigo."'";
		$queryUsuario = mysqli_query($conn, $sqlUsuario);
		$fetchUsuario = mysqli_fetch_row($queryUsuario);
		$rows = mysqli_num_rows($queryUsuario);
		if($rows == 0){
			
			$eliminarSubObraDetalle = $db->prepare("DELETE FROM tbl_detalle_sub_obra_productos WHERE codigo_sub_obra = :codigo_sub_obra ;");
			$eliminarSubObraDetalle->bindParam(':codigo_sub_obra', $codigoViejo);
			$eliminarSubObraDetalle->execute();

			$sqlActualizar = "UPDATE tbl_sub_obra SET codigo=?, nombre=?, descripcion=?, costo=?, fk_id_unidad_medida=? WHERE codigo =?";
			$actualizarSubObra= $db->prepare($sqlActualizar);
			$actualizarSubObra->execute([$codigo, $nombre, $descripcion, $costo, $unidadMedida, $codigoViejo]);

			$arrayProducto = array();
			$arrayProducto = $_POST["tarea"];
			$arraycantidad = array();
			$arraycantidad = $_POST["cantidad"];
			$sizeArray = sizeof($arrayProducto);
			$i = 0;
			while($i < $sizeArray){
				$crearSubObraDetalle = $db->prepare("INSERT INTO tbl_detalle_sub_obra_productos (codigo_sub_obra,fk_id_producto,cantidad_producto) VALUES(:codigo_sub_obra,:fk_id_producto,:cantidad_producto);");
				$crearSubObraDetalle->bindParam(':codigo_sub_obra', $codigo);
				$crearSubObraDetalle->bindParam(':fk_id_producto', $arrayProducto[$i]);
				$crearSubObraDetalle->bindParam(':cantidad_producto', $arraycantidad[$i]);
				$crearSubObraDetalle->execute();
				$i++;
			}
			header('location:'.$base_url.'pages/subObras/indexSubObras.php?r=editado');
		}else{
			header('location:'.$base_url.'pages/subObras/indexSubObras.php?r=existe');
		}
	}



	break;
	case 'eliminar':
    $codigo = $_REQUEST['codigo'];
    $sqlSubObra = "SELECT COUNT(*) total FROM tbl_detalle_sub_obra WHERE codigo_sub_obra = ".$codigo;
    $querySubObra = $db->query($sqlSubObra);
    $fetchSubObra = $querySubObra->fetchAll(PDO::FETCH_OBJ);
    $registrosEncontrados = 0;
    foreach ($fetchSubObra as $fetch) {$registrosEncontrados = $fetch->total;}
    if($registrosEncontrados > 0){
      header('location:'.$base_url.'pages/subObras/indexSubObras.php?r=noeliminado');
    }else{
      $eliminarSubObraDetalle = $db->prepare("DELETE FROM tbl_detalle_sub_obra_productos WHERE codigo_sub_obra = :codigo_sub_obra;");
      $eliminarSubObraDetalle->bindParam(':codigo_sub_obra', $codigo);
      $eliminarSubObraDetalle->execute();
      $eliminarSubObraEncabezado = $db->prepare("DELETE FROM tbl_sub_obra WHERE codigo = :codigo;");
      $eliminarSubObraEncabezado->bindParam(':codigo', $codigo);
      $eliminarSubObraEncabezado->execute();
      header('location:'.$base_url.'pages/subObras/indexSubObras.php?r=eliminado');
    }
	break;
	default:
		# code...
	break;
}


?>

