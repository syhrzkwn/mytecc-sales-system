<?php
session_start();
require_once 'connection.inc.php';
require_once 'functions.inc.php';
require_once 'ordersFunction.inc.php';

if(isset($_POST["pay"])) {
  if(!empty($_SESSION['cart'])) {

    $_SESSION['invoiceid'] = $_POST['invoiceid'];
    $usersId = $_SESSION["userid"];
    $orderCode = $_POST['invoiceid'];
    $orderDate = $_POST['date'];
    $orderTime = $_POST['time'];
    $total = $_POST['total'];

    insertOrders($conn,$orderCode,$orderDate,$orderTime,$total,$usersId);
  
    $count = count($_SESSION['cart']);
    for ($i=0; $i < $count; $i++) {
      
      $size = $_POST['size'][$i];
      $quantity = $_POST['quantity'][$i];
      $productCode = $_POST['product'][$i];

      if($size !== '' && $quantity !== '' && $productCode !== '') {
        insertOrd($conn, $size, $quantity, $orderCode, $productCode);
      }
    }
    header("location: ../php/payment?order=saved&invoice=$orderCode");
    exit();
  }
}
else if(isset($_POST["update"])) {

  $orderCode = $_POST['invoice'];
  $statusId = $_POST['status'];

  updateOrder($conn,$statusId,$orderCode);
}
else if(isset($_POST["delete"])) {

  $orderCode = $_POST['invoice'];

  deleteOrder($conn,$orderCode);
}
else {
  header("location: ../php/invoice");
  exit();
}