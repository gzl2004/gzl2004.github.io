<?php
if (isset($_COOKIE['phar'])) {
    $username = $_COOKIE['phar'];
} else {
    echo "<script>alert('Please login to access the dashboard.');</script>";
    echo "<script>window.location.href = 'login.php';</script>";
}
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Report Section</title>
        <link href="dashboardcss.css" rel="stylesheet" type="text/css"/>
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
        <div id="nav">
            <nav>
                <ul>
                    <li><a href="logout.php"><i class='bx bx-log-out' id="log_out"></i> Logout</a></li>
                </ul>
            </nav>                
        </div> 
        <iframe title="Report Section" width="100%" height="800" src="https://app.powerbi.com/view?r=eyJrIjoiMGNkYjRjNTUtNjcwNC00ZjdiLTkzMWQtMGEyNGQzYWQ2NzcwIiwidCI6IjdhODU3ZTA5LWQ5YWQtNDNkMi04OTNlLTMyMTVkZGRkM2EzYiIsImMiOjEwfQ%3D%3D" frameborder="0" allowFullScreen="true"></iframe>
    </body>
</html>
