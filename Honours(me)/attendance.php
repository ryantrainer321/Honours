<?php
require('db.php');
include("auth.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Attendance</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
    <p>attendance</p>

    <p><a href="index.php">Home</a></p>

    <a href="logout.php">Logout</a>
</div>

<form action='modulePicker.php' method=post>
    <select name="pickedModule">

        <?php
        $request = mysqli_query($con,"select * from modules order by Code asc");
        while ($row=mysqli_fetch_array($request)) {
            ?>


            <option> <?php echo $row["Code"];?></option>

            <?php

        }
        ?>

    </select>



    <input type=submit>


</form>












</body>
</html>