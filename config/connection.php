<?php
date_default_timezone_set('Asia/Jakarta');

$server = "localhost:3306";
$user = "root";
$pass = "";
$database = "oes";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("Connection failed to: ".mysqli_connect_error());
}
?>