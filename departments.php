<?php require_once __DIR__ . "/layouts/header.php"; ?>
<header style="width: 100%; display: flex; justify-content:space-between;">
  <h1>ฝ่าย/งาน</h1>
  <a class="btn btn-primary" href="departments_add.php">เพิ่มฝ่าย/งาน</a>
</header>
<hr>
<article>
  <?php

  $stmt = $conn->prepare("SELECT * FROM departments");
  $stmt->execute();

  ?>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>ฝ่าย/งาน</th>
        <th>เครื่องมือ</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($stmt->rowCount() > 0) { ?>
        <?php foreach ($stmt->fetchAll() as $row) { ?>
          <tr>
            <td><?= $row['id']?></td>
            <td><?= $row['title']?></td>
            <td >
              <a href="departments_edit.php?id=<?=$row['id']?>" class="btn btn-primary">แก้ไข</a>
              <a href="departments_remove.php?id=<?=$row['id']?>" class="btn btn-danger">ลบ</a>
            </td>
          </tr>
        <?php } ?>
      <?php } else { ?>
        <tr>
          <td colspan="3" style="text-align: center;">ไม่พบฝ่าย/งาน</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</article>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>