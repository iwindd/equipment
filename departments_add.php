<?php require_once __DIR__ . "/layouts/header.php"; ?>
<?php 
if ($_SERVER['REQUEST_METHOD'] == "POST"){

  $stmt = $conn->prepare("INSERT INTO departments (title) VALUES (:title)");
  $stmt->bindParam(':title', $_POST['department']);
  $stmt->execute();

  header("Location: departments.php");
}
?>
<header style="width: 100%; display: flex; justify-content:space-between;">
  <h1>เพิ่มฝ่าย/งาน</h1>
</header>
<hr>
<article>
  <form method="post">
    <input type="text" name="department" id="department">
    <button type="submit">เพิ่มรายการ</button>
  </form>
</article>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>