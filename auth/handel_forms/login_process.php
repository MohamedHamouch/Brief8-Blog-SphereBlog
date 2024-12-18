<?php
session_start();

require '../../config_db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM Users WHERE email = ?";

    $stmt = mysqli_prepare($conn, $query);

    //   if ($stmt === false) {
    //     die("Error preparing the query: " . mysqli_error($conn));
    // }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
      if (password_verify($password, $user['password'])) {
        echo "Login successful! Welcome " . $user['first_name'] . " " . $user['last_name'];
      } else {
        echo "Invalid password.";
      }

    } else {
      echo "No user found with that email.";
    }
  }

}