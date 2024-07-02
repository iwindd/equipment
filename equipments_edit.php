<?php require_once __DIR__ . "/layouts/header.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $stmt = $conn->prepare("UPDATE equipments SET title=:title, work_id=:work_id, location_id=:location_id, code1=:code1, code2=:code2, code3=:code3, code4=:code4, status=:status WHERE id = :id");
  $stmt->bindParam(':title', $_POST['title']);
  $stmt->bindParam(':work_id', $_POST['works']);
  $stmt->bindParam(':location_id', $_POST['location']);
  $stmt->bindParam(':code1', $_POST['code1']);
  $stmt->bindParam(':code2', $_POST['code2']);
  $stmt->bindParam(':code3', $_POST['code3']);
  $stmt->bindParam(':code4', $_POST['code4']);
  $stmt->bindParam(':status', $_POST['status']);
  $stmt->bindParam(':id', $_POST['id']);
  $stmt->execute();

  header("Location: equipments.php");
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  if (!isset($_GET['id'])) {
    header("Location: equipments.php");
  }

  $stmt = $conn->prepare("SELECT * FROM equipments LEFT JOIN works ON equipments.work_id = works.id WHERE equipments.id = :id");
  $stmt->bindParam(":id", $_GET['id']);
  $stmt->execute();

  if ($stmt->rowCount() <= 0) {
    header("Location: equipments.php");
  }

  $data = $stmt->fetchAll()[0];
}

?>
<header style="width: 100%; display: flex; justify-content:space-between;">
  <h1>แก้ไขครุภัณฑ์</h1>
</header>
<hr>
<article>
  <form method="post">
    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
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
                <option value="<?= $row['id'] ?>" <?= $row['id'] == $data['work_id'] ? 'selected="true"' : "" ?>>(<?= $row['d_title'] ?>) <?= $row['title'] ?></option>
              <?php } ?>
            <?php } else { ?>
              <option value="0">กรุณาเพิ่มฝ่าย/งาน</option>
            <?php } ?>
          </select>
        </td>
      </tr>
      <tr>
        <td><label for="tile">ชื่อครุภัณฑ์</label></td>
        <td><input type="text" placeholder="ครุภัณฑ์" value="<?= $data['title'] ?>" name="title" id="title" required></td>
      </tr>
      <tr>
        <td><label for="tile">สถานะ</label></td>
        <td>
          <select name="status" id="status" required>
            <option value="using" <?= "using" == $data['status'] ? 'selected="true"' : "" ?>>ใช้งาน</option>
            <option value="selling" <?= "selling" == $data['status'] ? 'selected="true"' : "" ?>>จำหน่าย</option>
            <option value="repair" <?= "repair" == $data['status'] ? 'selected="true"' : "" ?>>ชำรุด</option>
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
                <option value="<?= $row['id'] ?>" <?= $row['id'] == $data['location_id'] ? 'selected="true"' : "" ?>><?= $row['title'] ?></option>
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
                <option value="<?= $row['id'] ?>" <?= $row['id'] == $data['code1'] ? 'selected="true"' : "" ?>>(<?= $row['value'] ?>) <?= $row['title'] ?></option>
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
                <option value="<?= $row['id'] ?>" <?= $row['id'] == $data['code2'] ? 'selected="true"' : "" ?>>(<?= $row['value'] ?>) <?= $row['title'] ?></option>
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
                <option value="<?= $row['id'] ?>" <?= $row['id'] == $data['code3'] ? 'selected="true"' : "" ?>>(<?= $row['value'] ?>) <?= $row['title'] ?></option>
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
                <option value="<?= $row['id'] ?>" <?= $row['id'] == $data['code4'] ? 'selected="true"' : "" ?>>(<?= $row['value'] ?>) <?= $row['title'] ?></option>
              <?php } ?>
            <?php } else { ?>
              <option value="0">กรุณาเพิ่มหมายเลขชุดที่ 4</option>
            <?php } ?>
          </select>
        </td>
      </tr>
      <tr>
        <td colspan="2"><button type="submit">บันทึก</button></td>
      </tr>
    </table>
    <!--     
    <select name="works" id="works" required>
      <?php
      $stmt = $conn->prepare("SELECT works.id, works.title, departments.title as d_title FROM works LEFT JOIN departments ON works.department_id = departments.id");
      $stmt->execute();
      ?>
      <?php if ($stmt->rowCount() > 0) { ?>
        <?php foreach ($stmt->fetchAll() as $row) { ?>
          <option value="<?= $row['id'] ?>" <?= $row['id'] == $data['work_id'] ? 'selected="true"' : "" ?>>(<?= $row['d_title'] ?>) <?= $row['title'] ?></option>
        <?php } ?>
      <?php } else { ?>
        <option value="0">กรุณาเพิ่มฝ่าย/งาน</option>
      <?php } ?>
    </select>
    <input type="text" value="<?= $data['title'] ?>" name="title" id="title" required>
    <select name="status" id="status" required>
      <option value="using"  <?= "using" == $data['status'] ? 'selected="true"' : "" ?>>ใช้งาน</option>
      <option value="selling"<?= "selling" == $data['status'] ? 'selected="true"' : "" ?>>จำหน่าย</option>
      <option value="repair" <?= "repair" == $data['status'] ? 'selected="true"' : "" ?>>ชำรุด</option>
    </select>
    <select name="location" id="location" required>
      <?php
      $stmt = $conn->prepare("SELECT * FROM locations");
      $stmt->execute();
      ?>
      <?php if ($stmt->rowCount() > 0) { ?>
        <?php foreach ($stmt->fetchAll() as $row) { ?>
          <option value="<?= $row['id'] ?>" <?= $row['id'] == $data['location_id'] ? 'selected="true"' : "" ?>><?= $row['title'] ?></option>
        <?php } ?>
      <?php } else { ?>
        <option value="0">กรุณาเพิ่มฝ่าย/งาน</option>
      <?php } ?>
    </select>
    <section class="code-inputs">
      <input type="text" value="<?= $data['code1'] ?>" name="code1" id="code1" required>
      <input type="text" value="<?= $data['code2'] ?>" name="code2" id="code2" required>
      <input type="text" value="<?= $data['code3'] ?>" name="code3" id="code3" required>
      <input type="text" value="<?= $data['code4'] ?>" name="code4" id="code4" required>
      <input type="text" value="<?= $data['code5'] ?>" name="code5" id="code5" required>
    </section>
    <button type="submit">บันทึก</button> -->
  </form>
</article>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>