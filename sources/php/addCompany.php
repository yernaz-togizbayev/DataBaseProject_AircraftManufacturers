<?php
//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variables from POST request
$name = '';
if(isset($_POST['NAME'])){
    $name = $_POST['NAME'];
}

$country = '';
if(isset($_POST['COUNTRY'])){
    $country = $_POST['COUNTRY'];
}

// Insert method
$success = $database->insertIntoUnternehmen($name, $country);

// Check result
if ($success){
    echo "Company '{$name}' successfully added!'";
}
else{
    echo "Error can't insert Company '{$name}'!";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>