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
if(isset($_POST['PROJEKTNUMMER'])){
    $projectnumber = $_POST['PROJEKTNUMMER'];
}

$projectname = '';
if(isset($_POST['PROJEKTNAME'])){
    $projectname = $_POST['PROJEKTNAME'];
}

$budget = '';
if(isset($_POST['BUDGET'])){
    $budget = $_POST['BUDGET'];
}

$deadline = '';
if(isset($_POST['DEADLINE'])){
    $deadline = $_POST['DEADLINE'];
}

// Insert method
$success = $database->insertIntoProject($companyname, $projectnumber, $projectname, $budget, $deadline);

// Check result
if ($success){
    echo "Project '{$projectname}' with number '{$projectnumber}' in company '{$companyname}' successfully added!'";
}
else{
    echo "Error can't insert project '{$projectname}' with number '{$projectnumber}' into company '{$companyname}'!";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>