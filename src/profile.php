<?php
session_start();
include_once('config.php');

if(!isset($_SESSION['username'])){
    header('Location: index.php');
}

$user_id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($link, $sql);
if($result->num_rows>0){
    while($rows=$result->fetch_assoc()){
        $profile = base64_encode($rows['profile_picture']);
        $roll_number = $rows['roll_number'];
        $fullname = $rows['fullname'];
        $email = $rows['email'];
        $username = $rows['username'];
        $role_id = $rows['role_id'];
        $dob = $rows['dob'];
        $fname = $rows['father_or_husband_name'];
        $cnic = $rows['cnic_number'];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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
        <h1 class="text-3xl font-bold text-center mb-6">User Profile</h1>
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex justify-center mb-4">
                    <?php if(!empty($profile)): ?>
                        <img src="data:image/jpeg;base64,<?php echo $profile; ?>" alt="Profile Picture" class="w-32 h-32 rounded-full">
                    <?php else: ?>
                        <div class="w-32 h-32 rounded-full bg-gray-200 flex justify-center items-center text-gray-400">
                            <span>No Image</span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="roll_number">Roll Number:</label>
                    <p><?php echo $roll_number; ?></p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="fullname">Full Name:</label>
                    <p><?php echo $fullname; ?></p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="email">Email:</label>
                    <p><?php echo $email; ?></p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="username">Username:</label>
                    <p><?php echo $username; ?></p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="dob">Date of Birth:</label>
                    <p><?php echo $dob; ?></p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="fname">Father/Husband Name:</label>
                    <p><?php echo $fname; ?></p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="cnic">CNIC:</label>
                    <p><?php echo $cnic; ?></p>
                </div>
            </div>
        </div>
        </main>
    </div>
</body>
</html>
