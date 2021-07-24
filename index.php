<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="assets/css/login-nav.css" />
    <link rel="stylesheet" href="assets/css/index.css" />

    <!-- ===== BOX ICONS ===== -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>

    <link rel="icon" href="assets/img/logo MYTECC (white outline).png" />
    <title>MYTECC | Home</title>
  </head>
  <body>
    <!-- ===== HEADER ===== -->
    <header class="l-header" id="header">
      <nav class="nav bd-container">
        <div>
          <a href="">
            <img src="assets/img/logo MYTECC navbar.png" alt="" class="nav__logo"/>
          </a>
        </div>

        <div class="nav__menu" id="nav-menu">
          <ul class="nav__list">
            <div class="nav__item">
              <a href="index" class="nav__link active">Home</a>
            </div>
            <div class="nav__item">
              <a href="php/login" class="nav__link">Log In</a>
            </div>
            <div class="nav__item">
              <a href="php/signup" class="nav__link">Sign Up</a>
            </div>
            <div class="nav__item">
              <a href="groupMemberCSC264.html" class="nav__link" style="color:#ff1111; font-weight:600;">Developer</a>
            </div>
          </ul>
        </div>

        <div class="nav__toggle" id="nav-toggle">
          <i class="bx bx-menu"></i>
        </div>
      </nav>
    </header>

    <main class="l-main">
      <!-- ===== HOME ===== -->
      <section class="home" id="home">
        <div class="home__container bd-container bd-grid">
          <div class="home__data">
            <span class="home-greeting">Hello, Welcome to</span>
            <h1 class="home__name">MYTECC</h1>
            <span class="home__profession">eCommerce System</span>
            <a href="php/login" class="button home__button button-light">Get Started</a>
          </div>

          <div class="home__social">
            <a href="https://www.instagram.com/myteccpahang" target="_blank" class="home__social-icon">
              <i class="bx bxl-instagram"></i>
            </a>
            <a href="https://www.twitter.com/myteccpahang" target="_blank" class="home__social-icon">
              <i class="bx bxl-twitter"></i>
            </a>
          </div>

          <div class="home__img">
            <img src="assets/img/home_img.PNG" alt="" />
          </div>
        </div>
      </section>
    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
      <div class="footer__container bd-container">
        <div>
          <img src="assets/img/Logo FSKM (white outline).png" class="footer__img fskm"></img>
          <img src="assets/img/logo MYTECC (white outline).png" class="footer__img"></img>
        </div>
        
        <p class="footer__description">"Technology is The Future of Creativity"</p>

        <p class="footer__copy">&#169; 2021 MYTECC. All right reserved.</p>
      </div>
    </footer>

    <!-- ===== JS ===== -->
    <script type="text/javascript" src="assets/js/login.js"></script>
    <script type="text/javascript" src="assets/js/login-nav.js"></script>

    <!-- ===== GSAP ===== -->
    <script src="assets/js/gsap.min.js"></script>

    <!-- ===== GSAP ANIMATION ===== -->
    <script language="JavaScript">
      gsap.from('.home__img', { opacity: 0, duration: 2, delay: .5, x: 60 })
      gsap.from('.home__data', { opacity: 0, duration: 2, delay: .5, y: 25 })
      gsap.from('.home__greeting, .home__name, .home__profession, .home__button', { opacity: 0, duration: 2, delay: 1, y: 25, ease: 'expo.out', stagger: .2 })
      gsap.from('.nav__logo, .nav__toggle', { opacity: 0, duration: 2, delay: 1.5, y: 25, ease: 'expo.out', stagger: .2 })
      gsap.from('.nav__item', { opacity: 0, duration: 2, delay: 1.8, y: 25, ease: 'expo.out', stagger: .2 })
      gsap.from('.home__social-icon', { opacity: 0, duration: 2, delay: 2.3, y: 25, ease: 'expo.out', stagger: .2 })
    </script>
  </body>
</html>