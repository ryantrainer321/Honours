<?php
include "db.php";


if(isset($_POST['submit']))
{
    $count = $_POST["count"];
    $result = sizeof($count);



// get size of array//
    for ($x = 1; $x <= $result ; $x++)
    {
        $studentID = $_POST["studentID"][$x];
        $moduleID = $_POST["moduleID"][$x];
        $classID = $_POST["classID"][$x];
        $attended = $_POST["attendance_status"][$x];



        if ($attended == '0') {
            $query1 = "UPDATE at_risk_students SET number_of_classes_not_attended = number_of_classes_not_attended + 1 WHERE student_id = '$studentID' AND module = '$moduleID'";

           // echo $query1;
            //echo $attended;
           // echo $result;

        }

        if ($attended == '1') {
            $query = "UPDATE class_enrolment SET attended = 1 WHERE student_id = '$studentID' AND class_id = '$classID'";

        }
        $success1 = mysqli_query($con, $query);
        $success2 = mysqli_query($con, $query1);



    }

   if ($success1) {
       header("refresh:1;url=dashboard.php");
        echo '<script type="text/javascript">alert("Entry has been added successfully!");</script>';

    }
   else if ($success2) {
       header("refresh:1;url=dashboard.php");
       echo '<script type="text/javascript">alert("Entry has been added successfully!");</script>';


    }
    else {
        echo "Error: " . $sql . "<br>" . $con->error;

    }












}
?>
