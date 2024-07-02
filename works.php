<?php require_once __DIR__ . "/layouts/header.php"; ?>
<header style="width: 100%; display: flex; justify-content:space-between;">
  <h1>งาน</h1>
  <a class="btn btn-primary" href="works_add.php">เพิ่มงาน</a>
</header>
<hr>
<article>
  <?php

  $stmt = $conn->prepare("SELECT works.id, works.title, departments.title as d_title FROM works LEFT JOIN departments ON works.department_id = departments.id");
  $stmt->execute();

  ?>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>ฝ่าย/งาน</th>
        <th>งาน</th>
        <th>เครื่องมือ</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($stmt->rowCount() > 0) { ?>
        <?php foreach ($stmt->fetchAll() as $row) { ?>
          <tr>
            <td><?= $row['id']?></td>
            <td><?= $row['d_title']?></td>
            <td><?= $row['title']?></td>
            <td >
              <a href="works_edit.php?id=<?=$row['id']?>" class="btn btn-primary">แก้ไข</a>
              <a href="works_remove.php?id=<?=$row['id']?>" class="btn btn-danger">ลบ</a>
            </td>
          </tr>
        <?php } ?>
      <?php } else { ?>
        <tr>
          <td colspan="4" style="text-align: center;">ไม่พบงาน</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</article>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>