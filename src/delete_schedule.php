<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
    exit();
}
include_once("config.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $schedule_id = $_POST['schedule_id'];
    $course_id = $_POST['course_id'];
    $instructor_id = $_POST['teacher_id'];

    $sql = "DELETE FROM instructor_schedule WHERE schedule_id = $schedule_id";
    $result = mysqli_query($link, $sql);
    if($result){
        $sql = "DELETE from course_instructors where course_id = $course_id and user_id = $instructor_id";
        $result = mysqli_query($link, $sql);
        if($result){
            echo "Schedule deleted successfully";
        }
        else{
            echo "Error deleting schedule";
        }
    }
    else{
        echo "Error deleting schedule";
    }
}
?>