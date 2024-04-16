<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body class="">
    <header>
    <?php include('header.php'); ?>
    </header>
    <div class="flex flex-wrap">
        <aside class="w-64">
            <?php include('sidebar.php'); ?>
        </aside>
        <main class="mt-4 flex-1 ms-4">
            <div id="main-content" class=""></div>
        </main>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
    $('.sidebar-link').click(function(event) {
        event.preventDefault();
        var url = $(this).data('url');
        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                $('#main-content').html(response);
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