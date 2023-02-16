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

$projectnumber_production = '';
if(isset($_POST['PROJEKTNUMMER_FUER_FLUGZEUGKOMPONENTE'])){
    $projectnumber_production = $_POST['PROJEKTNUMMER_FUER_FLUGZEUGKOMPONENTE'];
}

$materialid = '';
if(isset($_POST['MATERIALNUMMER'])){
    $materialid = $_POST['MATERIALNUMMER'];
}

$designengineerid = '';
if(isset($_POST['KONSTRUKTEUR_ID'])){
    $designengineerid = $_POST['KONSTRUKTEUR_ID'];
}


$productiontime = '';
if(isset($_POST['HERSTELLUNGSDAUER'])){
    $productiontime = $_POST['HERSTELLUNGSDAUER'];
}

// Insert method
$success = $database->insertIntoProduction($companyname, $projectnumber_production, $materialid, $designengineerid, $productiontime);

// Check result
if ($success){
    echo "Production with material number '{$materialid}' in company '{$companyname}' successfully added!'";
}
else{
    echo "Error can't insert production with material number '{$materialid}' in company '{$companyname}'!";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>