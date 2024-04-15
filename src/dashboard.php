<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <header>
    <?php include('header.php'); ?>
    </header>
    <div>
        <nav>
            <?php include('sidebar.php'); ?>
        </nav>
        <main>
            
        </main>

    </div>
    
</body>
</html>