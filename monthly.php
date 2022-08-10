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
    <meta content="https://bench.benji.link" property="og:url">
    <meta content="/assets/controller.png" property="og:image">
    <meta content="#5a43b5" data-react-helmet="true" name="theme-color">
   
    <title>Benchmarks of Game Streaming Providers (Monthly)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/bulma-prefers-dark.css" />
    <link rel="stylesheet" type="text/css" href="assets/custom.css" />

    <script async src="https://arc.io/widget.min.js#a24jhCmw"></script>

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
              order: [[4, 'desc']],
              paging: false,
              info: false,
              searching: false
            });
        });
    </script>


  </head>
  <body>

  <?php

  include('conn.php');

  $sql = "SELECT * FROM monthly";
  $result = $conn->query($sql);


  ?>



  <section class="section">
    <div class="container">
      <h1 class="title">
        Benchmarks of Game Streaming Providers (Monthly)
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
      <th onclick="sortTable(0)">Name</th>
      <th onclick="sortTable(1)">Locations</th>
      <th onclick="sortTable(2)">Price</th>
      <th onclick="sortTable(3)"><abbr title="How much?/Is it Persitant?">Storage</th>
      <th onclick="sortTable(4)"><abbr title="Non-RTX FPS MAX settings 1080p">FPS</th>
      <th onclick="sortTable(5)"><abbr title="RTX FPS MAX settings 1080p">RTX FPS</th>
      <th onclick="sortTable(6)">Library</th>
      <th onclick="sortTable(7)">RAM</th>
      <th onclick="sortTable(8)"><abbr title="vCores">CPU</th>
      <th onclick="sortTable(9)">GPU</th>
      <th>Link</th>
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
              <td><a href='overview.php?type=monthly&id=" . $row["id"]. "'>" . $row["name"]. "</td>
              <td>" . $row["locations"]. "</td>
              <td>" . $row["price"]. "$/m</td>
              <td>" . $row["storage"]. "</td>
              <td>" . $fps. "</td>
              <td>" . $rtx_fps. "</td>
              <td>" . $row["library"]. "</td>
              <td>" . $row["ram"]. "</td>
              <td>" . $row["vcores"]. "</td>
              <td>" . $row["gpu"]. "</td>
              <td><a href='" . $row["link"]. "' target='_blank'>Link</a></td>
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
  <section class="section">
    <div class="container">
      <i class="fa fa-italic">*more storage can be added at setup</i> <br>
      <i class="fa fa-italic">**BYOG = Bring your own Games</i> <br>
      <i class="fa fa-italic">***GFN = Geforce Now</i>
    </div>
  </section>


  <footer class="footer">
    <div class="content has-text-centered">
      <p>
        <strong>Benchmarks</strong> by <a href="https://benji.link">Benji</a>.<br>
        If you have any problems or suggestions, please contact me on discord: Benji#1652 <br>
        Email: benjibordne@outlook.com
      </p>
    </div>
  </footer>


  </body>
</html>