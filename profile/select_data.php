<?php
require '../config_db.php';

$query = "SELECT title, publish_date
        FROM articles 
        JOIN users ON articles.user_id = users.id
        WHERE articles.user_id = {$_SESSION['user_id']}";

$result = mysqli_query($conn, $query);
$articles = mysqli_fetch_all($result, MYSQLI_ASSOC);

$query = "SELECT title, comment_date 
        FROM comments
        JOIN articles ON articles.id = comments.article_id
        WHERE comments.user_id = {$_SESSION['user_id']}";

$result = mysqli_query($conn, $query);
$comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

$query = "SELECT * FROM tags";
$result = mysqli_query($conn, $query);
$tags = mysqli_fetch_all($result, MYSQLI_ASSOC);


