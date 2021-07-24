<?php
session_start();

$session = $_SESSION['userid'];
if (empty($session)) {
  header("Location: ../index");
  exit();
}

require_once '../includes/connection.inc.php';
require_once 'usersFunction.php';
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

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/accounts.css" />
    <link rel="stylesheet" href="../assets/css/alert-notification.css" />

    <link rel="icon" href="../assets/img/logo MYTECC (white outline).png" />
    <title>MYTECC | Accounts</title>
  </head>
  <body>
    <?php
    if(isset($_GET['action'])) {
      if($_GET['action'] == 'insertsuccess') {
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
                  <p class="sub">Your contact details is successfully inserted!</p>
                </div>
                <div class="icon close">
                  <i class="bx bx-x" ></i>
                </div>
              </div>
            </div>
          </div>
        ';
      }
      else if($_GET['action'] == 'updatesuccess') {
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
                  <p class="sub">Your contact details is successfully updated!</p>
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
      <?php headerBar('Accounts'); ?>

      <main>
        <?php
        $name = $_SESSION['username'];
        echo '
        <div class="card-header">
          <h3>Hello, '.$name.'</h3>
        </div>';
        ?>
        <div class="recent-grid">
          <div class="orders">
            <form class="card" action="../includes/insert-update-contact.inc.php" method="post" autocomplete="off">
              <div class="card-header">
                <h3>Contact Details</h3><br>

                <div>
                  <?php
                  $result = getUsersContactDetails();
                  if($result == null) {
                    echo '<button type="submit" name="submit" value="insert">Update<span class="bx bx-right-arrow-alt"></span></button>';
                  }
                  else {
                    echo '<button type="submit" name="submit" value="update">Update<span class="bx bx-right-arrow-alt"></span></button>';
                  }
                  ?>
                </div>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  <div>
                    <div style="margin-top:1rem;">
                      <div>
                        <i class="bx bx-map-pin contact-icon"></i>
                        <input type="text" placeholder="Address" name="address" class="text-box" style="width:67%;" required>
                      </div>
                      <div style="margin-left: 43px;">
                        <input type="number" placeholder="Postcode" name="postcode" class="text-box" required>
                        <input type="text" placeholder="City" name="city" class="text-box" required>
                        <select name="state" id="state" class="text-box" required>
                          <option value="17">Choose State</option>
                          <option value="1">Johor</option>
                          <option value="2">Kedah</option>
                          <option value="3">Kelantan</option>
                          <option value="4">Melaka</option>
                          <option value="5">Negeri Sembilan</option>
                          <option value="6">Pahang</option>
                          <option value="7">Penang</option>
                          <option value="8">Perak</option>
                          <option value="9">Perlis</option>
                          <option value="10">Selangor</option>
                          <option value="11">Terengganu</option>
                          <option value="12">Sabah</option>
                          <option value="13">Sarawak</option>
                          <option value="14">Kuala Lumpur</option>
                          <option value="15">Labuan</option>
                          <option value="16">Putrajaya</option>
                        </select>
                      </div>
                    </div>
                    <br>
                    <div>
                      <i class="bx bx-phone contact-icon"></i>
                      <input type="text" placeholder="Phone Number" name="phone" class="text-box" required>
                    </div>
                    
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="customers">
            
            <?php

            $result1 = getUsersAccountDetails();
            while ($row1 = mysqli_fetch_assoc($result1)) {
              dispAccountDetails($row1['usersUid'], $row1['usersName'], $row1['usersEmail']);
            }

            //get result from function getUsersContactDetails
            if($result != null) {
              while ($row = mysqli_fetch_assoc($result)) {
                dispContactDetails($row['address'], $row['postcode'], $row['city'], $row['stateName'], $row['phoneNum']);
              }
            }
            else {
              dispContactDetails('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
            }
            
            ?>

          </div>
        </div>
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
