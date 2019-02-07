<?php
//include auth.php file on all secure pages
include("auth.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>At risk students</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
    <p>Welcome <?php echo $_SESSION['username']; ?>!</p>
    <p>This is the at risk students area.</p>
    <p><a href="dashboard.php">Dashboard</a></p>
    <a href="logout.php">Logout</a>
</div>

<form method="post" action="atRiskStudents.php">

    <div class="form-group">
        <label for="title">Select Module:</label>
        <select name="module" class="form-control" style="width:350px">
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
    <input type="submit" name="submit" value="Show class list" />
</form>


        <form action="atRiskStudents.php" method="post">
            <?php
            require('db.php');
            $sel_year= $_POST['module'];
            $rule = mysqli_query( $con,"select rule from modules where Code = '$sel_year'");

            $query = mysqli_query($con,"select * from at_risk_students where module = '$sel_year ' and '$rule' > number_of_classes_not_attended");

            ?>
            <table border="3">
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
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>

            <br/>
            <p><a href="index.php">Home</a></p>
        </form>


</body>
</html>