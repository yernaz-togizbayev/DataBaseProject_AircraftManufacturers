<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variable id from POST request
$projectnumber = '';
if(isset($_POST['PROJEKTNUMMER'])){
    $projectnumber = $_POST['PROJEKTNUMMER'];
}

// Delete method
$error_code = $database->deleteProject($projectnumber);

// Check result
if ($error_code == 1){
    echo "Project with number '{$projectnumber}' successfully deleted!'";
}
else{
    echo "Error: can't delete Project with number '{$projectnumber}'. Errorcode: {$error_code}";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>