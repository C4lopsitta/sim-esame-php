<?php
include_once ("GenericDAO.php");
include_once ("../Classes/Pilot.php");

class PilotsDAO extends GenericDAO {
  public static function create(object $obj): int {
    if(GenericDAO::$pdo == null) {
      throw new Exception("PDO is not instantiated");
    }

    return 1;
  }

  public static function read(int $id): ?object {
    if(GenericDAO::$pdo == null) {
      throw new Exception("PDO is not instantiated");
    }

    $result = GenericDAO::$pdo->query("SELECT * FROM studentPilot WHERE id = $id", PDO::FETCH_NAMED)->fetch();

    if($result) {
      return new Pilot(
         $result["id"],
         $result["name"],
         $result["surname"],
         $result["birthDate"],
         $result["medicalCertificate"]
      );
    }

    return null;
  }

  public static function readAll(): ?array {
    if(GenericDAO::$pdo == null) {
      throw new Exception("PDO is not instantiated");
    }

    return [];
  }

  public static function update(object $obj): bool {
    if(GenericDAO::$pdo == null) {
      throw new Exception("PDO is not instantiated");
    }

    return true;
  }

  public static function delete(int $id): bool {
    if(GenericDAO::$pdo == null) {
      throw new Exception("PDO is not instantiated");
    }

    return true;
  }
}