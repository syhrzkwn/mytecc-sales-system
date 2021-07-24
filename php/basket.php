<?php
session_start();
  
$session = $_SESSION['userid'];
if (empty($session)) {
  header("Location: ../index");
  exit();
}

require_once 'header.php';
require_once 'product.php';

if(isset($_POST['remove'])) {
  if($_GET['action'] == 'remove') {
    foreach($_SESSION['cart'] as $key => $value) {
      if($value['productCode'] == $_GET['id']) {
        unset($_SESSION['cart'][$key]);
        echo"<script>window.location = 'basket?productremoved'</script>";
      }
    }
  }
}

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
    <link rel="stylesheet" href="../assets/css/basket.css" />
    <link rel="stylesheet" href="../assets/css/alert-notification.css" />

    <link rel="icon" href="../assets/img/logo MYTECC (white outline).png" />
    <title>MYTECC | Basket</title>
  </head>
  <body>
    <?php
    if(isset($_GET['productremoved'])) {
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
                <p class="sub">Product has been removed!</p>
              </div>
              <div class="icon close">
                <i class="bx bx-x" ></i>
              </div>
            </div>
          </div>
        </div>
      ';
    }
    else if (isset($_GET['alertupdateaccount'])) {
      echo '
        <div class="alert_wrapper active1">
          <div class="alert_backdrop"></div>
          <div class="alert_inner">
            <div class="alert_item alert_info">
              <div class="icon data_icon">
                <i class="bx bxs-info-circle" ></i>
              </div>
              <div class="data">
                <p class="title"><span>Info:</span>
                  User action pending
                </p>
                <p class="sub">Please update your contact details on Accounts page first before performing any order!</p>
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
    
    <!-- ===== SIDEBAR ===== -->
    <?php require_once 'sideBar.php'; ?>

    <div class="main-content">
      
      <!-- ===== HEADER ===== -->
      <?php headerBar('Basket'); ?>

      <main>
        <!-- ===== BASKET ===== -->
        <section class="featured section" id="featured">
          <h2 class="section-title">
            <span style="color: #ff1111;">BASKET <i class="bx bxs-right-arrow"></i></span> INVOICE <i class="bx bxs-right-arrow"></i> PAYMENT
          </h2>
          <div class="wrapper">
            <div class="wrapper_content">
              <div class="header_title">
                <div class="title">
                  MY SHOPPING BASKET :
                </div>
                <div class="amount">
                  <?php
                  if(isset($_SESSION['cart'])) {
                    $count = count($_SESSION['cart']);
                    echo '<b>( '.$count.' ) ITEMS</b>';
                  }
                  else {
                    echo '<b>( 0 ) ITEMS</b>';
                  }
                  ?>
                </div>
              </div>

              <?php

              $total = 0;
              if(!empty($_SESSION['cart'])) {
                foreach($_SESSION['cart'] as $keys => $value) {
                  cartElement($value['productImg'],$value['productName'],$value['productDisc'],$value['price'],$value['productCode'],$value['size'],$value['quantity']);
                  $total = $total + ($value['price'] * $value['quantity']);
                }
              }
              else {
                echo '<div style="text-align: center;margin-top: 5rem;margin-bottom: 5rem">';
                echo '<p>You have no item(s) in basket!</p>';
                echo '<p>Back to <strong><a href="shop" style="color: #ff1111">Shop</a></strong></p>';
                echo '</div>';
              }

              ?>
              
            </div>

            <div class="wrapper_amount">
              <div class="header_title">
                <div class="title">
                  TOTAL PRICE DETAILS :
                </div>
                <div class="amount">
                  <b>RM<?php echo number_format($total+5,2) ?></b> 
                </div>
              </div>
              <div class="price_details">
                <div class="item">
                  <p>Subtotal :</p>
                  <p>RM<?php echo number_format($total,2) ?></p>
                </div>    
                <div class="item">
                  <p>Delivery fee :</p>
                  <p><span>RM5.00</span><!--<span class="green">FREE</span></p>-->
                </div>
                <div class="total">
                  <p>Total :</p>
                  <p>RM<?php echo number_format($total+5,2) ?></p>
                </div>
              </div>
              <div class="checkout">
                <?php
                echo '<a href="invoice" type="button" class="checkout_btn">Place Order</a>';
                ?>
              </div>
              <br>
              <div class="disclaimer">
                <small>1. We will be delivered your order to the address that you have saved on Accounts.</small><br>
                <small>2. If you do not update your address in Accounts, kindly do it first before placing any order.</small><br>
                <small>3. Terms & Conditions apply.</small>
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
    <script src="../assets/js/basket-jquery.js"></script>
    <script src="../assets/js/alert-notification.js"></script>
  </body>
</html>