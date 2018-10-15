<?php
require('db.php');
$searchCode = $_POST["pickedModule"];

$query1 = mysqli_query($con, "select student_id from enrollment where module_code = '$searchCode'");

while ($printModuleList=mysqli_fetch_array($query1))
{
echo $printModuleList['student_id'];
}
?>

