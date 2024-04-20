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
$records_per_page = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

$sql = "SELECT * FROM instructor_schedule LIMIT $offset, $records_per_page";
$result = mysqli_query($link, $sql);

$total_records_query = "SELECT COUNT(*) AS total_records FROM instructor_schedule";
$total_records_result = mysqli_query($link, $total_records_query);
$total_records_row = mysqli_fetch_assoc($total_records_result);
$total_records = $total_records_row['total_records'];

$total_pages = ceil($total_records / $records_per_page);


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
       <table>
        <tr>
            <th>Course Name</th>
            <th>Teacher Name</th>
            <th>Class Room</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Days</th>
            <th>Action</th>
        </tr>
        <?php
        while($row = mysqli_fetch_array($result)) {
            $sql1 = "Select course_name from courses where course_id = {$row['course_id']}";
            $result1 = mysqli_query($link, $sql1);
            $row1 = mysqli_fetch_array($result1);
            $sql2 = "Select * from users where user_id = {$row['course_instructor_id']}";
            $result2 = mysqli_query($link, $sql2);
            $row2 = mysqli_fetch_array($result2);
            echo "<form>";
            echo "<tr>";
            echo "<td><input type='text' class='course_name' name='course_name' value='" . $row1['course_name'] . "' disabled></td>";
            echo "<input type='hidden' class='course_id' name='course_id' value='" . $row['course_id'] . "'>";
            echo "<input type='hidden' class='teacher_id' name='teacher_id' value='". $row['course_instructor_id'] . "'>";
            echo "<td><input type='text' class='teacher_name' name='teacher_name' value='". $row2['fullname'] . "' disabled></td>";
            echo "<td><input type='text' class='class_room' name='class_room' value='". $row['class_room'] . "' disabled></td>";
            echo "<td><input type='time' class='start_time' name='start_time' value='". $row['start_time'] . "' disabled></td>";
            echo "<td><input type='time' class='end_time' name='end_time' value='". $row['end_time'] . "' disabled></td>";
            echo "<td><input type='text' class='days' name='days' value='". $row['day_of_week'] . "' disabled></td>";
            echo "<td class='action-links'>";
            echo "<button type='button'class='bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600' onclick='DeleteSchedule(this)' data-schedule-id='". $row['schedule_id']. "'>Delete</button>";
            echo "</td>";
            echo "</tr>";
            echo "</form>";
            }
        ?>
       </table> 

       <div class="pagination">
           <?php if ($page > 1): ?>
                <a href="#" onclick="loadPage(<?php echo $page - 1; ?>)">Previous</a>
            <?php endif; ?>
            
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="#" onclick="loadPage(<?php echo $i; ?>)" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
            <?php endfor; ?>
            
            <?php if ($page < $total_pages): ?>
                <a href="#" onclick="loadPage(<?php echo $page + 1; ?>)">Next</a>
            <?php endif; ?>
       </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function loadPage(page) {
            $.ajax({
                url: 'manage_schedule.php?page='+page,
                type: 'GET',
                data: {page: page},
                success: function(response) {
                    $('.container').html(response);
                }
            });
        }

        function DeleteSchedule(button){
            var schedule_id = $(button).data('schedule-id');
            var row = $(button).closest('tr');
            var schedule_id = $(button).data('schedule-id');
            var course_name = row.find('.course_name').val();
            var course_id = row.find('.course_id').val();
            var teacher_id = row.find('.teacher_id').val();
            var class_room = row.find('.class_room').val();
            var start_time = row.find('.start_time').val();
            var end_time = row.find('.end_time').val();
            var days = row.find('.days').val();
            $.ajax({
                url:'delete_schedule.php',
                type:'POST',
                data:{course_id:course_id,
                        teacher_id:teacher_id,
                        schedule_id:schedule_id
                      },
                success:function(response){
                    alert(response);
                    console.log(response);
                    location.reload();
                },

            });
            
            
        }
    </script>
</body>
</html>
