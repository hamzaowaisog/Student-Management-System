<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
include_once("config.php");

$course_id = $_POST['course_id'];
$course_name = $_POST['course_name'];
$course_code = $_POST['course_code'];
$credit_hours = $_POST['credit_hour'];
$class_room = $_POST['class_room'];

$sql = "Update courses set course_name = '$course_name', course_code = '$course_code', Credit_hours = '$credit_hours', class_room = '$class_room' where course_id = $course_id";
$result = mysqli_query($link, $sql);
if($result){
    echo "Course updated successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}


?>