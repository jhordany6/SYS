<?php

include_once "models/connection.php";

class PostModel
{
  public static function postData($table, $row)
  {
    $columns = Connection::getTableColumns($table);

    if (empty($columns)) {
      return array(
        "error" => true,
        "message" => "Tabla '$table' no encontrada"
      );
    };

    $tableID = "";
    $values = [];

    //validate columns and extract tableID
    foreach ($columns as $column) {
      $match = explode("_", $column)[1] ?? null;
      if (!empty($match)) {
        if (preg_match("/$match/i", $table)) {
          $tableID = $column;
          continue;
        };
      }

      if (isset($row[$column])) {
        $values[$column] = $row[$column];
      } /* else {
        print_r($column);
        $key = key($column) || $column;
        return array(
          "error" => true,
          "message" => "The field '$key' is required"
        );
      } */
    }

    $insertColumns = implode(", ", array_keys($values));
    $insertValues = implode("', '", $values);

    $sql = "INSERT INTO $table ($insertColumns) VALUES ('$insertValues')";
    $stmt = Connection::connect()->prepare($sql);

    try {
      $stmt->execute();
      $lastId = Connection::connect()->prepare("SELECT * FROM $table ORDER BY $tableID DESC LIMIT 1");
      $lastId->execute();
      return array(
        "error" => false,
        "message" => "Datos insertados correctamente",
        "data" => $lastId->fetchAll(PDO::FETCH_CLASS)[0]
      );
    } catch (PDOException $e) {
      return array(
        "error" => true,
        "message" => $e->getMessage()
      );
    }
  }

  public static function postLogin($credencials)
  {
    $sql = "SELECT * FROM usuarios WHERE email = :email AND password = :password";
    $stmt = Connection::connect()->prepare($sql);

    $stmt->bindParam(":email", $credencials["email"], PDO::PARAM_STR);
    $stmt->bindParam(":password", $credencials["password"], PDO::PARAM_STR);

    try {
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_CLASS);
      unset($result[0]->password);

      if (empty($result)) {
        return array(
          "error" => true,
          "message" => "Credenciales invalidos"
        );
      } else {
        $jwt = Connection::generateJWT($result[0]);
        $result = ["user_info" => $result[0], "token" => $jwt];
        return array(
          "error" => false,
          "message" => "Inicio de sesión exitoso",
          "data" => $result,
        );
      }
    } catch (PDOException $e) {
      return array(
        "error" => true,
        "message" => $e->getMessage()
      );
    }
  }

  public static function postRegister($data)
  {
    $sql = "INSERT INTO usuarios (username, email, password, rol) VALUES (:username, :email, :password, :rol)";
    $stmt = Connection::connect()->prepare($sql);
    
    $stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
    $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
    $stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
    $stmt->bindParam(":rol", $data["rol"], PDO::PARAM_STR);

    try {
      $stmt->execute();
      $lastId = Connection::connect()->prepare("SELECT * FROM usuarios ORDER BY id_usuario DESC LIMIT 1");
      $tipos_documento = Connection::connect()->prepare("SELECT * FROM tipos_documento");
      $cursos = Connection::connect()->prepare("SELECT * FROM cursos");
      $establecimientos = Connection::connect()->prepare("SELECT * FROM establecimientos");

      $lastId->execute();
      $tipos_documento->execute();
      $cursos->execute();
      $establecimientos->execute();

      $result = $lastId->fetchAll(PDO::FETCH_CLASS)[0];
      $jwt = Connection::generateJWT($result);
      $result = [
        "user_info" => $result,
        "token" => $jwt,
        "tipos_documento" => $tipos_documento->fetchAll(PDO::FETCH_CLASS),
        "cursos" => $cursos->fetchAll(PDO::FETCH_CLASS),
        "establecimientos" => $establecimientos->fetchAll(PDO::FETCH_CLASS),
      ];
      return array(
        "error" => false,
        "message" => "Usuario registrado correctamente",
        "data" => $result
      );
    } catch (PDOException $e) {
      return array(
        "error" => true,
        "message" => $e->getMessage()
      );
    }
  }
}
