<?php

class MedicalVisit {
  private int $id;
  private string $description;
  private string $date;
  private string $result;

  /**
   * @param int $id
   * @param string $description
   * @param string $date
   * @param string $result
   */
  public function __construct(int $id, string $description, string $date, string $result) {
    $this->id = $id;
    $this->description = $description;
    $this->date = $date;
    $this->result = $result;
  }

  public function getId(): int {
    return $this->id;
  }

  public function setId(int $id): void {
    $this->id = $id;
  }

  public function getDescription(): string {
    return $this->description;
  }

  public function setDescription(string $description): void {
    $this->description = $description;
  }

  public function getDate(): string {
    return $this->date;
  }

  public function setDate(string $date): void {
    $this->date = $date;
  }

  public function getResult(): string {
    return $this->result;
  }

  public function setResult(string $result): void {
    $this->result = $result;
  }

  public function toRow(): string {
    return <<<HTML
<tr>
    <td>$this->id</td>
    <td>$this->description</td>
    <td>$this->date</td>
    <td>$this->result</td>
</tr>
HTML;
  }
}