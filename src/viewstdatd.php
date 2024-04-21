<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:index.php');
}
if($_SESSION['role']!=3){
    $_SESSION['role']=0;
    $_SESSION['role_id']=0;
    header('location:dashboard.php');
}
include_once("config.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $course_id = $_POST['courseid'];
    $user_id = $_SESSION['id'];
    $records_per_page = 10;
    $page = isset($_POST['page']) ? $_POST['page'] : 1;
    $offset = ($page - 1) * $records_per_page;

    $total_records_query = "SELECT COUNT(*) AS total_records FROM attendance where course_id='$course_id' and user_id ='$user_id'";
    $total_records_result = mysqli_query($link, $total_records_query);
    $total_records_row = mysqli_fetch_assoc($total_records_result);
    $total_records = $total_records_row['total_records'];

    $total_pages = ceil($total_records / $records_per_page);
    $sql = "SELECT * FROM attendance where course_id = '$course_id' and user_id = '$user_id' LIMIT $offset, $records_per_page";
    $result = mysqli_query($link, $sql);
    $grade_data = '';
    while($row = mysqli_fetch_assoc($result)){
        $grade_data .= "<tr>";
        $grade_data .= "<td>".$row['session_date']."</td>";
        $grade_data .= "<td>".$row['status']."</td>";
        $grade_data .= "</tr>";
    }

    $total_attend = "";

    $sql = "SELECT SUM(CASE WHEN status = 'Present' THEN 1 ELSE 0 END) AS session_attend, count(distinct Date(session_date)) AS total_session 
    FROM attendance where course_id = '$course_id' and user_id = '$user_id'";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_assoc($result)){
                $total_session = $row['total_session'];
                $session_attend = $row['session_attend'];
                $percentage = ($session_attend / $total_session) * 100;
        
                $total_attend .= "<tr>";
                $total_attend .= "<td>$total_session</td>";
                $total_attend .= "<td>$session_attend</td>";
                $total_attend .= "<td><div class='progress-bar' style='width: $percentage%;'>$percentage%</div></td>";
                $total_attend .= "</tr>";
    }
    
    $pagination = '';
    if ($page > 1) {
        $pagination .= '<a href="#" onclick="loadatd(' . $course_id . ', ' . ($page - 1) . ')">Previous</a>';
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        $pagination .= '<a href="#" onclick="loadatd(' . $course_id . ', ' . $i . ')"';
        if ($i == $page) $pagination .= 'class="active"';
        $pagination .= '>' . $i . '</a>';
    }
    if ($page < $total_pages) {
        $pagination .= '<a href="#" onclick="loadatd(' . $course_id . ', ' . ($page + 1) . ')">Next</a>';
    }

    echo json_encode(array('grade_data' => $grade_data, 'pagination' => $pagination, 'total_attend' => $total_attend));
}


?>