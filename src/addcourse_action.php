<?php

session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
include_once("config.php");

$course_code = $_POST['course_code'];
$course_name = $_POST['course_name'];
$course_credit = $_POST['course_credit'];
$class_room = $_POST['class_room'];

$sql = "INSERT INTO courses (course_code, course_name, Credit_hours, class_room) VALUES ('$course_code', '$course_name', '$course_credit', '$class_room')";
$result = mysqli_query($link, $sql);
if($result){
    echo "Course added successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}

?>