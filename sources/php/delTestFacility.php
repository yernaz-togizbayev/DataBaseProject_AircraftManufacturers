<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variable id from POST request
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

// Delete method
$error_code = $database->deleteTestFacility($companyname, $projectnumber, $testfacilitynumber);

// Check result
if ($error_code == 1){
    echo "Test Facility with number '{$testfacilitynumber}' in company '{$companyname}' from project '{$projectnumber}' successfully deleted!'";
}
else{
    echo "Error: can't delete Test Facility with number '{$testfacilitynumber}' in company '{$companyname}' from project '{$projectnumber}'. Errorcode: {$error_code}";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>