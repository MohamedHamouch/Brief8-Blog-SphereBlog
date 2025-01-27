<?php
require '../config_db.php';

$sql = "SELECT users.id, first_name, last_name, email, role_name
    FROM users JOIN roles
    ON role_id = roles.id";

$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT title, publish_date, first_name, last_name
      FROM articles JOIN users
      ON user_id = users.id";

$result = mysqli_query($conn, $sql);
$articles = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT title, first_name, last_name, comment_date
    FROM Comments
    JOIN Articles ON Comments.article_id = Articles.id
    JOIN Users ON Comments.user_id = Users.id;";

$result = mysqli_query($conn, $sql);
$comments = mysqli_fetch_all($result, MYSQLI_ASSOC);