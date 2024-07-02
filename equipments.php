<?php require_once __DIR__ . "/layouts/header.php"; ?>
<header style="width: 100%; display: flex; justify-content:space-between;">
  <h1>ครุภัณฑ์</h1>
  <a class="btn btn-primary" href="equipments_add.php">เพิ่มครุภัณฑ์</a>
</header>
<hr>
<article>
  <?php

  $stmt = $conn->prepare("SELECT * FROM equipments");
  $stmt->execute();

  ?>
  <table>
    <thead>
      <tr>
        <th>รหัส</th>
        <th>ชื่อ</th>
        <th>ฝ่าย/งาน</th>
        <th>งาน</th>
        <th>สถานะ</th>
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
              <a href="equipments_edit.php?id=<?=$row['id']?>" class="btn btn-primary">แก้ไข</a>
              <a href="equipments_remove.php?id=<?=$row['id']?>" class="btn btn-danger">ลบ</a>
            </td>
          </tr>
        <?php } ?>
      <?php } else { ?>
        <tr>
          <td colspan="6" style="text-align: center;">ไม่พบครุภัณฑ์</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</article>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>