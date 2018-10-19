<?php
require('db.php');
if(isset($_POST['submit']))
{
    foreach ($_POST['attendance_status'] as $id => $attendance_status)
    {
        $roll_no = $_POST['roll_no'][$id];
        $student_name = $_POST['student_name'][$id];
        $date_created = date('Y-m-d H:i:s');
        $date_modified = date('Y-m-d H:i:s');

        $attendance = $con->prepare("INSERT INTO attendance (roll_no, student_name, date_created, date_modified, attendance_status) VALUES (?, ?, ?, ?, ?)");
        $attendance->bind_param("issss", $roll_no, $student_name, $date_created, $date_modified, $attendance_status);
        $attendance->execute();
    }

    if ($con->affected_rows==1) {
        $msg = "Attendance has been added successfully";
    }
}
