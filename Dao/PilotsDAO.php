<?php
include_once ("GenericDAO.php");
include_once ("./Classes/Pilot.php");

class PilotsDAO extends GenericDAO {
  public static function create(object $obj): int {
    if(GenericDAO::$pdo == null) {
      throw new Exception("PDO is not instantiated");
    }

    return 1;
  }

  public static function readAbsencesByPilot(Pilot $pilot): array {
    include_once ("./Classes/Lesson.php");

    $result = GenericDAO::$pdo->query("SELECT studentPilot.*, lessons.*, lessonStudentsAbsences.*
                                                FROM studentPilot, lessons, lessonStudentsAbsences
                                                WHERE studentPilot.id = lessonStudentsAbsences.studentPilot
                                                    AND lessons.id = lessonStudentsAbsences.lesson
                                                    AND studentPilot.id = ".$pilot->getId().";");

    $rows = $result->fetchAll(PDO::FETCH_ASSOC);

    $lessonAbsent = array();

    foreach ($rows as $row) {
      $lessonAbsent[] = new Lesson(
         $row["id"], $row["type"], $row["argument"], $row["date"], $row["course"], $row["duration"]
      );
    }

    return $lessonAbsent;
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

    $result = GenericDAO::$pdo->query("SELECT * FROM studentPilot;");

    $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    $pilots = array();

    foreach ($rows as $row) {
      $pilots[] = new Pilot(
         $row["id"],
         $row["name"],
         $row["surname"],
         $row["birthDate"],
         $row["medicalCertificate"]
      );
    }

    return $pilots;
  }

  public static function getCount(): int {
    if(GenericDAO::$pdo == null) {
      throw new Exception("PDO is not instantiated");
    }

    $result = GenericDAO::$pdo->query("SELECT COUNT(*) FROM studentPilot;");
    $rows = $result->fetch(PDO::FETCH_NUM);
    return $rows[0];
  }

  public static function readPage($items, $offset): ?array {
    if(GenericDAO::$pdo == null) {
      throw new Exception("PDO is not instantiated");
    }

    $result = GenericDAO::$pdo->query("SELECT * FROM studentPilot ORDER BY id LIMIT $items OFFSET $offset;");

    $rows = $result->fetchAll(PDO::FETCH_ASSOC);

    $pilots = array();

    foreach ($rows as $row) {
      $pilots[] = new Pilot(
         $row["id"],
         $row["name"],
         $row["surname"],
         $row["birthDate"],
         $row["medicalCertificate"]
      );
    }

    return $pilots;
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