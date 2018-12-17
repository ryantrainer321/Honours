<?php
//include auth.php file on all secure pages
include("auth.php");
?>
<!DOCTYPE html>

<html>
<head>
    <title>Select Class</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
</head>
<body>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Select Class</div>
        <div class="panel-body">
            <div class="form-group">
                <label for="title">Select Module:</label>
                <select name="module" class="form-control">
                    <option value="">--- Select Module ---</option>

                    <?php
                    require('db_config.php');
                    $sql = "SELECT * FROM modules";
                    $result = $mysqli->query($sql);
                    while($row = $result->fetch_assoc()){
                        echo "<option value='".$row['Code']."'>".$row['module_Name']."</option>";
                    }
                    ?>

                </select>
            </div>

            <form method="post" action="attendance.php">

            <div class="form-group">
                <label for="title">Select Class:</label>
                <select name="class" class="form-control" style="width:350px">
                </select>
            </div>
                <input type="submit" name="submit" value="Mark Attendance" />
            </form>
            <form action="submitAttendance.php" method="post">
                <?php
                require('db.php');
                $sel_year= $_POST['class'];
                $query = mysqli_query($con,"select * from class_enrolment where Class_id = '$sel_year ' ");

                ?>
                <table border="3">
                    <tbody>
                    <tr>
                        <td></td>
                        <td>Student Code</td>
                        <td>Class Code</td>
                        <td>Attendance</td>
                        <td></td>
                        <td></td>
                    </tr>


                    <?php
                    $counter = 0;
                    while ($row = mysqli_fetch_array($query)) {

                        $sID = $row['Student_id'];
                        $cID = $row['Class_id'];

                        $counter++;
                        echo "<tr>";
                        echo "<td></td>";
                        echo "<td><input type='hidden' name='studentID[$counter]' value ='$sID' /> " .$row['Student_id']."</td>";
                        echo "<td><input type='hidden' name='classID[$counter]' value = '$cID' />" .$row['Class_id']."</td>";
                        echo "<td><label for='present'><input type='radio' id='present' name='attendance_status[$counter]' value='1'> Present</label>";
                        echo "<td><label for='absent'><input type='radio' id='absent' name='attendance_status[$counter]' value='0'> Absent</label>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>

                <br/>
                <input type="submit" name="submit" value="Mark Attendance" />
                <p><a href="index.php">Home</a></p>
            </form>

        </div>
    </div>
</div>




<script>
    $( "select[name='module']" ).change(function () {
        var moduleID = $(this).val();

        if(moduleID) {

            $.ajax({
                type: "POST",
                url: "ajaxpro.php",
                dataType: 'Json',
                data: {'id':moduleID},
                success: function(data) {
                    $('select[name="class"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="class"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                }
            });

        }else{
            $('select[name="class"]').empty();
        }
    });


</script>

</body>
</html>