<?php
if(!isset($_SESSION['username'])){
    header('Location: index.php');
    exit();
}
if($_SESSION['role_id'] != 1){
    $_SESSION['role_id']=0;
    header('Location: dashboard.php');

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="output.css" rel="stylesheet">
    <style>
        body {
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
    }
    </style>
</head>
<body>
    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-slate-200 p-8 rounded shadow-md">
            <h2 class="text-2xl font-bold mb-6">Add Course</h2>
            <form id="addcourse" method="post">
                <div class="mb-4">
                    <label for="course_code" class="block text-gray-700 font-bold mb-2">Course Code:</label>
                    <input type="text" id="course_code" name="course_code" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="course_name" class="block text-gray-700 font-bold mb-2">Course Name:</label>
                    <input type="text" id="course_name" name="course_name" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="course_credit" class="block text-gray-700 font-bold mb-2">Course Credit:</label>
                    <input type="number" id="course_credit" name="course_credit" class="w-full px-3 py-2 border rounded-md" min="0" max="3" required>
                </div>
                <div class="mb-4">
                    <label for="class_room" class="block text-gray-700 font-bold mb-2">Class room:</label>
                    <input type="text" id="class_room" name="class_room" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Add Course</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#addcourse').submit(function(event) {
                event.preventDefault();
                var course_code = $('#course_code').val();
                var course_name = $('#course_name').val();
                var course_credit = $('#course_credit').val();
                var class_room =$('#class_room').val();
                $.ajax({
                    url: 'addcourse_action.php',
                    method: 'POST',
                    data: {
                        course_code: course_code,
                        course_name: course_name,
                        course_credit: course_credit,
                        class_room :class_room,
                    },
                    success: function(response) {
                        alert(response);
                       location.reload(); 
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', status, error);
                    }
                });
            });
        });
    </script>
</body>
</html>
