<?php require '../../../session.php';

$idPais = $_POST['id'];

$sqlDepartamento = 'SELECT * FROM tbl_departamento WHERE fk_id_pais = '.$idPais.'  ORDER BY nombre ASC;';
$queryDepartamento = $db->query($sqlDepartamento);
$fetchDepartamento = $queryDepartamento->fetchAll(PDO::FETCH_OBJ);

$html = '<option value="0" >Selecciona una opción</option>';
foreach ($fetchDepartamento as $fetch) {
	$html .= '<option value="'.$fetch->id_departamento.'">'.$fetch->nombre.'</option>';
}
echo $html;

?>