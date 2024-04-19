<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
$user_id = $_SESSION['id'];

include ("config.php");

$sql = "select * from users where user_id = '$user_id'";
$result = mysqli_query($link,$sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="output.css" rel="stylesheet">
    <style>
         body {
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
    }
    </style>
</head>
<body>
<div class="container mx-auto">
      <div class="max-w-md mx-auto bg-slate-200 rounded shadow-md p-8">
      <div id="error-message" class="alert alert-danger hidden" role="alert"></div>
        <h2 class="text-2xl font-bold mb-2">Edit Profile</h2>
        <form id="edit_profile_form" method="post" enctype="multipart/form-data">
          <div class="mb-4">
            <label for="fullname" class="block font-bold text-gray-700 mb-1">Full Name</label>
            <input type="text" name="fullname" class="w-full px-3 py-2 border rounded-md" id="fullname" value="<?php echo $row['fullname']?>" placeholder="Enter your full name">
          </div>
          <div class="mb-4">
            <label for="email" class="block font-bold text-gray-700 mb-1">Email</label>
            <input type="email" name="email" class="w-full px-3 py-2 border rounded-md" id="email" placeholder="Enter your email" value="<?php echo $row['email']?>" >
          </div>
          <div class="mb-4">
            <label for="username" class="block font-bold text-gray-700 mb-1">Username</label>
            <input type="text" name="username" class="w-full px-3 py-2 border rounded-md" id="username" placeholder="Choose a username" value="<?php echo $row['username']?>">
          </div>
          <div class="mb-4">
            <label for="dob" class="block font-bold text-gray-700 mb-1">Date of Birth</label>
            <input type="date" name="dob" class="w-full px-3 py-2 border rounded-md" id="dob" value="<?php echo $row['dob']?>">
          </div>
          <div class="mb-4">
            <label for="fatherName" class="block font-bold text-gray-700 mb-1">Father/Husband Name</label>
            <input type="text" name="fname" class="w-full px-3 py-2 border rounded-md" id="fatherName" placeholder="Enter your father or husband name" value="<?php echo $row['father_or_husband_name']?>">
          </div>
          <div class="mb-4">
            <label for="cnic" class="block font-bold text-gray-700 mb-1">CNIC Number</label>
            <input type="text" name="cnic" class="w-full px-3 py-2 border rounded-md" id="cnic" placeholder="Enter your CNIC number" value="<?php echo $row['cnic_number']?>">
          </div>
          <div class="mb-4">
            <label for="profilePicture" class="block font-bold text-gray-700">Profile Picture</label>
            <input type="file" name="picture" class="w-full px-2 py-2 border rounded-md" accept="image/*" id="profilePicture">
          </div>
          <div class="mb-4">
          <button type="submit" id="smb_but" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Profile</button>
          </div>
        </form>
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
                        $('#error-message').removeClass('hidden');
                        $('#error-message').text(response.message);
                    } else {
                      alert(response.message);
                      location.reload();
                    }
            },
            error: function(response){
              $('#error-message').removeClass('hidden');
              $('#error-message').text('An error occured');

            }
         });
        });
});
</script>
</body>
</html>