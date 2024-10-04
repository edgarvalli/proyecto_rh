<?php
var_dump($_POST);
$action = $_POST['action'];
$fullname = $_POST['fullname'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

if ($start_date == '') {
    $start_date = date('Y-m-d');
}

if ($end_date == '') {
    $end_date = NULL;
}

require_once('../database.php');
$dbname = database::get_db_name();
$db = database::connect($dbname);

switch ($action) {
    case "new":
        $sql = "INSERT INTO employees (fullname, phone, email,start_date) VALUE ('$fullname','$phone','$email', '$start_date')";
        $db->query($sql);
        $db->commit();
        header('Location: /');
        break;
    case "update":
        $id = $_POST['id'];
        $sql = "UPDATE employees SET fullname='$fullname', phone='$phone', email='$email' WHERE id=$id;";
        $db->query($sql);
        $db->commit();
        header('Location: /');
        break;
    case "fired":
        $id = $_POST['id'];
        $comment = $_POST['comment'];
        $end_date = $_POST['end_date'];
        $sql = "UPDATE employees SET end_date='$end_date', comment='$comment',is_active=0 WHERE id=$id";
        $db->query($sql);
        $db->commit();
        header('Location: /');
        break;
}