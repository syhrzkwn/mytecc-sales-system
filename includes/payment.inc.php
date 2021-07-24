<?php
session_start();

if(isset($_POST['submit'])) {
  $file = $_FILES['file'];

  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg','jpeg','png','pdf');

  if(in_array($fileActualExt, $allowed)) {
    if($fileError === 0) {
      //file size must be < 10MB
      if($fileSize < 10485760) {
        $orderCode = $_SESSION['invoiceid'];
        $fileNameNew = $orderCode.".".$fileActualExt;
        $fileDestination = '../payments/'. $fileNameNew;

        move_uploaded_file($fileTmpName, $fileDestination); //to upload file to a specific folder
        unset($_SESSION['cart']); //to clear item in basket

        header("Location: ../php/ordersUser?paymentsuccess");
        exit();
      }
      else {
        echo"<script>window.location = '../php/payment?error=filetoobig'</script>";
      }
    }
    else {
      echo"<script>window.location = '../php/payment?error=uploading'</script>";
    }
  }
  else {
    echo"<script>window.location = '../php/payment?error=filetype'</script>";
  }
}