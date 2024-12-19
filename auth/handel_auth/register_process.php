<?php
session_start();
require '../../config_db.php';

if (isset($_SESSION['user_id']) || isset($_SESSION['role'])) {
  header("Location: ../../index.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (
    isset($_POST['email']) && isset($_POST['first_name']) && isset($_POST['last_name'])
    && isset($_POST['password']) && isset($_POST['confirm_password'])
  ) {
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $query = "INSERT INTO Users (first_name, last_name, email, password, role_id) VALUES (?, ?, ?, ?, ?)";
      $stmt = mysqli_prepare($conn, $query);
      $role_id = 2;
      mysqli_stmt_bind_param($stmt, "ssssi", $first_name, $last_name, $email, $hashed_password, $role_id);


      if (mysqli_stmt_execute($stmt)) {
        $query = "SELECT * FROM Users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['role'] = $role_id;
        $_SESSION['email'] = $email;
        // echo "User registered successfully!";
      } else {
        // echo "Error executing querry" . mysqli_stmt_error(statement: $stmt);
        $_SESSION['register_error'] = "email already used";

      }
      mysqli_stmt_close($stmt);
      header("location: ../../index.php");
    } else {
      // echo "Passwords don't match";
      $_SESSION['register_error'] = "Passwords don't match";
    }
  } else {
    // echo "All fields are required";
    $_SESSION['register_error'] = "All fields are required";
  }
  header("location: ../register.php");
  mysqli_close($conn);
}