<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variables from POST request
$employeeid = '';
if(isset($_POST['MITARBEITERID'])){
    $employeeid = $_POST['MITARBEITERID'];
}

$companyname = '';
if(isset($_POST['UNTERNEHMENSNAME'])){
    $companyname = $_POST['UNTERNEHMENSNAME'];
}

// Insert method
$success = $database->updateEmployeesCompany($employeeid, $companyname);

// Check result
if ($success){
    echo "Employee with ID '{$employeeid}' successfully changed his working company!'";
}
else{
    echo "Unsuccessful switch company for Employee with ID '{$employeeid}'!";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>