<!DOCTYPE html>
<?php
include_once ("./Dao/PilotsDAO.php");
include_once ("./Dao/GenericDAO.php");
include_once ("./Classes/Pilot.php");
include_once ("./Classes/Lesson.php");

GenericDAO::connect();

$pilot = null;
$allPilots = array();
$error = null;
$absences = array();

try {
  $allPilots = PilotsDAO::readAll();
} catch (Exception $e) {
  $error = $e->getMessage();
}


?>

<html lang="en">
  <head>
      <title>SmartFly - Pilot</title>
      <link rel="stylesheet" type="text/css" href="index.css" />
  </head>
  <body>
    <form action="/pilot.php" method="get">
        <label>
            Student
            <select id="id" name="id">
                <?php
                foreach($allPilots as $pilot){
                    echo $pilot->toOption();
                }
                ?>
            </select>
        </label>
        <button type="submit">
            Go to student
        </button>
    </form>


<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["id"]) && $_GET["id"] != null) {
      try {
        $pilot = PilotsDAO::read($_GET["id"]);
        $absences = PilotsDAO::readAbsencesByPilot($pilot);

        $htmlAbsences = "";
        foreach($absences as $ab){
          $htmlAbsences = $htmlAbsences . $ab->toRow();
        }

        $pilotName = $pilot->getName() . " " . $pilot->getSurname();
        $pilotBday = $pilot->getBirthDate();
        $pilotCert = $pilot->getMedicalCertificate();

        echo <<< HTML
    <h1>$pilotName</h1>
    <p>Birthday: $pilotBday</p>
    <p>Medical Certificate: $pilotCert</p>

    <br>
    <h2>Lessons where student was absent</h2>
    <table>
        <thead><tr>
            <th>ID</th>
            <th>Type</th>
            <th>Argument</th>
            <th>Date</th>
            <th>Duration</th>
            <th>Course ID</th>
        </tr></thead>
        <tbody>
            $htmlAbsences
        </tbody>
    </table> 
HTML;
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    } else {
        echo <<< HTML
<h1>Select a pilot to view all lessons where they were absent</h1>
HTML;

    }
}



?>

  </body>
</html>


