<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
include_once("config.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $course_id = $_POST['course_id'];
    $previous_teacher_id = $_POST['previous_teacher_id'];
    $new_teacher_id = $_POST['new_teacher_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $days = $_POST['days'];
    $class_room = $_POST['class_room'];
    $schedule_id = $_POST['schedule_id'];


    $sql = "Update course_instructors set user_id = '$new_teacher_id' where course_id = '$course_id' and user_id = '$previous_teacher_id'";
    if(mysqli_query($link,$sql)){
        $sql = "update instructor_schedule set course_id = '$course_id', start_time = '$start_time', end_time = '$end_time', day_of_week = '$days', class_room = '$class_room', course_instructor_id ='$new_teacher_id' where schedule_id ='$schedule_id' ";
        if(mysqli_query($link,$sql)){
            echo "Schedule updated successfully";
        } else{
            echo "Could not able to execute $sql. " . mysqli_error($link);
        }
    } else{
        echo "Could not able to execute $sql. " . mysqli_error($link);
    }

}
?>