<!DOCTYPE html>
<?php
include_once ("./Dao/PilotsDAO.php");
include_once ("./Dao/GenericDAO.php");
include_once ("./Classes/Pilot.php");

GenericDAO::connect();

$pilotId = -1;
$pilot = null;
$error = null;

if($_SERVER["REQUEST_METHOD"] == "GET"){
  $pilotId = $_REQUEST["id"];
}

try {
  if($pilotId == -1){
      throw new Exception("No Pilot ID provided");
  }
  $pilot = PilotsDAO::read((int) $pilotId);
  if($pilot == null){
      throw new Exception("Pilot with ID $pilotId not found");
  }
} catch (Exception $e) {
  $error = $e->getMessage();
}

?>
<html lang="en">
  <head>
    <title>SmartFly - Pilot</title>
  </head>
  <body>
    <?php
    if($error != null) echo "<h1>" . $error . "</h1>";
    ?>
    <h1><?php echo $pilot->getName() . " " . $pilot->getSurname() ?></h1>
    <p><?php echo $pilot->getBirthDate() ?></p>
    <p><?php echo $pilot->getMedicalCertificate() ?></p>
  </body>
</html>


