<?php
include 'config.php';
//$idOpcion = 0;

if(!isset($_SESSION)) {
	session_start();
}
//error_reporting(E_ALL);
error_reporting(0);


if(!isset($_SESSION['ID_CUENTA'])) {

	header("location:" . $base_url . 'index.php');	
	exit();
}
date_default_timezone_set('America/Bogota');
set_time_limit ( 300 );