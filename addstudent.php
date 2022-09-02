<?php
require_once 'config.php';
session_start();

$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$sql = "INSERT INTO students (firstname, lastname)
VALUES ('$fname', '$lname')";

if (mysqli_query($link, $sql)) {
    $_SESSION["message"] = "Student successfully added!";
} else {
    $_SESSION["message"] = "Error querying into the database!";
}
header("location: index.php?");
