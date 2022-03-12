<?php
// Creates a database object.
$db = mysqli_connect("localhost","Username","Password","demo_app");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
?> 