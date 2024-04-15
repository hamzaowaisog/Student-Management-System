<?php
session_start();

$error = isset($_GET['error']) ? $_GET['error'] : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
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

    .login-container {
      max-width: 400px;
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
    <div class="col-md-6 login-container">
      <h2 class="mb-4">Login</h2>
      
      <?php if ($error == '1'): ?>
        <div class="alert alert-danger" role="alert">
          Incorrect username or password. Please try again.
        </div>
      <?php endif; ?>

      <form id="login" method="post">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
        <span>Click here to <a href="singup.php">Register</a></span>
      </form>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('#login').submit(function(e) {
      e.preventDefault();
      var username = $('#username').val();
      var password = $('#password').val();
      $.ajax({
        type: "POST",
        url: "login.php",
        data: {
          username: username,
          password: password
        },
        dataType: "json",
        success: function(data) {
          if (data.success) {
            window.location.href = 'dashboard.php';
          } else {
            window.location.href = 'index.php?error=1';
          }
        }
      });
    });
  });
</script>
</body>
</html>
