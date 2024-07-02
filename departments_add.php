<?php require_once __DIR__ . "/layouts/header.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

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
    <table>
      <tr>
        <td><label for="department">แผนก</label></td>
        <td><input type="text" placeholder="แผนก" name="department" id="department"></td>
      </tr>
      <tr>
        <td colspan="2"><button type="submit">เพิ่มรายการ</button></td>
      </tr>
    </table>
  </form>
</article>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>