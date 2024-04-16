<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
include_once("config.php");
$course_id = $_POST['course_id'];
$sql = "DELETE FROM courses WHERE course_id = $course_id";
$result = mysqli_query($link, $sql);
if($result){
    echo "Course deleted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}
?>
