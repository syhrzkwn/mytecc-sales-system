<?php

function getOrders() {
  require '../includes/connection.inc.php';

  $sql = "SELECT orders.orderCode, orders.orderPrice,
  users.usersName, usersContact.address, usersContact.postcode, usersContact.city,
  status.statusName,
  state.stateName
  FROM orders
  JOIN users ON users.usersId = orders.usersId
  JOIN usersContact ON users.usersId = usersContact.usersId
  JOIN state ON usersContact.stateId = state.stateId
  JOIN status ON orders.statusId = status.statusId";
  $result = mysqli_query($conn, $sql);
  return $result;
}

function getOrdersDashboard() {
  require '../includes/connection.inc.php';

  $sql = "SELECT ord.quantity, ord.size, product.productName, users.usersName, status.statusName
  FROM orders
  JOIN ord ON ord.orderCode = orders.orderCode
  JOIN product ON product.productCode = ord.productCode
  JOIN users ON users.usersId = orders.usersId
  JOIN status ON status.statusId = orders.statusId
  ORDER BY orders.orderDate DESC";
  $result = mysqli_query($conn, $sql);
  return $result;
}

function dispOrders($orderCode,$usersName,$address,$postcode,$city,$state,$price,$status) {
  $color = '';
  if($status == 'pending') {
    $color = 'color:#ffbb33';
  }
  else if($status == 'processing') {
    $color = 'color:#33b5e5';
  }
  else if($status == 'delivered') {
    $color = 'color:#00c851';
  }
  else if($status == 'failed') {
    $color = 'color:#eb6060';
  }

  $element = '
  <tbody>
    <tr style="border-bottom: 1px solid #f0f0f0;">
      <form method="post" action="../php/invoice-users">
        <td><input type="hidden" name="invoice" value="'.$orderCode.'"><button type="submit" name="submit" style="width:100%;border:none;font-weight:500;cursor:pointer;background-color:#fff;">'.$orderCode.'</button></input></td>
        <td>'.$usersName.'</td>
        <td>'.$address.', '.$postcode.', '.$city.', '.$state.'</td>
        <td>RM'.$price.'</td>
        <td style="'.$color.';font-weight:600;">'.$status.'</td>
      </form>
      <form action="../includes/orders.inc.php" method="post">
        <td style="margin-top:1rem;width:16%;">  
          <select name="status" class="text-box">
            <option value="1">pending</option>  
            <option value="4">failed</option>  
            <option value="2">processing</option>  
            <option value="3">delivered</option> 
          <select>
          <input type="hidden" name="invoice" value="'.$orderCode.'">
          <button type="submit" name="update" class="inv-btn">update</button>
        </td>
        <td style="padding:30px;">
          <button type="submit" name="delete" style="border:none;background-color:#fff;"><i class="bx bx-trash" style="font-size:1.1rem;cursor:pointer;"></i></button>
        </td>
      </form>
    </tr>
  </tbody>
  ';
  echo $element;
}

function dispOrdersDashboard($productName,$size,$quantity,$usersName,$status) {
  $color = '';
  if($status == 'pending') {
    $color = 'color:#ffbb33';
    $colors = 'orange';
  }
  else if($status == 'processing') {
    $color = 'color:#33b5e5';
    $colors = 'blue';
  }
  else if($status == 'delivered') {
    $color = 'color:#00c851';
    $colors = 'green';
  }
  else if($status == 'failed') {
    $color = 'color:#eb6060';
    $colors = 'red';
  }
  
  $element = '

  <tbody>
    <tr>
      <td>'.$productName.'</td>
      <td style="text-align:center;">'.$size.'</td>
      <td style="text-align:center;">'.$quantity.'</td>
      <td>'.$usersName.'</td>
      <td style="'.$color.';font-weight:600;"><span class="status '.$colors.'"></span>'.$status.'</td>
    </tr>
  </tbody>

  ';
  echo $element;
}

function getInvoiceUsersDetails($conn,$orderCode) {
  $sql = "SELECT orders.orderCode, orders.orderDate, orders.orderTime, orders.orderPrice,
  users.usersName, users.usersEmail,
  usersContact.phoneNum, usersContact.address, usersContact.postcode, usersContact.city, state.stateName
  FROM orders
  JOIN users ON users.usersId = orders.usersId
  JOIN usersContact ON usersContact.usersId = users.usersId
  JOIN state ON state.stateId = usersContact.stateId
  WHERE orders.orderCode = '$orderCode';";
  $result = mysqli_query($conn, $sql);
  return $result;
}

function getInvoiceOrderDetails($conn,$orderCode) {
  $sql = "SELECT product.productName, product.price, ord.size, ord.quantity
  FROM ord
  JOIN orders ON orders.orderCode = ord.orderCode
  JOIN product ON product.productCode = ord.productCode
  WHERE orders.orderCode = '$orderCode';";
  $result = mysqli_query($conn, $sql);
  return $result;
}

function updateOrder($conn,$statusId,$orderCode) {
  $sql = "UPDATE orders SET statusId=? WHERE orderCode =?;";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../php/ordersAdmin?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $statusId,$orderCode);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../php/ordersAdmin?action=updatesuccess");
  exit();
}

function getOrdersUser($conn,$usersId) {
  $sql = "SELECT product.productImg, product.productName, product.price,
  ord.size, ord.quantity, orders.orderDate, ord.orderCode, status.statusName
  FROM ord
  JOIN product ON product.productCode = ord.productCode
  JOIN orders ON orders.orderCode = ord.orderCode
  JOIN status ON status.statusId = orders.statusId
  JOIN users ON users.usersId = orders.usersId
  WHERE users.usersId = '$usersId';";
  $result = mysqli_query($conn, $sql);
  return $result;
}

function deleteOrder($conn,$orderCode) {
  $sql = "DELETE FROM orders WHERE orderCode = ?";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../php/ordersAdmin?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $orderCode);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../php/ordersAdmin?action=deletesuccess");
  exit();
}