<?php

include_once ("Classes/Pilot.php");
include_once ("Dao/GenericDAO.php");
include_once ("Dao/PilotsDAO.php");

GenericDAO::connect();

$pilots = array();

try {
  $pilots = PilotsDAO::readAll();
} catch (Exception $exception) {
  echo "<h1>".$exception->getMessage()."</h1>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>SmartFly - All Pilots</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="index.css" />


  <script>

      $(document).ready( function() {
          let itemsPerPage = 5;
          let page = 1;

          pageItems({data: { p1: page, p2: itemsPerPage }});
      })

      const pageItems = (event) => {
          let page = event.data.p1;
          let itemsPerPage = event.data.p2;

          let items = $("#items tr");
          let itemCount = items.length;

          for(let i = 1; i < itemCount; i++) {
              items.eq(i).show();
          }

          for(let i = 1; i < itemCount; i++) {
              if(i <= ((page-1) * itemsPerPage) || i > (page * itemsPerPage)) {
                items.eq(i).hide();
              }
          }

          activateButtons(itemCount, page, itemsPerPage);
      }

      const activateButtons = (items, page, itemsPerPage) => {
          let txtIndex = $("#txtPageIndex");
          let btnNext = $("#btnNext");
          let btnPrev = $("#btnPrev");

          let maxPages = parseInt(
              (items.length / itemsPerPage) + ((items.length % itemsPerPage) ? 1:2)
          );

          btnPrev.off("click")
          btnNext.off("click")

          if(page == 1) {
              btnPrev.show()
          } else {
              btnPrev.show()
              btnPrev.on("click", {p1: page-1, p2: itemsPerPage}, pageItems)
          }

          if(page == maxPages) {
              btnNext.hide()
          } else {
              btnNext.show()
              btnNext.on("click", {p1: page+1, p2: itemsPerPage}, pageItems)
          }

          txtIndex.text(`Page ${page}`)
      }

  </script>
</head>
<body>
    <h1>All Pilots - Javashit Paging</h1>
    <table id="items">
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
        <p id="txtPageIndex">Page</p>
        <button id="btnPrev">Previous Page</button>
        <button id="btnNext">Next Page</button>
    </footer>
</body>
</html>

