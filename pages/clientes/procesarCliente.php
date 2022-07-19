<?php 
require '../../session.php';
//error_reporting(E_ALL);
$accion = $_REQUEST['accion'];
$idCliente = $_REQUEST['id'];

$primerNombre = $_POST['primerNombre'];
$segundoNombre = $_POST['segundoNombre'];
$primerApellido = $_POST['primerApellido'];
$segundoApellido = $_POST['segundoApellido'];
$documento = $_POST['documento'];
$tipoDocumento = $_POST['tipoDocumento'];
$tipoCliente = $_POST['tipoCliente'];
$pais = $_POST['pais'];
$departamentoSelect = $_POST['departamento'];
$ciudad = $_POST['ciudad'];
$direccion = $_POST['direccion'];
$barrio = $_POST['barrio'];
$email = $_POST['email'];
$nombreEmpresa = $_POST['nombreEmpresa'];


switch ($accion) {
	case 'crear':
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

    $crearCliente = $db->prepare("INSERT INTO tbl_cliente (primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,documento,email,nombre_empresa,fk_id_tipo_documento,fk_id_tipo_cliente,fk_id_ubicacion) VALUES (:primer_nombre, :segundo_nombre, :primer_apellido, :segundo_apellido, :documento, :email, :nombre_empresa, :fk_id_tipo_documento, :fk_id_tipo_cliente, :fk_id_ubicacion)");
    $crearCliente->bindParam(':primer_nombre', $primerNombre);
    $crearCliente->bindParam(':segundo_nombre', $segundoNombre);
    $crearCliente->bindParam(':primer_apellido', $primerApellido);
    $crearCliente->bindParam(':segundo_apellido', $segundoApellido);
    $crearCliente->bindParam(':documento', $documento);
    $crearCliente->bindParam(':email', $email);
    $crearCliente->bindParam(':nombre_empresa', $nombreEmpresa);
    $crearCliente->bindParam(':fk_id_tipo_documento', $tipoDocumento);
    $crearCliente->bindParam(':fk_id_tipo_cliente', $tipoCliente);
    $crearCliente->bindParam(':fk_id_ubicacion', $idUbicacion);
    $crearCliente->execute();

		header('location:'.$base_url.'pages/clientes/indexClientes.php?r=success');
		break;
	case 'actualizar':
		$sqlActualizar = "UPDATE tbl_cliente SET primer_nombre=?, segundo_nombre=?, primer_apellido=?, segundo_apellido=?, documento=?, email=?, nombre_empresa=?, fk_id_tipo_documento=?, fk_id_tipo_cliente=? WHERE id_cliente=?";
		$actualizarCliente= $db->prepare($sqlActualizar);
		$actualizarCliente->execute([$primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $documento, $email, $nombreEmpresa, $tipoDocumento, $tipoCliente, $idCliente]);
		header('location:'.$base_url.'pages/clientes/indexClientes.php?r=editado');
		break;
	case 'eliminar':
		$sqlCantidadCliente = "SELECT COUNT(*) total FROM tbl_obra WHERE fk_id_cliente = ".$idCliente;
    $queryCantidadCliente = $db->query($sqlCantidadCliente);
    $fetchCantidadCliente = $queryCantidadCliente->fetchAll(PDO::FETCH_OBJ);
    $registrosEncontrados = 0;
    foreach ($fetchCantidadCliente as $fetch) {$registrosEncontrados = $fetch->total;}
    if($registrosEncontrados > 0){
      header('location:'.$base_url.'pages/clientes/indexClientes.php?r=noeliminado');
    }else{
      $eliminarContratista = $db->prepare("DELETE FROM tbl_cliente WHERE id_cliente = :id_cliente;");
      $eliminarContratista->bindParam(':id_cliente', $idCliente);
      $eliminarContratista->execute();
      header('location:'.$base_url.'pages/clientes/indexClientes.php?r=eliminado');
    }

		break;
	
	default:
		# code...
		break;
}


?>

