<?php 
require '../config/connection.php';

$emailTo = $_POST['email-to'];
if (!isset($emailTo)) {
    header("location:../fp-email.php?r=not-found");
    exit();
}

$otp1 = $_POST['otp-1'];
$otp2 = $_POST['otp-2'];
$otp3 = $_POST['otp-3'];
$otp4 = $_POST['otp-4'];
$otp = $otp1 . $otp2 . $otp3 . $otp4;
if (!isset($otp)) {
    header("location:../fp-otp.php?r=failed&e=" . $emailTo);
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM otps WHERE otp = '$otp' AND email_to = '$emailTo'");
$data = mysqli_fetch_array($result);

if ($data) {
    $createdDate = $data['created_date'];
    $now = date("Y-m-d H:i:s");

    $differenceInMins = (abs($end_timestamp - $start_timestamp)) / 60;
    if ($differenceInMins >= 5) {
        // Expired
        header("location:../fp-email.php?r=expired");
    } else {
        // Success
        header("location:../fp-form.php?e=" . $emailTo);
    }
} else {
    // Failed
    header("location:../fp-otp.php?r=failed&e=" . $emailTo);
}
?>