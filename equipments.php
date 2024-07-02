<?php require_once __DIR__ . "/layouts/header.php"; ?>
<header style="width: 100%; display: flex; justify-content:space-between;">
  <h1>ครุภัณฑ์</h1>
  <a class="btn btn-primary" href="equipments_add.php">เพิ่มครุภัณฑ์</a>
</header>
<hr>
<article>
  <?php

  $stmt = $conn->prepare("SELECT equipments.id, equipments.code1, equipments.code2, equipments.code3, equipments.code4, equipments.code5, equipments.title, equipments.status, works.title as w_title, departments.title as d_title, locations.title as l_title FROM equipments LEFT JOIN works ON equipments.work_id = works.id LEFT JOIN departments ON works.department_id = departments.id LEFT JOIN locations ON equipments.location_id = locations.id");
  $stmt->execute();

  ?>
  <table>
    <thead>
      <tr>
        <th>รหัส</th>
        <th>ชื่อ</th>
        <th>ฝ่าย/งาน</th>
        <th>งาน</th>
        <th>สถานที่</th>
        <th>สถานะ</th>
        <th>เครื่องมือ</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($stmt->rowCount() > 0) { ?>
        <?php foreach ($stmt->fetchAll() as $row) { ?>
          <tr>
            <td><?= $row['code1'] . "-" . $row['code2'] . "-" . $row['code3'] . "-" . $row['code4'] . "-" . $row['code5'] ?></td>
            <td><?= $row['title'] ?></td>
            <td><?= $row['d_title'] ?></td>
            <td><?= $row['w_title'] ?></td>
            <td><?= $row['l_title'] ?></td>
            <td><?= $row['status'] == "using" ? "กำลังใช้งาน" : ($row['status'] == 'selling' ? "จำหน่าย" : ($row['status'] == 'repair' ? "ชำรุด" : "สถานะไม่ทราบ")) ?></td>
            <td>
              <a href="equipments_edit.php?id=<?= $row['id'] ?>" class="btn btn-primary">แก้ไข</a>
              <a href="equipments_remove.php?id=<?= $row['id'] ?>" class="btn btn-danger">ลบ</a>
            </td>
          </tr>
        <?php } ?>
      <?php } else { ?>
        <tr>
          <td colspan="7" style="text-align: center;">ไม่พบครุภัณฑ์</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</article>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>