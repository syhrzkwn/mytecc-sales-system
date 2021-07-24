<?php
session_start();

$session = $_SESSION['userid'];
if (empty($session)) {
  header("Location: ../index");
  exit();
}

require_once 'header.php';
require_once 'product.php';

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

    <!-- ===== MAIN CSS FOR SHOP ===== -->
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/shop.css" />
    <link rel="stylesheet" href="../assets/css/alert-notification.css" />

    <link rel="icon" href="../assets/img/logo MYTECC (white outline).png" />
    <title>MYTECC | Shop</title>
  </head>
  <body>
    <?php
    if(isset($_GET['action'])) {
      if(($_GET['action'] == 'loginsuccess')) {
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
                  <p class="sub">You have successfully Log In.</p>
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
      <?php headerBar('Shop'); ?>

      <main>
        <!-- ===== SHOP ===== -->
        <?php

        if(isset($_POST['add'])) {
          if(isset($_SESSION['cart'])) {
      
            $item_array_id = array_column($_SESSION['cart'],'productCode');

            if(in_array($_POST['productCode'],$item_array_id)) {
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
                      <p class="sub">Product is already added in basket!</p>
                    </div>
                    <div class="icon close">
                      <i class="bx bx-x" ></i>
                    </div>
                  </div>
                </div>
              </div>
              ';
            }
            else {
              $count = count($_SESSION['cart']);
              $item_array = array(
                'productCode' => $_POST['productCode'],
                'productName' => $_POST['productName'],
                'productImg' => $_POST['productImg'],
                'productDisc' => $_POST['productDisc'],
                'price' => $_POST['price'],
                'size' => $_POST['size'],
                'quantity' => $_POST['quantity'],
              );

              $_SESSION['cart'][$count] = $item_array;
            }
      
          }
          else {
            $item_array = array(
              'productCode' => $_POST['productCode'],
              'productName' => $_POST['productName'],
              'productImg' => $_POST['productImg'],
              'productDisc' => $_POST['productDisc'],
              'price' => $_POST['price'],
              'size' => $_POST['size'],
              'quantity' => $_POST['quantity'],
            );
      
            //Create new session variable
            $_SESSION['cart'][0] = $item_array;
          }
        }
        
        echo '<a href="basket" class="basket-header">';
        echo '<i class="bx bx-basket"></i>';
          
        if(isset($_SESSION['cart'])) {
          $count = count($_SESSION['cart']);
          echo "<span id='cart_count'> $count</span>";
        }
        else {
          echo "<span id='cart_count'> 0</span>";
        }

        ?>
        </a>
        
        <section class="featured section" id="featured">
          <h2 class="section-title">MYTECC OFFICIAL MERCHANDISE</h2>
          <div class="featured__container bd-grid">

            <?php

            $result = getProduct();
            while ($row = mysqli_fetch_assoc($result)) {
              product($row['productName'], $row['price'], $row['productImg'], $row['productDisc'], $row['productCode'], $row['normalPrice']);
            }
            
            ?>

          </div>
        </section>
      </main>
    </div>

    <!-- ===== WHATSAPP WIDGET ===== -->
    <script src="https://apps.elfsight.com/p/platform.js" defer></script>
    <div class="elfsight-app-cb77e803-0fac-46dc-ab86-1d1dfd9b488c"></div>

    <!-- ===== MAIN JS ===== -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/alert-notification.js"></script>
  </body>
</html>
