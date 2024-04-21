<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
    exit();
}
if($_SESSION['role_id'] != 3){
    $_SESSION['role_id']=0;
    $_SESSION['role']=0;
    header('Location: dashboard.php');
}
include_once("config.php");

$courses = array();
$user_id = $_SESSION['id'];
$sql = "SELECT course_id from course_enrollment where user_id = '$user_id'";
$result = mysqli_query($link, $sql);
while($row = mysqli_fetch_assoc($result)){
    $course_id = $row['course_id'];
    $sql2 = "SELECT * from courses where course_id = '$course_id'";
    $result2 = mysqli_query($link, $sql2);
    while($row2 = mysqli_fetch_assoc($result2)){
        $courses[$row2['course_id']] = $row2['course_name'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
    body {
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
    }

    .container {
        width: 100%;
        margin: 20px auto;
        overflow-x: auto; 
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .role-dropdown select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .action-links a {
        color: #007bff;
        text-decoration: none;
        margin-right: 10px;
    }

    .action-links a:hover {
        text-decoration: underline;
        color: bisque;
    }

    .pagination {
        margin-top: 20px;
        text-align: center;
    }

    .pagination a {
        color: #007bff;
        padding: 8px 16px;
        text-decoration: none;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin: 0 4px;
    }

    .pagination a.active {
        background-color: #007bff;
        color: white;
    }

    .pagination a:hover:not(.active) {
        background-color: #f2f2f2;
    }

    @media screen and (max-width: 768px) {
        table {
            font-size: 14px;
        }
    }
</style>
<link href="output.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="mb-4">
        <form method="post">
        <select id="course_name" class="mb-2">
            <option value="">Select Course</option>
            <?php foreach($courses as $id => $name): ?>
                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
            <?php endforeach; ?>
        </select>
        </form>
        </div>
       <table>
        <thead>
        <tr>
            <th>Work</th>
            <th>Marks Gain</th>
            <th>Total Marks</th>
        </tr>
        </thead>
        <tbody id="marks_table">

        </tbody>
        
       </table> 
       <table class="mt-3">
        <thead>
        <tr>
            <th>Marks Gain</th>
            <th>Total Marks</th>
            <th>Grade</th>
            <th>Marks Progress</th>
        </tr>
        </thead>
        <tbody id="total_table">

        </tbody>
       </table>

       <div class="pagination">
          
       </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function loadmarks(courseid, page) {
    $.ajax({
        url: "viewstdgrade.php",
        type: "POST",
        data: {
            courseid: courseid,
            page: page
        },
        dataType: 'JSON',
        success: function(response) {
            $('#marks_table').html(response.marks_data);
            $('#total_table').html(response.grade_data);
            $('.pagination').html(response.pagination);
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    });
}
        $(document).ready(function(){
        $('#course_name').change(function(){
        var courseid = $('#course_name').val();
        $('#total_table').html("");
        $('#marks_table').html("");
        $('.pagination').html("");
        if(courseid != ''){
            console.log(courseid);
            loadmarks(courseid,1);
        }
    });

    });

    
</script>
</body>
</html>
