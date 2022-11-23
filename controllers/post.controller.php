<?php

include_once "models/post.model.php";

class PostController {
  static public function postData($table, $row) {
    $response = PostModel::postData($table, $row);
    $return = new PostController();
    $return -> setResponse($response);
  }

  static public function postLogin($credencials) {
    $response = PostModel::postLogin($credencials);
    $return = new PostController();
    $return -> setResponse($response);
  }

  static public function postRegister($data) {
    $response = PostModel::postRegister($data);
    $return = new PostController();
    $return -> setResponse($response);
  }

  public function setResponse($response) {
    if ($response["error"] == false) {
      $json = array(
        "status" => 200,
        "message" => $response["message"],
        "results" => $response["data"]
      );
    } else {
      $json = array(
        "status" => 404,
        "error" => $response["message"],
      );
    }

    echo json_encode($json, http_response_code($json['status']));
    return;
  }
}