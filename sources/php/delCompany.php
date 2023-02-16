<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variable id from POST request
$companyid = '';
if(isset($_POST['ID'])){
    $companyid = $_POST['ID'];
}

// Delete method
$error_code = $database->deleteUnternehmen($companyid);

// Check result
if ($error_code == 1){
    echo "Company with ID '{$companyid}' successfully deleted!'";
}
else{
    echo "Error: can't delete company with ID '{$companyid}'. Errorcode: {$error_code}";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>