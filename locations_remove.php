<?php require_once __DIR__ . "/layouts/header.php"; ?>
<?php 
if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['id']){

  $stmt = $conn->prepare("DELETE FROM locations WHERE id = :id");
  $stmt->bindParam(':id', $_GET['id']);
  $stmt->execute();

  header("Location: locations.php");
}
?>
