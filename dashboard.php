<?php
require('db.php');
include("auth.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Secured Page</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>



<div class="form">
    <p>Dashboard</p>

    <p><a href="index.php">Home</a></p>

    <a href="logout.php">Logout</a>
</div>

<div id='navigationButtons'>
<button class="btn allModules" onclick="location.href = 'allModules.php';">All modules</button>
<button class="btn newModule" onclick="location.href = 'newModule.php';">Add a new module</button>
<button class="btn atRiskStudents" onclick="location.href = 'atRiskStudents.php';">Show at risk students</button>
    <button class="btn takeAttendance" onclick="location.href = 'attendance.php';">Take attendance </button>
</div>




</body>
</html>