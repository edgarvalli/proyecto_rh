<?php

if (array_key_exists('REQUEST_METHOD', $_SERVER)) {
    echo "Url Not Allowed";
    die();
}


require_once('database.php');

$db = database::get_db_name();

$sqls = array(
    "CREATE DATABASE IF NOT EXISTS $db",
    "CREATE TABLE IF NOT EXISTS $db.users (
        id tinyint auto_increment,
        username varchar(200),
        password varchar(500),
        created_date datetime DEFAULT current_timestamp(),
        UNIQUE(username),
        PRIMARY KEY(id)
    )",
    "CREATE TABLE IF NOT EXISTS $db.employees (
        id tinyint auto_increment,
        fullname varchar(200),
        phone varchar(50),
        email varchar(100),
        comment varchar(500),
        is_active tinyint DEFAULT 1,
        start_date datetime DEFAULT current_timestamp(),
        end_date datetime,
        created_date datetime DEFAULT current_timestamp(),
        PRIMARY KEY(id)
    )",
    "INSERT INTO $db.users (username, password) VALUES ('admin', SHA1('admin'));"
);

$db = database::connect("mysql");

if($db->connect_error) {
    $no_error = $db->connect_errno;
    echo "Ocurrio un error;Code [$no_error]";
} else {
    foreach($sqls as $sql) {
        $db->query($sql);
        $db->commit();
        if($db->error) {
            $no_error = $db->errno;
            echo "Ocurrio un error al ejecturar el script $dbname; Code[$no_error]";
        } else {
            echo "\nSe ejecturo corractamente la sentencia SQL: \n $sql";
        }
    }
}