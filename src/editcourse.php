<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
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

$sql = "SELECT * FROM courses LIMIT $offset, $records_per_page";
$result = mysqli_query($link, $sql);

$total_records_query = "SELECT COUNT(*) AS total_records FROM courses";
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
    <title>Unconfirmed Signups</title>
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
            <th>Course Code</th>
            <th>Course Name</th>
            <th>Class Room</th>
            <th>Credit Hours</th>
            <th>Action</th>
        </tr>
        <?php
        while($row = mysqli_fetch_array($result)) {
            echo "<form>";
            echo "<tr>";
            echo "<td><input type='text' id='course_code' name='course_code' value='" . $row['course_code'] . "'></td>";
            echo "<td><input type='text' id='course_name' name='course_name' value='" . $row['course_name'] . "'></td>";
            echo "<td><input type='text' id='class_room' name='class_room' value='" . $row['class_room'] . "'></td>";
            echo "<td><input type='number' id='credit_hour' name='credit_hours' min='0' max='3' value='" . $row['Credit_hours'] . "'></td>";
            echo "<td class='action-links'>";
            echo "<button type='button'class='bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600' onclick='EditCourse(".$row['course_id'].")'>Edit</button>";
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
                url: 'editcourse.php?page='+page,
                type: 'GET',
                data: {page: page},
                success: function(response) {
                    $('.container').html(response);
                }
            });
        }

        function EditCourse(course_id){
                var course_code = $('#course_code').val();
                var course_name = $('#course_name').val();
                var class_room = $('#class_room').val();
                var credit_hour = $('#credit_hour').val();
            $.ajax({
                url:"edit_course.php",
                type:"POST",
                data:{course_id:course_id,
                      course_code:course_code,
                      course_name:course_name,
                      class_room:class_room,
                      credit_hour:credit_hour},
                success:function(response){
                    alert(response);
                    location.reload();

                },

            });

        }
    </script>
</body>
</html>