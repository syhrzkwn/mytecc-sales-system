<?php
session_start();
  
$session = $_SESSION['userid'];
if (empty($session)) {
  header("Location: ../index");
  exit();
}

require_once 'header.php';

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
    
    <!-- ===== MAIN CSS FOR PAYMENT ===== -->
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/shop.css" />
    <link rel="stylesheet" href="../assets/css/orders.css" />
    <link rel="stylesheet" href="../assets/css/invoice.css" />
    <link rel="stylesheet" href="../assets/css/alert-notification.css" />

    <link rel="icon" href="../assets/img/logo MYTECC (white outline).png" />
    <title>MYTECC | Payment</title>
  </head>
  <body>
    <?php
      if(!empty($_GET['action'])) {
        if($_GET['action'] == 'filetoobig') {
          echo '
          <div class="alert_wrapper active1">
          <div class="alert_backdrop"></div>
          <div class="alert_inner">
            <div class="alert_item alert_error">
              <div class="icon data_icon">
              <i class="bx bxs-x-circle" ></i>
              </div>
              <div class="data">
                <p class="title"><span>Error:</span>
                  User action error
                </p>
                <p class="sub">This file is too big!</p>
              </div>
              <div class="icon close">
                <i class="bx bx-x" ></i>
              </div>
            </div>
          </div>
        </div>
          ';
        }
        else if($_GET['action'] == 'uploading') {
          echo '
          <div class="alert_wrapper active1">
          <div class="alert_backdrop"></div>
          <div class="alert_inner">
            <div class="alert_item alert_error">
              <div class="icon data_icon">
              <i class="bx bxs-x-circle" ></i>
              </div>
              <div class="data">
                <p class="title"><span>Error:</span>
                  User action error
                </p>
                <p class="sub">There was an error uploading this file!</p>
              </div>
              <div class="icon close">
                <i class="bx bx-x" ></i>
              </div>
            </div>
          </div>
        </div>
          ';
        }
        else if($_GET['action'] == 'filetype') {
          echo '
          <div class="alert_wrapper active1">
          <div class="alert_backdrop"></div>
          <div class="alert_inner">
            <div class="alert_item alert_error">
              <div class="icon data_icon">
              <i class="bx bxs-x-circle" ></i>
              </div>
              <div class="data">
                <p class="title"><span>Error:</span>
                  User action error
                </p>
                <p class="sub">Cannot upload file of this type!</p>
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
    
    <!-- ===== SIDEBAR ===== -->
    <?php require_once 'sideBar.php'; ?>

    <div class="main-content">
      
      <!-- ===== HEADER ===== -->
      <?php headerBar('Payment'); ?>

      <main>
        <!-- ===== PAYMENT ===== -->
        <section class="featured section">
          <h2 class="section-title1">
            <span style="color: #ff1111;">BASKET <i class='bx bxs-right-arrow'></i> INVOICE <i class='bx bxs-right-arrow'></i> PAYMENT</span>
          </h2>
        </section>
        <section class="featured__container bd-grid">
          <div class="orders">
            <div class="card">
              <div class="card-header">
                <h3>PROVE OF PAYMENT - <span><?php echo $_SESSION['invoiceid'];?></span></h3>
              </div>
              <div class="card-body">
                <form action="../includes/payment.inc.php" method="post" enctype="multipart/form-data">
                  <table>
                    <tr>
                      <td><p style="font-weight:500;color:gray;">Transfer to: <br>MYTECC CLUB<br>7072119000 CIMB Bank</p></td>
                    </tr>
                    <tr>
                      <td style="padding:20px;">
                        <input type="file" name="file">
                      </td>
                      <td><button type="submit" name="submit" class="inv-btn"><i class='bx bx-upload'></i> Upload</button></td>
                    </tr>
                    <tr>
                      <td><small style="font-weight:500;color:gray;">File type: .jpg, .jpeg, .png, & .pdf only & max 10MB</small></td>
                    </tr>
                  </table>
                </form>
              </div>
            </div>
          </div>
        </section>
          <!--
          <iframe style="width:100%;margin-left:auto;margin-right:auto;" src="https://docs.google.com/forms/d/e/1FAIpQLSc7Qkgwse_I62QgsLIbKiI3v8P6a8A6T-oJXmPO0yrRSMuSAw/viewform?embedded=true" width="700" height="500" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
          -->
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
  </body>
</html>