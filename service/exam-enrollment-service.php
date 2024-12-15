<?php
session_start();

require '../config/connection.php';

if (!isset($_SESSION['id'])) {
    header("location:logout-service.php");
    exit();
}

$examId = $_GET['ei'];
$userId = $_SESSION['id'];

if (!isset($examId) || !isset($userId)) {
    header("location:../student/dashboard.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM exam_enrollments WHERE exam_id = '$examId' AND user_id = '$userId'");
$count = mysqli_num_rows($result);
if ($count > 0) {
    header("location:../student/exam.php?ei=" . $examId);
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM exam_questions WHERE exam_id = '$examId' ORDER BY rand()");
$no = 0;
while($examQuestion = mysqli_fetch_array($result)) {
    $no++;
    mysqli_query($conn, "INSERT INTO exam_enrollments (exam_id, user_id, number, question_id) VALUES ('$examId', '$userId', '$no', '$examQuestion[question_id]')");
}

header("location:../student/exam.php?ei=" . $examId);
?>