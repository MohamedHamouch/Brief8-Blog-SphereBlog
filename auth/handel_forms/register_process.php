<?php
require '../../config_db.php';

// var_dump(value: $conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (
    isset($_POST['email']) && isset($_POST['first_name']) && isset($_POST['last_name'])
    && isset($_POST['password']) && isset($_POST['confirm_password'])
  ) {
    $email = $_POST['email'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      // var_dump($hashed_password);
      $query = "INSERT INTO Users (first_name, last_name, email, password) VALUES (?, ?, ?, ? )";
      $stmt = mysqli_prepare($conn, $query);
      mysqli_stmt_bind_param($stmt, "ssss", $fname, $lname, $email, $hashed_password);

      if (mysqli_stmt_execute($stmt)) {
        // echo "User registered successfully!";
      } else {
        echo "Error executing querry" . mysqli_stmt_error($stmt);
      }
      mysqli_stmt_close($stmt);
    } else {
      // echo "Passwords don't match";
    }
  } else {
    echo "All fields are required";
  }

  mysqli_close($conn);
}