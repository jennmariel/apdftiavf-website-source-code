<?php
$servername = "localhost";
$username = "id16629113_user";
$password = "#Unfathomable2021";
$dbname = "id16629113_thesis_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//Get current date
date_default_timezone_set('Asia/Manila');
$d = date("Y-m-d");

// sql to delete a record
$sql = "DELETE FROM polstats WHERE Date='$d'";

if ($conn->query($sql) === TRUE) {
  header("location: home.php");
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>