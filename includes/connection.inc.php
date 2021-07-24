<?php

$dbuser = "root";
$dbpass = "";
$dbhost = "localhost";
$dbname = "mytecc_sales_system";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$conn) {
  die("Connection Failed:".mysqli_connect_error());
}