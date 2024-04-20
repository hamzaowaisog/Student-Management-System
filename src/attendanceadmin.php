<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
    exit();
}
if($_SESSION['role_id'] != 1){
    $_SESSION['role_id']=0;
    $_SESSION['role']=0;
    header('Location: dashboard.php');
}
include_once("config.php");

$sql = "SELECT * from users where roll_number like '%t%'";
$result = mysqli_query($link, $sql);
$teachers = array();

while($row = mysqli_fetch_assoc($result)){
    $teachers[$row['user_id']] = $row['fullname'];
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

</head>
<body>
    <div class="container">
        <div class="mb-4">
        <form method="post">
        <select id="teacher_name" class="mb-2">
            <option value="">Select Teacher</option>
            <?php foreach($teachers as $id => $name): ?>
                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
            <?php endforeach; ?>
        </select>
        </form>
        <select id="course_name" class="d-none">
        </select>
        </div>
       <table>
        <thead>
        <tr>
            <th>Student Name</th>
            <th>Roll Number</th>
            <th>Total Classes</th>
            <th>Total Present</th>
            <th>Attendance Progress</th>
        </tr>
        </thead>
        <tbody id="grades_table">

        </tbody>
        
       </table> 

       <div class="pagination">
          
       </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function loadattendance(teacherid, courseid, page) {
        $.ajax({
            url: "loadattendadmin.php",
            type: "POST",
            data: {
                teacherid: teacherid,
                courseid: courseid,
                page: page
            },
            dataType: 'JSON',
            success: function(response) {
                $('#grades_table').html(response.grade_data);
                $('.pagination').html(response.pagination);
            }
        });
        }

        $(document).ready(function(){
            
        function loadcoursesByteacher(teacherid){
            $.ajax({
                url: "loadcoursesbyteacher.php",
                type: "POST",
                data: {teacherid: teacherid},
                success: function(response){
                    $('#course_name').removeClass('d-none');
                    $('#course_name').html(response);
                }
            });
        }

        $('#teacher_name').change(function(){
            $('#grades_table').html("");
            $('.pagination').html("");
            var selectedteacherid = $(this).val();
            if(selectedteacherid != ''){
                loadcoursesByteacher(selectedteacherid);
            }
            else{
                $('#course_name').addClass('d-none');
            }

        });

        $('#course_name').change(function(){
        var teacherid = $('#teacher_name').val();
        var courseid = $(this).val();
        $('#grades_table').html("");
        $('.pagination').html("");
        if(courseid != ''){
            console.log(teacherid);
            console.log(courseid);
            loadattendance(teacherid,courseid,1);
        }
    });
    $('.pagination').on('click', 'a', function(e) {
        e.preventDefault();
        var teacherid = $('#teacher_name').val();
        var courseid = $('#course_name').val();
        var page = $(this).text();
        loadattendance(teacherid, courseid, page); 
    });

    });

    
</script>
</body>
</html>
