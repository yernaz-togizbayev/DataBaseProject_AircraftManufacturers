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
if(isset($_POST['PROJEKTNUMMER_FUER_FLUGZEUG'])){
    $projectnumber = $_POST['PROJEKTNUMMER_FUER_FLUGZEUG'];
}

$objectnumber = '';
if(isset($_POST['OBJEKTID'])){
    $objectnumber = $_POST['OBJEKTID'];
}

$model = '';
if(isset($_POST['MODEL'])){
    $model = $_POST['MODEL'];
}


$length = '';
if(isset($_POST['LAENGE'])){
    $length = $_POST['LAENGE'];
}

$width = '';
if(isset($_POST['BREITE'])){
    $width = $_POST['BREITE'];
}

$hight = '';
if(isset($_POST['HOEHE'])){
    $hight = $_POST['HOEHE'];
}

// Insert method
$success = $database->insertIntoAircraft($companyname, $projectnumber, $objectnumber, $model, $length, $width, $hight);

// Check result
if ($success){
    echo "Aircraft '{$model}' with id '{$objectnumber}' for project '{$projectnumber}'in company '{$companyname}' successfully added!'";
}
else{
    echo "Error can't insert Aircraft '{$model}' with id '{$objectnumber}' for project '{$projectnumber}'in company '{$companyname}'!";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>