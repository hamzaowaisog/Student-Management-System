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

$user_id = $_SESSION['id'];
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
       <table>
        <thead>
        <tr>
            <th>Course Name</th>
            <th>Course Code</th>
            <th>Teacher</th>
            <th>Credit Hours</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="course_table">

        </tbody>
        
       </table> 

       <div class="pagination">
          
       </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function loadcourse(page) {
    $.ajax({
        url: "loadcoursesstd.php",
        type: "POST",
        data: {
            page: page
        },
        dataType: 'JSON',
        success: function(response) {
            $('#course_table').html(response.course_data);
            $('.pagination').html(response.pagination);
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
            console.error(xhr);
        }
    });
}

    function saveregister(courseid,event){
        var teacher_id = $('#teachername_'+courseid).val();
        event.preventDefault();
        $.ajax({
            url: "saveregister.php",
            type: "POST",
            data: {
                course_id: courseid,
                teacher_id: teacher_id,
                userid : <?php echo $user_id; ?>
            },
            success:function(response){
                alert(response);
                $('#btn_'+courseid).text('Registered');
                $('#btn_'+courseid).attr('disabled', true);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
                console.log(xhr);
            }
        })
        
        
    }
        
        $(document).ready(function(){
    $('.pagination').on('click', 'a', function(e) {
        e.preventDefault();
        var page = $(this).text();
        loadcourse(page); 
    });
    loadcourse(1);

    });

    
</script>
</body>
</html>
