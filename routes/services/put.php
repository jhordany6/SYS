<?php

require_once "controllers/put.controller.php";

$rows = json_decode(file_get_contents('php://input'), true);
if (!isset($rows[0])) {
  $rows = array($rows);
}

$response = new PutController();
$response -> putData($table, $rows, $ID);