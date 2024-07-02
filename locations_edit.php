<?php require_once __DIR__ . "/layouts/header.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $stmt = $conn->prepare("UPDATE locations SET title = :title WHERE id = :id");
  $stmt->bindParam(':id', $_POST['id']);
  $stmt->bindParam(':title', $_POST['location']);
  $stmt->execute();

  header("Location: locations.php");
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  if (!isset($_GET['id'])) {
    header("Location: locations.php");
  }

  $stmt = $conn->prepare("SELECT * FROM locations WHERE id = :id");
  $stmt->bindParam(":id", $_GET['id']);
  $stmt->execute();

  if ($stmt->rowCount() <= 0) {
    header("Location: locations.php");
  }

  $data = $stmt->fetchAll()[0];
}
?>
<header style="width: 100%; display: flex; justify-content:space-between;">
  <h1>แก้ไขสถานที่</h1>
</header>
<hr>
<article>
  <form method="post">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <table>
      <tr>
        <td><label for="location">สถานที่</label></td>
        <td><input type="text" value="<?= $data['title'] ?>" name="location" id="location"></td>
      </tr>
      <tr>
        <td colspan="2"><button type="submit">บันทึก</button></td>
      </tr>
    </table>
  </form>
</article>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>