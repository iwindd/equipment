<?php require_once __DIR__ . "/layouts/header.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $stmt = $conn->prepare("INSERT INTO equipments (title, code1, code2, code3, code4, code5, status, work_id, location_id) VALUES (:title, :code1, :code2, :code3, :code4, :code5, :status, :work_id, :location_id)");
  $stmt->bindParam(':title', $_POST['title']);
  $stmt->bindParam(':work_id', $_POST['works']);
  $stmt->bindParam(':location_id', $_POST['location']);
  $stmt->bindParam(':code1', $_POST['code1']);
  $stmt->bindParam(':code2', $_POST['code2']);
  $stmt->bindParam(':code3', $_POST['code3']);
  $stmt->bindParam(':code4', $_POST['code4']);
  $stmt->bindParam(':code5', $_POST['code5']);
  $stmt->bindParam(':status', $_POST['status']);
  $stmt->execute();

  header("Location: equipments.php");
}

?>
<header style="width: 100%; display: flex; justify-content:space-between;">
  <h1>เพิ่มครุภัณฑ์</h1>
</header>
<hr>
<article>
  <form method="post">
    <select name="works" id="works" required>
      <?php
      $stmt = $conn->prepare("SELECT works.id, works.title, departments.title as d_title FROM works LEFT JOIN departments ON works.department_id = departments.id");
      $stmt->execute();
      ?>
      <?php if ($stmt->rowCount() > 0) { ?>
        <?php foreach ($stmt->fetchAll() as $row) { ?>
          <option value="<?= $row['id'] ?>">(<?= $row['d_title'] ?>) <?= $row['title'] ?></option>
        <?php } ?>
      <?php } else { ?>
        <option value="0">กรุณาเพิ่มฝ่าย/งาน</option>
      <?php } ?>
    </select>
    <input type="text" name="title" id="title" required>
    <select name="status" id="status" required>
      <option value="using">ใช้งาน</option>
      <option value="selling">จำหน่าย</option>
      <option value="repair">ชำรุด</option>
    </select>
    <select name="location" id="location" required>
      <?php
      $stmt = $conn->prepare("SELECT * FROM locations");
      $stmt->execute();
      ?>
      <?php if ($stmt->rowCount() > 0) { ?>
        <?php foreach ($stmt->fetchAll() as $row) { ?>
          <option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
        <?php } ?>
      <?php } else { ?>
        <option value="0">กรุณาเพิ่มฝ่าย/งาน</option>
      <?php } ?>
    </select>
    <section class="code-inputs">
      <input type="text" name="code1" id="code1" required>
      <input type="text" name="code2" id="code2" required>
      <input type="text" name="code3" id="code3" required>
      <input type="text" name="code4" id="code4" required>
      <input type="text" name="code5" id="code5" required>
    </section>
    <button type="submit">เพิ่มรายการ</button>
  </form>
</article>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>