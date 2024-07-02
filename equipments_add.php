<?php require_once __DIR__ . "/layouts/header.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

}


$stmt = $conn->prepare("SELECT works.id, works.title, departments.title as d_title FROM works LEFT JOIN departments ON works.department_id = departments.id");
$stmt->execute();
?>
<header style="width: 100%; display: flex; justify-content:space-between;">
  <h1>เพิ่มครุภัณฑ์</h1>
</header>
<hr>
<article>
  <form method="post">
    <select name="works" id="works">
      <?php if ($stmt->rowCount() > 0) { ?>
        <?php foreach ($stmt->fetchAll() as $row) { ?>
          <option value="<?= $row['id'] ?>">(<?=$row['d_title']?>) <?= $row['title'] ?></option>
        <?php } ?>
      <?php } else { ?>
        <option value="0">กรุณาเพิ่มฝ่าย/งาน</option>
      <?php } ?>
    </select>
    <input type="text" name="title" id="title">
    <select name="status" id="status">
      <option value="using">ใช้งาน</option>
      <option value="selling">จำหน่าย</option>
      <option value="repair">ชำรุด</option>
    </select>
    <section class="code-inputs">
      <input type="text" name="code1" id="code1">
      <input type="text" name="code2" id="code2">
      <input type="text" name="code3" id="code3">
      <input type="text" name="code4" id="code4">
      <input type="text" name="code5" id="code5">
    </section>
    <button type="submit">เพิ่มรายการ</button> 
  </form>
</article>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>