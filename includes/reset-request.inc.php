<?php

if (isset($_POST["reset-request-submit"])) {

  $selector = bin2hex(random_bytes(8));
  $token = random_bytes(32);

  $url = "http://localhost/MYTECC_SALES_SYSTEM/php/create-new-password?selector=" . $selector . "&validator=" . bin2hex($token);

  $expires = date("U") + 1800;

  require 'connection.inc.php';

  $userEmail = $_POST["email"];

  $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    echo "There was an error!";
    exit();
  }
  else {
    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_execute($stmt);
  }

  $sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)) {
    echo "There was an error!";
    exit();
  }
  else {
    $hashedToken = password_hash($token, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
    mysqli_stmt_execute($stmt);
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conn);

  require_once('../PHPMailer/PHPMailerAutoload.php');

  $to = $userEmail;

  $message = '<p>We received a password reset request. The link to reset your password is below. If you do not make this request, you can ignore this email.</p>';
  $message .= '<p>Here is your password reset link: </br>';
  $message .= '<a href="'. $url .'">' . $url . '</a></p>';

  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'tls1.3';
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = '587';
  $mail->isHTML();
  $mail->Username = 'myteccsystem@gmail.com';
  $mail->Password = 'mytecc2021*';
  $mail->SetFrom('myteccsystem@gmail.com');
  $mail->Subject = 'MYTECC Reset Your Password';
  $mail->Body = $message;
  $mail->AddAddress($to);

  $mail->Send();
   
  header("location: ../php/reset-password?reset=success");
}
else {
  header("location: ../php/reset-password");
  exit();
}