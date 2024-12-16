<!DOCTYPE html>
<?php
include_once ("./Dao/InstructorsDAO.php");
include_once ("./Dao/MedicalVisistsDAO.php");
include_once ("./Dao/GenericDAO.php");
include_once ("./Classes/Instructor.php");
include_once ("./Classes/MedicalVisit.php");

GenericDAO::connect();

$allInstructors = array();
$error = null;
$absences = array();

try {
  $allInstructors = InstructorsDAO::readAll();
} catch (Exception $e) {
  $error = $e->getMessage();
}


?>

<html lang="en">
<head>
  <title>SmartFly - Instructor</title>
  <link rel="stylesheet" type="text/css" href="index.css" />
</head>
<body>
<form action="/instructor.php" method="get">
  <label>
    Instructor
    <select id="id" name="id">
      <?php
      foreach($allInstructors as $instructor){
        echo $instructor->toOption();
      }
      ?>
    </select>
  </label>
  <button type="submit">
    Go to Instructor
  </button>
</form>


<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
  if(isset($_GET["id"]) && $_GET["id"] != null) {
    try {
      $instructor = InstructorsDAO::read($_GET["id"]);
      $certificates = MedicalVisistsDAO::readByInstructor($instructor);

      $htmlCerts = "";
      foreach($certificates as $cert){
        $htmlCerts = $htmlCerts . $cert->toRow();
      }

      $instructorName = $instructor->getName() . " " . $instructor->getSurname();
      $instructorBday = $instructor->getBirthDate();
      $instructorLicense = $instructor->getLicense();

      echo <<< HTML
    <h1>$instructorName</h1>
    <p>Birthday: $instructorBday</p>
    <p>License: $instructorLicense</p>

    <br>
    <h2>Medical certificates</h2>
    <table>
        <thead><tr>
            <th>ID</th>
            <th>Description</th>
            <th>Date</th>
            <th>Result</th>
        </tr></thead>
        <tbody>
            $htmlCerts
        </tbody>
    </table> 
HTML;
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  } else {
    echo <<< HTML
<h1>Select an instructor to view all lessons where they were absent</h1>
HTML;

  }
}



?>

</body>
</html>


