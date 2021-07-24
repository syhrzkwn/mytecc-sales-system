<?php

function headerBar($pageName) {
  if($_SESSION["usertypes"] == 1) {
    $type = "Admin";
    $search = '
    <form action="search" method="post" autocomplete="off">
      <div class="search-wrapper">
        <input type="search" name="admin-search" placeholder="Search" style="margin-left:1rem;"/>
        <button type="submit" name="submit-search" value="admin" style="border:none;cursor:pointer;background-color:#fff;"><span class="bx bx-search"></span></button>
      </div>
    </form>
    ';
  }
  else if($_SESSION["usertypes"] == 2) {
    $type = "User";
    $search = '
    <form action="search" method="post" autocomplete="off">
      <div class="search-wrapper">
        <input type="search" name="users-search" placeholder="Search" style="margin-left:1rem;"/>
        <button type="submit" name="submit-search" value="users" style="border:none;cursor:pointer;background-color:#fff;"><span class="bx bx-search"></span></button>
      </div>
    </form>
    ';
  }

  $name = $_SESSION["useruid"];

  $header = '
  <header>
    <h2 id="header-name">
      <label for="nav-toggle">
        <span class="las la-bars"></span>
      </label>

      '.$pageName.'
    </h2>

    '.$search.'

    <div class="user-wrapper">
      <img src="../assets/img/default-profile.jpg" style="width:40px;height:40px;border-radius:50%;" alt="profile picture" />
      <div>
        <h4>'.$name.'</h4>

        <small>'.$type.'</small>

      </div>
    </div>
  </header>
  
  ';
  echo $header;
}