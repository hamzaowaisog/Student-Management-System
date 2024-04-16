<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
$user_id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="output.css" rel="stylesheet">
</head>
<body>
<div class="container mx-auto">
  <div class="flex justify-center">
    <div class="w-full md:w-8/12">
      <div class="bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-semibold mb-4">Edit Profile</h2>
        <div id="error-message" class="alert alert-danger hidden" role="alert"></div>
        <form id="edit_profile_form" method="post" enctype="multipart/form-data">
          <div class="mb-4">
            <label for="fullname" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input type="text" name="fullname" class="form-input mt-1 block w-full rounded-md border-gray-300" id="fullname" placeholder="Enter your full name">
          </div>
          <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" class="form-input mt-1 block w-full rounded-md border-gray-300" id="email" placeholder="Enter your email">
          </div>
          <div class="mb-4">
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" name="username" class="form-input mt-1 block w-full rounded-md border-gray-300" id="username" placeholder="Choose a username">
          </div>
          <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" class="form-input mt-1 block w-full rounded-md border-gray-300" id="password" placeholder="Choose a password">
          </div>
          <div class="mb-4">
            <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
            <input type="date" name="dob" class="form-input mt-1 block w-full rounded-md border-gray-300" id="dob">
          </div>
          <div class="mb-4">
            <label for="fatherName" class="block text-sm font-medium text-gray-700">Father/Husband Name</label>
            <input type="text" name="fname" class="form-input mt-1 block w-full rounded-md border-gray-300" id="fatherName" placeholder="Enter your father or husband name">
          </div>
          <div class="mb-4">
            <label for="cnic" class="block text-sm font-medium text-gray-700">CNIC Number</label>
            <input type="text" name="cnic" class="form-input mt-1 block w-full rounded-md border-gray-300" id="cnic" placeholder="Enter your CNIC number">
          </div>
          <div class="mb-4">
            <label for="profilePicture" class="block text-sm font-medium text-gray-700">Profile Picture</label>
            <input type="file" name="picture" class="form-input mt-1 block w-full rounded-md border-gray-300" accept="image/*" id="profilePicture">
          </div>
          <button type="submit" id="smb_but" class="w-full bg-blue-500 text-white font-semibold px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">Update Profile</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#smb_but').click(function(e){
            e.preventDefault();
            var formData = new FormData($('#edit_profile_form')[0]);
            $.ajax({
                url: "updateprofile1.php",
                type: "post",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    if(response.error){
                        $('#error-message').removeClass('d-none');
                        $('#error-message').text(response.message);
                    } else {
                        window.location.href = "dashboard.php";
                    }
            }
         });
        });
});
</script>
</body>
</html>