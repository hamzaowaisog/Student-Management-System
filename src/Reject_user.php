<?php

session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
include_once("config.php");
$signup_id = $_POST['signup_id'];

$sql = "UPDATE unconfirmed_signups SET confirmation_status = 'rejected' WHERE signup_id = $signup_id";
$result = mysqli_query($link, $sql);
if($result){
    echo "User rejected successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}

?>
