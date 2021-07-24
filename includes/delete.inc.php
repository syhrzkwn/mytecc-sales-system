<?php
session_start();

if(isset($_POST['delete'])) {

  $userid = $_POST["userid"];

  require_once 'connection.inc.php';
  require_once 'functions.inc.php';

  deleteUser($conn,$userid);
}
else {
  header("location: ../php/users");
  exit();
}
