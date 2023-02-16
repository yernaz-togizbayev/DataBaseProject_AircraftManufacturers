<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variables from POST request
$employeeid = '';
if(isset($_POST['AUTOMATISIERUNGSTECHNIKER_ID'])){
    $employeeid = $_POST['AUTOMATISIERUNGSTECHNIKER_ID'];
}

$salary = '';
if(isset($_POST['GEHALT'])){
    $salary = $_POST['GEHALT'];
}


// Insert method
$success = $database->updateAutomationEngineer($employeeid, $salary);

// Check result
if ($success){
    echo "Automation Engineer's Salary with ID '{$employeeid}' successfully has been changed!'";
}
else{
    echo "Error can't update Automation Engineer's Salary with ID '{$employeeid}'!";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>