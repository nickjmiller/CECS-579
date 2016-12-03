<?php
include_once 'db_config.php';   // As functions.php is not included
$mysqli = new mysqli('127.0.0.1','sec_user', 'cecs579group', 'voterInfo');
if ($mysqli->connect_error) {
    header("Location: ../error.php?err=Unable to connect to MySQL");
    exit();
}
?>
