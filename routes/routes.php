<?php
include_once "models/connection.php";

$routesArr = array_filter(explode("/", $_SERVER['REQUEST_URI']));

if (empty($routesArr)) {
  $json = ["status" => 404, "result" => "Not found"];
  echo json_encode($json, http_response_code($json['status']));
  return;
}

if (isset($_SERVER['REQUEST_METHOD'])) {
  $table = explode('?', $routesArr[1])[0];
  $ID = $routesArr[2] ?? null;

  // set access to login and register routes
  if ($table != 'login' && $table != 'register') {
    $headers = getallheaders();
    $token = $headers['Authorization'] ?? null;

    if ($token == null) {
      $json = ["status" => 401, "result" => "Unauthorized"];
      echo json_encode($json, http_response_code($json['status']));
      return;
    }

    $response = Connection::validateJWT($token);
    if (is_array($response)) {
      $json = ["status" => 401, "result" => $response["message"]];
      echo json_encode($json, http_response_code($json['status']));
      return;
    }
  }

  if ($_SERVER['REQUEST_METHOD'] == "GET") include "services/get.php";
  if ($_SERVER['REQUEST_METHOD'] == "POST") include "services/post.php";
  if ($_SERVER['REQUEST_METHOD'] == "PUT") include "services/put.php";
  if ($_SERVER['REQUEST_METHOD'] == "DELETE") include "services/delete.php";
}
