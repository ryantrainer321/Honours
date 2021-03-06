<?php
//include auth.php file on all secure pages
include("auth.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>At risk students</title>
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
            <li><a href="attendance.php"> Take attendance</a></li>
            <li class="active"><a href="atRiskStudents.php"> Show at risk students</a></li>
            <li ><a href="createRule.php"> Create Rule</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>
<div class="container text-center">
    <h1>At risk students</h1>
</div>

<form method="post" action="atRiskStudents.php">

    <div class="form-group text-center">
        <label for="title">Select Module:</label>
        <select name="module" class="form-row ">
            <option value="">--- Select Module ---</option>
            <?php
            require('db_config.php');
            $sql = "select * from modules";
            $result = $mysqli->query($sql);
            while($row = $result->fetch_assoc()){
                echo "<option value='".$row['Code']."'>".$row['module_Name']."</option>";
            }
            ?>
        </select>

        <label for="title">Select how many sessions missed:</label>
        <select name="rule" class="form-row" >
            <option value="">--- Select Amount ---</option>
            <option> 1 </option>
            <option> 2 </option>
            <option> 3 </option>
            <option> 4 </option>
            <option> 5 </option>
            <option> 6 </option>
            <option> 7 </option>
            <option> 8 </option>
            <option> 9 </option>
            <option> 10 </option>
            <option> 11 </option>
            <option> 12 </option>
        </select>

    </div>
    <div class = "text-center">
    <button type="submit" class="btn btn-success">Show class list</button>
        </div>
    <br/>
    </div>


</form>


        <form action="atRiskStudents.php" method="post">
            <?php
            require('db.php');
            $sel_year= $_POST['module'];
            $rule= $_POST['rule'];

           // $success = mysqli_query($con, $rule);
           $query = mysqli_query($con,"select * from at_risk_students where module = '$sel_year ' and number_of_classes_not_attended >= '$rule'");



            ?>
            <div class="container">
                <table class="table table-hover">
                <tbody>
                <tr>
                    <td>Student Count</td>
                    <td>Student Code</td>
                    <td>Module Code</td>
                    <td>Number of sessions missed</td>
                </tr>



                <?php
                $count = 0;
                while ($row = mysqli_fetch_array($query)) {

                    $sID = $row['student_id'];
                    $cID = $row['number_of_classes_not_attended'];
                    $mID = $row['module'];

                    $count++;
                    echo "<tr>";
                    echo "<td><input type='hidden' name='count[$count]' value = '$count' />".$count."</td>";
                    echo "<td><input type='hidden' name='studentID[$count]' value ='$sID' /> " .$row['student_id']."</td>";
                    echo "<td><input type='hidden' name='moduleID[$count]' value ='$mID' /> " .$row['module']."</td>";
                    echo "<td><input type='hidden' name='numberID[$count]' value = '$cID' />" .$row['number_of_classes_not_attended']."</td>";
                    echo "<td><input type='button' name='showClasses' value = 'Show classes' data-toggle='modal' data-target='#classModal'></td>";
                    echo "<td><input type='button' name='sendMail' value = 'Send Mail' data-toggle='modal' data-target='#mailModal'></td>";
                    echo "</tr>";
                }

                ?>
                </tbody>
            </table>
            </div>

        </form>



<div class="modal fade" id="mailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>