<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="../assets/css/login.css" />
    <link rel="stylesheet" href="../assets/css/login-nav.css" />
    <link rel="stylesheet" href="../assets/css/alert-notification.css" />

    <!-- ===== BOX ICONS ===== -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>

    <link rel="icon" href="../assets/img/logo MYTECC (white outline).png" />
    <title>MYTECC</title>
  </head>
  <body>
    <!-- ===== HEADER ===== -->
    <header class="l-header" id="header">
      <nav class="nav bd-container">
        <div>
          <a href="login">
            <img src="../assets/img/logo MYTECC navbar.png" alt="" class="nav__logo"/>
          </a>
        </div>

        <div class="nav__menu" id="nav-menu">
          <ul class="nav__list">
            <div class="nav__item">
              <a href="../index" class="nav__link">Home</a>
            </div>
            <div class="nav__item">
              <a href="login" class="nav__link">Log In</a>
            </div>
            <div class="nav__item">
              <a href="signup" class="nav__link">Sign Up</a>
            </div>
            <div class="nav__item">
              <a href="../groupMemberCSC264.html" class="nav__link" style="color:#ff1111; font-weight:600;">Developer</a>
            </div>
          </ul>
        </div>

        <div class="nav__toggle" id="nav-toggle">
          <i class="bx bx-menu"></i>
        </div>
      </nav>
    </header>

    <div class="login">
      <div class="login__header">
        <h1>MYTECC ECOMMERCE SYSTEM</h1>
        <span>Reset Password Request</span>
      </div>
      <div class="login__content">
        <div class="login__img">
          <img src="../assets/img/logo MYTECC (white outline).png" alt="" />
        </div>
        <div class="login__forms">

          <!-- ===== RESET PASSWORD ===== -->
          <form action="../includes/reset-request.inc.php" class="reset__pwd" method="post" autocomplete="off">
            <h1 class="login__title">Reset Password</h1>

            <div>
              <span class = "reset__subtitle">An email will be send to you with instruction on how to reset your password.</span>
            </div>

            <div class="login__box">
              <i class="bx bx-at login__icon"></i>
              <input type="email" placeholder="Email" class="login__input" name="email" required/>
            </div>

            <input type="submit" name="reset-request-submit" class="login__button" value="Request"></input>

            <div>
              <span class="login__account">Back to </span>
              <a href="login" class="login__signup">Log In</a>
            </div>
          </form>

          <?php

          if(isset($_GET["reset"])) {
            if($_GET["reset"] == "success") {
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
                      <p class="sub">Check your email!</p>
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

        </div>
      </div>

      <footer clas="footer">
        <div class="footer__copy">&#169; 2021 MYTECC. All Rights Reserved.</div>
      <footer>
    </div>

      <!-- ===== LOGIN JS ===== -->
      <script type="text/javascript" src="../assets/js/login.js"></script>
      <script type="text/javascript" src="../assets/js/login-nav.js"></script>
      <script src="../assets/js/alert-notification.js"></script>
   </body>
</html>
