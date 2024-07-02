<?php require_once __DIR__ . "/layouts/header.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $stmt = $conn->prepare("INSERT INTO locations (title) VALUES (:title)");
  $stmt->bindParam(':title', $_POST['location']);
  $stmt->execute();

  header("Location: locations.php");
}
?>
<header style="width: 100%; display: flex; justify-content:space-between;">
  <h1>เพิ่มสถานที่</h1>
</header>
<hr>
<article>
  <form method="post">
    <table>
      <tr>
        <td><label for="location">สถานที่</label></td>
        <td><input type="text" name="location" id="location"></td>
      </tr>
      <tr>
        <td colspan="2"><button type="submit">เพิ่มรายการ</button></td>
      </tr>
    </table>
  </form>
</article>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>