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

$objectnumber = '';
if(isset($_POST['OBJEKTID'])){
    $objectnumber = $_POST['OBJEKTID'];
}

// Delete method
$error_code = $database->deleteAircraft($companyname, $objectnumber);

// Check result
if ($error_code == 1){
    echo "Aircraft Component with id '{$objectnumber}' in company '{$companyname}' successfully deleted!'";
}
else{
    echo "Error: can't delete Aircraft Component with id '{$objectnumber}' in company '{$companyname}'. Errorcode: {$error_code}";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>