<?php 

if (!isset($_SESSION) || !isset($_SESSION['id'])){
  header("Location: auth/index.php");
}
