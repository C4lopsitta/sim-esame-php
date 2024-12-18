<?php

include_once ("Classes/Pilot.php");
include_once ("Dao/GenericDAO.php");
include_once ("Dao/PilotsDAO.php");

GenericDAO::connect();

$items = $_GET['items'] ?? 20;
$offset = $_GET['page'] ?? 0;

$pilots = array();
$totalItems = 0;

try {
  $totalItems = PilotsDAO::getCount();

  if($offset + 1 * $items > $totalItems){
      $offset = 0;
  }

  $allPilots = PilotsDAO::readAll();

  $pilots = array_splice($allPilots, $offset * $items, $items);

} catch (Exception $exception) {
  echo "<h1>".$exception->getMessage()."</h1>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>SmartFly - All Pilots</title>
  <link rel="stylesheet" type="text/css" href="index.css" />
</head>
<body>
    <h1>All Pilots - PHP Paging</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Birthdate</th>
                <th>Medical Certificate</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php

            if(count($pilots) > 0) {
              foreach ($pilots as $pilot) {
                echo $pilot->toRow();
              }
            } else {
                echo "<h2>no results</h2>";
            }

            ?>
        </tbody>
    </table>
    <footer>
        <form action="pilots.php" method="get">
            <label>Page
                <input type="number" name="page" id="page" value="<?php echo $offset?>" required>
            </label>
            <label>Items per page
                <select id="items" name="items" required>
                    <option value="2" <?php echo ($items == 2)? "selected" : "" ?>>2 Items</option>
                    <option value="5" <?php echo ($items == 5)? "selected" : "" ?>>5 Items</option>
                    <option value="10" <?php echo ($items == 10)? "selected" : "" ?>>10 Items</option>
                    <option value="15" <?php echo ($items == 15)? "selected" : "" ?>>15 Items</option>
                    <option value="20" <?php echo ($items == 20)? "selected" : "" ?>>20 Items</option>
                    <option value="25" <?php echo ($items == 25)? "selected" : "" ?>>25 Items</option>
                </select>
            </label>
            <button type="submit">Go to page</button>
        </form>
        <p>Viewing <?php
          $viewingItems = $items * ($offset + 1);
          if($viewingItems > $totalItems) $viewingItems = $totalItems;
          echo $viewingItems;
          ?> of <?php echo $totalItems ?></p>
        <p>Page: <?php echo $offset ?></p>
        <a href="pilots.php?items=<?php echo $items?>&page=0">First Page</a>
        <?php
        if($offset > 0) {
            $index = $offset - 1;
            echo <<< HTML
<a href="pilots.php?items=$items&page=$index">Previous page</a>
HTML;
        }
        $offset++;
        if($offset * $items < $totalItems) {
          echo <<< HTML
<a href="pilots.php?items=$items&page=$offset">Next Page</a>
HTML;
        }
        ?>
    </footer>
</body>
</html>

