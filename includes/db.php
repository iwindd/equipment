<?php

$servername = "localhost";
$username = "root";
$password = "12341234z";


try {
  $conn = new PDO("mysql:host=$servername;dbname=equipments", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  session_start();
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>

