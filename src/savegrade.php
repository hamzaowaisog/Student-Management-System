<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
    exit();
}
if($_SESSION['role_id'] != 2){
    $_SESSION['role_id']=0;
    $_SESSION['role']=0;
    header('Location: dashboard.php');
}

include_once("config.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $user_id = $_POST['user_id'];
    $course_id = $_POST['course_id'];
    $type = $_POST['type'];
    $marks = $_POST['marks'];
    $totalmarks = $_POST['totalmarks'];
    $teacher_id = $_SESSION['id'];

    $sql = "INSERT INTO grades (user_id, course_id, assignment_type, marks, Total_marks, teacher_id) VALUES ('$user_id', '$course_id', '$type', '$marks', '$totalmarks', '$teacher_id')";
    $result = mysqli_query($link, $sql);
    if($result){
        echo "Grade saved successfully";
    }else{
        echo "Error in saving grade";
    }
}

?>