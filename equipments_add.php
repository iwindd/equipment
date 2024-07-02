<?php require_once __DIR__ . "/layouts/header.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $stmt = $conn->prepare("SELECT MAX(code5) as max_code5 FROM equipments WHERE code1 = :code1 AND code2 = :code2 AND code3 = :code3 AND code4 = :code4");
  $stmt->bindParam(':code1', $_POST['code1']);
  $stmt->bindParam(':code2', $_POST['code2']);
  $stmt->bindParam(':code3', $_POST['code3']);
  $stmt->bindParam(':code4', $_POST['code4']);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $new_code5 = $result['max_code5'] ? $result['max_code5'] + 1 : 1;

  $stmt = $conn->prepare("INSERT INTO equipments (title, code1, code2, code3, code4, code5, status, work_id, location_id) VALUES (:title, :code1, :code2, :code3, :code4, :code5, :status, :work_id, :location_id)");
  $stmt->bindParam(':title', $_POST['title']);
  $stmt->bindParam(':work_id', $_POST['works']);
  $stmt->bindParam(':location_id', $_POST['location']);
  $stmt->bindParam(':code1', $_POST['code1']);
  $stmt->bindParam(':code2', $_POST['code2']);
  $stmt->bindParam(':code3', $_POST['code3']);
  $stmt->bindParam(':code4', $_POST['code4']);
  $stmt->bindParam(':code5', $new_code5);
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
    <table>
      <tr>
        <td><label for="works">งาน</label></td>
        <td>
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
        </td>
      </tr>
      <tr>
        <td><label for="tile">ชื่อครุภัณฑ์</label></td>
        <td><input type="text" placeholder="ครุภัณฑ์" name="title" id="title" required></td>
      </tr>
      <tr>
        <td><label for="tile">สถานะ</label></td>
        <td>
          <select name="status" id="status" required>
            <option value="using">ใช้งาน</option>
            <option value="selling">จำหน่าย</option>
            <option value="repair">ชำรุด</option>
          </select>
        </td>
      </tr>
      <tr>
        <td><label for="location">สถานที่</label></td>
        <td>
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
        </td>
      </tr>
      <tr>
        <td><label for="code1">หมายเลข</label></td>
        <td>
          <select name="code1" id="code1" required>
            <?php
            $stmt = $conn->prepare("SELECT * FROM serials WHERE number = 1");
            $stmt->execute();
            ?>
            <?php if ($stmt->rowCount() > 0) { ?>
              <?php foreach ($stmt->fetchAll() as $row) { ?>
                <option value="<?= $row['id'] ?>">(<?= $row['value'] ?>) <?= $row['title'] ?></option>
              <?php } ?>
            <?php } else { ?>
              <option value="0">กรุณาเพิ่มหมายเลขชุดที่ 1</option>
            <?php } ?>
          </select>
          <select name="code2" id="code2" required>
            <?php
            $stmt = $conn->prepare("SELECT * FROM serials WHERE number = 2");
            $stmt->execute();
            ?>
            <?php if ($stmt->rowCount() > 0) { ?>
              <?php foreach ($stmt->fetchAll() as $row) { ?>
                <option value="<?= $row['id'] ?>">(<?= $row['value'] ?>) <?= $row['title'] ?></option>
              <?php } ?>
            <?php } else { ?>
              <option value="0">กรุณาเพิ่มหมายเลขชุดที่ 2</option>
            <?php } ?>
          </select>
          <select name="code3" id="code3" required>
            <?php
            $stmt = $conn->prepare("SELECT * FROM serials WHERE number = 3");
            $stmt->execute();
            ?>
            <?php if ($stmt->rowCount() > 0) { ?>
              <?php foreach ($stmt->fetchAll() as $row) { ?>
                <option value="<?= $row['id'] ?>">(<?= $row['value'] ?>) <?= $row['title'] ?></option>
              <?php } ?>
            <?php } else { ?>
              <option value="0">กรุณาเพิ่มหมายเลขชุดที่ 3</option>
            <?php } ?>
          </select>
          <select name="code4" id="code4" required>
            <?php
            $stmt = $conn->prepare("SELECT * FROM serials WHERE number = 4");
            $stmt->execute();
            ?>
            <?php if ($stmt->rowCount() > 0) { ?>
              <?php foreach ($stmt->fetchAll() as $row) { ?>
                <option value="<?= $row['id'] ?>">(<?= $row['value'] ?>) <?= $row['title'] ?></option>
              <?php } ?>
            <?php } else { ?>
              <option value="0">กรุณาเพิ่มหมายเลขชุดที่ 4</option>
            <?php } ?>
          </select>
        </td>
      </tr>
      <tr>
        <td colspan="2"><button type="submit">เพิ่มรายการ</button></td>
      </tr>
    </table>
  </form>
</article>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>