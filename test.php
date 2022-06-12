<!DOCTYPE html>
<html>
<head>
<title>Sort a HTML Table Alphabetically</title>
<style>
table {
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th {
  cursor: pointer;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}
</style>
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

$sql = "SELECT * FROM hourly";
$result = $conn->query($sql);


?>



<p><strong>Click the headers to sort the table.</strong></p>
<p>The first time you click, the sorting direction is ascending (A to Z).</p>
<p>Click again, and the sorting direction will be descending (Z to A):</p>




<table id="myTable">
  <tr>
   <!--When a header is clicked, run the sortTable function, with a parameter, 0 for sorting by names, 1 for sorting by country:-->  
    <th onclick="sortTable(0)">Name</th>
    <th onclick="sortTable(1)">Country</th>
    <th onclick="sortTable(2)">Price</th>
  </tr>
   <?php
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "
            <tr>
            <td><a href='" . $row["link"]. "' target='_blank'>" . $row["name"]. "</td>
            <td>" . $row["locations"]. "</td>
            <td>" . $row["price"]. "$/hr</td>
            </tr>
            "; 
        }
    } else {
        echo "0 results";
    }

  ?>
</table>



<table id="myTable1" class="table">
    <tr>
      <th onclick="sortTable(0)">Name</th>
      <th onclick="sortTable(1)">Locations</th>
      <th onclick="sortTable(2)">Price</th>
    </tr>

      <?php
      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo "
              <tr>
              <td><a href='" . $row["link"]. "' target='_blank'>" . $row["name"]. "</td>
              <td>" . $row["locations"]. "</td>
              <td>" . $row["price"]. "$/hr</td>
              </tr>
              "; 
          }
      } else {
          echo "0 results";
      }
      ?>
</table>


<script src="table.js"></script>


</body>
</html>
