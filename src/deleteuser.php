<?php

session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
include_once("config.php");
$user_id = $_POST['user_id'];

$sql = "DELETE FROM users WHERE user_id = $user_id";
$result = mysqli_query($link, $sql);
if($result){
    echo "User deleted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}

?>