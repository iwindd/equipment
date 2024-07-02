<?php require_once __DIR__ . "/layouts/header.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $stmt = $conn->prepare("INSERT INTO works (title, department_id) VALUES (:title, :did)");
  $stmt->bindParam(':title', $_POST['work']);
  $stmt->bindParam(':did', $_POST['department']);
  $stmt->execute();

  header("Location: works.php");
}

$stmt = $conn->prepare("SELECT * FROM departments");
$stmt->execute();
?>
<header style="width: 100%; display: flex; justify-content:space-between;">
  <h1>เพิ่มงาน</h1>
</header>
<hr>
<article>
  <form method="post">
    <select name="department" id="department">
      <?php if ($stmt->rowCount() > 0) { ?>
        <?php foreach ($stmt->fetchAll() as $row) { ?>
          <option value="<?=$row['id']?>"><?=$row['title']?></option>
        <?php } ?>
      <?php } else { ?>
        <option value="0">กรุณาเพิ่มฝ่าย/งาน</option>
      <?php } ?>
    </select>
    <input type="text" name="work" id="work">
    <button type="submit">เพิ่มรายการ</button>
  </form>
</article>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>