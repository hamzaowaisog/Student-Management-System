<?php
session_start();

if(!isset($_SESSION['username'])){
    header('Location: index.php');
    exit();
}
if($_SESSION['role_id'] != 1){
    $_SESSION['role_id']=0;
    header('Location: dashboard.php');
}

include_once("config.php");
$total_marks = 0;
$marks_gained = 0;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $course_id = $_POST['courseid'];
    $teacher_id = $_POST['teacherid'];
    $sql = "SELECT user_id,SUM(marks) AS total_marks_gained, SUM(Total_marks) AS total_marks 
    FROM grades where course_id = '$course_id'
    GROUP BY user_id, course_id";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $sql2 = "SELECT * FROM users WHERE user_id = $row[user_id]";
        $result2 = mysqli_query($link, $sql2);
        while($row2 = mysqli_fetch_assoc($result2)){
                $student_name = $row2['fullname'];
                $roll_number = $row2['roll_number'];
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
        
                echo "<tr>";
                echo "<td>$student_name</td>";
                echo "<td>$roll_number</td>";
                echo "<td>$marks_gained</td>";
                echo "<td>$total_marks</td>";
                echo "<td>$grade</td>";
                echo "<td><div class='progress-bar' style='width: $percentage%;'>$percentage%</div></td>";
                echo "</tr>";
        }
       

    }
}

?>