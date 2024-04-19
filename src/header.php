<?php
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
include_once('config.php');
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($link, $sql);
if($result->num_rows>0){
    while($rows=$result->fetch_assoc()){
        $profile = base64_encode($rows['profile_picture']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .header {
            background-color: #355c7d;
            color: #fff;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .profile-info {
            display: flex;
            align-items: center;
        }

        .profile-info img {
            width: 8rem;
            height: 8rem;
            border-radius: 50%;
            margin-right: 10px;
        }

        @media (max-width: 576px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .profile-info {
                margin-top: 10px;
            }
        }
        .span{
            font-weight: bold;
            color: #d2b01a;
        }
        .profile-name {
            position: relative;
            cursor: pointer;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #fff;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
            margin-top: 0px;
            z-index: 999;
            border-radius: 10px;
            overflow: hidden;
        }

        .profile-name:hover .dropdown-menu {
            display: block;
        }
        .profile-name:hover {
            color:#d2b01a
        }
        .dropdown-menu ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .dropdown-menu ul li {
            padding: 5px 0;
        }

        .dropdown-menu ul li a {
            display: block;
            color: #000;
            text-decoration: none;
        }
        .dropdown-menu ul li a:hover {
            color:white;
            background-color: #355c7d;
        }


        .dropdown-menu ul li button {
            color:white;
            background-color: #355c7d;
            display: block;
            padding: 5px 10px;
            margin-top: 5px;
            border: none;
            border-radius: 10px;
        }

        .dropdown-menu ul li button:hover {
            color:white;
            background-color: black;
        }
        a:hover{
            text-decoration: none;
            color: #d2b01a;
        }
        .profile-picture-container {
            width: 40px; 
            height: 40px;
            border-radius: 50%; 
            overflow: hidden;
            position: relative; 
        }

        .profile-picture-container img {
            width: auto;
    height: 100%; 
    position: absolute; 
    left: 50%; 
    transform: translateX(-50%)
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0 ">
        <div class="header">
            <div><h1 class="text-3xl"><a href="dashboard.php">TechZone University</a></h1></div>
            <div class="profile-info">
                <div class="profile-name me-5 ">
                    <span class="span">Hello, </span><?php echo $_SESSION['fullname']; ?>
                    <div class="dropdown-menu text-center  ">
                        <ul>
                            <li><a href="#" class="header-link" data-url="profile.php">Profile</a></li>
                            <li><a href="#" class="header-link" data-url="change_password.php">Change Password</a></li>
                            <li>
                                <form action="logout.php">
                                    <button class="m-auto btn rounded-pill text-center d-flex justify-content-center">Log Out</button></li>
                                </form>
                        </ul>
                    </div>
                </div>
                <div class="profile-picture-container">
                    <?php
                    $image_info = getimagesizefromstring(base64_decode($profile));
                    $image_mime = $image_info['mime'];
                    $image_src = 'data:' . $image_mime . ';base64,' . $profile;
                    ?>
                    <img src="<?php echo $image_src; ?>" alt="profile">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
