<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variable id from POST request
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

// Delete method
$error_code = $database->deleteAutomation($automationengineerid, $companyname, $projectnumber_automation, $testfacilitynumber);

// Check result
if ($error_code == 1){
    echo "Automation with test facility number '{$testfacilitynumber}' in company '{$companyname}' from project '{$projectnumber_automation}' successfully deleted!'";
}
else{
    echo "Error: can't delete Automation with test facility number '{$testfacilitynumber}' in company '{$companyname}' from project '{$projectnumber_automation}'. Errorcode: {$error_code}";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>