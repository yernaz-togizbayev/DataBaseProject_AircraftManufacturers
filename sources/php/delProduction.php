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

$projectnumber_production = '';
if(isset($_POST['PROJEKTNUMMER_FUER_FLUGZEUGKOMPONENTE'])){
    $projectnumber_production = $_POST['PROJEKTNUMMER_FUER_FLUGZEUGKOMPONENTE'];
}

$materialid = '';
if(isset($_POST['MATERIALNUMMER'])){
    $materialid = $_POST['MATERIALNUMMER'];
}

// Delete method
$error_code = $database->deleteProduction($companyname, $projectnumber_production, $materialid);

// Check result
if ($error_code == 1){
    echo "Production with material number '{$materialid}' in company '{$companyname}' from project '{$projectnumber_production}' successfully deleted!'";
}
else{
    echo "Error: can't delete Production with material number '{$materialid}' in company '{$companyname}' from project '{$projectnumber_production}'. Errorcode: {$error_code}";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>