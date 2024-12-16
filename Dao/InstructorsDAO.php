<?php

include_once ("GenericDAO.php");
include_once ("../Classes/Instructor.php");

class InstructorsDAO extends GenericDAO {
  public static function create(object $obj): int {
    // TODO: Implement create() method.
    return -1;
  }

  public static function read(int $id): ?object {
    if(GenericDAO::$pdo == null) {
      throw new Exception("PDO is not instantiated");
    }

    $result = GenericDAO::$pdo->query("SELECT * FROM instructors WHERE id = $id", PDO::FETCH_NAMED)->fetch();

    if($result) {
      return new Instructor(
         $result["id"],
         $result["name"],
         $result["surname"],
         $result["birthDate"],
         $result["license"]
      );
    }

    return null;
}

  public static function readAll(): ?array {
    if(GenericDAO::$pdo == null) {
      throw new Exception("PDO is not instantiated");
    }

    $result = GenericDAO::$pdo->query("SELECT * FROM instructors;");

    $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    $instructors = array();

    foreach ($rows as $row) {
      $instructors[] = new Instructor(
         $row["id"],
         $row["name"],
         $row["surname"],
         $row["birthDate"],
         $row["license"]
      );
    }

    return $instructors;
  }

  public static function update(object $obj): bool {
    // TODO: Implement update() method.
    return false;
  }

  public static function delete(int $id): bool {
    // TODO: Implement delete() method.
    return false;
  }
}