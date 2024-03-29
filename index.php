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

    <title>Benchmarks of Game Streaming Providers</title>
    <meta name="description" content="Benchmarks of various Game Streaming Providers using Shadow of the Tomb Raider.">
    <meta name="keywords" content="game streaming, cloud streaming, benchmarks, cloud pc">
    <meta name="author" content="Benji">


    <meta content="Benchmarks" property="og:title">
    <meta content="Benchmarks and comparison of cloud game streaming providers" property="og:description">
    <meta content="https://bench.benji.link" property="og:url">
    <meta content="/assets/controller.png" property="og:image">
    <meta content="#5a43b5" data-react-helmet="true" name="theme-color">
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/dark-min.css" />
    <link rel="stylesheet" type="text/css" href="assets/custom.css" />

    <script async src="https://arc.io/widget.min.js#a24jhCmw"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-50TJ289NGW"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-50TJ289NGW');
    </script>

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
              order: [[5, 'desc']],
              paging: false,
              info: false,
              searching: false
            });
        });

        const elements = document.getElementsByClassName("hours");
        console.log(elements);

        var check = "h"

        function myHours() {

          var input = document.getElementById("myHours").value;
          if (input === "") {input = 1;}

          var out = document.getElementsByClassName("hour");

          for(var i = 0; i < elements.length; i++) {

              if (check == "h") {
                out[i].classList.toggle('special');
              }
              
              old = elements[i].attributes.name.value;

              elements[i].innerHTML = Math.ceil(old * input * 100) /100;

          }

          var table = $('#myTable').DataTable();
          table
              .rows()
              .invalidate()
              .order( [[ 2, 'asc' ]] )
              .draw();

          check = "m"
        }
      
    </script>


  </head>
  <body>

  <?php

  include('conn.php');

  $sql = "SELECT * FROM hourly";
  $result = $conn->query($sql);

  $sql2 = "SELECT * FROM monthly";
  $result2 = $conn2->query($sql2);

  ?>

  <section class="section">
    <div class="container">
      <h1 class="title">
        Benchmarks of Game Streaming Providers
      </h1>
      <br>

      <p class="subtitle">

        <!-- button to hourly and monthly -->
        <a href="hourly.php" class="button is-primary">Hourly</a>
        <a href="monthly.php" class="button is-primary">Monthly</a>

        <br>
        <br>


        How many hours a month do you play games on average?<br>
        <i><small>This will show the montly price in the table</small></i><br>
        <input class="input" type="number" id="myHours" onkeyup="myHours()" placeholder="Hours" title="Hours per month">

        <br>
        <br>
        All Benchmarks were in run <b><u>Shadow of the Tomb Raider</u></b> without <b>DLSS</b> and at <b>1080p</b> at <b>Ultra Settings.</b><br>
        <i><small>Click the headers to sort the table.</small></i>
        <br>
      </p>
    

  <table id="myTable" class="table">
  <thead>
    <tr>
      <th onclick="sortTable(0)">Name</th>
      <th onclick="sortTable(1)">Locations</th>
      <th onclick="sortTable(2)">Price</th>
      <th onclick="sortTable(3)">Payment</th>
      <th onclick="sortTable(4)"><abbr title="How much?/Is it Persitant?">Storage</th>
      <th onclick="sortTable(5)"><abbr title="Non-RTX FPS MAX settings 1080p">FPS</th>
      <th onclick="sortTable(6)"><abbr title="RTX FPS MAX settings 1080p">RTX FPS</th>
      <th onclick="sortTable(7)">Library</th>
      <th onclick="sortTable(8)">RAM</th>
      <th onclick="sortTable(9)"><abbr title="vCores">CPU</th>
      <th onclick="sortTable(10)">GPU</th>
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
              <td><a href='overview.php?type=hourly&id=" . $row["id"]. "'>" . $row["name"]. "</td>
              <td>" . $row["locations"]. "</td>
              <td><span class='hour'><p style='display:inline' name='" . $row["price"]. "' class='hours'>" . $row["price"]. "</p></span></td>
              <td>Hourly</td>
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

<?php
      if ($result2->num_rows > 0) {
          // output data of each row
          while($row = $result2->fetch_assoc()) {

              if($row["fps"] < 30) {
                $fps = "<span id='" . $row["fps"] . "' class='tag is-danger'>" . $row["fps"] . "</span>";
              } else if($row["fps"] < 60) {
                $fps = "<span id='" . $row["fps"] . "' class='tag is-warning'>" . $row["fps"] . "</span>";
              } else if($row["fps"] < 100) {
                $fps = "<span id='" . $row["fps"] . "' class='tag is-success'>" . $row["fps"] . "</span>";
              } else {
                $fps = "<span id='9" . $row["fps"] . "' class='tag is-success'>" . $row["fps"] . "</span>";
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
              <td><span class='month'>" . $row["price"]. "</span></td>
              <td>Monthly</td>
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


