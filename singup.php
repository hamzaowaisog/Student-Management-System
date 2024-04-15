<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup Page</title>
  
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url('https://via.placeholder.com/1500x1000'); 
      background-size: cover;
      background-position: center;
      height: 100vh;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .signup-container {
      max-width: 600px;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      background-color: rgba(255, 255, 255, 0.9);
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 signup-container">
      <h2 class="mb-4">Sign Up</h2>
      <div id="error-message" class="alert alert-danger d-none" role="alert"></div>
      <form id="singup_form" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="fullname">Full Name</label>
          <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Enter your full name">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email">
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" class="form-control" id="username" placeholder="Choose a username">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Choose a password">
        </div>
        <div class="form-group">
          <label for="dob">Date of Birth</label>
          <input type="date" name="dob" class="form-control" id="dob">
        </div>
        <div class="form-group">
          <label for="fatherName">Father/Husband Name</label>
          <input type="text" name="fname" class="form-control" id="fatherName" placeholder="Enter your father or husband name">
        </div>
        <div class="form-group">
          <label for="cnic">CNIC Number</label>
          <input type="text" name="cnic" class="form-control" id="cnic" placeholder="Enter your CNIC number">
        </div>
        <div class="form-group">
          <label for="profilePicture">Profile Picture</label>
          <input type="file" name="picture" class="form-control-file" accept="image/*" id="profilePicture">
        </div>
        <button type="submit" id="smb_but" class="btn btn-primary btn-block">Sign Up</button>
      </form>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
  $('#smb_but').click(function(e){
    e.preventDefault();

    var formData = new FormData($('#singup_form')[0]);

    $.ajax({
      url: "signup.php",
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
          window.location.href = "index.php";
        }
      }
    });
  });
});

</script>
</body>
</html>
