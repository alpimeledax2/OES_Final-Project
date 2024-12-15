<?php 
session_start();

require '../config/connection.php';

$userId = $_SESSION['id'];
$examId = $_POST['exam-id'];
$questionId = $_POST['question-id'];

$no = $_POST['no'];
if (!$no) {
    $no = 1;
}

$selectedAnswerId = $_POST['selected-answer-id'];

mysqli_query($conn, "UPDATE exam_enrollments SET selected_answer_id = '$selectedAnswerId' WHERE exam_id = '$examId' AND user_id = '$userId' AND question_id = '$questionId'");
header("location:../student/exam.php?ei=" . $examId . "&no=" . $no);
?>