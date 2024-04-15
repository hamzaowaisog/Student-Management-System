<?php

$username = $_POST['username'];
$password = $_POST['password'];
include('config.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $errors = [];

    if(empty($_POST['username'])){
        $errors['username'] = 'Username is required';
    }
    if(empty($_POST['password'])){
        $errors['password'] = 'Password is required';
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
    if(empty($_FILES['picture'])){
        $errors['picture'] = 'Profile Picture is required';
    }

    if(empty($errors)){
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $fname = $_POST['fname'];
        $cnic = $_POST['cnic'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $picture = $_FILES['picture'];
        $date = date('Y-m-d H:i:s');
        if($picture['error'] == UPLOAD_ERR_OK){
            $imgdata = file_get_contents($picture['tmp_name']);
            $imgdata = mysqli_real_escape_string($link,$imgdata);
            $sql = "INSERT INTO `unconfirmed_signups`(`fullname`, `email`, `username`, `password`, `dob`, `father_or_husband_name`, `cnic_number`, `profile_picture`, `signup_date`, `confirmation_status`) VALUES ('$fullname','$email','$username','$password','$dob','$fname','$cnic','$imgdata','$date','pending')";
            if(mysqli_query($link,$sql)){
                echo json_encode(['error' => false]);
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