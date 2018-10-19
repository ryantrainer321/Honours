<html>
<form action="submitAttendance.php" method="post">
    <?php
    require('db.php');
    $searchCode = $_POST["pickedModule"];
    $query = mysqli_query($con,"select * from enrollment where module_code = '$searchCode'");
    ?>
    <table border="3">
        <tbody>
        <tr>
            <td></td>
            <td>Student Name</td>

            <td>Student ID</td>
            <td>Attendance</td>
        </tr>


        <?php
        $counter = 1;
        while ($row = mysqli_fetch_array($query)) {
            $counter++;
           echo "<tr>";
           echo "<td></td>";
           echo "<td><input type='hidden' name='studentname[]' />" .$row['student_name']."</td>";
           echo "<td><input type='hidden' name='studentID[]'/>" .$row['student_id']."</td>";
           echo "<td><label for='present'><input type='radio' id='present' name='attendance_status[$counter]' value='Present'> Present</label>";
           echo "<td><label for='absent'><input type='radio' id='absent' name='attendance_status[$counter]' value='absent'> Absent</label>";
        echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <br/>
    <input type="submit" name="submit" value="Mark Attendance" />
    <p><a href="index.php">Home</a></p>
</form>
</html>

