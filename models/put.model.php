<?php

include_once "models/connection.php";

class PutModel
{
  static public function putData($table, $rows, $ID)
  {
    $columns = Connection::getTableColumns($table);
    if (empty($columns)) {
      return array(
        "error" => true,
        "message" => "Tabla '$table' no encontrada"
      );
    };

    $tableIdName = null;
    $errors = [];
    $satisfactory = [];

    foreach ($rows as $row) {
      $values = [];

      foreach ($columns as $column) {
        $match = explode("_", $column)[1] ?? null;
        if (!empty($match)) {
          if (preg_match("/$match/i", $table)) {
            $tableIdName = $column;
            continue;
          };
        }

        if (isset($row[$column])) {
          $values[$column] = $row[$column];
        }
      }

      $updateQuery = "";
      foreach ($values as $key => $value) {
        $updateQuery .= "$key = '$value', ";
      }
      $updateQuery = substr($updateQuery, 0, -2);

      $sql = "UPDATE $table SET $updateQuery WHERE $tableIdName = $ID";
      $stmt = Connection::connect()->prepare($sql);

      try {
        $stmt->execute();

        $lastId = Connection::connect()->prepare("SELECT * FROM $table WHERE $tableIdName = $ID");
        $lastId->execute();
        $satisfactory[] = $lastId->fetchAll(PDO::FETCH_CLASS);
      } catch (PDOException $e) {
        $errors[] = array(
          "message" => $e->getMessage()
        );
      }

      if (empty($errors)) {
        return array(
          "error" => false,
          "message" => empty($satisfactory) ? "Los datos no se han actualizado" : "Datos actualizados correctamente",
          "data" => count($satisfactory[0]) == 1 ? $satisfactory[0][0] : $satisfactory
        );
      } else {
        return array(
          "error" => true,
          "message" => $errors
        );
      }
    }
  }
}
