<?php

ob_start();

session_start();



include("config.php");



//$VeriReg = mysql_query("SELECT l.id_cuenta, l.usuario, e.id_empresa, e.nom_empresa, u.id_tipo_profesional FROM gddt_login l, gddt_cuentas u, gddt_empresas e WHERE l.usuario ='".$_REQUEST["usuario"]."' AND l.password ='".$_REQUEST["contrasena"]."' AND l.id_cuenta = u.id_cuenta AND u.id_empresa = e.id_empresa;",$conexion) or die ("Error: ". mysql_error());

/*$sql = "SELECT UPPER(CONCAT(u.primer_nombre,' ',u.primer_apellido)) AS nombre,u.documento,r.nombre AS rol FROM tbl_usuario u INNER JOIN tbl_rol r ON r.id_rol = u.fk_id_rol WHERE u.usuario ='".$_REQUEST["usuario"]."' AND u.password ='".$_REQUEST["contrasena"]."';";
$query = $db->query($sql);
$Reg = $query->fetch(PDO::FETCH_ASSOC);*/

$query = $db->prepare("SELECT UPPER(CONCAT(u.primer_nombre,' ',u.primer_apellido)) AS nombre,u.documento,r.nombre AS rol FROM tbl_usuario u INNER JOIN tbl_rol r ON r.id_rol = u.fk_id_rol WHERE u.usuario = :usuario AND u.password = :password;");
$query->bindParam(':usuario', $_REQUEST["usuario"]);
$query->bindParam(':password', $_REQUEST["contrasena"]);
$query->execute();
$Reg = $query->fetch(PDO::FETCH_ASSOC);		
$Num = $query->rowCount();

//$Reg = mysql_fetch_array($VeriReg);

//$Num = $query->rowCount(); // mysql_num_rows($VeriReg);


$_SESSION["LOGIN"] = $Reg["nombre"];
$_SESSION["NUMREG"] = $Num;
$_SESSION["ID_CUENTA"] = $Reg["documento"];
$_SESSION["ROL"] = $Reg["rol"];


if($_SESSION["LOGIN"] != "" && $_SESSION["NUMREG"] == 1){
	setcookie("verificacion",2);
	header("location:pages/inicio.php");
}else{
	setcookie("verificacion",1);
	header("location:index.php?error=1");
}
?>

<?php

ob_end_flush();

?>