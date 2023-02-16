<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variable id from POST request
$designengineerid = '';
if(isset($_POST['KONSTRUKTEUR_ID'])){
    $designengineerid = $_POST['KONSTRUKTEUR_ID'];
}

// Delete method
$error_code = $database->deleteDesignEngineer($designengineerid);

// Check result
if ($error_code == 1){
    echo "Automation Engineer with ID: '{$designengineerid}' successfully deleted!'";
}
else{
    echo "Error: can't delete Automation Engineer with ID: '{$designengineerid}'. Errorcode: {$error_code}";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>