<?php 
#################### URL BASE ###############################
$arrServer = filter_input_array(INPUT_SERVER);
$currentPath = $arrServer['PHP_SELF'];
$pathInfo = pathinfo($currentPath);
$hostName = $arrServer['HTTP_HOST'];
$protocol = strtolower(substr($arrServer['SERVER_PROTOCOL'], 0, 5)) == 'https://' ? 'https://' : 'http://';
$arrDirname = explode('/', $pathInfo['dirname']);
$project = $arrDirname[1];

//$base_url = $protocol . $hostName . '/' . $project . '/';

$base_url = 'https://' . $hostName . '/';        


#################### FIN URL BASE #############################


################### CONEXION BASE DE DATOS LOCAL ###################
$dbServer = 'pxukqohrckdfo4ty.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
$dbUser = 'd5lq6hfkkb9vajha';
$dbPassword = 'i17ofz67tvc3jcrd';
$dbSchema = 'qnoj6rd8pftwfmxv';


try {
    $db = new PDO('mysql:host=' . $dbServer . ';dbname=' . $dbSchema . ';chasrset=utf8', $dbUser, $dbPassword);
    $db->exec("set names utf8");
    $conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbSchema) or die("Connection failed: " . mysqli_connect_error());
} catch (PDOException  $e) {
    echo "ERROR: " . $e->getMessage();
}
################### FIN CONEXION BASE DE DATOS ###################

 ?>