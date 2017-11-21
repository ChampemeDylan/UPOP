<?php

session_start();
if(!isset($_SESSION['loginUser'])) {
  header("Location: index.php");
  exit();
}

?>