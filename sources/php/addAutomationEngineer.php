<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variables from POST request
$automationengineerid = '';
if(isset($_POST['AUTOMATISIERUNGSTECHNIKER_ID'])){
    $automationengineerid = $_POST['AUTOMATISIERUNGSTECHNIKER_ID'];
}

$salary = '';
if(isset($_POST['GEHALT'])){
    $salary = $_POST['GEHALT'];
}

$email = '';
if(isset($_POST['EMAIL'])){
    $email = $_POST['EMAIL'];
}

$laptop = '';
if(isset($_POST['LAPTOP'])){
    $laptop = $_POST['LAPTOP'];
}

// Insert method
$success = $database->insertIntoAutomationEngineer($automationengineerid, $salary, $email, $laptop);

// Check result
if ($success){
    echo "Automation Engineer with ID: '{$automationengineerid}' successfully added!'";
}
else{
    echo "Error can't insert Automation Engineer with ID: '{$automationengineerid}'!";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>