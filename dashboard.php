<?php
session_start();
$username = $_SESSION['username'];
$role_id = $_SESSION['role_id'];


echo "Welcome, $username!";
echo "<br>";
echo "Your role ID is: $role_id";

?>