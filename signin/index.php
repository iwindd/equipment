<?php  require_once __DIR__."/../includes/db.php"; ?>
<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  $stmt = $conn->prepare("SELECT id FROM users WHERE username = :user AND password = :pass");
  $stmt->bindParam(":user", $_POST['username']);
  $stmt->bindParam(":pass", $_POST['password']);
  $stmt->execute();

  if ($stmt->rowCount() > 0){
    $user = $stmt->fetchAll()[0];
    $_SESSION['id'] = $user['id'];
    echo "ไม่พบผู้ใช้";
    header("Location: ../index.php");
  }else{
    echo "ไม่พบผู้ใช้";
    header("Location: index.php");
    die();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
</head>
<body>
  <form method="post">
    <h1>Login</h1>
    <input type="text" name="username" id="username" placeholder="username">
    <input type="password" name="password" id="password" placeholder="password">
    <button type="submit">Submit</button>
  </form>
</body>
</html>