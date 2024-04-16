<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
include_once("config.php");

$signup_id = $_POST['signup_id'];
$role = $_POST['role'];
if($role == 'admin'){
    $role = '1';
} else if ($role == 'user') {
    $role = '3';
}
else{
    $role = '2';
}


$sql = "UPDATE unconfirmed_signups SET confirmation_status = 'confirmed' WHERE signup_id = $signup_id";
$result = mysqli_query($link, $sql);
if($result){
    $sql = "SELECT * FROM unconfirmed_signups WHERE signup_id = $signup_id";
    $result = mysqli_query($link, $sql);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $username = mysqli_real_escape_string($link, $row['username']);
        $email = mysqli_real_escape_string($link, $row['email']);
        $password = mysqli_real_escape_string($link, $row['password']);
        $fullname = mysqli_real_escape_string($link, $row['fullname']);
        $dob = mysqli_real_escape_string($link, $row['dob']);
        $fhname = mysqli_real_escape_string($link, $row['father_or_husband_name']);
        $cnic = mysqli_real_escape_string($link, $row['cnic_number']);
        $picture = mysqli_real_escape_string($link, $row['profile_picture']);
        $sql = "INSERT INTO users (username,email, password, fullname, dob, father_or_husband_name, cnic_number, profile_picture, role_id) VALUES ('$username','$email', '$password', '$fullname', '$dob', '$fhname', '$cnic', '$picture', '$role')";
        $result = mysqli_query($link, $sql);
        
        if ($result) {

            echo "User inserted successfully.";
        } else {
            echo "Error: " . mysqli_error($link);
        }
    } else {
        echo "Error: " . mysqli_error($link);
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);

}



?>
