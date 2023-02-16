<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variable id from POST request
$automationengineerid = '';
if(isset($_POST['AUTOMATISIERUNGSTECHNIKER_ID'])){
    $automationengineerid = $_POST['AUTOMATISIERUNGSTECHNIKER_ID'];
}

// Delete method
$error_code = $database->deleteAutomationEngineer($automationengineerid);

// Check result
if ($error_code == 1){
    echo "Automation Engineer with ID: '{$automationengineerid}' successfully deleted!'";
}
else{
    echo "Error: can't delete Automation Engineer with ID: '{$automationengineerid}'. Errorcode: {$error_code}";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>