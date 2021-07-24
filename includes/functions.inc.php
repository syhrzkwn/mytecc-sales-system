<?php

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) {
  $result = false;
  if(empty($name) || empty($email || empty($username) || empty($pwd) || empty($pwdRepeat))) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function invalidUid($username) {
  $result = false;
  if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function invalidEmail($email) {
  $result = false;
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function pwdMatch($pwd, $pwdRepeat) {
  $result = false;
  if($pwd !== $pwdRepeat) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function uidExists($conn, $username, $email) {
  $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../php/signup?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  }
  else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $username, $pwd) {
  $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd, user_types) VALUES (? ,? ,? ,? ,'2');";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../php/signup?error=stmtfailed");
    exit();
  }

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../php/signup?error=none");
  exit();
}

function insertUserContact($conn, $address, $postcode, $city, $phone, $state ,$userId) {
  $sql = "INSERT INTO userscontact (address, postcode, city, phoneNum, stateId, usersId)
  VALUES (?,?,?,?,?,?);";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../php/accounts?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssssss", $address, $postcode, $city, $phone, $state, $userId);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../php/accounts?action=insertsuccess");
  exit();
}

function updateUserContact($conn, $address, $postcode, $city, $phone, $state, $userId) {

  $sql = "UPDATE userscontact SET address=?, postcode=?, city=?, phoneNum=?, stateId=? WHERE usersId=?;";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../php/accounts?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssssss", $address, $postcode, $city, $phone, $state, $userId);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../php/accounts?action=updatesuccess");
  exit();
}

function emptyInputLogin($username, $pwd) {
  $result = false;
  if(empty($username) || empty($pwd)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function loginUser($conn, $username, $pwd) {
  $uidExists = uidExists($conn, $username, $username);

  if($uidExists === false) {
    header("location: ../php/login?error=invalidusernameorpwd");
    exit();
  }

  $pwdHashed = $uidExists["usersPwd"];
  $checkPwd = password_verify($pwd, $pwdHashed);

  if($checkPwd === false) {
    header("location: ../php/login?error=invalidpassword");
    exit();
  }
  else if($checkPwd === true) {

    session_start();
    $_SESSION["userid"] = $uidExists["usersId"];
    $_SESSION["useruid"] = $uidExists["usersUid"];
    $_SESSION["usertypes"] = $uidExists["user_types"];
    $_SESSION["username"] = $uidExists["usersName"];
    $_SESSION["useremail"] = $uidExists["usersEmail"];

    if($_SESSION["usertypes"] == 1) {

      header("location: ../php/dashboard?action=loginsuccess");
      exit();
    }
    else if($_SESSION["usertypes"] == 2) {

      header("location: ../php/shop?action=loginsuccess");
      exit();
    }
  }
}

function insertOrd($conn, $size, $quantity, $orderCode, $productCode) {
  $sql = "INSERT INTO ord (size, quantity, orderCode, productCode)
  VALUES (?,?,?,?);";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../php/invoice?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssss", $size, $quantity, $orderCode, $productCode);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

function insertOrders($conn,$orderCode,$orderDate,$orderTime,$total,$usersId) {
  $sql = "INSERT INTO orders (orderCode, orderDate, orderTime, orderPrice, usersId, statusId)
  VALUES (?,?,?,?,?,1);";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../php/invoice?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "sssss", $orderCode, $orderDate, $orderTime, $total, $usersId);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

function deleteUser($conn,$userid) {
  $sql = "DELETE FROM users WHERE usersId = ?";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../php/users?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $userid);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../php/users?action=deletesuccess");
  exit();
}
