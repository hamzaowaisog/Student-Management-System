<?php
session_start();

if(!isset($_SESSION['username'])){
    header('Location: index.php');
    exit();
}
if($_SESSION['role_id'] != 2){
    $_SESSION['role_id']=0;
    $_SESSION['role']=0;
    header('Location: dashboard.php');
}

include_once("config.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $course_id = $_POST['courseid'];
    $teacher_id = $_SESSION['id'];
    $records_per_page = 10;
    $page = isset($_POST['page']) ? $_POST['page'] : 1;
    $offset = ($page - 1) * $records_per_page;

    $total_records_query = "SELECT COUNT(*) AS total_records FROM course_enrollment where course_id='$course_id' and teacher_id = '$teacher_id' ";
    $total_records_result = mysqli_query($link, $total_records_query);
    $total_records_row = mysqli_fetch_assoc($total_records_result);
    $total_records = $total_records_row['total_records'];

    $total_pages = ceil($total_records / $records_per_page);
    $sql = "SELECT * FROM course_enrollment where course_id = '$course_id' and teacher_id = '$teacher_id' LIMIT $offset, $records_per_page";
    $result = mysqli_query($link, $sql);
    $grade_data = '';
    while($row = mysqli_fetch_assoc($result)){
        $sql2 = "SELECT * FROM users WHERE user_id = $row[user_id]";
        $result2 = mysqli_query($link, $sql2);
        while($row2 = mysqli_fetch_assoc($result2)){
                $student_name = $row2['fullname'];
                $roll_number = $row2['roll_number'];
               
                $grade_data .= "<tr>";
                $grade_data .= "<td>$student_name</td>";
                $grade_data .= "<td>$roll_number</td>";
                $grade_data .= "<td><input type='text' id='type_".$row['user_id']."'></td>";
                $grade_data .= "<td><input type='number' min='0' max='100' id='marks_".$row['user_id']."'></td>"; 
                $grade_data .= "<td><input type='number' min='0' max='100' id='totalmarks_".$row['user_id']."'></td>"; 
                $grade_data .= "<td><button class='bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600' onclick='savegrade(\"".$row['user_id']."\", \"$course_id\")' id='btn".$row['user_id']."'>Save</button></td>";
                $grade_data .= "</tr>";
                
        }
    }
    
    $pagination = '';
    if ($page > 1) {
        $pagination .= '<a href="#" onclick="loadstudent(' . $course_id . ', ' . ($page - 1) . ')">Previous</a>';
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        $pagination .= '<a href="#" onclick="loadstudent(' . $course_id . ', ' . $i . ')"';
        if ($i == $page) $pagination .= 'class="active"';
        $pagination .= '>' . $i . '</a>';
    }
    if ($page < $total_pages) {
        $pagination .= '<a href="#" onclick="loadstudent(' . $course_id . ', ' . ($page + 1) . ')">Next</a>';
    }

    echo json_encode(array('grade_data' => $grade_data, 'pagination' => $pagination));
}
?>
