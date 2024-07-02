<?php  require_once __DIR__."/../includes/db.php"; ?>
<?php  require_once __DIR__."/../guards/AuthGuard.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=
  , initial-scale=1.0">
  <link rel="stylesheet" href="./css/style.css">
  <title>Equipments</title>
  <style>
    body{
      display: flex;
      height: 100vh;
    }

    .nav{
      background-color: var(--nav-bg);
      width: 260px;
      text-align: center;
    }

    .nav header{
      padding: 1em 0em;
    }
    
    .nav header h1{
      color: white;
    }

    .nav hr{
      margin-top: 0em;
      margin-bottom: 1em;
    }

    .nav ul, .nav li, .nav li a{
      width: 100%;
    }

    .nav li{
      margin-bottom: .5em;
    }

    .nav li a{
      color: white;
      text-decoration: none;
    }

    .wrapper{
      flex-grow: 1;
      padding: 1em;
    }
  </style>
</head>
<body>

<div class="nav">
  <header>
    <h1>Equipments</h1>
  </header>
  <hr>
  <ul>
    <li><a href="#">ครุภัณฑ์</a></li>
    <li><a href="departments.php">ฝ่าย/งาน</a></li>
    <li><a href="works.php">งาน</a></li>
    <li><a href="auth/logout.php">ออกจากระบบ</a></li>
  </ul>
</div>

<div class="wrapper">