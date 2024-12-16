<?php

include_once ("GenericDAO.php");
include_once ("../Classes/MedicalVisit.php");

class MedicalVisistsDAO extends GenericDAO {
  public static function create(object $obj): int {
    // TODO: Implement create() method.
    return -1;
  }

  public static function read(int $id): ?object {
    // TODO: Implement read() method.
    return null;
  }

  public static function readByInstructor($instructor): array {
    if(GenericDAO::$pdo == null) {
      throw new Exception("PDO is not Instantiated");
    }

    $instructorId = $instructor->getId();
    $result = GenericDAO::$pdo->query("SELECT * FROM medicalVisits WHERE instructor = $instructorId")->fetchAll(PDO::FETCH_ASSOC);

    $visits = array();

    foreach ($result as $row) {
      $visits[] = new MedicalVisit(
         $row["id"],
         $row["description"],
         $row["date"],
         $row["result"]
      );
    }

    return $visits;
  }

  public static function readAll(): ?array {
    // TODO: Implement readAll() method.
    return null;
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