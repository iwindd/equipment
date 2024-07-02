<?php require_once __DIR__ . "/layouts/header.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $stmt = $conn->prepare("UPDATE works SET title = :title, department_id = :did WHERE id = :id");
  $stmt->bindParam(':id', $_POST['id']);
  $stmt->bindParam(':title', $_POST['work']);
  $stmt->bindParam(':did', $_POST['department']);
  $stmt->execute();

  header("Location: works.php");
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  if (!isset($_GET['id'])) {
    header("Location: works.php");
  }

  $stmt = $conn->prepare("SELECT * FROM works WHERE id = :id");
  $stmt->bindParam(":id", $_GET['id']);
  $stmt->execute();

  if ($stmt->rowCount() <= 0) {
    header("Location: works.php");
  }

  $data = $stmt->fetchAll()[0];
}

$stmt = $conn->prepare("SELECT * FROM departments");
$stmt->execute();
?>
<header style="width: 100%; display: flex; justify-content:space-between;">
  <h1>แก้ไขงาน</h1>
</header>
<hr>
<article>
  <form method="post">
    <input type="hidden" value="<?= $data['id'] ?>" name="id">
    <table>
      <tr>
        <td><label for="department">แผนก</label></td>
        <td>
          <select name="department" id="department">
            <?php if ($stmt->rowCount() > 0) { ?>
              <?php foreach ($stmt->fetchAll() as $row) { ?>
                <option value="<?= $row['id'] ?>" <?= $row['id'] == $data['department_id'] ? 'selected="true"' : "" ?>><?= $row['title'] ?></option>
              <?php } ?>
            <?php } else { ?>
              <option value="0">กรุณาเพิ่มฝ่าย/งาน</option>
            <?php } ?>
          </select>
        </td>
      </tr>
      <tr>
        <td><label for="work">งาน</label></td>
        <td><input type="text" value="<?= $data['title'] ?>" name="work" id="work"></td>
      </tr>
      <tr>
        <td colspan="2"><button type="submit">บันทึก</button></td>
      </tr>
    </table>
    
  </form>
</article>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>