<?php
session_start();
include_once('config.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $error = [];

    if(empty($_POST['username'])){
        $error['username'] = "Username is required";
    }
    if(empty($_POST['password'])){
        $error['password'] = "Password is required";
    }

    if(empty($error)){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($link, $sql);
        if($result->num_rows>0){
            while($rows=$result->fetch_assoc()){
                $_SESSION['username'] = $rows['username'];
                $_SESSION['role_id'] = $rows['role_id'];
                $_SESSION['fullname']= $rows['fullname'];
                $_SESSION['id'] = $rows['user_id'];
                $_SESSION['role'] = $rows['role_id'];
                $_SESSION['profile'] = $rows['profile_picture'];
                $response = [
                  'success' => true,
                ];
                echo json_encode($response);
                exit;
            }
        }
        else{
            $response =[
                'error' => 'Invalid Username or Password'
            ];
            echo json_encode($response);
            exit;
        }
    }
    else{
        $response = [
            'error' => $error
        ];
        echo json_encode($response);
        exit;
    }
}


?>