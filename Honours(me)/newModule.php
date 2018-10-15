<?php
//include auth.php file on all secure pages
include("auth.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Module</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
    <p>Welcome <?php echo $_SESSION['username']; ?>!</p>
    <p>This is the add new modules area.</p>
    <p><a href="dashboard.php">Dashboard</a></p>
    <a href="logout.php">Logout</a>
</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
require('db.php');
include("auth.php");

if (isset($_REQUEST['moduleName'])){
    // removes backslashes
    $moduleName = stripslashes($_REQUEST['moduleName']);
    //escapes special characters in a string
    $moduleName = mysqli_real_escape_string($con,$moduleName);
    $moduleCode = stripslashes($_REQUEST['moduleCode']);
    $moduleCode = mysqli_real_escape_string($con,$moduleCode);

    $query = "INSERT into `modules` (module_Name, Code)
VALUES ('$moduleName','$moduleCode')";
    $result = mysqli_query($con,$query);
    if($result){
        echo "<div class='form'>
<h3>You are registered successfully.</h3>
<br/>Click here to <a href='dashboard.php'>Return home</a></div>";

    }
}else{
    ?>
    <div class="form">
        <h1>Add a new module</h1>
        <form name="registration" action="" method="post">
            <input type="text" name="moduleName" placeholder="Name of module" required />
            <input type="text" name="moduleCode" placeholder="Module code" required />
            <input type="text" name="moduleCoordinator" placeholder="Name of the module Coordinator" required />
            <input type="submit" name="submit" value="Register" />
        </form>
    </div>
<?php } ?>
</body>
</html>



