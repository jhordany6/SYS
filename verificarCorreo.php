<?php 
require('config.php');

$correoDestinatario = $_REQUEST['email'];
$celular = $_REQUEST['phone'];
$documento = $_REQUEST['document'];

$sqlUsuario = "SELECT * FROM tbl_usuario WHERE email ='" . $correoDestinatario."' AND telefono ='".$celular."' AND documento ='".$documento."' ;";
$queryUsuario = mysqli_query($conn, $sqlUsuario);
$fetchUsuario = mysqli_fetch_row($queryUsuario);
$rows = mysqli_num_rows($queryUsuario);

if($rows == 0){
	header("location:index.php?error=3");
}else{
	header("location:index.php?success=1&passwd=".$fetchUsuario[8]);
}
?>