<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
    exit();
}
if($_SESSION['role_id'] != 1){
    $_SESSION['role_id']=0;
    header('Location: dashboard.php');
}

include_once("config.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $teacher_id = $_POST['teacherid'];
    $sql = "SELECT * FROM course_instructors WHERE user_id = $teacher_id";
    $result = mysqli_query($link, $sql);
    echo "<option value=''>Select Course</option>";
    while($row = mysqli_fetch_assoc($result)){
        $sql1 = "SELECT * FROM courses WHERE course_id = ".$row['course_id'];
        $result2 = mysqli_query($link, $sql1);
        while($row1 = mysqli_fetch_assoc($result2)){
            echo "<option value='".$row1['course_id']."'>".$row1['course_name']."</option>";
        }   
    }
}
?>