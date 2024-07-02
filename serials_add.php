<?php require_once __DIR__ . "/layouts/header.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $stmt = $conn->prepare("INSERT INTO serials (number, value, title) VALUES (:number, :value, :title)");
  $stmt->bindParam(':number', $_POST['number']);
  $stmt->bindParam(':value', $_POST['value']);
  $stmt->bindParam(':title', $_POST['title']);
  $stmt->execute();

  header("Location: serials.php");
}

?>
<header style="width: 100%; display: flex; justify-content:space-between;">
  <h1>เพิ่มหมายเลข</h1>
</header>
<hr>
<article>
  <form method="post">
    <table>
      <tr>
        <td><label for="number">ลำดับชุด</label></td>
        <td>
          <select name="number" id="number" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
        </td>
      </tr>
      <tr>
        <td><label for="value">หมายเลข</label></td>
        <td><input type="text" placeholder="หมายเลข" name="value" id="value" required></td>
      </tr>
      <tr>
        <td><label for="title">ชื่อ</label></td>
        <td><input type="text" placeholder="ชื่อ" name="title" id="title" required></td>
      </tr>
      <tr>
        <td colspan="2"><button type="submit">เพิ่มรายการ</button></td>
      </tr>
    </table>
  </form>
</article>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>