<?php
// Enter your Host, username, password, database below.
$con = mysqli_connect("localhost","root","root","Attendance_Management");
// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>


