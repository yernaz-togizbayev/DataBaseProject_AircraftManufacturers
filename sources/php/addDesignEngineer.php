<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variables from POST request
$designengineerid = '';
if(isset($_POST['KONSTRUKTEUR_ID'])){
    $designengineerid = $_POST['KONSTRUKTEUR_ID'];
}

$sv_number = '';
if(isset($_POST['SVNUMMER'])){
    $sv_number = $_POST['SVNUMMER'];
}

$equipment = '';
if(isset($_POST['AUSRUESTUNG'])){
    $equipment = $_POST['AUSRUESTUNG'];
}

$training = '';
if(isset($_POST['AUSBILDUNG'])){
    $training = $_POST['AUSBILDUNG'];
}

// Insert method
$success = $database->insertIntoDesignEngineer($designengineerid, $sv_number, $equipment, $training);

// Check result
if ($success){
    echo "Automation Engineer with ID: '{$designengineerid}' successfully added!'";
}
else{
    echo "Error can't insert Automation Engineer with ID: '{$designengineerid}'!";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>