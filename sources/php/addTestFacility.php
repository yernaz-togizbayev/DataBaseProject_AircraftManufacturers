<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variables from POST request
$companyname = '';
if(isset($_POST['UNTERNEHMENSNAME'])){
    $companyname = $_POST['UNTERNEHMENSNAME'];
}

$projectnumber = '';
if(isset($_POST['PROJEKTNUMMER_FUER_PRUEFANLAGE'])){
    $projectnumber = $_POST['PROJEKTNUMMER_FUER_PRUEFANLAGE'];
}

$testfacilitynumber = '';
if(isset($_POST['PRUEFANLAGENNUMMER'])){
    $testfacilitynumber = $_POST['PRUEFANLAGENNUMMER'];
}


$supervisory = '';
if(isset($_POST['BEAUFSICHTSPERSON'])){
    $supervisory = $_POST['BEAUFSICHTSPERSON'];
}

// Insert method
$success = $database->insertIntoTestFacility($companyname, $projectnumber, $testfacilitynumber, $supervisory);

// Check result
if ($success){
    echo "Test Facility with number '{$testfacilitynumber}' in company '{$companyname}' successfully added!'";
}
else{
    echo "Error can't insert Test Facility with number '{$testfacilitynumber}' in company '{$companyname}'!";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>