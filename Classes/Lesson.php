<?php

class Lesson {
  private $id;
  private $type;
  private $argument;
  private $date;
  private $course;
  private $duration;

  /**
   * @param $id
   * @param $type
   * @param $argument
   * @param $date
   * @param $course
   * @param $duration
   */
  public function __construct($id, $type, $argument, $date, $course, $duration) {
    $this->id = $id;
    $this->type = $type;
    $this->argument = $argument;
    $this->date = $date;
    $this->course = $course;
    $this->duration = $duration;
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id): void {
    $this->id = $id;
  }

  public function getType() {
    return $this->type;
  }

  public function setType($type): void {
    $this->type = $type;
  }

  public function getArgument() {
    return $this->argument;
  }

  public function setArgument($argument): void {
    $this->argument = $argument;
  }

  public function getDate() {
    return $this->date;
  }

  public function setDate($date): void {
    $this->date = $date;
  }

  public function getCourse() {
    return $this->course;
  }

  public function setCourse($course): void {
    $this->course = $course;
  }

  public function getDuration() {
    return $this->duration;
  }

  public function setDuration($duration): void {
    $this->duration = $duration;
  }

  public function toRow(): string {
    return <<< HTML
<tr>
    <td>$this->id</td>
    <td>$this->type</td>
    <td>$this->argument</td>
    <td>$this->date</td>
    <td>$this->duration</td>
    <td>$this->course</td>
</tr>
HTML;
  }
}