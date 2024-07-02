<?php

$servername = "localhost";
$username = "root";
$password = "12341234z";

try {
  $conn = new PDO("mysql:host=$servername;dbname=equipments", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>

