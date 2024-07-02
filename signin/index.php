<?php  require_once __DIR__."/../includes/db.php"; ?>
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