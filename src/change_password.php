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
    <style>
        body {
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
    }
    </style>
</head>
<body>
    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-slate-200 p-8 rounded shadow-md">
            <h2 class="text-2xl font-bold mb-6">Change Password</h2>
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
                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Change Password</button>
                    </div>
                </form>
    </div>
</div>
</body>
</html>
