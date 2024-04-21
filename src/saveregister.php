<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
    exit();
}
if($_SESSION['role_id'] != 3){
    $_SESSION['role_id']=0;
    $_SESSION['role']=0;
    header('Location: dashboard.php');
}

include_once("config.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $teacher_id = $_POST['teacher_id'];
    $course_id = $_POST['course_id'];
    $user_id = $_SESSION['id'];
    $sql = "INSERT INTO course_enrollment (course_id, user_id, teacher_id) VALUES ('$course_id', '$user_id','$teacher_id')";
    if(mysqli_query($link, $sql)){
        echo "success";
    }else{
        echo "error";
    }
}

?>