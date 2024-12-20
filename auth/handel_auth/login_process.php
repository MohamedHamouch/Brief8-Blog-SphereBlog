<?php
session_start();
require '../../config_db.php';

if (isset($_SESSION['user_id']) || isset($_SESSION['role'])) {
  header("Location: ../../index.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM Users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
      if (password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['role'] = $user['role_id'];
        $_SESSION['email'] = $user['email'];

        header("Location: ../../index.php");
      } else {
        // echo "Invalid password.";
        $_SESSION['login_error'] = "Invalid password.";
      }

    } else {
      // echo "No user found with that email.";
      $_SESSION['login_error'] = "No user found with that email.";

    }
  }
  header("location: ../login.php");
  mysqli_close($conn);
}