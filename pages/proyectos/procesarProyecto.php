<?php 
require '../../session.php';

$accion = $_REQUEST['accion'];

$nombreObra = $_POST['nombreObra'];
$fechaInicio = $_POST['fecha_inicio'];
$fechaFin = $_POST['fecha_fin'];
$cantidadPisos = $_POST['cantidadPisos'];
$presupuestoObra = $_POST['presupuestoObra'];
$estadoObra = $_POST['estadoObra'];
$ciudad = $_POST['ciudad'];
$direccion = $_POST['direccion'];
$barrio = $_POST['barrio'];
$cliente = $_POST['cliente'];
$tipoObra = $_POST['tipoObra'];
$contratista = $_POST['contratista'];
$idUbicacion = 0;
$idObra = 0;
/** TEXTO JSON PARA ALMACENAR EN DB **/
$planos = $_POST['planos'];
$documentos = $_POST['documentos'];
$imagenes = $_POST['imagenes'];
/*****************************************/

switch ($accion) {
	case 'crear':
		/**** INSERT ENCABEZADO DE LA OBRA ***/
		$insertUbicacion = $db->prepare("INSERT INTO tbl_ubicacion (direccion,barrio,fk_id_ciudad) VALUES(:direccion, :barrio, :fk_id_ciudad)");
		$insertUbicacion->bindParam(':direccion', $direccion);
		$insertUbicacion->bindParam(':barrio', $barrio);
		$insertUbicacion->bindParam(':fk_id_ciudad', $ciudad);
		$insertUbicacion->execute();

		/*select ultima ubicacion*/
		$sqlIdUbicacion = "SELECT MAX(id_ubicacion) id_ubicacion FROM tbl_ubicacion ORDER BY id_ubicacion DESC";
		$queryIdUbicacion = $db->query($sqlIdUbicacion);
		$fetchIdUbicacion = $queryIdUbicacion->fetchAll(PDO::FETCH_OBJ);
		foreach ($fetchIdUbicacion as $fetch) {
			$idUbicacion = $fetch->id_ubicacion;
		}

    /**** INSERT DOCUMENTACION DE LA OBRA ***/
		$insertDocumentacion = $db->prepare("INSERT INTO tbl_referencia_documentos (ref_planos,ref_pdf,ref_img) VALUES(:ref_planos, :ref_pdf, :ref_img)");
		$insertDocumentacion->bindParam(':ref_planos', $planos);
		$insertDocumentacion->bindParam(':ref_pdf', $documentos);
		$insertDocumentacion->bindParam(':ref_img', $imagenes);
		$insertDocumentacion->execute();

		/*select ultima DOCUMENTACION*/
		$sqlIdDocumentacion = "SELECT MAX(id_referencia_documentos) id_referencia_documentos FROM tbl_referencia_documentos ORDER BY id_referencia_documentos DESC";
		$queryIdDocumentacion = $db->query($sqlIdDocumentacion);
		$fetchIdDocumentacion = $queryIdDocumentacion->fetchAll(PDO::FETCH_OBJ);
		foreach ($fetchIdDocumentacion as $fetch) {
			$idDocumentacion = $fetch->id_referencia_documentos;
		}

		/*Insert Obra*/
		$insertEncabezado = $db->prepare("INSERT INTO tbl_obra (nombre,fecha_inicio,fecha_fin,cantidad_pisos,presupuesto_obra,fk_id_estado_obra,fk_id_ubicacion,fk_id_cliente,fk_id_tipo_obra, fk_id_contratista, fk_id_ref_documentos) 
			VALUES (:nombre, :fecha_inicio, :fecha_fin, :cantidad_pisos, :presupuesto_obra, :fk_id_estado_obra, :fk_id_ubicacion, :fk_id_cliente, :fk_id_tipo_obra, :fk_id_contratista, :fk_id_ref_documentos)");
		$insertEncabezado->bindParam(':nombre', $nombreObra);
		$insertEncabezado->bindParam(':fecha_inicio', $fechaInicio);
		$insertEncabezado->bindParam(':fecha_fin', $fechaFin);
		$insertEncabezado->bindParam(':cantidad_pisos', $cantidadPisos);
		$insertEncabezado->bindParam(':presupuesto_obra', $presupuestoObra);
		$insertEncabezado->bindParam(':fk_id_estado_obra', $estadoObra);
		$insertEncabezado->bindParam(':fk_id_ubicacion', $idUbicacion);
		$insertEncabezado->bindParam(':fk_id_cliente', $cliente);
		$insertEncabezado->bindParam(':fk_id_tipo_obra', $tipoObra);
    $insertEncabezado->bindParam(':fk_id_contratista', $contratista);
    $insertEncabezado->bindParam(':fk_id_ref_documentos', $idDocumentacion);
		$insertEncabezado->execute();

		/** TRAER ID DE LA OBRA**/
		$sqlIdObra = "SELECT MAX(id_obra) id_obra FROM tbl_obra ORDER BY id_obra DESC";
		$queryIdObra = $db->query($sqlIdObra);
		$fetchIdObra = $queryIdObra->fetchAll(PDO::FETCH_OBJ);
		foreach ($fetchIdObra as $fetch) {
			$idObra = $fetch->id_obra;
		}

		/**** INSERT DETALLE DE LA OBRA ***/
		$arraySubObra = array();
		$arraySubObra = $_POST["subObra"];
		$arraycantidad = array();
		$arraycantidad = $_POST["cantidad"];
		$sizeArray = sizeof($arraySubObra);
		$i = 0;
		while($i < $sizeArray){
			$crearObraDetalle = $db->prepare("INSERT INTO tbl_detalle_sub_obra (codigo_sub_obra,cantidad_sub_obra,fk_id_obra) VALUES(:codigo_sub_obra,:cantidad_sub_obra,:fk_id_obra);");
			$crearObraDetalle->bindParam(':codigo_sub_obra', $arraySubObra[$i]);
			$crearObraDetalle->bindParam(':cantidad_sub_obra', $arraycantidad[$i]);
			$crearObraDetalle->bindParam(':fk_id_obra', $idObra);
			$crearObraDetalle->execute();
			$i++;
		}

    /**** INSERT DETALLE EMPLEADOS***/
		$arrayEstudiante = array();
		$arrayEstudiante = $_POST["Estudiante"];
    var_dump($arrayEstudiante);
		$arraycantidadEstudiante = array();
		$arraycantidadEstudiante = $_POST["cantidadEstudiante"];
    var_dump($arraycantidadEstudiante);
		$sizeArrayEstudiante = sizeof($arrayEstudiante);
		$i = 0;
		while($i < $sizeArrayEstudiante){
			$crearObraDetalleEstudiante = $db->prepare("INSERT INTO tbl_detalle_estudiante (cantidad,fk_id_estudiante,fk_id_obra) VALUES(:cantidad,:fk_id_estudiante,:fk_id_obra);");
			$crearObraDetalleEstudiante->bindParam(':cantidad', $arraycantidadEstudiante[$i]);
			$crearObraDetalleEstudiante->bindParam(':fk_id_estudiante', $arrayEstudiante[$i]);
			$crearObraDetalleEstudiante->bindParam(':fk_id_obra', $idObra);
			$crearObraDetalleEstudiante->execute();
			$i++;
		}

    // PROCESO PARA CALCULAR EL VALOR DE LA OBRA

    $valorTotalObra = 0;

    $sqlDetalleSubObras = "SELECT codigo_sub_obra codigo, cantidad_sub_obra cantidad FROM tbl_detalle_sub_obra WHERE fk_id_obra = ".$idObra;
    $queryDetalleSubObras = $db->query($sqlDetalleSubObras);
    $fetchDetalleSubObras = $queryDetalleSubObras->fetchAll(PDO::FETCH_OBJ);
    foreach ($fetchDetalleSubObras as $fetchDetalleSubObra) {
      $codigoSubObra = $fetchDetalleSubObra->codigo;
      $cantidadSubObra = $fetchDetalleSubObra->cantidad;

      $sqlSubObra = "SELECT costo FROM tbl_sub_obra WHERE codigo = ".$codigoSubObra;
      $querySubObra = $db->query($sqlSubObra);
      $fetchSubObra = $querySubObra->fetchAll(PDO::FETCH_OBJ);
      $valorSubObra = 0;

      foreach ($fetchSubObra as $fetchSubObra) {
        $valorSubObra = $fetchSubObra->costo;
      }

      $valorTotalObra = $valorTotalObra + ($valorSubObra*$cantidadSubObra);

    }

    $crearActualizarValorObra = $db->prepare("UPDATE tbl_obra SET valor_total = ".$valorTotalObra." WHERE id_obra = ".$idObra);
    $crearActualizarValorObra->execute();

		header('location:'.$base_url.'pages/proyectos/index.php?r=success');
		break;
	case 'actualizar':



		break;
	case 'eliminar':
		$idObra = $_REQUEST['idObra'];
		/*** ELIMINAR DETALLE**/
		$eliminarObraDetalle = $db->prepare("DELETE FROM tbl_detalle_sub_obra WHERE fk_id_obra = :fk_id_obra;");
		$eliminarObraDetalle->bindParam(':fk_id_obra', $idObra);
		$eliminarObraDetalle->execute();

    /*** ELIMINAR DETALLE EMPLEADO**/
		$eliminarObraDetalleEstudiante = $db->prepare("DELETE FROM tbl_detalle_estudiante WHERE fk_id_obra = :fk_id_obra;");
		$eliminarObraDetalleEstudiante->bindParam(':fk_id_obra', $idObra);
		$eliminarObraDetalleEstudiante->execute();

		/** ELIMINAR ENCABEZADO **/
		$eliminarObraEncabezado = $db->prepare("DELETE FROM tbl_obra WHERE id_obra = :id_obra;");
		$eliminarObraEncabezado->bindParam(':id_obra', $idObra);
		$eliminarObraEncabezado->execute();

		header('location:'.$base_url.'pages/proyectos/index.php?r=eliminado');
		break;
	default:
		# code...
	break;
}


?>

