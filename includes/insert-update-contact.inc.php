<?php
session_start();

if($_POST['submit'] == 'insert') {
  
  $address = $_POST["address"];
  $postcode = $_POST["postcode"];
  $city = $_POST["city"];
  $state = $_POST["state"];
  $phone = $_POST["phone"];
  $userId = $_SESSION["userid"];

  require_once 'connection.inc.php';
  require_once 'functions.inc.php';

  insertUserContact($conn, $address, $postcode, $city, $phone, $state ,$userId);
}
else if($_POST['submit'] == 'update') {

  $address = $_POST["address"];
  $postcode = $_POST["postcode"];
  $city = $_POST["city"];
  $state = $_POST["state"];
  $phone = $_POST["phone"];
  $userId = $_SESSION["userid"];

  require_once 'connection.inc.php';
  require_once 'functions.inc.php';

  updateUserContact($conn, $address, $postcode, $city, $phone, $state, $userId);
}
else {
  header("location: ../php/accounts");
  exit();
}