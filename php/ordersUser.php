<?php
session_start();

$session = $_SESSION['userid'];
if (empty($session)) {
  header("Location: ../index");
  exit();
}

require_once 'header.php';
require_once '../includes/connection.inc.php';
require_once '../includes/ordersFunction.inc.php';

$usersId = $_SESSION['userid'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0" />

    <!-- ===== LINE AWESOME ICONS ===== -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css"/>

    <!-- ===== BOX ICONS ===== -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    
    <!-- ===== MAIN CSS FOR ORDERS ADMIN ===== -->
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/shop.css" />
    <link rel="stylesheet" href="../assets/css/orders.css" />
    <link rel="stylesheet" href="../assets/css/alert-notification.css" />

    <link rel="icon" href="../assets/img/logo MYTECC (white outline).png" />
    <title>MYTECC | Orders</title>
  </head>
  <body>
    <?php
    if(isset($_GET['paymentsuccess'])) {
      echo '
        <div class="alert_wrapper active1">
          <div class="alert_backdrop"></div>
          <div class="alert_inner">
            <div class="alert_item alert_success">
              <div class="icon data_icon">
                <i class="bx bxs-check-circle" ></i>
              </div>
              <div class="data">
                <p class="title"><span>Success:</span>
                  User action success
                </p>
                <p class="sub">Your payment is under review, and we will update your order status in Orders section ASAP. Thank You!</p>
              </div>
              <div class="icon close">
                <i class="bx bx-x" ></i>
              </div>
            </div>
          </div>
        </div>
      ';
    }
    ?>
    <input type="checkbox" id="nav-toggle" />
    
    <!--SIDEBAR-->
    <?php require_once 'sideBar.php'; ?>

    <div class="main-content">
      
      <!--HEADER-->
      <?php headerBar('Orders'); ?>

      <main>
        <!-- ===== ORDER LIST FOR USER ===== -->
        <section class="featured__container bd-grid">
          <div class="orders">
            <div class="card">
              <div class="card-header">
                <?php
                
                $sql = "SELECT COUNT('ordId') FROM ord
                JOIN orders ON orders.orderCode = ord.orderCode
                JOIN users ON users.usersId = orders.usersId
                WHERE users.usersId = '$usersId';";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_array($result);
                if(!empty($row)) {
                  echo '<h3>'.$row[0].' item(s)</h3>';
                }
                else {
                  echo '<h3>0 item(s)</h3>';
                }
                
                $sql = "SELECT SUM(orderPrice) FROM orders WHERE usersId = '$usersId'";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_array($result);
                if(!empty($row)) {
                  echo '<h3>Total RM'.$row[0].'</h3>';
                }
                else {
                  echo '<h3>Total RM0</h3>';
                }
                

                ?>
                
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table width="100%">
                    <thead>
                      <tr style="text-align:center;">
                        <td>Invoice</td>
                        <td>Product</td>
                        <td>Name</td>
                        <td>Size</td>
                        <td>Quantity</td>
                        <td>Price</td>
                        <td>Date Order</td>
                        <td>Status</td>
                        <td></td>
                      </tr>
                    </thead>
                    <tbody style="text-align:center;">
                    <?php
                    $sql = "SELECT orderCode FROM orders WHERE usersId = '$usersId'";
                    $result = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_array($result);
                    if(!empty($row)) {
                      $result = getOrdersUser($conn,$usersId);
                      while($row = mysqli_fetch_assoc($result)) {
                      ?>
                      
                        <tr style="border-bottom: 1px solid #f0f0f0;">
                          <form method="post" action="invoice-users">
                            <td><input type="hidden" name="invoice" value="<?php echo $row['orderCode']?>"><button type="submit" name="submit" style="width:100%;border:none;font-weight:500;cursor:pointer;background-color:#fff;"><?php echo $row['orderCode']?></button></input></td>
                          </form>
                          <td><img src="<?php echo $row['productImg']?>" style="width:auto;height:180px;"></img></td>
                          <td><?php echo $row['productName']?></td>
                          <td><?php echo $row['size']?></td>
                          <td><?php echo $row['quantity']?></td>
                          <td>RM<?php echo $row['price']?></td>
                          <td><?php echo $row['orderDate']?></td>
                          <?php
                          if($row['statusName'] == 'pending') {
                            echo '<td><span style="color:#ffbb33;font-weight:500;">pending<span></td>';
                          }
                          else if($row['statusName'] == 'processing') {
                            echo '<td><span style="color:#33b5e5;font-weight:500;">processing<span></td>';
                          }
                          else if($row['statusName'] == 'delivered') {
                            echo '<td><span style="color:#00c851;font-weight:500;">delivered<span></td>';
                          }
                          else if($row['statusName'] == 'failed') {
                            echo '<td><span style="color:#eb6060;font-weight:500;">failed<span></td>';
                          }?>
                          <td></td>
                        </tr>
                      <?php }?>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Delivery Fee :</td>
                        <td>+ RM5.00</td>
                        <td></td>
                      </tr><?php
                    }
                    else {
                      ?>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>No Orders</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <?php
                    }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>
      </main>
    </div>

    <!-- ===== JQUERY CDN ===== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <!-- ===== WHATSAPP WIDGET ===== -->
    <script src="https://apps.elfsight.com/p/platform.js" defer></script>
    <div class="elfsight-app-cb77e803-0fac-46dc-ab86-1d1dfd9b488c"></div>
    
    <!-- ===== MAIN JS ===== -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/alert-notification.js"></script>
  </body>
</html>
