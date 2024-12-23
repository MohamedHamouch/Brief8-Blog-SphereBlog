<?php
require '../config_db.php';

$sql = "SELECT users.id, first_name, last_name, email, role_name
    FROM users JOIN roles
    ON role_id = roles.id";

$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);