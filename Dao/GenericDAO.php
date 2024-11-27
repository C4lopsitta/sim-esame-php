<?php

abstract class GenericDAO {
  static protected ?PDO $pdo = null;
  static private $DB_URL = "sqlite:db.db";

  public static function connect() {
    if (GenericDAO::$pdo == null) {
      try {
        GenericDAO::$pdo = new PDO(GenericDAO::$DB_URL);
        GenericDAO::$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }
  }

  public static function disconnect() {
    if (GenericDAO::$pdo != null) {
      GenericDAO::$pdo = null;
    }
  }

  public abstract static function create(object $obj): int;
  public abstract static function read(int $id): ?object;
  public abstract static function readAll(): ?array;
  public abstract static function update(object $obj): bool;
  public abstract static function delete(int $id): bool;
}