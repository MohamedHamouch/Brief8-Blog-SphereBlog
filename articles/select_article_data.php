<?php
require '../config_db.php';
session_start();

if (isset($_GET['article'])) {
  $article_id = $_GET['article'];
  $stmt = mysqli_prepare($conn, "SELECT * FROM articles WHERE id = ?");
  mysqli_stmt_bind_param($stmt, 'i', $article_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($result) {
    $article = mysqli_fetch_assoc($result);
    if (!$article) {
      $found = false;
    } else {
      $found = true;

      $name_result = mysqli_query($conn, "SELECT * FROM users WHERE id = {$article["user_id"]}");
      $publisher = mysqli_fetch_assoc($name_result);

      $tags_query = "SELECT tags.name FROM tags 
             JOIN article_tag ON tags.id = article_tag.tag_id 
             WHERE article_tag.article_id = $article_id";

      $tags_result = mysqli_query($conn, $tags_query);
      $tags = mysqli_fetch_all($tags_result, MYSQLI_ASSOC);

      $comments_query = "SELECT * FROM users
                      JOIN comments ON users.id = comments.user_id
                      WHERE comments.article_id = {$article["id"]}";

      $comments_result = mysqli_query($conn, $comments_query);
      $comments = mysqli_fetch_all($comments_result, MYSQLI_ASSOC);
    }
  } else {
    header('Location: ../index.php');
    exit();
  }

  if (isset($_SESSION['user_id']) && isset($_SESSION['email'])) {
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $role = ($_SESSION['role'] == 2) ? 'user' : 'admin';
    $connected = true;
  } else {
    $connected = false;
  }
} else {
  header('Location: ../index.php');
  exit();
}
?>