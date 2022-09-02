<?php
require_once 'config.php';
session_start();

$subj = $_POST['subject'];
$grade = $_POST['grade'];
$studID = $_POST['studentid'];

$sql2 = "SELECT id FROM students WHERE id = $studID";
$result2 = mysqli_query($link, $sql2);
if (mysqli_num_rows($result2) > 0) {
    $sql = "INSERT INTO subjects (subjectname, grade, student_id)
    VALUES ('$subj', '$grade', '$studID')";
    if (mysqli_query($link, $sql)) {
        $_SESSION["message"] = "Subject successfully added!";
        $sql3 = "SELECT AVG(grade) as average FROM subjects WHERE student_id = $studID";
        $result3 = mysqli_query($link, $sql3);
        $row3 = mysqli_fetch_assoc($result3);
        $average = $row3['average'];
        $sql4 = "UPDATE students SET total_grade=$average WHERE id=$studID";
        $result4 = mysqli_query($link, $sql4);
        $_SESSION["message"] = "grade added succesfully!";
    } else {
        $_SESSION["message"] = "Error querying into the database!";
    }
} else {
    $_SESSION["message"] = "no student with that ID!";
}

header("location: index.php?");
