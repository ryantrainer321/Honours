<?php
include "db.php";


if(isset($_POST['submit']))
{

// get size of array//
    for ($x = 1; $x <= 40 ; $x++)
    {
        $studentID = $_POST["studentID"][$x];
        $classID = $_POST["classID"][$x];
        $attended = $_POST["attendance_status"][$x];

        //echo $studentID;
       // echo $classID;
        //echo $attended;
$query = "UPDATE class_enrolment SET Attended = '$attended' WHERE Student_id = '$studentID' AND Class_id = '$classID'";
//echo $query;
        $success = mysqli_query($con, $query);



    }

    if ($success) {
        header("refresh:1;url=dashboard.php");
        echo '<script type="text/javascript">alert("Entry has been added successfully!");</script>';

    }
    else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }












}
?>
