<?php require_once __DIR__ . "/layouts/header.php"; ?>
<header style="width: 100%; display: flex; justify-content:space-between;">
  <h1>สถานที่</h1>
  <a class="btn btn-primary" href="locations_add.php">เพิ่มสถานที่</a>
</header>
<hr>
<article>
  <?php

  $stmt = $conn->prepare("SELECT * FROM locations");
  $stmt->execute();

  ?>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>สถานที่</th>
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
              <a href="locations_edit.php?id=<?=$row['id']?>" class="btn btn-primary">แก้ไข</a>
              <a href="locations_remove.php?id=<?=$row['id']?>" class="btn btn-danger">ลบ</a>
            </td>
          </tr>
        <?php } ?>
      <?php } else { ?>
        <tr>
          <td colspan="3" style="text-align: center;">ไม่พบงาน</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</article>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>