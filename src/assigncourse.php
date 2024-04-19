<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}       
if($_SESSION['role_id'] != 1){
    $_SESSION['role_id']=0;
    header('Location: dashboard.php');

}
include_once("config.php");
$sql = "Select user_id,fullname from users where role_id = 2";
$result1 = mysqli_query($link, $sql);
$sql1 = "Select * from courses";
$result2 = mysqli_query($link, $sql1);
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
    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-slate-200 p-8 rounded shadow-md">
            <h2 class="text-2xl font-bold mb-6">Assign Course</h2>
            <form id="assigncourse" method="post">
                <div class="mb-4">
                    <label for="course_name" class="block text-gray-700 font-bold mb-2">Course Name:</label>
                    <Select name="coursename" id="coursename" class="w-full px-3 py-2 border rounded-md" required>
                        <option>Select Course</option>
                        <?php
                        while($row = mysqli_fetch_assoc($result2)){
                            echo "<option value='".$row['course_id']."'>".$row['course_name']."</option>";
                        }
                        ?>
                        </Select>
                </div>
                <div class="mb-4">
                    <label for="teacher_name" class="block text-gray-700 font-bold mb-2">Teacher Name:</label>
                    <select name="teachername" id="teachername" class="w-full px-3 py-2 border rounded-md" required>
                        <option>Select Teacher</option>
                        <?php 
                        while($row = mysqli_fetch_assoc($result1)){
                            echo "<option value='".$row['user_id']."'>".$row['fullname']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="Start_time" class="block text-gray-700 font-bold mb-2">Start Time:</label>
                    <select id="start_time" name="start_time" class="w-full px-3 py-2 border rounded-md" required>
                        <option>Select Time</option>
                        <?php
                            for($hour =9;$hour<=16;$hour++){
                            $hour_twelve_hour_format = ($hour % 12 == 0) ? 12 : $hour % 12;
                            $time_label = ($hour < 12) ? $hour_twelve_hour_format . ':00 am' : $hour_twelve_hour_format . ':00 pm';
                            echo "<option value='{$hour}:00:00'>$time_label</option>";
                                }
                          ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="end_time" class="block text-gray-700 font-bold mb-2">End Time:</label>
                    <select id="end_time" name="end_time" class="w-full px-3 py-2 border rounded-md" required>
                        <option>Select Time</option>
                        <?php
                        for($hour =9;$hour<=16;$hour++){
                            $hour_twelve_hour_format = ($hour % 12 == 0) ? 12 : $hour % 12;
                            $time_label = ($hour < 12) ? $hour_twelve_hour_format . ':00 am' : $hour_twelve_hour_format . ':00 pm';
                            echo "<option value='{$hour}:00:00'>$time_label</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="days" class="block text-gray-700 font-bold mb-2">Days</label>
                    <select id="days" name="days" class="w-full px-3 py-2 border rounded-md" required>
                        <option>Select Day</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Assign Course</button>
                </div>
            </form>
        </div>
    </div>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#assigncourse').submit(function(e){
                e.preventDefault();
                var formdata = $(this).serialize();
                $.ajax({
                    url: 'assign_course.php',
                    type:'post',
                    data :formdata,
                    success:function(response){
                        alert(response);
                        location.reload();
                    },
                    error:function(err){
                        console.log(err);
                    },

                });
            });
        });
    </script>
</body>
</html>
