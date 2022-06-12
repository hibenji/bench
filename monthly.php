<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 300);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Benchmarks" property="og:title">
    <meta content="Benchmarks and comparison of cloud game streaming providers" property="og:description">
    <meta content="https://bench.benji.live" property="og:url">
    <meta content="/contoller.png" property="og:image">
    <meta content="#5a43b5" data-react-helmet="true" name="theme-color">
   
    <title>List of Game Streaming Providers (Monthly)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="bulma-prefers-dark.css" />
    <link rel="stylesheet" type="text/css" href="custom.css" />


    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
              paging: false,
              info: false,
              searching: false
            });
        });
    </script>


  </head>
  <body>

  <?php

  $servername = "localhost";
  $username = "bench";
  $password = "bB6n8vQWzSx656bQ";
  $dbname = "bench";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM monthly ORDER BY fps DESC";
  $result = $conn->query($sql);


  ?>



  <section class="section">
    <div class="container">
      <h1 class="title">
        List of Game Streaming Providers (Monthly)
      </h1>
      <br>
      <!-- back button -->
      <a href="/" class="button is-primary">Back</a>
      <a href="hourly.php" class="button is-primary">Hourly</a>
      <br>
      <br>
      <p class="subtitle">
        Click the headers to sort the table.
        <br>
        All Benchmarks were in run Shadow of the Tomb Raider without DLSS and at 1080p at Max Settings.
      </p>

<table id="myTable" class="table">
  <thead>
    <tr>
      <th onclick="sortTable(0)">Names</th>
      <th onclick="sortTable(1)">Locations</th>
      <th onclick="sortTable(2)">Price</th>
      <th onclick="sortTable(3)"><abbr title="How much?/Is it Persitant?">Storage</th>
      <th onclick="sortTable(4)"><abbr title="Non-RTX FPS MAX settings 1080p">FPS</th>
      <th onclick="sortTable(5)"><abbr title="RTX FPS MAX settings 1080p">RTX FPS</th>
      <th onclick="sortTable(6)">Library</th>
      <th onclick="sortTable(7)">RAM</th>
      <th onclick="sortTable(8)"><abbr title="vCores">CPU</th>
      <th onclick="sortTable(9)">GPU</th>
      <th><abbr title="Non-RTX Benchmark Screenshot">Screenshot</th>
      <th><abbr title="RTX Benchmark Screenshot">Screenshot RTX</th>
      <th><abbr title="Just some more random info">Extra Info</th>
    </tr>
  </thead>
  <tbody>

      <?php
      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {

              if($row["fps"] < 30) {
                $fps = "<span id='" . $row["fps"] . "' class='tag is-danger'>" . $row["fps"] . "</span>";
              } else if($row["fps"] < 60) {
                $fps = "<span id='" . $row["fps"] . "' class='tag is-warning'>" . $row["fps"] . "</span>";
              } else {
                $fps = "<span id='" . $row["fps"] . "' class='tag is-success'>" . $row["fps"] . "</span>";
              }

              if($row["rtx-fps"] < 30) {
                $rtx_fps = "<span id='" . $row["rtx-fps"] . "' class='tag is-danger'>" . $row["rtx-fps"] . "</span>";
              } else if($row["rtx-fps"] < 60) {
                $rtx_fps = "<span id='" . $row["rtx-fps"] . "' class='tag is-warning'>" . $row["rtx-fps"] . "</span>";
              } else {
                $rtx_fps = "<span id='" . $row["rtx-fps"] . "' class='tag is-success'>" . $row["rtx-fps"] . "</span>";
              }


              echo "
              <tr>
              <td><a href='" . $row["link"]. "' target='_blank'>" . $row["name"]. "</td>
              <td>" . $row["locations"]. "</td>
              <td>" . $row["price"]. "$/m</td>
              <td>" . $row["storage"]. "</td>
              <td>" . $fps. "</td>
              <td>" . $rtx_fps. "</td>
              <td>" . $row["library"]. "</td>
              <td>" . $row["ram"]. "</td>
              <td>" . $row["vcores"]. "</td>
              <td>" . $row["gpu"]. "</td>
              <td><a href='" . $row["ss-non"]. "' target='_blank'>Screenshot</a></td>
              <td><a href='" . $row["ss-rtx"]. "' target='_blank'>Screenshot</a></td>
              <td>" . $row["info"]. "</td>
              </tr>
              "; 
          }
      } else {
          echo "0 results";
      }
      ?>
  </tbody>
</table>


      </p>
    </div>
  </section>
  </body>


</html>