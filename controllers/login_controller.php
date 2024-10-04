<?php

require_once('../database.php');

$username = $_POST['username'];
$password = $_POST['password'];
$dbname = database::get_db_name();

$db = database::connect($dbname);

$sql = "SELECT id,username FROM users WHERE username='$username' and password=SHA1('$password')";

$cursor = $db->query($sql);
$result = $cursor->fetch_all(MYSQLI_ASSOC);

if(count($result) > 0) {
    session_start();
    $_SESSION['is_logged_in'] = 1;
    $_SESSION['user_id'] = $result[0]['id'];
    header('Location: /dashboard');
} else {
    header('Location: /login?error=1&message=Usuario o Contraseña incorrecto');
}