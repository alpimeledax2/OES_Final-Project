<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../config/connection.php';

$emailTo = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailTo = $_POST['email-to'];
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $emailTo = $_GET['e'];
}

if (!isset($emailTo)) {
    header("location:../fp-email.php?r=not-found");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$emailTo'");
$data = mysqli_fetch_array($result);
if (!$data) {
    header("location:../fp-email.php?r=not-found");
    exit();
}

$digits = 4;
$otp = substr(str_shuffle("0123456789"), 0, $digits);

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'alfiff418@gmail.com'; // TODO: Change with Alfi
$mail->Password = 'ktjjazzastgjkynn'; //TODO: Change with Alfi
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->setFrom('no-reply@oes.id', 'OES');
$mail->addAddress($emailTo, 'OES Student'); 

$mail->isHTML(true);
$mail->Subject = 'OES - Reset Password OTP';
$mail->Body    = "<!doctypehtml><html lang=en><meta charset=UTF-8><title></title><style>body{margin:0;padding:0;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;color:#333;background-color:#fff}.container{margin:0 auto;width:100%;max-width:600px;padding:0 0;padding-bottom:10px;border-radius:5px;line-height:1.8}.header{border-bottom:1px solid #eee}.header a{font-size:1.4em;color:#000;text-decoration:none;font-weight:600}.content{min-width:700px;overflow:auto;line-height:2}.otp{background:linear-gradient(to right,#00bc69 0,#00bc88 50%,#00bca8 100%);margin:0 auto;width:max-content;padding:0 10px;color:#fff;border-radius:4px}.footer{color:#aaa;font-size:.8em;line-height:1;font-weight:300}.email-info{color:#666;font-weight:400;font-size:13px;line-height:18px;padding-bottom:6px}.email-info a{text-decoration:none;color:#00bc69}</style><div class=container><div class=header><a>OES - Online Examination System</a></div><br><p>We have received a reset password request for your OES account. For security purposes, please verify your identity by providing the following One-Time Password (OTP).<br><b>Your One-Time Password (OTP) verification code is:</b><h2 class=otp>$otp</h2><p style=font-size:.9em><strong>One-Time Password (OTP) is valid for 5 minutes.</strong><br><br>If you did not initiate this login request, please disregard this message. Please ensure the confidentiality of your OTP and do not share it with anyone.<hr style='border:none;border-top:.5px solid #131111'><div class=footer><p>This email can't receive replies.</div></div>";

// Attempt to send the email
if (!$mail->send()) {
    header("location:../fp-email.php?r=failed");
} else {
    $now = date("Y-m-d H:i:s");
    mysqli_query($conn, "INSERT INTO otps (otp, email_to, created_date) VALUES ('$otp', '$emailTo', '$now')");

    header("location:../fp-otp.php?e=" . $emailTo);
}

$mail->smtpClose();
?>