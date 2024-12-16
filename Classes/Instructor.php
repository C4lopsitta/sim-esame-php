<?php

class Instructor {

  private $id;
  private $name;
  private $surname;
  private $birthDate;
  private $license;

  public function __construct($id, $name, $surname, $birthDate, $license)
  {
    $this->id = $id;
    $this->name = $name;
    $this->surname = $surname;
    $this->birthDate = $birthDate;
    $this->license = $license;
  }

  public function toHtmlRow() {
    return <<< HTML
<tr>
    
</tr>
HTML;

  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getName() {
    return $this->name;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function getSurname() {
    return $this->surname;
  }

  public function setSurname($surname) {
    $this->surname = $surname;
  }

  public function getBirthDate() {
    return $this->birthDate;
  }

  public function setBirthDate($birthDate) {
    $this->birthDate = $birthDate;
  }

  public function getLicense() {
    return $this->license;
  }

  public function setLicense($license) {
    $this->license = $license;
  }

  public function toOption(): string {
    return <<< HTML
<option value="$this->id">
    $this->name $this->surname (id $this->id)
</option>
HTML;
  }}