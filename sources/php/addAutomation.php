<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variables from POST request
$automationengineerid = '';
if(isset($_POST['AUTOMATISIERUNGSTECHNIKERID'])){
    $automationengineerid = $_POST['AUTOMATISIERUNGSTECHNIKERID'];
}

$companyname = '';
if(isset($_POST['UNTERNEHMENSNAME'])){
    $companyname = $_POST['UNTERNEHMENSNAME'];
}

$projectnumber_automation = '';
if(isset($_POST['PROJEKTNUMMER_FUER_PRUEFANLAGE'])){
    $projectnumber_automation = $_POST['PROJEKTNUMMER_FUER_PRUEFANLAGE'];
}

$testfacilitynumber = '';
if(isset($_POST['PRUEFANLAGENNUMMER'])){
    $testfacilitynumber = $_POST['PRUEFANLAGENNUMMER'];
}

// Insert method
$success = $database->insertIntoAutomation($automationengineerid, $companyname, $projectnumber_automation, $testfacilitynumber);

// Check result
if ($success){
    echo "Automation with project numer '{$projectnumber_automation}' and material number '{$testfacilitynumber}' in company '{$companyname}' successfully added!'";
}
else{
    echo "Error can't insert Automation with project numer '{$projectnumber_automation}' and material number '{$testfacilitynumber}' in company '{$companyname}'!";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>