<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variables from POST request
$vorname = '';
if(isset($_POST['VORNAME'])){
    $vorname = $_POST['VORNAME'];
}

$nachname = '';
if(isset($_POST['NACHNAME'])){
    $nachname = $_POST['NACHNAME'];
}

$geburtsdatum = '';
if(isset($_POST['GEBURTSDATUM'])){
    $geburtsdatum = $_POST['GEBURTSDATUM'];
}

$geschlecht = '';
if(isset($_POST['GESCHLECHT'])){
    $geschlecht = $_POST['GESCHLECHT'];
}

$unternehmensname = '';
if(isset($_POST['UNTERNEHMENSNAME'])){
    $unternehmensname = $_POST['UNTERNEHMENSNAME'];
}

// Insert method
$success = $database->insertIntoMitarbeiter($vorname, $nachname, $geburtsdatum, $geschlecht, $unternehmensname);

// Check result
if ($success){
    echo "Employee '{$vorname} {$nachname}' successfully added!'";
}
else{
    echo "Error can't insert Employee '{$vorname} {$nachname}'!";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>