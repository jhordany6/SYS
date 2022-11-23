<?php

require_once "controllers/delete.controller.php";

$response = new DeleteController();
$response -> deleteData($table, $ID);