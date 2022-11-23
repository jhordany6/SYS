<?php

require_once "vendor/autoload.php";

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

$userToken = "";

class Connection
{
  public static function infoDatabase() {
    $infoDB = [
      "database" => "qnoj6rd8pftwfmxv",
      "user" => "d5lq6hfkkb9vajha",
      "pass" => "i17ofz67tvc3jcrd"
    ];

    return $infoDB;
  }

  public static function connect() {
    try {
      $link = new PDO(
        "mysql:host=pxukqohrckdfo4ty.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=" . Connection::infoDatabase()["database"],
        Connection::infoDatabase()["user"],
        Connection::infoDatabase()["pass"],
      );

      $link->exec("set names utf8");
    } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
    }

    return $link;
  }

  public static function getTableColumns($table) {
    $database = Connection::infoDatabase()["database"];

    return Connection::connect()
      ->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$database' AND TABLE_NAME = '$table'")
      ->fetchAll(PDO::FETCH_COLUMN);
  }

  public static function getIdColumn($table) {
    $columns = Connection::getTableColumns($table);
    foreach ($columns as $column) {
      if (preg_match("/^id_/", $column)) {
        $id = explode("_", $column)[1];

        if (preg_match("/$id/i", $table)) {
          return $column;
        }
      }
    }
  }

  public static function generateJWT($userInfo) {
    $token = [
      "iat" => time(), //time of creation
      "exp" => time() + (60 * 60 * 24), //expiration time
      "data" => $userInfo
    ];

    $userToken = JWT::encode($token, 'systemica', 'HS256');
    return $userToken;
  }

  public static function validateJWT($token) {
    try {
      return JWT::decode(
        $token,
        new Key('systemica', 'HS256')
      );
    } catch (Exception $e) {
      return [
        "error" => true,
        "message" => $e->getMessage()
      ];
    }
  }
}
