<?php

session_start();
if(!isset($_SESSION['username'])){
    header('location:index.php');
}
if($_SESSION['role']!=2){
    $_SESSION['role']=0;
    $_SESSION['role_id']=0;
    header('location:dashboard.php');
}

include_once("config.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $student_name = $_POST['student_name'];
    $course_id = $_POST['course_id'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    $roll_number = $_POST['roll_number'];

    $sql = "Select * from users where fullname = '$student_name' and roll_number = '$roll_number'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    $user_id = $row['user_id'];

    $sql1 = "INSERT into attendance (user_id,course_id,session_date,status) values('$user_id','$course_id','$date','$status')";
    $result1 = mysqli_query($link, $sql1);
    if($result1){
        echo "Attendance taken successfully";
    }else{
        echo "Error in taking attendance";
    }
}

?>