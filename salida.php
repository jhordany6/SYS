<?php

//Eliminamos todas las variables de sesion y cookies
require_once('session.php');


session_destroy();

header("location:" . $base_url);
