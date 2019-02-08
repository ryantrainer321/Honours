<?php
//include auth.php file on all secure pages
include("auth.php");
?>
<!DOCTYPE html>

<html>
<head><meta charset="utf-8">
    <title>Take attendance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li><a href="dashboard.php"> Home </a></li>
            <li class="active"><a href="attendance.php"> Take attendance</a></li>
            <li ><a href="atRiskStudents.php"> Show at risk students</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>


<div class="container text-center">
    <h1>Take attendance</h1>
</div>

<div class="container">
    <div class="panel panel-default">
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
                <select name="class" class="form-control" >
                    <option value="">--- Module selection required ---</option>
                </select>
            </div>
                <br/>

                <input type="submit" name="submit" class=" btn btn-success" value="Show class list" />
            </form>

            <form action="submitAttendance.php" method="post">
                <?php
                require('db.php');
                $sel_year= $_POST['class'];
                $query = mysqli_query($con,"select * from class_enrolment where Class_id = '$sel_year ' ");

                ?>
                <br/>

                <div class="container">
                    <table class="table table-hover">
                    <tbody>
                    <tr>
                        <td></td>
                        <td>Student Count</td>
                        <td>Student Code</td>
                        <td>Module Code</td>
                        <td>Class Code</td>
                        <td>Attendance</td>
                        <td></td>
                        <td></td>
                    </tr>


                    <?php
                    $count = 0;
                    while ($row = mysqli_fetch_array($query)) {

                        $sID = $row['student_id'];
                        $cID = $row['class_id'];
                        $mID = $row['module_id'];

                        $count++;
                        echo "<tr>";
                        echo "<td></td>";
                        echo "<td><input type='hidden' name='count[$count]' value = '$count' />".$count."</td>";
                        echo "<td><input type='hidden' name='studentID[$count]' value ='$sID' /> " .$row['student_id']."</td>";
                        echo "<td><input type='hidden' name='moduleID[$count]' value ='$mID' /> " .$row['student_id']."</td>";
                        echo "<td><input type='hidden' name='classID[$count]' value = '$cID' />" .$row['class_id']."</td>";
                        echo "<td><label for='present'><input type='radio' id='present' name='attendance_status[$count]' value='1'> Present</label>";
                        echo "<td><label for='absent'><input type='radio' id='absent' name='attendance_status[$count]' value='0'> Absent</label>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>


                    <br/>
                <input type="submit" name="submit" class=" btn btn-success" value="Mark Attendance" />

            </form>
        </div>
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