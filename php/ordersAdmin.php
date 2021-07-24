<?php
session_start();

$session = $_SESSION['userid'];
if (empty($session)) {
  header("Location: ../index");
  exit();
}

require_once 'header.php';
require_once '../includes/ordersFunction.inc.php';

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
    if(!empty($_GET['action'])) {
      if($_GET['action'] == 'deletesuccess') {
        echo '
        <div class="alert_wrapper active1">
          <div class="alert_backdrop"></div>
          <div class="alert_inner">
            <div class="alert_item alert_warning">
              <div class="icon data_icon">
                <i class="bx bxs-error-circle" ></i>
              </div>
              <div class="data">
                <p class="title"><span>Warning:</span>
                  User action warning
                </p>
                <p class="sub">You have successfully deleted this order!</p>
              </div>
              <div class="icon close">
                <i class="bx bx-x" ></i>
              </div>
            </div>
          </div>
        </div>
        ';
      }
    }
    ?>
    <input type="checkbox" id="nav-toggle" />
    
    <!--SIDEBAR-->
    <?php require_once 'sideBar.php'; ?>

    <div class="main-content">
      
      <!--HEADER-->
      <?php headerBar('Orders'); ?>

      <main>
        <!-- ===== ORDER LIST FOR ADMIN ===== -->
        <section class="featured__container">
          <div class="orders">
            <div class="card">
              <div class="card-header">
                <?php
                
                require '../includes/connection.inc.php';
                $sql = "SELECT COUNT('orderCode') FROM orders";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_array($result);
                echo '<h3>'.$row[0].' orders found</h3>';

                ?>
                
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table width="100%">
                    <thead>
                      <tr>
                        <td>Invoice</td>
                        <td>Customers</td>
                        <td>Address</td>
                        <td>Price</td>
                        <td>Status</td>
                        <td>Update Order</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <?php
                    
                    $result = getOrders();
                    while ($row = mysqli_fetch_assoc($result)) {
                      dispOrders($row['orderCode'], $row['usersName'], $row['address'], $row['postcode'], $row['city'], $row['stateName'], $row['orderPrice'], $row['statusName']);
                    }

                    ?>
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
