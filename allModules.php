<?php
//include auth.php file on all secure pages
include("auth.php");
require('db.php');
$result = mysqli_query($con,"SELECT * FROM modules");
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>All Modules</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
    <p>Welcome <?php echo $_SESSION['username']; ?>!</p>
    <p>This is the all modules area.</p>
    <p><a href="dashboard.php">Dashboard</a></p>
    <a href="logout.php">Logout</a>
</div>

