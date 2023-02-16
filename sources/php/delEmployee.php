<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();


$mitarbeiterid = '';
if(isset($_POST['MITARBEITERID'])){
    $mitarbeiterid = $_POST['MITARBEITERID'];
}

// Delete method
$error_code = $database->deleteEmployee($mitarbeiterid);

// Check result
if ($error_code == 1){
    echo "Employee with ID: '{$mitarbeiterid}' successfully deleted!'";
}
else{
    echo "Error: can't delete employee with ID: '{$mitarbeiterid}'. Errorcode: {$error_code}";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>