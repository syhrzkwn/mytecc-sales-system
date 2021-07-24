<?php

if(isset($_POST["submit"])) {
  $username = $_POST["uid"];
  $pwd = $_POST["pwd"];

  include_once 'connection.inc.php';
  include_once 'functions.inc.php';

  if(emptyInputLogin($username, $pwd) !== false) {
    header("location: ../php/login?error=emptyinput");
    exit();
  }

  loginUser($conn, $username, $pwd);
}
else {
  header("location: ../php/login");
  exit();

}