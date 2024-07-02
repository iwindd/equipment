<?php require_once __DIR__ . "/layouts/header.php"; ?>
<header style="width: 100%; display: flex; justify-content:space-between;">
  <h1>หมายเลข</h1>
  <a class="btn btn-primary" href="serials_add.php">เพิ่มหมายเลข</a>
</header>
<hr>
<article>
  <?php

  $stmt = $conn->prepare("SELECT * FROM serials");
  $stmt->execute();

  ?>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>ชุดที่</th>
        <th>ชื่อ </th>
        <th>เครื่องมือ </th>
      </tr>
    </thead>
    <tbody>
      <?php if ($stmt->rowCount() > 0) { ?>
        <?php foreach ($stmt->fetchAll() as $row) { ?>
          <tr>
            <td><?= $row['id']?></td>
            <td><?= $row['number']?></td>
            <td><?= $row['title']?>(<?= $row['value']?>)</td>
            <td >
              <a href="serials_edit.php?id=<?=$row['id']?>" class="btn btn-primary">แก้ไข</a>
              <a href="serials_remove.php?id=<?=$row['id']?>" class="btn btn-danger">ลบ</a>
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