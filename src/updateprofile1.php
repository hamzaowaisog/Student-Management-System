<?php
header('Content-Type: application/json');
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
$user_id = $_SESSION['id'];
$username = $_POST['username'];
include('config.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $errors = [];

    if(empty($_POST['username'])){
        $errors['username'] = 'Username is required';
    }
    if(empty($_POST['fullname'])){
        $errors['fullname'] = 'Fullname is required';
    }
    if(empty($_POST['email'])){
        $errors['email'] = 'Email is required';
    }
    if(empty($_POST['dob'])){
        $errors['dob'] = 'Date of Birth is required';
    }
    if(empty($_POST['fname'])){
        $errors['fname'] = 'Father/Husband Name is required';
    }
    if(empty($_POST['cnic'])){
        $errors['cnic'] = 'CNIC is required';
    }
    if(empty($_FILES['picture']['name'])){
        $errors['picture'] = 'Profile Picture is required';
    }

    if(empty($errors)){
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $fname = $_POST['fname'];
        $cnic = $_POST['cnic'];
        $username = $_POST['username'];
        $picture = $_FILES['picture'];
        $date = date('Y-m-d H:i:s');
        if($picture['error'] == UPLOAD_ERR_OK){
            $imgdata = file_get_contents($picture['tmp_name']);
            $imgdata = mysqli_real_escape_string($link,$imgdata);
            $sql = "UPDATE `users` SET `fullname`='$fullname',`email`='$email',`username`='$username',`dob`='$dob',`father_or_husband_name`='$fname',`cnic_number`='$cnic',`profile_picture`='$imgdata' WHERE user_id = $user_id";
            if(mysqli_query($link,$sql)){
                $_SESSION['fullname'] = $fullname;
                echo json_encode(['error' => false , 'message' => 'Profile Updated Successfully']);
                
            } else{
                echo json_encode(['error' => true, 'message' => 'Could not able to execute $sql. ' . mysqli_error($link)]);
            }
        }
    }
    else{
        echo json_encode(['error' => true, 'message' => "Please fill all the required fields"]);
    }
}

?>