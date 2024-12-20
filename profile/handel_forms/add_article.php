<?php
session_start();
require "../../config_db.php";

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
  header("Location: ../../index.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $user_id = $_SESSION['user_id'];
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  $content = mysqli_real_escape_string($conn, $_POST['content']);
  $tags = $_POST['tags'];
  $image = $_FILES['image'];

  if ($image['size'] > 5 * 1024 * 1024) {
    $_SESSION['upload_error'] = 'Image size exceeds 5MB.';
    header("Location: ../profile.php");
    exit();
  }

  $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
  if (!in_array($image['type'], $allowed_types)) {
    $_SESSION['upload_error'] = 'Only JPEG, PNG, and GIF formats are allowed.';
    header("Location: ../profile.php");
    exit();
  }

  $imageName = $image['name'];
  $imageTmpName = $image['tmp_name'];
  $imageDestination = "../../uploads/" . $imageName;

  if (!move_uploaded_file($imageTmpName, $imageDestination)) {
    $_SESSION['upload_error'] = 'Failed to move the uploaded file.';
    header("Location: ../profile.php");
    exit();
  }

  $stmt = mysqli_prepare($conn, "INSERT INTO articles (user_id, title, description, content, image) VALUES (?, ?, ?, ?, ?)");
  mysqli_stmt_bind_param($stmt, "issss", $user_id, $title, $description, $content, $imageName);

  if (mysqli_stmt_execute($stmt)) {
    $article_id = mysqli_insert_id($conn);

    if (!empty($tags)) {
      $stmt = mysqli_prepare($conn, "INSERT INTO article_tag (article_id, tag_id) VALUES (?, ?)");
      foreach ($tags as $tag_id) {
        mysqli_stmt_bind_param($stmt, "ii", $article_id, $tag_id);
        mysqli_stmt_execute($stmt);
      }
    }

    $_SESSION['success_message'] = 'Article has been successfully posted!';
    header("Location: ../profile.php");
    exit();
  } else {
    $_SESSION['upload_error'] = 'Failed to insert the article into the database.';
    header("Location: ../profile.php");
    exit();
  }
}
