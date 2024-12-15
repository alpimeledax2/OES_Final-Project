<?php 
require '../config/connection.php';

$email = $_POST['email'];
if (!isset($email)) {
    header("location:../fp-email.php?r=not-found");
    exit();
}

$password = $_POST['password'];
$confirmPassword = $_POST['confirm-password'];

if ($password != $confirmPassword) {
    header("location:../fp-form.php?r=failed&e=" . $email);
    exit();
}

$password = hash('sha256', $password);

mysqli_query($conn, "UPDATE users SET password = '$password' WHERE email = '$email'");
header("location:../login.php?r=reset-password");
?>