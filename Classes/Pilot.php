<?php

class Pilot {
  private $id;
  private $name;
  private $surname;
  private $birthDate;
  private $medicalCertificate;

  public function __construct($id, $name, $surname, $birthDate, $medicalCertificate)
  {
    $this->id = $id;
    $this->name = $name;
    $this->surname = $surname;
    $this->birthDate = $birthDate;
    $this->medicalCertificate = $medicalCertificate;
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

  public function getMedicalCertificate() {
    return $this->medicalCertificate;
  }

  public function setMedicalCertificate($medicalCertificate) {
    $this->medicalCertificate = $medicalCertificate;
  }

  public function toOption(): string {
    return <<< HTML
<option value="$this->id">
    $this->name $this->surname (id $this->id)
</option>
HTML;
  }

  public function toRow(): string {
    return <<< HTML
<tr>
    <td>$this->id</td>
    <td>$this->name</td>
    <td>$this->surname</td>
    <td>$this->birthDate</td>
    <td>$this->medicalCertificate</td>
</tr>
HTML;

  }
}