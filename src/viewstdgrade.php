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
$total_marks = 0;
$marks_gained = 0;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $course_id = $_POST['courseid'];
    $user_id = $_SESSION['id'];
    
    $records_per_page = 10;
    $page = isset($_POST['page']) ? $_POST['page'] : 1;
    $offset = ($page - 1) * $records_per_page;

    $total_records_query = "SELECT COUNT(*) AS total_records FROM grades where course_id='$course_id' and user_id = '$user_id'";
    $total_records_result = mysqli_query($link, $total_records_query);
    $total_records_row = mysqli_fetch_assoc($total_records_result);
    $total_records = $total_records_row['total_records'];

    $total_pages = ceil($total_records / $records_per_page);
    $grade_data = '';
    $sql = "SELECT user_id,SUM(marks) AS total_marks_gained, SUM(Total_marks) AS total_marks 
    FROM grades where course_id = '$course_id' and user_id = '$user_id'";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_assoc($result)){
                $total_marks = $row['total_marks'];
                $marks_gained = $row['total_marks_gained'];
                $percentage = ($marks_gained / $total_marks) * 100;
                $grade = '';
                if ($percentage >= 90) {
                $grade = 'A+';
                } elseif ($percentage >= 80) {
                $grade = 'A';
                } elseif ($percentage >= 70) {
                $grade = 'B';
                } elseif ($percentage >= 60) {
                $grade = 'C';
                } elseif ($percentage >= 50) {
                $grade = 'D';
                } else {
                $grade = 'F';
                }


        
                $grade_data .= "<tr>";
                $grade_data .= "<td>$marks_gained</td>";
                $grade_data .= "<td>$total_marks</td>";
                $grade_data .= "<td>$grade</td>";
                $grade_data .= "<td><div class='progress-bar' style='width: $percentage%;'>$percentage%</div></td>";
                $grade_data .= "</tr>";
    }
    
    $pagination = '';
    if ($page > 1) {
        $pagination .= '<a href="#" onclick="loadmarks(' . $course_id . ', ' . ($page - 1) . ')">Previous</a>';
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        $pagination .= '<a href="#" onclick="loadmarks(' . $course_id . ', ' . ($i) . ')"';
        if ($i == $page) $pagination .= 'class="active"';
        $pagination .= '>' . $i . '</a>';
    }
    if ($page < $total_pages) {
        $pagination .= '<a href="#" onclick="loadmarks(' . $course_id . ', ' . ($page + 1) . ')">Next</a>';
    }

    $sql = "Select * from grades where user_id = '$user_id' and course_id = '$course_id' limit $offset, $records_per_page";
    $result = mysqli_query($link, $sql);
    $marks_data = '';
    while($row = mysqli_fetch_assoc($result)){
        $marks_data .= "<tr>";
        $marks_data .= "<td>".$row['assignment_type']."</td>";
        $marks_data .= "<td>".$row['marks']."</td>";
        $marks_data .= "<td>".$row['Total_marks']."</td>";
        $marks_data .= "</tr>";
    }

    echo json_encode(array('grade_data' => $grade_data, 'pagination' => $pagination, 'marks_data' => $marks_data));
}
?>
