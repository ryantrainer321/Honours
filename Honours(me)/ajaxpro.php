<?php

require('db_config.php');

$moduleCode = $_POST['id'];
$sql = "SELECT * FROM classes WHERE Module_code LIKE '%".$moduleCode."%'";
$classCode = "SELECT Class_id FROM classes WHERE Module_code LIKE '%".$moduleCode."%'";

$result = $mysqli->query($sql);
$result1 = $mysqli->query($classCode);

$json = [];
while($row = $result->fetch_assoc()){
    $json[$row['id']] = $row['Name'];
}

echo json_encode($json);
?>




