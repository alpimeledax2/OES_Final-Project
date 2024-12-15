<?php 
session_start();

require '../config/connection.php';

$examId = $_POST['exam-id'];
$userId = $_SESSION['id'];

$result = mysqli_query($conn, "SELECT * FROM results WHERE exam_id = '$examId' AND user_id = '$userId'");
$count = mysqli_num_rows($result);
if ($count > 0) {
    header("location:../student/grading.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM exam_enrollments WHERE exam_id = '$examId' AND user_id = '$userId'");

$totalCorrect = 0;
$totalWrong = 0;
$now = date("Y-m-d H:i:s");

while ($examEnrollment = mysqli_fetch_array($result)) {
    $selectedAnswerId = $examEnrollment['selected_answer_id'];

    if ($selectedAnswerId) {
        $answerResult = mysqli_query($conn, "SELECT * FROM answers WHERE id = '$selectedAnswerId'");
        $answer = mysqli_fetch_array($answerResult);

        if ($answer['is_correct'] == 1) {
            $totalCorrect++;
        } else {
            $totalWrong++;
        }
    } else {
        $totalWrong++;
    }
}

mysqli_query($conn, "INSERT INTO results (exam_id, user_id, total_correct, total_wrong, submit_date) VALUES ('$examId', '$userId', '$totalCorrect', '$totalWrong', '$now')");
header("location:../student/grading.php");
?>