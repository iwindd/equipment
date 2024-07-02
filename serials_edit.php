<?php require_once __DIR__ . "/layouts/header.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $stmt = $conn->prepare("UPDATE serials SET number = :number, value = :value, title = :title WHERE id = :id");
  $stmt->bindParam(':number', $_POST['number']);
  $stmt->bindParam(':value', $_POST['value']);
  $stmt->bindParam(':title', $_POST['title']);
  $stmt->bindParam(':id', $_POST['id']);
  $stmt->execute();

  header("Location: serials.php");
}

if ($_SERVER['REQUEST_METHOD'] == "GET"){
  if (!isset($_GET['id'])){
    header("Location: locations.php");
  }

  $stmt = $conn->prepare("SELECT * FROM serials WHERE id = :id");
  $stmt->bindParam(":id", $_GET['id']);
  $stmt->execute();

  if ($stmt->rowCount() <= 0) {
    header("Location: serials.php");
  }

  $data = $stmt->fetchAll()[0];
}

?>
<header style="width: 100%; display: flex; justify-content:space-between;">
  <h1>แก้ไขหมายเลข</h1>
</header>
<hr>
<article>
  <form method="post">
    <input type="hidden" name="id" value="<?=$data['id']?>">
    <table>
      <tr>
        <td><label for="number">ลำดับชุด</label></td>
        <td>
          <select name="number" id="number" required>
            <option value="1" <?="1" == $data['number'] ? 'selected="true"': ""?>>1</option>
            <option value="2" <?="2" == $data['number'] ? 'selected="true"': ""?>>2</option>
            <option value="3" <?="3" == $data['number'] ? 'selected="true"': ""?>>3</option>
            <option value="4" <?="4" == $data['number'] ? 'selected="true"': ""?>>4</option>
          </select>
        </td>
      </tr>
      <tr>
        <td><label for="value">หมายเลข</label></td>
        <td><input type="text" value="<?=$data['value']?>" name="value" id="value" required></td>
      </tr>
      <tr>
        <td><label for="title">ชื่อ</label></td>
        <td><input type="text" value="<?=$data['title']?>" name="title" id="title" required></td>
      </tr>
      <tr>
        <td colspan="2"><button type="submit">บันทึก</button></td>
      </tr>
    </table>
  </form>
</article>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>