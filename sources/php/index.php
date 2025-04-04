<?php

// Include DatabaseHelper.php file
require_once('DatabaseHelper.php');

// Instantiate DatabaseHelper class
$database = new DatabaseHelper();


// Get parameter 'person_id', 'surname' and 'name' from GET Request
$id = '';
if (isset($_GET['ID'])) {
    $id = $_GET['ID'];
}

$name = '';
if (isset($_GET['NAME'])) {
    $name = $_GET['NAME'];
}

$country = '';
if (isset($_GET['COUNTRY'])) {
    $country = $_GET['COUNTRY'];
}



//Get parameters for Employee
$mitarbeiterid = '';
if(isset($_GET['MITARBEITERID'])){
    $mitarbeiterid = $_GET['MITARBEITERID'];
}

$vorname = '';
if(isset($_GET['VORNAME'])){
    $vorname = $_GET['VORNAME'];
}

$nachname = '';
if(isset($_GET['NACHNAME'])){
    $nachname = $_GET['NACHNAME'];
}

$employee_company = '';
if(isset($_GET['UNTERNEHMENSNAME'])){
    $employee_company = $_GET['UNTERNEHMENSNAME'];
}



//Get parameters for Automation Engineer
$automationengineerid = '';
if(isset($_GET['AUTOMATISIERUNGSTECHNIKER_ID'])){
    $automationengineerid = $_GET['AUTOMATISIERUNGSTECHNIKER_ID'];
}


//Get parameters for Design Engineer
$designengineerid = '';
if(isset($_GET['KONSTRUKTEUR_ID'])){
    $designengineerid = $_GET['KONSTRUKTEUR_ID'];
}


//Get parameters for Project
$project_company = '';
if(isset($_GET['UNTERNEHMENSNAME'])){
    $project_company = $_GET['UNTERNEHMENSNAME'];
}

$projectnumber = '';
if(isset($_GET['PROJEKTNUMMER'])){
    $projectnumber = $_GET['PROJEKTNUMMER'];
}



//Get parameters for Aircraft Component
$aircraft_company = '';
if(isset($_GET['UNTERNEHMENSNAME'])){
    $aircraft_company = $_GET['UNTERNEHMENSNAME'];
}

$objectnumber = '';
if(isset($_GET['OBJEKTID'])){
    $objectnumber = $_GET['OBJEKTID'];
}

//Get parameters for Test Facility
$testfacility_company = '';
if(isset($_GET['UNTERNEHMENSNAME'])){
    $testfacility_company = $_GET['UNTERNEHMENSNAME'];
}

$projectnumber_testfacility = '';
if(isset($_GET['PROJEKTNUMMER_FUER_PRUEFANLAGE'])){
    $projectnumber_testfacility = $_GET['PROJEKTNUMMER_FUER_PRUEFANLAGE'];
}

$testfacilitynumber = '';
if(isset($_GET['PRUEFANLAGENNUMMER'])){
    $testfacilitynumber = $_GET['PRUEFANLAGENNUMMER'];
}


//Get parameters for Production
$production_company = '';
if(isset($_GET['UNTERNEHMENSNAME'])){
    $production_company = $_GET['UNTERNEHMENSNAME'];
}

$projectnumber_production = '';
if(isset($_GET['PROJEKTNUMMER_FUER_FLUGZEUG'])){
    $projectnumber_production = $_GET['PROJEKTNUMMER_FUER_FLUGZEUG'];
}

//Get parameters for Automation
$automation_company = '';
if(isset($_GET['UNTERNEHMENSNAME'])){
    $automation_company = $_GET['UNTERNEHMENSNAME'];
}

$projectnumber_automation = '';
if(isset($_GET['PROJEKTNUMMER_FUER_PRUEFANLAGE'])){
    $projectnumber_automation = $_GET['PROJEKTNUMMER_FUER_PRUEFANLAGE'];
}

$testfacilityid_automation = '';
if(isset($_GET['PRUEFANLAGENNUMMER'])){
    $testfacilityid_automation = $_GET['PRUEFANLAGENNUMMER'];
}

//Get parameters for All Automation Engineers
$automationengineer_company = '';
if(isset($_GET['UNTERNEHMENSNAME'])){
    $automationengineer_company = $_GET['UNTERNEHMENSNAME'];
}

//Get parameters for All Design Engineers
$designengineer_company = '';
if(isset($_GET['UNTERNEHMENSNAME'])){
    $designengineer_company = $_GET['UNTERNEHMENSNAME'];
}


//Fetch data from database
$unternehmen_array = $database->selectFromUnternehmenWhere($id, $name, $country);
$mitarbeiter_array = $database->selectFromMitarbeiterWhere($mitarbeiterid, $employee_company);
$automationengineer_array = $database->selectFromAutomationEngineerWhere($automationengineerid);
$designengineer_array = $database->selectFromDesignEngineerWhere($designengineerid);
$project_array = $database->selectFromProjectWhere($project_company, $projectnumber);
$aircraft_array = $database->selectFromAircraftWhere($aircraft_company, $objectnumber);
$testfacility_array = $database->selectFromTestFacilityWhere($testfacility_company,$projectnumber_testfacility, $testfacilitynumber);
$production_array = $database->selectFromProductionWhere($production_company, $projectnumber_production, $objectnumber);
$automation_array = $database->selectFromAutomationWhere($automation_company, $projectnumber_automation, $testfacilitynumber);
$allautomationengineers_array = $database->selectFromAllAutomationEngineersWhere($nachname, $vorname, $automationengineer_company, $automationengineerid);
$alldesignengineers_array = $database->selectFromAllDesignEngineersWhere($nachname, $vorname, $designengineer_company, $designengineerid);
?>

<html>
<head>
    <title>DBS</title>
</head>

<body background="https://www.lockheedmartin.com/content/dam/lockheed-martin/eo/photo/yourmission/1820_LM_F35_SIDE_MISSION_MARKS.jpg">
<br>
<h1><center>Aircraft Manufacturers</center></h1>

<!-- Company -->
<details>
    <summary>Company</summary>

    <!-- Add Company -->
    <h2>Add Company: </h2>
    <form method="post" action="addCompany.php">
        <!-- Company ID is not needed, because its autogenerated by the database -->
        <!-- Name textbox -->
        <div>
            <label for="new_name">Company name*:</label>
            <input id="new_name" name="NAME" type="text" maxlength="100">
        </div>
        <br>

        <!-- Strasse textbox -->
        <div>
            <label for="new_country">Country:</label>
            <input id="new_country" name="COUNTRY" type="text" maxlength="10">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button type="submit">
                Add Company
            </button>
        </div>
    </form>
    <br>
    <hr>

    <!-- Delete Unternehmen -->
    <h2>Delete Company:</h2>
    <form method="post" action="delCompany.php">
        <!-- Name textbox -->
        <div>
            <label for="del_id">Company ID:</label>
            <input id="del_id" name="ID" type="number" min="0">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button type="submit">
                Delete Company
            </button>
        </div>
    </form>
    <br>
    <hr>

    <!-- Search form -->
    <h2>Company Search:</h2>
    <form method="get">
        <!-- ID textbox:-->
        <div>
            <label for="id">ID:</label>
            <input id="id" name="ID" type="number" value='<?php echo $id; ?>' min="0">
        </div>
        <br>

        <!-- Name textbox:-->
        <div>
            <label for="name">Company name:</label>
            <input id="name" name="NAME" type="text" class="form-control input-md" value='<?php echo $name; ?>' maxlength="100">
        </div>
        <br>

        <!-- Country textbox:-->
        <div>
            <label for="name">Country:</label>
            <input id="name" name="COUNTRY" type="text" class="form-control input-md" value='<?php echo $country; ?>' maxlength="10">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button id='submit' type='submit'>
                Search
            </button>
        </div>
    </form>
    <br>
    <hr>

    <!-- Search result -->
    <h2>Company Search Result:</h2>
    <table>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Company Name</th>
            <th>Country</th>
        </tr>
        <?php $i = 1; foreach ($unternehmen_array as $unternehmen) : ?>
            <tr>
                <td> <?php echo $i++; ?> </td>
                <td style="width:70px"><center><?php echo $unternehmen['ID']; ?> </center> </td>
                <td style="width:300px"><center><?php echo $unternehmen['NAME']; ?> </center> </td>
                <td style="width:100px"><center><?php echo $unternehmen['COUNTRY']; ?> </center> </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <hr style="height:15px;border:none;background-color:#333;" />
</details>


<!-- Employee -->
<details>
    <summary>Employee</summary>

    <!-- Add Employee -->
    <h2>Add Employee: </h2>
    <form method="post" action="addEmployee.php">
        <!-- First name textbox -->
        <div>
            <label for="new_vorname">First name*:</label>
            <input id="new_vorname" name="VORNAME" type="text" maxlength="30">
        </div>
        <br>

        <!-- Last name textbox -->
        <div>
            <label for="new_nachname">Last name*:</label>
            <input id="new_nachname" name="NACHNAME" type="text" maxlength="30">
        </div>
        <br>

        <!-- Date of Birth textbox -->
        <div>
            <label for="new_gebdat">Date of Birth:</label>
            <input id="new_gebdat" name="GEBURTSDATUM" type="date">
        </div>
        <br>

        <!-- Sex textbox -->
        <div>
            <legend>Sex:
                <label for="maennlich">
                    <input id="männlich" name="GESCHLECHT" type="radio" value="m">male
                </label>
                <label for="weiblich">
                    <input id="weiblich" name="GESCHLECHT" type="radio" value="f">female
                </label>
                <label for="divers">
                    <input id="divers" name="GESCHLECHT" type="radio" value="d">divers
                </label>
            </legend>
        </div>
        <br>

        <!-- Geschlecht textbox -->
        <div>
            <label for="new_company">Company*:</label>
            <input id="new_company" name="UNTERNEHMENSNAME" type="text" maxlength="100">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button type="submit">
                Add Employee
            </button>
        </div>
    </form>
    <br>
    <hr>
    

    <h2>Update Employee:</h2>
    <form method="post" action="updateEmployee.php">
        <div>
            <label for="update_employee">Employee ID:</label>
            <input for="update_employee" name="MITARBEITERID" type="text" maxlength="10">
        </div>
        <br>

        <div>
            <label for="companyname">Company Name:</label>
            <input for="companyname" name="UNTERNEHMENSNAME" type="text" maxlength="100">
        </div>
        <br>
        
        <div>
            <button type="submit">
                Update Employee
            </button>
        </div>
    </form>
    <br>
    <hr>


    <!-- Delete Employee -->
    <h2>Delete Employee:</h2>
    <form method="post" action="delEmployee.php">
        <!-- Employee ID textbox -->
        <div>
            <label for="del_mitarbeiterid">Employee ID:</label>
            <input id="del_mitarbeiterid" name="MITARBEITERID" type="text" maxlength="10">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button type="submit">
                Delete Employee
            </button>
        </div>
    </form>
    <br>
    <hr>



    <!-- Search form -->
    <h2>Employee Search:</h2>
    <form method="get">
        <!-- ID textbox:-->
        <div>
            <label for="employeeid">Employee ID:</label>
            <input id="employeeid" name="MITARBEITERID" type="text" value='<?php echo $mitarbeiterid; ?>' maxlength="10">
        </div>
        <br>
        
        <div>
            <label for="name">Company Name:</label>
            <input id="name" name="UNTERNEHMENSNAME" type="text" value='<?php echo $employee_company; ?>' maxlength="100">
        </div>
        <br>
        <!-- Submit button -->
        <div>
            <button id='submit' type='submit'>
                Search
            </button>
        </div>
    </form>
    <br>
    <hr>


    <!-- Search result -->
    <h2>Employee Search Result:</h2>
    <table>
        <tr>
            <th></th>
            <th>Employee ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of Birth</th>
            <th>Sex</th>
            <th>Company</th>
        </tr>
        <?php $i = 1; foreach ($mitarbeiter_array as $mitarbeiter) : ?>
            <tr>
                <td> <?php echo $i++; ?> </td>
                <td style="width:150px"><center><?php echo $mitarbeiter['MITARBEITERID']; ?> </center> </td>
                <td style="width:100px"><center><?php echo $mitarbeiter['VORNAME']; ?> </center> </td>
                <td style="width:150px"><center><?php echo $mitarbeiter['NACHNAME']; ?> </center> </td>
                <td style="width:100px"><center><?php echo $mitarbeiter['GEBURTSDATUM']; ?> </center> </td>
                <td style="width:50px"><center><?php echo $mitarbeiter['GESCHLECHT']; ?> </center> </td>
                <td style="width:300px"><center><?php echo $mitarbeiter['UNTERNEHMENSNAME']; ?> </center> </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <hr style="height:15px;border:none;background-color:#333;" />
</details>


<!-- Automation Engineer -->
<details>
    <summary>Automation Engineer</summary>

    <!-- Add Automation Engineer -->
    <h2>Add Automation Engineer: </h2>
    <form method="post" action="addAutomationEngineer.php">

        <!-- Automation Engineer ID textbox -->
        <div>
            <label for="new_id">Automation Engineer ID*:</label>
            <input id="new_id" name="AUTOMATISIERUNGSTECHNIKER_ID" type="text" maxlength="10">
        </div>
        <br>

        <!-- Salary textbox -->
        <div>
            <label for="new_salary">Salary:</label>
            <input id="new_salary" name="GEHALT" type="number" min="0" step=".01">
        </div>
        <br>
        <!-- Email textbox -->
            <div>
                <label for="new_email">Email:</label>
                <input id="new_email" name="EMAIL" type="email">
            </div>
            <br>
        <!-- Laptop textbox -->
            <div>
                <label for="new_laptop">Laptop:</label>
                <input id="new_laptop" name="LAPTOP" type="text" maxlength="40">
            </div>
            <br>

        <!-- Submit button -->
        <div>
            <button type="submit">
                Add Automation Engineer
            </button>
        </div>
    </form>
    <br>
    <hr>
    

    <h2>Update Automation Engineer:</h2>
    <form method="post" action="updateAutomationEngineer.php">
        <div>
            <label for="update_employee">Automation Engineer ID:</label>
            <input for="update_employee" name="AUTOMATISIERUNGSTECHNIKER_ID" type="text" maxlength="10">
        </div>
        <br>

        <div>
            <label for="salary">Salary:</label>
            <input for="salary" name="GEHALT" type="number" min="0" step=".01">
        </div>
        <br>
        
        <div>
            <button type="submit">
                Update Employee
            </button>
        </div>
    </form>
    <br>
    <hr>

    <!-- Delete Employee -->
    <h2>Delete Automation Engineer:</h2>
    <form method="post" action="delAutomationEngineer.php">
        <!-- Automation Engineer ID textbox -->
        <div>
            <label for="del_automationengineerid">Automation Engineer ID:</label>
            <input id="del_automationengineerid" name="AUTOMATISIERUNGSTECHNIKER_ID" type="text" maxlength="10">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button type="submit">
                Delete Automation Engineer
            </button>
        </div>
    </form>
    <br>
    <hr>



    <!-- Search form -->
    <h2>Automation Engineer Search:</h2>
    <form method="get">
        <!-- Automation Engineer ID textbox:-->
        <div>
            <label for="automationengineerid">Automation Engineer ID:</label>
            <input id="automationengineerid" name="AUTOMATISIERUNGSTECHNIKER_ID" type="text" value='<?php echo $automationengineerid; ?>' maxlength="10">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button id='submit' type='submit'>
                Search
            </button>
        </div>
    </form>
    <br>
    <hr>


    <!-- Search result -->
    <h2>Automation Engineer Search Result:</h2>
    <table>
        <tr>
            <th></th>
            <th>Automation Engineer ID</th>
            <th>Salary</th>
            <th>Email</th>
            <th>Laptop</th>
        </tr>
        <?php $i = 1; foreach ($automationengineer_array as $automationengineer) : ?>
            <tr>
                <td> <?php echo $i++; ?> </td>
                <td style="width:200px"><center><?php echo $automationengineer['AUTOMATISIERUNGSTECHNIKER_ID']; ?> </center> </td>
                <td style="width:100px"><center><?php echo '$ '.$automationengineer['GEHALT']; ?> </center> </td>
                <td style="width:500px"><center><?php echo $automationengineer['EMAIL']; ?> </center> </td>
                <td style="width:300px"><center><?php echo $automationengineer['LAPTOP']; ?> </center> </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <hr style="height:15px;border:none;background-color:#333;" />
</details>


<!-- Design Engineer -->
<details>
    <summary>Design Engineer</summary>

    <!-- Add Design Engineer -->
    <h2>Add Design Engineer: </h2>
    <form method="post" action="addDesignEngineer.php">

        <!-- Design Engineer ID textbox -->
        <div>
            <label for="new_id">Design Engineer ID*:</label>
            <input id="new_id" name="KONSTRUKTEUR_ID" type="text" maxlength="10">
        </div>
        <br>

        <!-- SV-Number textbox -->
        <div>
            <label for="new_sv">SV-Number:</label>
            <input id="new_sv" name="SVNUMMER" type="number" min="0">
        </div>
        <br>
        <!-- Equipment textbox -->
            <div>
                <label for="new_equipment">Equipment:</label>
                <input id="new_equipment" name="AUSRUESTUNG" type="text">
            </div>
            <br>
        <!-- Training textbox -->
            <div>
            <legend>Training:
                <label for="present">
                    <input id="present" name="AUSBILDUNG" type="radio" value="j">present
                </label>
                <label for="not_present">
                    <input id="not_present" name="AUSBILDUNG" type="radio" value="n">not present
                </label>
            </legend>
            </div>
            <br>

        <!-- Submit button -->
        <div>
            <button type="submit">
                Add Design Engineer
            </button>
        </div>
    </form>
    <br>
    <hr>


    <!-- Delete Design Engineer -->
    <h2>Delete Design Engineer:</h2>
    <form method="post" action="delDesignEngineer.php">
        <!-- ID textbox -->
        <div>
            <label for="del_designengineerid">Design Engineer ID:</label>
            <input id="del_designengineerid" name="KONSTRUKTEUR_ID" type="text" maxlength="10">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button type="submit">
                Delete Design Engineer
            </button>
        </div>
    </form>
    <br>
    <hr>



    <!-- Search form -->
    <h2>Design Engineer Search:</h2>
    <form method="get">
        <!-- ID textbox:-->
        <div>
            <label for="designengineerid">Design Engineer ID:</label>
            <input id="designengineerid" name="KONSTRUKTEUR_ID" type="text" value='<?php echo $designengineerid; ?>' maxlength="10">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button id='submit' type='submit'>
                Search
            </button>
        </div>
    </form>
    <br>
    <hr>


    <!-- Search result -->
    <h2>Design Engineer Search Result:</h2>
    <table>
        <tr>
            <th></th>
            <th>Design Engineer ID</th>
            <th>SV-Number</th>
            <th>Equipment</th>
            <th>Training</th>
        </tr>
        <?php $i = 1; foreach ($designengineer_array as $designengineer) : ?>
            <tr>
                <td> <?php echo $i++; ?> </td>
                <td style="width:200px"><center><?php echo $designengineer['KONSTRUKTEUR_ID']; ?> </center> </td>
                <td style="width:100px"><center><?php echo $designengineer['SVNUMMER']; ?> </center> </td>
                <td style="width:500px"><center><?php echo $designengineer['AUSRUESTUNG']; ?> </center> </td>
                <td style="width:50px"><center><?php echo $designengineer['AUSBILDUNG']; ?> </center> </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <hr style="height:15px;border:none;background-color:#333;" />
</details>


<!-- Project -->
<details>
    <summary>Project</summary>

    <!-- Add Project -->
    <h2>Add Project: </h2>
    <form method="post" action="addProject.php">

        <!-- Company Name textbox -->
        <div>
            <label for="new_company">Company Name*:</label>
            <input id="new_company" name="UNTERNEHMENSNAME" type="text" maxlength="100">
        </div>
        <br>

        <!-- Project Name textbox -->
        <div>
            <label for="new_projectname">Project Name*:</label>
            <input id="new_projectname" name="PROJEKTNAME" type="text" maxlength="100">
        </div>
        <br>

        <!-- Budget textbox -->
        <div>
            <label for="new_projectname">Budget:</label>
            <input id="new_projectname" name="BUDGET" type="number" min="0" step=".01">
        </div>
        <br>
        <!-- Deadline textbox -->
        <div>
            <label for="new_deadline">Deadline:</label>
            <input id="new_deadline" name="DEADLINE" type="date">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button type="submit">
                Add Project
            </button>
        </div>
    </form>
    <br>
    <hr>


    <!-- Delete Design Engineer -->
    <h2>Delete Project:</h2>
    <form method="post" action="delProject.php">
        <div>
            <label for="del_projectnumber">Project Number:</label>
            <input id="del_projectnumber" name="PROJEKTNUMMER" type="number" min="0">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button type="submit">
                Delete Project
            </button>
        </div>
    </form>
    <br>
    <hr>



    <!-- Search form -->
    <h2>Project Search:</h2>
    <form method="get">
        <!-- Company Name textbox:-->
        <div>
            <label for="companyname">Company Name:</label>
            <input id="companyname" name="UNTERNEHMENSNAME" type="text" value='<?php echo $project_company; ?>' maxlength="100">
        </div>
        <br>
        
        <div>
            <label for="projectnumber">Project Number:</label>
            <input id="projectnumber" name="PROJEKTNUMMER" type="number" value='<?php echo $projectnumber; ?>' min="0">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button id='submit' type='submit'>
                Search
            </button>
        </div>
    </form>
    <br>
    <hr>


    <!-- Search result -->
    <h2>Project Search Result:</h2>
    <table>
        <tr>
            <th></th>
            <th>Project Number</th>
            <th>Project Name</th>
            <th>Budget</th>
            <th>Deadline</th>
            <th>Company Name</th>
        </tr>
        <?php $i = 1; foreach ($project_array as $project) : ?>
            <tr>
                <td> <?php echo $i++; ?> </td>
                <td style="width:100px"><center><?php echo $project['PROJEKTNUMMER']; ?> </center> </td>
                <td style="width:500px"><center><?php echo $project['PROJEKTNAME']; ?> </center> </td>
                <td style="width:100px"><center><?php echo '$ ' . $project['BUDGET']; ?> </center> </td>
                <td style="width:100px"><center><?php echo $project['DEADLINE']; ?> </center> </td>
                <td style="width:300px"><center><?php echo $project['UNTERNEHMENSNAME']; ?> </center> </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <hr style="height:15px;border:none;background-color:#333;" />
</details>


<!-- Aircraft Component -->
<details>
    <summary>Aircraft</summary>

    <!-- Add Aircraft Components -->
    <h2>Add Aircraft: </h2>
    <form method="post" action="addAircraft.php">

        <!-- Company Name textbox -->
        <div>
            <label for="new_company">Company Name*:</label>
            <input id="new_company" name="UNTERNEHMENSNAME" type="text" maxlength="100">
        </div>
        <br>

        <!-- Project No textbox -->
        <div>
            <label for="new_projectid">Project No*:</label>
            <input id="new_projectid" name="PROJEKTNUMMER_FUER_FLUGZEUG" type="number" min="0">
        </div>
        <br>

        <!-- Object ID textbox -->
        <div>
            <label for="new_objectid">Object ID*:</label>
            <input id="new_objectid" name="OBJEKTID" type="text" maxlength="30">
        </div>
        <br>

        <!-- Aircraft Model textbox -->
        <div>
            <label for="new_model">Aircraft Model*:</label>
            <input id="new_model" name="MODEL" type="text" maxlength="100">
        </div>
        <br>

        <!-- Length textbox -->
        <div>
            <label for="new_length">Length:</label>
            <input id="new_length" name="LAENGE" type="number" min="0" step=".01">
        </div>
        <br>
        
        <!-- Width textbox -->
        <div>
            <label for="new_width">Width:</label>
            <input id="new_width" name="BREITE" type="number" min="0" step=".01">
        </div>
        <br>
        
        <!-- Hight textbox -->
        <div>
            <label for="new_hight">Hight:</label>
            <input id="new_hight" name="HOEHE" type="number" min="0" step=".01">
        </div>
        <br>
        
        <!-- Submit button -->
        <div>
            <button type="submit">
                Add Aircraft
            </button>
        </div>
    </form>
    <br>
    <hr>


    <!-- Delete Design Engineer -->
    <h2>Delete Aircraft:</h2>
    <h4><small>(This function requires both company name AND object mumber)</small></h4>
    <form method="post" action="delAircraft.php">
        <div>
            <label for="del_companyname">Company Name:</label>
            <input id="del_companyname" name="UNTERNEHMENSNAME" type="text" maxlength="100">
        </div>
        <br>

        <div>
            <label for="del_objectid">Object ID:</label>
            <input id="del_objectid" name="OBJEKTID" type="text" maxlength="50">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button type="submit">
                Delete Aircraft
            </button>
        </div>
    </form>
    <br>
    <hr>



    <!-- Search form -->
    <h2>Aircraft Search:</h2>
    <form method="get">
        <!-- ID textbox:-->
        <div>
            <label for="companyname">Company Name:</label>
            <input id="companyname" name="UNTERNEHMENSNAME" type="text" value='<?php echo $aircraft_company; ?>' maxlength="100">
        </div>
        <br>

        <div>
            <label for="objectnumber">Object Number:</label>
            <input id="objectnumber" name="OBJEKTID" type="text" value='<?php echo $objectnumber; ?>' min="0">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button id='submit' type='submit'>
                Search
            </button>
        </div>
    </form>
    <br>
    <hr>


    <!-- Search result -->
    <h2>Aircraft Search Result:</h2>
    <table>
        <tr>
            <th></th>
            <th>Company Name</th>
            <th>Project No.</th>
            <th>Object ID</th>
            <th>Model</th>
            <th>Length</th>
            <th>Width</th>
            <th>Hight</th>
        </tr>
        <?php $i = 1; foreach ($aircraft_array as $aircraft) : ?>
            <tr>
                <td> <?php echo $i++; ?> </td>
                <td style="width:200px"><center><?php echo $aircraft['UNTERNEHMENSNAME']; ?> </center> </td>
                <td style="width:100px"><center><?php echo $aircraft['PROJEKTNUMMER_FUER_FLUGZEUG']; ?> </center> </td>
                <td style="width:100px"><center><?php echo $aircraft['OBJEKTID']; ?> </center> </td>
                <td style="width:200px"><center><?php echo $aircraft['MODEL']; ?> </center> </td>
                <td style="width:100px"><center><?php echo $aircraft['LAENGE']; ?> </center> </td>
                <td style="width:100px"><center><?php echo $aircraft['BREITE']; ?> </center> </td>
                <td style="width:100px"><center><?php echo $aircraft['HOEHE']; ?> </center> </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <hr style="height:15px;border:none;background-color:#333;" />
</details>


<!-- Test Facility -->
<details>
    <summary>Test Facility</summary>

    <!-- Add Test Facility -->
    <h2>Add Test Facility: </h2>
    <form method="post" action="addTestFacility.php">

        <!-- Company Name textbox -->
        <div>
            <label for="new_company">Company Name*:</label>
            <input id="new_company" name="UNTERNEHMENSNAME" type="text" maxlength="100">
        </div>
        <br>

        <!-- Project No textbox -->
        <div>
            <label for="new_projectid">Project No*:</label>
            <input id="new_projectid" name="PROJEKTNUMMER_FUER_PRUEFANLAGE" type="number" min="0">
        </div>
        <br>

        <!-- Test Facility No textbox -->
        <div>
            <label for="new_testfacilityid">Test Facility No.*:</label>
            <input id="new_testfacilityid" name="PRUEFANLAGENNUMMER" type="number" min="0">
        </div>
        <br>

        <!-- Supervisory textbox -->
        <div>
            <label for="new_supervisory">Supervisory:</label>
            <input id="new_supervisory" name="BEAUFSICHTSPERSON" type="number" min="0" max="10">
        </div>
        <br>
        
        <!-- Submit button -->
        <div>
            <button type="submit">
                Add Test Facility
            </button>
        </div>
    </form>
    <br>
    <hr>


    <!-- Delete Design Engineer -->
    <h2>Delete Test Facility:</h2>
    <h4><small>(To delete test facility all 3 parameters need to be provided)</small></h4>
    <form method="post" action="delTestFacility.php">
        <div>
            <label for="del_companyname">Company Name:</label>
            <input id="del_companyname" name="UNTERNEHMENSNAME" type="text" maxlength="100">
        </div>
        <br>
        
        <div>
            <label for="del_projectnumber">Project No:</label>
            <input id="del_projectnumber" name="PROJEKTNUMMER_FUER_PRUEFANLAGE" type="number" min="0">
        </div>
        <br>

        <div>
            <label for="del_testfacilityid">Test Facility No:</label>
            <input id="del_testfacilityid" name="PRUEFANLAGENNUMMER" type="number" min="0">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button type="submit">
                Delete Test Facility
            </button>
        </div>
    </form>
    <br>
    <hr>



    <!-- Search form -->
    <h2>Test Facility Search:</h2>
    <form method="get">
        <!-- Company Name textbox:-->
        <div>
            <label for="companyname">Company Name:</label>
            <input id="companyname" name="UNTERNEHMENSNAME" type="text" value='<?php echo $testfacility_company; ?>' maxlength="100">
        </div>
        <br>

        <div>
            <label for="projectnumber">Project No:</label>
            <input id="projectnumber" name="PROJEKTNUMMER_FUER_PRUEFANLAGE" type="number" value='<?php echo $projectnumber_testfacility; ?>' min="0">
        </div>
        <br>
        <div>
            <label for="testfacilityid">Test Facility No:</label>
            <input id="testfacilityid" name="PRUEFANLAGENNUMMER" type="text" value='<?php echo $testfacilitynumber; ?>' maxlength="10">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button id='submit' type='submit'>
                Search
            </button>
        </div>
    </form>
    <br>
    <hr>


    <!-- Search result -->
    <h2>Test Facility Search Result:</h2>
    <table>
        <tr>
            <th></th>
            <th>Company Name</th>
            <th>Project No.</th>
            <th>Test Facility No.</th>
            <th>Supervisory</th>
        </tr>
        <?php $i = 1; foreach ($testfacility_array as $testfacility) : ?>
            <tr>
                <td> <?php echo $i++; ?> </td>
                <td style="width:200px"><center><?php echo $testfacility['UNTERNEHMENSNAME']; ?> </center> </td>
                <td style="width:100px"><center><?php echo $testfacility['PROJEKTNUMMER_FUER_PRUEFANLAGE']; ?> </center> </td>
                <td style="width:150px"><center><?php echo $testfacility['PRUEFANLAGENNUMMER']; ?> </center> </td>
                <td style="width:100px"><center><?php echo $testfacility['BEAUFSICHTSPERSON']; ?> </center> </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <hr style="height:15px;border:none;background-color:#333;" />
</details>


<!-- Production -->
<details>
    <summary>Production</summary>
    <!-- Add Test Facility -->
    <h2>Add Production: </h2>
    <form method="post" action="addProduction.php">

        <!-- Company Name textbox -->
        <div>
            <label for="new_company">Company Name*:</label>
            <input id="new_company" name="UNTERNEHMENSNAME" type="text" maxlength="100">
        </div>
        <br>

        <!-- Project No textbox -->
        <div>
            <label for="new_projectid">Project No*:</label>
            <input id="new_projectid" name="PROJEKTNUMMER_FUER_FLUGZEUG" type="number" min="0">
        </div>
        <br>

        <!-- Object ID textbox -->
        <div>
            <label for="new_objectid">Object ID*:</label>
            <input id="new_objectid" name="OBJEKTID" type="text" maxlength="50">
        </div>
        <br>

        <!-- Design Engineer ID textbox -->
        <div>
            <label for="new_designengineerid">Design Engineer ID*:</label>
            <input id="new_designengineerid" name="KONSTRUKTEUR_ID" type="text" maxlength="10">
        </div>
        <br>

        <!-- Production time textbox -->
        <div>
            <label for="new_productiontime">Production time:</label>
            <input id="new_productiontime" name="HERSTELLUNGSDAUER" type="number" min="0">
        </div>
        <br>
        
        <!-- Submit button -->
        <div>
            <button type="submit">
                Add Production
            </button>
        </div>
    </form>
    <br>
    <hr>


    <!-- Delete Production -->
    <h2>Delete Production:</h2>
    <h4><small>(To delete particular production, all 3 parameters need to be provided)</small></h4>
    <form method="post" action="delProduction.php">
        <div>
            <label for="del_companyname">Company Name:</label>
            <input id="del_companyname" name="UNTERNEHMENSNAME" type="text" maxlength="100">
        </div>
        <br>
        
        <div>
            <label for="del_projectnumber">Project No:</label>
            <input id="del_projectnumber" name="PROJEKTNUMMER_FUER_FLUGZEUG" type="number" min="0">
        </div>
        <br>

        <div>
            <label for="del_objectid">Object ID:</label>
            <input id="del_objectid" name="OBJEKTID" type="text" maxlength="50">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button type="submit">
                Delete Production
            </button>
        </div>
    </form>
    <br>
    <hr>



    <!-- Search form -->
    <h2>Production Search:</h2>
    <form method="get">
        <!-- Company Name textbox:-->
        <div>
            <label for="companyname">Company Name:</label>
            <input id="companyname" name="UNTERNEHMENSNAME" type="text" value='<?php echo $production_company; ?>' maxlength="100">
        </div>
        <br>

        <div>
            <label for="projectnumber">Project No:</label>
            <input id="projectnumber" name="PROJEKTNUMMER_FUER_FLUGZEUG" type="number" value='<?php echo $projectnumber_production; ?>' min="0">
        </div>
        <br>
        <div>
            <label for="objectid">Object ID:</label>
            <input id="objectid" name="OBJEKTID" type="text" value='<?php echo $objectnumber; ?>' maxlength="50">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button id='submit' type='submit'>
                Search
            </button>
        </div>
    </form>
    <br>
    <hr>


    <!-- Search result -->
    <h2>Production Search Result:</h2>
    <table>
        <tr>
            <th></th>
            <th>Company Name</th>
            <th>Project No.</th>
            <th>Object ID</th>
            <th>Design Engineer ID</th>
            <th>Production Time</th>
        </tr>
        <?php $i = 1; foreach ($production_array as $production) : ?>
            <tr>
                <td> <?php echo $i++; ?> </td>
                <td style="width:200px"><center><?php echo $production['UNTERNEHMENSNAME']; ?> </center> </td>
                <td style="width:100px"><center><?php echo $production['PROJEKTNUMMER_FUER_FLUGZEUG']; ?> </center> </td>
                <td style="width:150px"><center><?php echo $production['OBJEKTID']; ?> </center> </td>
                <td style="width:300px"><center><?php echo $production['KONSTRUKTEUR_ID']; ?> </center> </td>
                <td style="width:100px"><center><?php echo $production['HERSTELLUNGSDAUER']; ?> </center> </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <hr style="height:15px;border:none;background-color:#333;" />
</details>


<!-- Automation -->
<details>
    <summary>Automation</summary>
    <!-- Add Automation -->
    <h2>Add Automation: </h2>
    <form method="post" action="addAutomation.php">

        <div>
            <label for="new_automationengineerid">Automation Engineer ID*:</label>
            <input id="new_automationengineerid" name="AUTOMATISIERUNGSTECHNIKERID" type="text" maxlength="10">
        </div>
        <br>

        <div>
            <label for="new_companyname">Company Name*:</label>
            <input id="new_companyname" name="UNTERNEHMENSNAME" type="text" maxlength="100">
        </div>
        <br>

        <div>
            <label for="new_projectid">Project No.*:</label>
            <input id="new_projectid" name="PROJEKTNUMMER_FUER_PRUEFANLAGE" type="number" min="0">
        </div>
        <br>

        <div>
            <label for="new_testfacilityid">Test Facility No.*:</label>
            <input id="new_testfacilityid" name="PRUEFANLAGENNUMMER" type="number" min="0">
        </div>
        <br>
        
        <div>
            <button type="submit">
                Add Automation
            </button>
        </div>
    </form>
    <br>
    <hr>


    <!-- Delete Automation -->
    <h2>Delete Automation:</h2>
    <form method="post" action="delAutomation.php">
        <div>
            <label for="del_automationengineerid">Automation Engineer ID:</label>
            <input id="del_automationengineerid" name="AUTOMATISIERUNGSTECHNIKERID" type="text" maxlength="10">
        </div>
        <br>

        <div>
            <label for="del_companyname">Company Name:</label>
            <input id="del_companyname" name="UNTERNEHMENSNAME" type="text" maxlength="100">
        </div>
        <br>
        
        <div>
            <label for="del_projectnumber">Project No:</label>
            <input id="del_projectnumber" name="PROJEKTNUMMER_FUER_PRUEFANLAGE" type="number" min="0">
        </div>
        <br>

        <div>
            <label for="del_testfacilityid">Test Facility No:</label>
            <input id="del_testfacilityid" name="PRUEFANLAGENNUMMER" type="number" min="0">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button type="submit">
                Delete Automation
            </button>
        </div>
    </form>
    <br>
    <hr>



    <!-- Search form -->
    <h2>Automation Search:</h2>
    <form method="get">
        <div>
            <label for="companyname">Company Name:</label>
            <input id="companyname" name="UNTERNEHMENSNAME" type="text" value='<?php echo $automation_company; ?>' maxlength="100">
        </div>
        <br>

        <div>
            <label for="projectnumber">Project No:</label>
            <input id="projectnumber" name="PROJEKTNUMMER_FUER_PRUEFANLAGE" type="number" value='<?php echo $projectnumber_automation; ?>' min="0">
        </div>
        <br>
        <div>
            <label for="testfacilityid">Test Facility No:</label>
            <input id="testfacilityid" name="PRUEFANLAGENNUMMER" type="number" value='<?php echo $testfacilityid_automation; ?>' min="0">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button id='submit' type='submit'>
                Search
            </button>
        </div>

    </form>
    <br>
    <hr>


    <!-- Search result -->
    <h2>Automation Search Result:</h2>
    <table>
        <tr>
            <th></th>
            <th>Automation Engineer ID</th>
            <th>Company Name</th>
            <th>Project No.</th>
            <th>Test Facility No.</th>
        </tr>
        <?php $i = 1; foreach ($automation_array as $automation) : ?>
            <tr>
                <td> <?php echo $i++; ?> </td>
                <td style="width:200px"><center><?php echo $automation['AUTOMATISIERUNGSTECHNIKERID']; ?> </center> </td>
                <td style="width:300px"><center><?php echo $automation['UNTERNEHMENSNAME']; ?> </center> </td>
                <td style="width:100px"><center><?php echo $automation['PROJEKTNUMMER_FUER_PRUEFANLAGE']; ?> </center> </td>
                <td style="width:150px"><center><?php echo $automation['PRUEFANLAGENNUMMER']; ?> </center> </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <hr style="height:15px;border:none;background-color:#333;" />
</details>



<!-- View of all Automation Engineers with name, surname, company and ID -->
<details>
    <summary>All Automation Engineers</summary>

    <!-- Search form -->
    <h2>Automation Engineer Search:</h2>
    <form method="get">
        <div>
            <label for="last_name">Last Name:</label>
            <input id="last_name" name="NACHNAME" type="text" value='<?php echo $nachname; ?>' maxlength="30">
        </div>
        <br>

        <div>
            <label for="first_name">First Name:</label>
            <input id="first_name" name="VORNAME" type="text" value='<?php echo $vorname; ?>' maxlength="30">
        </div>
        <br>
        <div>
            <label for="companyname">Company Name:</label>
            <input id="companyname" name="UNTERNEHMENSNAME" type="text" value='<?php echo $automationengineer_company; ?>' maxlength="100">
        </div>
        <br>

        <div>
            <label for="automationengineerid">Employee ID:</label>
            <input id="automationengineerid" name="AUTOMATISIERUNGSTECHNIKER_ID" type="text" value='<?php echo $automationengineerid; ?>' maxlength="10">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button id='submit' type='submit'>
                Search
            </button>
        </div>
    </form>
    <br>
    <hr>


    <!-- Search result -->
    <h2>Automation Search Result:</h2>
    <table>
        <tr>
            <th></th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Company Name</th>
            <th>Employee ID</th>
        </tr>
        <?php $i = 1; foreach ($allautomationengineers_array as $automationengineer) : ?>
            <tr>
                <td> <?php echo $i++; ?> </td>
                <td style="width:200px"><center><?php echo $automationengineer['NACHNAME']; ?> </center> </td>
                <td style="width:200px"><center><?php echo $automationengineer['VORNAME']; ?> </center> </td>
                <td style="width:400px"><center><?php echo $automationengineer['UNTERNEHMENSNAME']; ?> </center> </td>
                <td style="width:400px"><center><?php echo $automationengineer['AUTOMATISIERUNGSTECHNIKER_ID']; ?> </center> </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <hr style="height:15px;border:none;background-color:#333;" />
</details>


<!-- View of all Design Engineers with name, surname, company and ID -->
<details>
    <summary>All Design Engineers</summary>

    <!-- Search form -->
    <h2>Design Engineer Search:</h2>
    <form method="get">
        <div>
            <label for="last_name">Last Name:</label>
            <input id="last_name" name="NACHNAME" type="text" value='<?php echo $nachname; ?>' maxlength="30">
        </div>
        <br>

        <div>
            <label for="first_name">First Name:</label>
            <input id="first_name" name="VORNAME" type="text" value='<?php echo $vorname; ?>' maxlength="30">
        </div>
        <br>

        <div>
            <label for="companyname">Company Name:</label>
            <input id="companyname" name="UNTERNEHMENSNAME" type="text" value='<?php echo $designengineer_company; ?>' maxlength="100">
        </div>
        <br>

        <div>
            <label for="automationengineerid">Employee ID:</label>
            <input id="automationengineerid" name="KONSTRUKTEUR_ID" type="text" value='<?php echo $designengineerid; ?>' maxlength="10">
        </div>
        <br>

        <!-- Submit button -->
        <div>
            <button id='submit' type='submit'>
                Search
            </button>
        </div>
    </form>
    <br>
    <hr>


    <!-- Search result -->
    <h2>Automation Search Result:</h2>
    <table>
        <tr>
            <th></th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Company Name</th>
            <th>Employee ID</th>
        </tr>
        <?php $i = 1; foreach ($alldesignengineers_array as $designengineer) : ?>
            <tr>
                <td> <?php echo $i++; ?> </td>
                <td style="width:200px"><center><?php echo $designengineer['NACHNAME']; ?> </center> </td>
                <td style="width:200px"><center><?php echo $designengineer['VORNAME']; ?> </center> </td>
                <td style="width:400px"><center><?php echo $designengineer['UNTERNEHMENSNAME']; ?> </center> </td>
                <td style="width:400px"><center><?php echo $designengineer['KONSTRUKTEUR_ID']; ?> </center> </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <hr>
</details>



</body>
</html>