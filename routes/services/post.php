<?php

require_once "controllers/post.controller.php";

$row = json_decode(file_get_contents('php://input'), true);

$response = new PostController();
if ($table == 'login') $response -> postLogin($row);
else if ($table == 'register') $response -> postRegister($row);
else $response -> postData($table, $row);