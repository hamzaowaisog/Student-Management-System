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
    $records_per_page = 10;
    $page = isset($_POST['page']) ? $_POST['page'] : 1;
    $offset = ($page - 1) * $records_per_page;

    $user_id = $_SESSION['id'];

    $total_records_query = "SELECT COUNT(*) AS total_records FROM courses";
    $total_records_result = mysqli_query($link, $total_records_query);
    $total_records_row = mysqli_fetch_assoc($total_records_result);
    $total_records = $total_records_row['total_records'];

    $total_pages = ceil($total_records / $records_per_page);
    $grade_data = '';

$sql = "SELECT * FROM courses where course_id not in ( SELECT course_id from course_enrollment where user_id = '$user_id' ) limit $offset, $records_per_page ";
$result = mysqli_query($link, $sql);
$course_data="";
while($row = $result -> fetch_assoc()){
    $course_id = $row['course_id'];
    $course_code = $row['course_code'];
    $course_name = $row['course_name'];
    $credit_hours = $row['Credit_hours'];
    $course_data.= "<tr>
            <td id='course_id_".$course_id."'>".$course_name."</td>
            <td>".$course_code."</td>
            <td><select id='teachername_".$course_id."'>
            <option value=''>Select Teacher</option>";

    $sql1 = "Select * from course_instructors where course_id = '$course_id'";
    $result1 = mysqli_query($link, $sql1);
    while($row2 = $result1 -> fetch_assoc()){
        $teacher_id = $row2['user_id'];
        $sql2 = "Select * from users where user_id = '$teacher_id'";
        $result2 = mysqli_query($link, $sql2);
        while($row3 = $result2 -> fetch_assoc()){
            // $teacher_name =$row3['fullname'];
            $course_data.="<option value='".$row3['user_id']."'>".$row3['fullname']."</option>";;    
        }
    } 
    $course_data.="
    </select></td>
    <td>".$credit_hours."</td>
    <td><button class='bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600' onclick='saveregister(".$course_id.", event)' id='btn_".$course_id."'>Register</button></td>
    </tr>";

}
$pagination = '';
if ($page > 1) {
    $pagination .= '<a href="#" onclick="loadcourse(' . ($page - 1) . ')">Previous</a>';
}
for ($i = 1; $i <= $total_pages; $i++) {
    $pagination .= '<a href="#" onclick="loadcourse(' . $i . ')"';
    if ($i == $page) $pagination .= ' class="active"';
    $pagination .= '>' . $i . '</a>';
}
if ($page < $total_pages) {
    $pagination .= '<a href="#" onclick="loadcourse(' . ($page + 1) . ')">Next</a>';
}

echo json_encode(array('course_data' => $course_data, 'pagination' => $pagination));


?>