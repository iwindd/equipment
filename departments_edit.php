<?php require_once __DIR__ . "/layouts/header.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $stmt = $conn->prepare("UPDATE departments SET title = :title WHERE id = :id");
  $stmt->bindParam(':id', $_POST['id']);
  $stmt->bindParam(':title', $_POST['department']);
  $stmt->execute();

  header("Location: departments.php");
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  if (!isset($_GET['id'])) {
    header("Location: departments.php");
  }

  $stmt = $conn->prepare("SELECT * FROM departments WHERE id = :id");
  $stmt->bindParam(":id", $_GET['id']);
  $stmt->execute();

  if ($stmt->rowCount() <= 0) {
    header("Location: departments.php");
  }

  $data = $stmt->fetchAll()[0];
}
?>
<header style="width: 100%; display: flex; justify-content:space-between;">
  <h1>แก้ไขฝ่าย/งาน</h1>
</header>
<hr>
<article>
  <form method="post">

    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <table>
      <tr>
        <td><label for="department">แผนก</label></td>
        <td><input type="text" placeholder="แผนก" value="<?= $data['title'] ?>" name="department" id="department"></td>
      </tr>
      <tr>
        <td colspan="2"> <button type="submit">บันทึก</button></td>
      </tr>
    </table>
  </form>
</article>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>