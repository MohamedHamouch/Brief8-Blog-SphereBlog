<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "0000";
$db_name = "blogDB";
$conn = "";

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
if (mysqli_connect_errno()) {

  die("Connection failed: " . mysqli_connect_error());
}