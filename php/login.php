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
    <title>MYTECC | Log In</title>
  </head>
  <body>
    <!-- ===== HEADER ===== -->
    <header class="l-header" id="header">
      <nav class="nav bd-container">
        <div>
          <a href="../index">
            <img src="../assets/img/logo MYTECC navbar.png" alt="" class="nav__logo"/>
          </a>
        </div>

        <div class="nav__menu" id="nav-menu">
          <ul class="nav__list">
            <div class="nav__item">
              <a href="../index" class="nav__link">Home</a>
            </div>
            <div class="nav__item">
              <a href="login" class="nav__link active">Log In</a>
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
        <h1>WELCOME!</h1>
        <span>TO MYTECC ECOMMERCE SYSTEM</span>
      </div>
      <div class="login__content">
        <div class="login__img">
          <img src="../assets/img/logo MYTECC (white outline).png" alt="" />
        </div>
        <div class="login__forms">

          <!-- ===== LOG IN ===== -->
          <form action="../includes/login.inc.php" class="login__user" method="post" autocomplete="off">
            <h1 class="login__title">Log In</h1>

            <div class="login__box">
              <i class="bx bx-user login__icon"></i>
              <input
                type="text"
                placeholder="Username or Email"
                class="login__input"
                name="uid"      
              />
            </div>

            <div class="login__box">
              <i class="bx bx-lock-alt login__icon"></i>
              <input
                type="password"
                placeholder="Password"
                class="login__input"
                name="pwd"
                id="user__password"      
              />
              <span class="eyes__login" id="eyes__login">
                <i class='bx bx-hide' id="eye__hide-icon"></i>
                <i class='bx bx-show-alt' id="eye__show-icon"></i>
              </span>
            </div>

            <?php

            if(isset($_GET["newpwd"])) {
              if($_GET["newpwd"] == "passwordupdated") {
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
                      <p class="sub">Your password has been reset!</p>
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

            <a href="reset-password" class="login__forgot">Forgot Password?</a>

            <input type="submit" name="submit" class="login__button" value="Log In"></input>

            <div>
              <span class="login__account">Don't have an Account ?</span>
              <a href="signup" class="login__signup">Sign Up</a>
            </div>

            <div class="login__social">
              <a href="https://www.instagram.com/myteccpahang" target="_blank" class="login__social-icon">
                <i class="bx bxl-instagram"></i>
              </a>
              <a href="https://www.twitter.com/myteccpahang" target="_blank" class="login__social-icon">
                <i class="bx bxl-twitter"></i>
              </a>
            </div>
          </form>
        </div>
      </div>
         
      <?php

      if(isset($_GET["error"])) {
        if($_GET["error"] == "emptyinput") {
          echo'
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
                  <p class="sub">Fill all the required fields!</p>
                </div>
                <div class="icon close">
                  <i class="bx bx-x" ></i>
                </div>
              </div>
            </div>
          </div>
          ';
        }
        else if($_GET["error"] == "invalidusernameorpwd") {
          echo'
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
                  <p class="sub">Invalid Username/Email or Password!</p>
                </div>
                <div class="icon close">
                  <i class="bx bx-x" ></i>
                </div>
              </div>
            </div>
          </div>
          ';
        }
        else if($_GET["error"] == "invalidpassword") {
          echo'
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
                  <p class="sub">Invalid Password!</p>
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
         
      <footer clas="footer">
        <div class="footer__copy">&#169; 2021 MYTECC. All Rights Reserved.</div>
      <footer>
    </div>

    <!-- ===== JQUERY CDN ===== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- ===== LOGIN JS ===== -->
    <script type="text/javascript" src="../assets/js/login.js"></script>
    <script type="text/javascript" src="../assets/js/login-nav.js"></script>
    <script src="../assets/js/alert-notification.js"></script>
  </body>
</html>
