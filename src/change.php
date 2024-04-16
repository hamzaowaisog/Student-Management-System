<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
require_once('config.php');
$user_id = $_SESSION['id'];
$new_password = $_POST['new_password'];
$sql = "UPDATE users set password = '$new_password' WHERE user_id = '$user_id'";
$result = mysqli_query($link, $sql);
if($result){
    header('Location: logout.php');
}
else{
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}

?>