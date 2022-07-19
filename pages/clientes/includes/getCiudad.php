<?php require '../../../session.php';

$idCiudad = $_POST['id'];

$sqlCiudad = 'SELECT * FROM tbl_ciudad WHERE fk_id_departamento = '.$idCiudad.'  ORDER BY nombre ASC;';
$queryCiudad = $db->query($sqlCiudad);
$fetchCiudad = $queryCiudad->fetchAll(PDO::FETCH_OBJ);

$html = '<option value="0">Selecciona una opción</option>';
foreach ($fetchCiudad as $fetch) {
	$html .= '<option value="'.$fetch->id_ciudad.'">'.$fetch->nombre.'</option>';
}
echo $html;

?>