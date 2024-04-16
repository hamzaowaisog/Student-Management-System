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
    <title>Change Password</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <header>
         <?php include('header.php'); ?>
    </header>
    <div class="container mx-auto py-10">
        <aside>
            <?php include('sidebar.php'); ?>
        </aside>
        <main>
        <h1 class="text-3xl font-bold text-center mb-6">Change Password</h1>
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <form action="change.php" method="post">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="current_password">Current Password:</label>
                        <input class="w-full px-3 py-2 placeholder-gray-400 border rounded-md focus:outline-none focus:ring focus:ring-indigo-200" type="password" id="current_password" name="current_password" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="new_password">New Password:</label>
                        <input class="w-full px-3 py-2 placeholder-gray-400 border rounded-md focus:outline-none focus:ring focus:ring-indigo-200" type="password" id="new_password" name="new_password" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="confirm_password">Confirm New Password:</label>
                        <input class="w-full px-3 py-2 placeholder-gray-400 border rounded-md focus:outline-none focus:ring focus:ring-indigo-200" type="password" id="confirm_password" name="confirm_password" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
        </main>
    </div>
</body>
</html>
