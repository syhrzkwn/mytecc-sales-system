<?php

//get users from the database
function getUsers() {
  require '../includes/connection.inc.php';

  $sql = "SELECT * FROM users";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) > 0) {
    return $result;
  }
}

//get users join usersContact from the database
function getUsersDetails() {
  require '../includes/connection.inc.php';

  $sql = "SELECT users.usersId, users.usersName, users.usersEmail, users.usersUid,
  usersContact.phoneNum, usersContact.address, usersContact.postcode, usersContact.city,
  state.stateName, user_types.type_name
  FROM users
  JOIN usersContact ON users.usersId = usersContact.usersId
  JOIN state ON usersContact.stateId = state.stateId
  JOIN user_types ON users.user_types = user_types.type_id
  WHERE users.user_types = 2";
  $result = mysqli_query($conn, $sql);
  return $result;
}

function getUsersDetailsDashboard() {
  require '../includes/connection.inc.php';

  $sql = "SELECT users.usersId, users.usersName, users.usersEmail, users.usersUid,
  usersContact.phoneNum, usersContact.address, usersContact.postcode, usersContact.city,
  state.stateName, user_types.type_name
  FROM users
  JOIN usersContact ON users.usersId = usersContact.usersId
  JOIN state ON usersContact.stateId = state.stateId
  JOIN user_types ON users.user_types = user_types.type_id";
  $result = mysqli_query($conn, $sql);
  return $result;
}

//get users join users Account and Contact details according to userId from database 
function getUsersAccountDetails() {
  require '../includes/connection.inc.php';

  $userid = $_SESSION['userid'];

  $sql = "SELECT users.usersName, users.usersEmail, users.usersUid, users.user_types,user_types.type_name
  FROM users
  JOIN user_types ON users.user_types = user_types.type_id
  WHERE users.usersId = $userid";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) > 0) {
    return $result;
  }
}

//get users join users Account and Contact details according to userId from database 
function getUsersContactDetails() {
  require '../includes/connection.inc.php';

  $userid = $_SESSION['userid'];

  $sql = "SELECT usersContact.usersId, usersContact.phoneNum, usersContact.address, usersContact.postcode, usersContact.city,
  state.stateName
  FROM usersContact
  JOIN state ON usersContact.stateId = state.stateId
  WHERE usersContact.usersId = $userid";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) > 0) {
    return $result;
  }
}

//display users details at dashboard.php
function users($name, $type, $email, $phone) {
  $users = '
  <div class="card-body">
    <div class="customer">
      <div class="info">
        <img src="../assets/img/default-profile.jpg" width="40px" height="40px" alt="" />
        <div>
          <h4>'.$name.'</h4>
          <small>'.$type.'</small>
        </div>
      </div>
      <div class="contact">
        <a href="mailto:'.$email.'"><span class="bx bx-envelope"></span></a>
        <a href="http:///wa.me/'.$phone.'" target="_blank"><span class="bx bxl-whatsapp"></span></a>
      </div>
    </div>
  </div>
  ';
  echo $users;
}

//display users details at users.php
function dispUsersDetails($userid, $username, $name, $email, $phone, $address, $postcode, $city, $state) {
  $element = '
  <form method="post" action="../includes/delete.inc.php">
    <tbody>
      <tr style="border-bottom: 1px solid #f0f0f0;">
        <td style="padding:27px;">'.$username.'</td>
        <td>'.$name.'</td>
        <td>'.$email.'</td>
        <td>'.$phone.'</td>
        <td>'.$address.', '.$postcode.', '.$city.', '.$state.'.</td>
        <input type="hidden" name="userid" value="'.$userid.'"></input>
        <td style="text-align:center"><button type="submit" name="delete" style="border:none;background-color:#fff;"><i class="bx bx-trash" style="font-size:1.1rem;cursor:pointer;"></i></button></td>
        <td></td>
      </tr>
    </tbody>
  </form>
  ';
  echo $element;
}

//display accounts details at accounts.php
function dispAccountDetails($username,$name,$email) {
  $accounts = '
  <div class="card">
    <div class="card-header" style="border-bottom: 1px solid #f0f0f0;">
      <h3>Accounts Details</h3>
    </div>
    <div class="card-body">
      <table style="width: 100%;">
        <tr>
          <th>Username</th>
          <td>'.$username.'</td>
        </tr>  
        <tr>
          <th>Full Name</th>
          <td>'.$name.'</td>
        </tr>
        <tr>
          <th>Email</th>
          <td>'.$email.'</td>
        </tr>
      </table>
    </div>
  </div>
  ';
  echo $accounts;
}

//display contact details at accounts.php
function dispContactDetails($address,$postcode,$city,$state,$phone) {
  $contact = '
  <br>
  <div class="card">
    <div class="card-header" style="border-bottom: 1px solid #f0f0f0;">
      <h3>Contact Details</h3>
    </div>
    <div class="card-body">
      <table style="width: 100%;">            
        <tr>
          <th>Address</th>
          <td>'.$address.'</td>
        </tr>
        <tr>
          <th>Postcode</th>
          <td>'.$postcode.'</td>
        </tr>
        <tr>
          <th>City</th>
          <td>'.$city.'</td>
        </tr>
        <tr>
          <th>State</th>
          <td>'.$state.'</td>
        </tr>
        <tr>
          <th>Phone Number</th>
          <td>'.$phone.'</td>
        </tr>
      </table>
    </div>
  </div>
  ';
  echo $contact;
}
