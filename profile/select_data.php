<?php
require '../config_db.php';

// $query = "SELECT * FROM users WHERE id = {$_SESSION['user_id']}";
// $result = mysqli_query($conn, $query);
// $user = mysqli_fetch_assoc($result);

$query = "SELECT * FROM tags";
$result = mysqli_query($conn, $query);
$tags = mysqli_fetch_all($result, MYSQLI_ASSOC);


