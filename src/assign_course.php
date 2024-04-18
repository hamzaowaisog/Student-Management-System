<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
include_once("config.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $course_id = $_POST['coursename'];
    $teacher_id = $_POST['teachername'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $days = $_POST['days'];

    $sql = "Select class_room from courses where course_id = '$course_id'";
    $result = mysqli_query($link, $sql);
    $class_room = mysqli_fetch_assoc($result)['class_room'];

    $sql = "INSERT INTO course_instructors (course_id,user_id) value ('$course_id','$teacher_id')";
    $result = mysqli_query($link, $sql);
    if($result){
        $sql = "INSERT into instructor_schedule (course_id,course_instructor_id,day_of_week,start_time,end_time,class_room) value
        ('$course_id','$teacher_id','$days','$start_time','$end_time','$class_room')";
        $result = mysqli_query($link,$sql);
        if($result){
            echo "Course assigned successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
    }
    else{
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
}
else{
    echo "Invalid request";
}

?>
