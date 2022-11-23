<?php

include_once "models/connection.php";

class DeleteModel {
  static public function deleteData($table, $ID) {
    $columns = Connection::getTableColumns($table);
    if (empty($columns)) {
      return array(
        "error" => true,
        "message" => "Tabla '$table' no encontrada"
      );
    };

    $tableID = null;

    //extract tableID
    foreach ($columns as $column) {
      $match = explode("_", $column)[1] ?? null;
      if (!empty($match)) {
        if (preg_match("/$match/i", $table)) {
          $tableID = $column;
          break;
        }
      }
    }

    //verificar si existe el id
    $sql = "SELECT * FROM $table WHERE $tableID = $ID";
    $stmt = Connection::connect()->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_CLASS);
    if (empty($row)) {
      return array(
        "error" => true,
        "message" => "El id $ID no existe en la tabla $table"
      );
    }

    $sql = "DELETE FROM $table WHERE $tableID = $ID";
    $stmt = Connection::connect()->prepare($sql);

    try {
      $stmt->execute();
      return array(
        "error" => false,
        "message" => "Datos eliminados correctamente",
        "data" => $row
      );
    } catch (PDOException $e) {
      $errors[] = array(
        "error" => true,
        "message" => $e->getMessage()
      );
    }
  }
}