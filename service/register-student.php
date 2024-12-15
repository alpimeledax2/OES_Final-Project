<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require '../config/connection.php';

$password = $_POST['password'];
$confirmPassword = $_POST['confirm-password'];

if ($password != $confirmPassword) {
    echo "<script>window.location.href='../index.php?status=p'</script>";
    exit();
}

$password = hash('sha256', $password);

$nik = $_POST['nik'];
$fullname = $_POST['fullname'];
$dob = $_POST['dob'];
$pob = $_POST['pob'];
$email = $_POST['email'];

$provinceId = $_POST['province'];
$cityId = $_POST['city'];
$schoolName = $_POST['school-name'];
$schoolMajorId = $_POST['major'];
$image = $_FILES['image']['name'];
$univ1 = $_POST['univ1'];
$univ2 = $_POST['univ2'];
$univMajor1 = $_POST['univ-major1'];
$univMajor2 = $_POST['univ-major2'];

$dir = 'photo-profiles/' . $nik . '.png';
$imagePath = '../images/' . $dir;
move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
mysqli_query($conn, "INSERT INTO users (nik, full_name, date_of_birth, place_of_birth, email, password, province_id, city_id, school_name, school_major_id, image_path, university_1_id, university_2_id, university_1_major_id, university_2_major_id) VALUES ('$nik', '$fullname', '$dob', '$pob', '$email', '$password', '$provinceId', '$cityId', '$schoolName', '$schoolMajorId', '$dir', '$univ1', '$univ2', '$univMajor1', '$univMajor2')");
echo "<script>window.location.href='../index.php?status=s'</script>";
?>