<?php
session_start();

require_once '../config/connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

if (!isset($email) || !isset($pass)) {
    header("location:../login.php?r=failed");
    exit();
}

$password = hash('sha256', $password);

$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND password = '$password'");
$data = mysqli_fetch_array($result);

if ($data) {
    $_SESSION['id'] = $data['id'];
    $_SESSION['status'] = 'logged-in';
    header("location:../student/dashboard.php");
} else {
    header("location:../login.php?r=failed");
}
?>