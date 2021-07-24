<?php
session_start();

$session = $_SESSION['userid'];
if (empty($session)) {
  header("Location: ../index");
  exit();
}

require_once 'header.php';
require_once '../includes/connection.inc.php';
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

    <!-- ===== MAIN CSS ===== -->
    <link rel="stylesheet" href="../assets/css/main.css" />

    <link rel="icon" href="../assets/img/logo MYTECC (white outline).png" />
    <title>MYTECC | Search</title>
  </head>
  <body>
    <input type="checkbox" id="nav-toggle" />

    <!--SIDEBAR-->
    <?php require_once 'sideBar.php'; ?>

    <div class="main-content">
      
      <!--HEADER-->
      <?php headerBar('Search'); ?>

      <main>
        <div class="search-container">
          <?php
          if(isset($_POST['submit-search'])) {
            if($_POST['submit-search'] == 'admin') {
              $search = mysqli_real_escape_string($conn, $_POST['admin-search']);
              $sql = "SELECT usersName, usersUid, usersEmail
              FROM users
              WHERE usersName LIKE '%$search%' OR usersUid LIKE '%$search%' OR usersEmail LIKE '%$search%'";
              $result = mysqli_query($conn, $sql);
              $queryResult = mysqli_num_rows($result);

              echo '<p>There are '.$queryResult.' result founds<p><br>';

              if($queryResult > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                  echo '
                  <div class="search-box">
                    <h3>Users Details:</h3>
                    <a href="users">
                      <p>Username : '.$row['usersUid'].'</p>
                      <p>Full Name : '.$row['usersName'].'</p>
                      <p>Email : '.$row['usersEmail'].'</p>
                    </a>
                  </div>
                  ';
                }
              }
              else {
                echo "<br>";
                echo "There is no result matching your search!";
              }
            }
            else if($_POST['submit-search'] == 'users') {
              $search = mysqli_real_escape_string($conn, $_POST['users-search']);
              $sql = "SELECT * FROM product
              WHERE productName LIKE '%$search%' OR price LIKE '%$search%' OR productCode LIKE '%$search%' OR productDisc LIKE '%$search%'";
              $result = mysqli_query($conn, $sql);
              $queryResult = mysqli_num_rows($result);
              
              echo '<p>There are '.$queryResult.' result founds</p><br>';

              if($queryResult > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                  echo '
                  <div class="search-box">
                    <h3>Product Details:</h3>
                    <a href="shop">
                      <p>Product Code : '.$row['productCode'].'</p>
                      <p>Product Name : '.$row['productName'].'</p>
                      <p>Discription : '.$row['productDisc'].'</p>
                      <p>Price : RM'.$row['price'].'</p>
                    </a>
                  </div>
                  ';
                }
              }
              else {
                echo "<br>";
                echo "There is no result matching your search!";
              }
            }
          }
          ?>
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
  </body>
</html>
