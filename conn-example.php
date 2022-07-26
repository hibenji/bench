<?php

$servername = "localhost";
$username = "mysql_user";
$password = "mysql_password";
$dbname = "mysql_dbname";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// second connection to same database
$conn2 = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn2->connect_error) {
    die("Connection failed: " . $conn2->connect_error);
}

?>