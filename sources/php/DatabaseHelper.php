<?php

class DatabaseHelper
{
    const username = '***'; // use a + your matriculation number
    const password = '***'; // use your oracle db password
    const con_string = '//oracle19.cs.univie.ac.at:1521/orclcdb';

    protected $conn;

    // Create connection in the constructor
    public function __construct()
    {
        try {
            // Create connection with the command oci_connect(String(username), String(password), String(connection_string))
            $this->conn = oci_connect(
                DatabaseHelper::username,
                DatabaseHelper::password,
                DatabaseHelper::con_string
            );

            //check if the connection object is != null
            if (!$this->conn) {
                // die(String(message)): stop PHP script and output message:
                die("DB error: Connection can't be established!");
            }

        } catch (Exception $e) {
            die("DB error: {$e->getMessage()}");
        }
    }

    public function __destruct()
    {
        // clean up
        oci_close($this->conn);
    }

    // UNTERNEHMEN
    // INSERT
    public function insertIntoUnternehmen($name, $country)
    {
        $sql = "INSERT INTO UNTERNEHMEN (NAME, COUNTRY)
                VALUES ('{$name}', '{$country}')";

        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }

    // selectFromUnternehmenWhere
    public function selectFromUnternehmenWhere($id, $name, $country)
    {
        if($id)
        {
            $sql = "SELECT * FROM UNTERNEHMEN
                WHERE ID LIKE '%{$id}%'";
        }
        elseif ($name)
        {
            $sql = "SELECT * FROM UNTERNEHMEN
                WHERE upper(name) LIKE upper('%{$name}%')";
        }
        elseif ($country)
        {
            $sql = "SELECT * FROM UNTERNEHMEN
                WHERE upper(country) LIKE upper('%{$country}%')
                ORDER BY ID ASC";
        }
        else
        {
            $sql = "SELECT * FROM UNTERNEHMEN ORDER BY ID ASC";
        }

        // oci_parse(...) prepares the Oracle statement for execution
        $statement = oci_parse($this->conn, $sql);

        // Executes the statement
        oci_execute($statement);

        // Fetches multiple rows from a query into a two-dimensional array
        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        //clean up;
        oci_free_statement($statement);

        return $res;
    }

    

    public function deleteUnternehmen($companyid)
    {
        $errorcode = 0;

        // The SQL string
        $sql = 'BEGIN P_DELETE_UNTERNEHMEN(:ID, :errorcode); END;';
        
        $statement = oci_parse($this->conn, $sql);

        //  Bind the parameters
        oci_bind_by_name($statement, ':ID', $companyid);
        oci_bind_by_name($statement, ':errorcode', $errorcode);

        // Execute Statement
        oci_execute($statement);

        //Clean Up
        oci_free_statement($statement);

        return $errorcode;
    }


    // MITARBEITER
    // INSERT
    public function insertIntoMitarbeiter($vorname, $nachname, $geburtsdatum, $geschlecht, $unternehmensname)
    {
        $sql = "INSERT INTO MITARBEITER (VORNAME, NACHNAME, GEBURTSDATUM, GESCHLECHT, UNTERNEHMENSNAME)
                VALUES ('{$vorname}', '{$nachname}', TO_DATE('{$geburtsdatum}', 'yyyy-mm-dd'), '{$geschlecht}', '{$unternehmensname}')";

        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }


    // selectFromMitarbeiterWhere
    public function selectFromMitarbeiterWhere($id, $companyname)
    {
        if($id)
        {
            $sql = "SELECT * FROM MITARBEITER
                WHERE upper(mitarbeiterid) LIKE upper('%{$id}%')";
        }
        elseif($companyname)
        {
            $sql = "SELECT * FROM MITARBEITER
                WHERE upper(unternehmensname) LIKE upper('%{$companyname}%')
                ORDER BY upper(nachname) ASC";
        }
        else
        {
            $sql = "SELECT * FROM MITARBEITER";
        }

        $statement = oci_parse($this->conn, $sql);

        oci_execute($statement);

        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        //clean up;
        oci_free_statement($statement);

        return $res;
    }


    public function deleteEmployee($mitarbeiterid)
    {
        $errorcode = 0;

        // The SQL string
        $sql = 'BEGIN P_DELETE_MITARBEITER(:MITARBEITERID, :errorcode); END;';
        
        $statement = oci_parse($this->conn, $sql);

        //  Bind the parameters
        oci_bind_by_name($statement, ':MITARBEITERID', $mitarbeiterid);
        oci_bind_by_name($statement, ':errorcode', $errorcode);

        // Execute Statement
        oci_execute($statement);

        //Clean Up
        oci_free_statement($statement);

        return $errorcode;
    }


    public function updateEmployeesCompany($employeeid, $companyname)
    {
        $sql = "BEGIN P_UPDATE_MITARBEITER(:MITARBEITERID, :UNTERNEHMENSNAME); END;";
        
        $statement = oci_parse($this->conn, $sql);

        //  Bind the parameters
        oci_bind_by_name($statement, ':MITARBEITERID', $employeeid);
        oci_bind_by_name($statement, ':UNTERNEHMENSNAME', $companyname);


        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }



    public function updateAutomationEngineer($employeeid, $salary)
    {
        $sql = "BEGIN P_UPDATE_AUTOMATISIERUNGSTECHNIKER(:AUTOMATISIERUNGSTECHNIKER_ID, :GEHALT); END;";


        $statement = oci_parse($this->conn, $sql);

        //  Bind the parameters
        oci_bind_by_name($statement, ':AUTOMATISIERUNGSTECHNIKER_ID', $employeeid);
        oci_bind_by_name($statement, ':GEHALT', $salary);


        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }


    // Automation Engineer
    // INSERT
    public function insertIntoAutomationEngineer($automationengineerid, $salary, $email, $laptop)
    {
        $sql = "INSERT INTO AUTOMATISIERUNGSTECHNIKER (AUTOMATISIERUNGSTECHNIKER_ID, GEHALT, EMAIL, LAPTOP)
                VALUES ('{$automationengineerid}', '{$salary}', '{$email}', '{$laptop}')";

        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }


    // selectFromAutomationEngineerWhere
    public function selectFromAutomationEngineerWhere($automationengineerid)
    {
        if($automationengineerid)
        {
            $sql = "SELECT * FROM AUTOMATISIERUNGSTECHNIKER
                WHERE AUTOMATISIERUNGSTECHNIKER_ID LIKE '%{$automationengineerid}%'";
        }
        else
        {
            $sql = "SELECT * FROM AUTOMATISIERUNGSTECHNIKER";
        }

        // oci_parse(...) prepares the Oracle statement for execution
        $statement = oci_parse($this->conn, $sql);

        // Executes the statement
        oci_execute($statement);

        // Fetches multiple rows from a query into a two-dimensional array
        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        //clean up;
        oci_free_statement($statement);

        return $res;
    }


    public function deleteAutomationEngineer($automationengineerid)
    {
        $errorcode = 0;

        // The SQL string
        $sql = 'BEGIN P_DELETE_AUTOMATISIERUNGSTECHNIKER(:AUTOMATISIERUNGSTECHNIKER_ID, :errorcode); END;';
        
        $statement = oci_parse($this->conn, $sql);

        //  Bind the parameters
        oci_bind_by_name($statement, ':AUTOMATISIERUNGSTECHNIKER_ID', $automationengineerid);
        oci_bind_by_name($statement, ':errorcode', $errorcode);

        // Execute Statement
        oci_execute($statement);

        //Clean Up
        oci_free_statement($statement);

        return $errorcode;
    }




    // Design Engineer
    // INSERT
    public function insertIntoDesignEngineer($designengineerid, $sv_number, $equipment, $training)
    {
        $sql = "INSERT INTO KONSTRUKTEUR (KONSTRUKTEUR_ID, SVNUMMER, AUSRUESTUNG, AUSBILDUNG)
                VALUES ('{$designengineerid}', '{$sv_number}', '{$equipment}', '{$training}')";

        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }


    // selectFromDesignEngineerWhere
    public function selectFromDesignEngineerWhere($designengineerid)
    {
        if($designengineerid)
        {
            $sql = "SELECT * FROM KONSTRUKTEUR
                WHERE KONSTRUKTEUR_ID LIKE '%{$designengineerid}%'";
        }
        else
        {
            $sql = "SELECT * FROM KONSTRUKTEUR";
        }

        $statement = oci_parse($this->conn, $sql);

        // Executes the statement
        oci_execute($statement);

        // Fetches multiple rows from a query into a two-dimensional array
        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        //clean up;
        oci_free_statement($statement);

        return $res;
    }


    public function deleteDesignEngineer($designengineerid)
    {
        $errorcode = 0;

        // The SQL string
        $sql = 'BEGIN P_DELETE_KONSTRUKTEUR(:KONSTRUKTEUR_ID, :errorcode); END;';
        
        $statement = oci_parse($this->conn, $sql);

        //  Bind the parameters
        oci_bind_by_name($statement, ':KONSTRUKTEUR_ID', $designengineerid);
        oci_bind_by_name($statement, ':errorcode', $errorcode);

        // Execute Statement
        oci_execute($statement);

        //Clean Up
        oci_free_statement($statement);

        return $errorcode;
    }



    // Project
    // INSERT
    public function insertIntoProject($companyname, $projectnumber, $projectname, $budget, $deadline)
    {
        $sql = "INSERT INTO PROJEKT (UNTERNEHMENSNAME, PROJEKTNAME, BUDGET, DEADLINE)
                VALUES ('{$companyname}', '{$projectname}', '{$budget}', TO_DATE('{$deadline}', 'yyyy-mm-dd'))";

        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }


    // selectFromProjectWhere
    public function selectFromProjectWhere($companyname, $projectnumber)
    {
        if ($companyname && $projectnumber)
        {
            $sql = "SELECT * FROM PROJEKT
                WHERE upper(unternehmensname) LIKE upper('%{$companyname}%')
                AND PROJEKTNUMMER LIKE '%{$projectnumber}%'";
        }
        elseif($companyname)
        {
            $sql = "SELECT * FROM PROJEKT
                WHERE upper(unternehmensname) LIKE upper('%{$companyname}%')";
        }
        elseif ($projectnumber)
        {
            $sql = "SELECT * FROM PROJEKT
                WHERE PROJEKTNUMMER LIKE '%{$projectnumber}%'";
        }
        else
        {
            $sql = "SELECT * FROM PROJEKT ORDER BY Deadline";
        }

        $statement = oci_parse($this->conn, $sql);

        // Executes the statement
        oci_execute($statement);

        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        //clean up;
        oci_free_statement($statement);

        return $res;
    }


    public function deleteProject($projectnumber)
    {
        $errorcode = 0;

        // The SQL string
        $sql = 'BEGIN P_DELETE_PROJEKT(:PROJEKTNUMMER, :errorcode); END;';
        
        $statement = oci_parse($this->conn, $sql);

        //  Bind the parameters
        oci_bind_by_name($statement, ':PROJEKTNUMMER', $projectnumber);
        oci_bind_by_name($statement, ':errorcode', $errorcode);

        // Execute Statement
        oci_execute($statement);

        //Clean Up
        oci_free_statement($statement);

        return $errorcode;
    }




    // Aircraft Component
    // INSERT
    public function insertIntoAircraft($companyname, $projectnumber, $objectnumber, $model, $length, $width, $hight)
    {
        $sql = "INSERT INTO FLUGZEUG (
                UNTERNEHMENSNAME,
                PROJEKTNUMMER_FUER_FLUGZEUG,
                OBJEKTID,
                MODEL, LAENGE, BREITE, HOEHE)
                VALUES ('{$companyname}', '{$projectnumber}',
                '{$objectnumber}', '{$model}',
                '{$length}', '{$width}', '{$hight}')";

        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }


    // selectFromAircraftComponentWhere
    public function selectFromAircraftWhere($companyname, $objectnumber)
    {
        if ($companyname && $objectnumber)
        {
            $sql = "SELECT * FROM FLUGZEUG
                WHERE upper(unternehmensname) LIKE upper('%{$companyname}%')
                AND OBJEKTID LIKE '%{$objectnumber}%'";
        }
        elseif ($companyname)
        {
            $sql = "SELECT * FROM FLUGZEUG
                WHERE upper(unternehmensname) LIKE upper('%{$companyname}%')";
        }
        else
        {
            $sql = "SELECT * FROM FLUGZEUG ORDER BY upper(unternehmensname) ASC";
        }

        $statement = oci_parse($this->conn, $sql);

        // Executes the statement
        oci_execute($statement);

        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        //clean up;
        oci_free_statement($statement);

        return $res;
    }


    public function deleteAircraft($companyname, $objectnumber)
    {
        $errorcode = 0;

        // The SQL string
        $sql = 'BEGIN P_DELETE_FLUGZEUG(:UNTERNEHMENSNAME, :OBJEKTID, :errorcode); END;';
        
        $statement = oci_parse($this->conn, $sql);

        //  Bind the parameters
        oci_bind_by_name($statement, ':UNTERNEHMENSNAME', $companyname);
        oci_bind_by_name($statement, ':OBJEKTID', $objectnumber);
        oci_bind_by_name($statement, ':errorcode', $errorcode);

        // Execute Statement
        oci_execute($statement);

        //Clean Up
        oci_free_statement($statement);

        return $errorcode;
    }



    // Test Facility
    // INSERT
    public function insertIntoTestFacility($companyname, $projectnumber, $testfacilitynumber, $supervisory)
    {
        $sql = "INSERT INTO PRUEFANLAGE (
                UNTERNEHMENSNAME,
                PROJEKTNUMMER_FUER_PRUEFANLAGE,
                PRUEFANLAGENNUMMER,
                BEAUFSICHTSPERSON)
                VALUES ('{$companyname}', '{$projectnumber}', '{$testfacilitynumber}', '{$supervisory}')";

        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }


    // selectFromTestFacilityWhere
    public function selectFromTestFacilityWhere($companyname, $projectnumber, $testfacilitynumber)
    {
        if ($companyname && $projectnumber && $testfacilitynumber)
        {
            $sql = "SELECT * FROM PRUEFANLAGE
                WHERE upper(unternehmensname) LIKE upper('%{$companyname}%')
                AND PROJEKTNUMMER_FUER_PRUEFANLAGE LIKE '%{$projectnumber}%'
                AND PRUEFANLAGENNUMMER LIKE '%{$testfacilitynumber}%'";
        }
        elseif ($companyname)
        {
            $sql = "SELECT * FROM PRUEFANLAGE
                WHERE upper(unternehmensname) LIKE upper('%{$companyname}%')";
        }
        elseif ($testfacilitynumber)
        {
            $sql = "SELECT * FROM PRUEFANLAGE
                WHERE PRUEFANLAGENNUMMER LIKE '%{$testfacilitynumber}%'";
        }
        else
        {
            $sql = "SELECT * FROM PRUEFANLAGE ORDER BY upper(unternehmensname) ASC";
        }

        $statement = oci_parse($this->conn, $sql);

        // Executes the statement
        oci_execute($statement);

        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        //clean up;
        oci_free_statement($statement);

        return $res;
    }


    public function deleteTestFacility($companyname, $projectnumber, $testfacilitynumber)
    {
        $errorcode = 0;

        // The SQL string
        $sql = 'BEGIN P_DELETE_PRUEFANLAGE(:UNTERNEHMENSNAME, :PROJEKTNUMMER_FUER_PRUEFANLAGE, :PRUEFANLAGENNUMMER, :errorcode); END;';
        
        $statement = oci_parse($this->conn, $sql);

        //  Bind the parameters
        oci_bind_by_name($statement, ':UNTERNEHMENSNAME', $companyname);
        oci_bind_by_name($statement, ':PROJEKTNUMMER_FUER_PRUEFANLAGE', $projectnumber);
        oci_bind_by_name($statement, ':PRUEFANLAGENNUMMER', $testfacilitynumber);
        oci_bind_by_name($statement, ':errorcode', $errorcode);

        // Execute Statement
        oci_execute($statement);

        //Clean Up
        oci_free_statement($statement);

        return $errorcode;
    }




    // Production
    // INSERT
    public function insertIntoProduction($companyname, $projectnumber_production, $objectid, $designengineerid, $productiontime)
    {
        $sql = "INSERT INTO HERSTELLUNG (
                UNTERNEHMENSNAME,
                PROJEKTNUMMER_FUER_FLUGZEUG,
                OBJEKTID,
                KONSTRUKTEUR_ID,
                HERSTELLUNGSDAUER)
                VALUES ('{$companyname}', '{$projectnumber_production}', '{$objectid}', '{$designengineerid}', '{$productiontime}')";

        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }


    // selectFromTestFacilityWhere
    public function selectFromProductionWhere($companyname, $projectnumber_production, $objectid)
    {
        if ($companyname && $projectnumber_production && $objectid)
        {
            $sql = "SELECT * FROM HERSTELLUNG
                WHERE upper(unternehmensname) LIKE upper('%{$companyname}%')
                AND PROJEKTNUMMER_FUER_FLUGZEUG LIKE '%{$projectnumber_production}%'
                AND OBJEKTID LIKE '%{$objectid}%'";
        }
        elseif ($companyname)
        {
            $sql = "SELECT * FROM HERSTELLUNG
                WHERE upper(unternehmensname) LIKE upper('%{$companyname}%')";
        }
        elseif ($projectnumber_production)
        {
            $sql = "SELECT * FROM HERSTELLUNG
                WHERE upper(PROJEKTNUMMER_FUER_FLUGZEUG) LIKE upper('%{$projectnumber_production}%')";
        }
        elseif ($objectid)
        {
            $sql = "SELECT * FROM HERSTELLUNG
                WHERE upper(OBJEKTID) LIKE upper('%{$objectid}%')";
        }
        else
        {
            $sql = "SELECT * FROM HERSTELLUNG ORDER BY upper(unternehmensname) ASC";
        }

        $statement = oci_parse($this->conn, $sql);

        // Executes the statement
        oci_execute($statement);

        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        //clean up;
        oci_free_statement($statement);

        return $res;
    }


    public function deleteProduction($companyname, $projectnumber_production, $materialid)
    {
        $errorcode = 0;

        // The SQL string
        $sql = 'BEGIN P_DELETE_HERSTELLUNG(:UNTERNEHMENSNAME, :PROJEKTNUMMER_FUER_FLUGZEUGKOMPONENTE, :MATERIALNUMMER, :errorcode); END;';
        
        $statement = oci_parse($this->conn, $sql);

        //  Bind the parameters
        oci_bind_by_name($statement, ':UNTERNEHMENSNAME', $companyname);
        oci_bind_by_name($statement, ':PROJEKTNUMMER_FUER_FLUGZEUGKOMPONENTE', $projectnumber_production);
        oci_bind_by_name($statement, ':MATERIALNUMMER', $materialid);
        oci_bind_by_name($statement, ':errorcode', $errorcode);

        // Execute Statement
        oci_execute($statement);

        //Clean Up
        oci_free_statement($statement);

        return $errorcode;
    }



    // Automation
    // INSERT
    public function insertIntoAutomation($automationengineerid, $companyname, $projectnumber_automation, $testfacilitynumber)
    {
        $sql = "INSERT INTO AUTOMATISIERUNG (
                AUTOMATISIERUNGSTECHNIKERID,
                UNTERNEHMENSNAME,
                PROJEKTNUMMER_FUER_PRUEFANLAGE,
                PRUEFANLAGENNUMMER)
                VALUES ('{$automationengineerid}', '{$companyname}',
                '{$projectnumber_automation}', '{$testfacilitynumber}')";

        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        oci_free_statement($statement);
        return $success;
    }


    // selectFromTestFacilityWhere
    public function selectFromAutomationWhere($companyname, $projectnumber_automation, $testfacilityid_automation)
    {
        if ($companyname && $projectnumber_automation && $testfacilityid_automation)
        {
            $sql = "SELECT * FROM AUTOMATISIERUNG
                WHERE upper(unternehmensname) LIKE upper('%{$companyname}%')
                AND PROJEKTNUMMER_FUER_PRUEFANLAGE LIKE '%{$projectnumber_automation}%'
                AND PRUEFANLAGENNUMMER LIKE '%{$testfacilityid_automation}%'";
        }
        elseif ($companyname)
        {
            $sql = "SELECT * FROM AUTOMATISIERUNG
                WHERE upper(unternehmensname) LIKE upper('%{$companyname}%')";
        }
        else
        {
            $sql = "SELECT * FROM AUTOMATISIERUNG";
        }

        $statement = oci_parse($this->conn, $sql);

        // Executes the statement
        oci_execute($statement);

        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        //clean up;
        oci_free_statement($statement);

        return $res;
    }


    public function deleteAutomation($automationengineerid, $companyname, $projectnumber_automation, $testfacilitynumber)
    {
        $errorcode = 0;

        // The SQL string
        $sql = 'BEGIN P_DELETE_AUTOMATISIERUNG(:AUTOMATISIERUNGSTECHNIKERID, :UNTERNEHMENSNAME, :PROJEKTNUMMER_FUER_PRUEFANLAGE, :PRUEFANLAGENNUMMER, :errorcode); END;';
        
        $statement = oci_parse($this->conn, $sql);

        //  Bind the parameters
        oci_bind_by_name($statement, ':AUTOMATISIERUNGSTECHNIKERID', $automationengineerid);
        oci_bind_by_name($statement, ':UNTERNEHMENSNAME', $companyname);
        oci_bind_by_name($statement, ':PROJEKTNUMMER_FUER_PRUEFANLAGE', $projectnumber_automation);
        oci_bind_by_name($statement, ':PRUEFANLAGENNUMMER', $testfacilitynumber);
        oci_bind_by_name($statement, ':errorcode', $errorcode);

        // Execute Statement
        oci_execute($statement);
        
        //Clean Up
        oci_free_statement($statement);

        return $errorcode;
    }


    // selectFromAllAutomationEngineersWhere
    public function selectFromAllAutomationEngineersWhere($nachname, $vorname, $companyname, $automationengineerid)
    {
        if ($nachname && $vorname && $companyname)
        {
            $sql = "SELECT * FROM ALLE_AUTOMATISIERUNGSTECHNIKER
                WHERE upper(nachname) LIKE upper('%{$nachname}%')
                AND upper(vorname) LIKE upper('%{$vorname}%')
                AND upper(unternehmensname) LIKE upper('%{$companyname}%')";
        }
        elseif ($nachname)
        {
            $sql = "SELECT * FROM ALLE_AUTOMATISIERUNGSTECHNIKER
                    WHERE upper(nachname) LIKE upper('%{$nachname}%')
                    ORDER BY upper(nachname) ASC";
        }
        else if($vorname)
        {
            $sql = "SELECT * FROM ALLE_AUTOMATISIERUNGSTECHNIKER
                    WHERE upper(vorname) LIKE upper('%{$vorname}%')
                    ORDER BY upper(nachname) ASC";
        }
        else if($companyname)
        {
            $sql = "SELECT * FROM ALLE_AUTOMATISIERUNGSTECHNIKER
                    WHERE upper(unternehmensname) LIKE upper('%{$companyname}%')
                    ORDER BY upper(nachname) ASC";
        }
        else if($automationengineerid)
        {
            $sql = "SELECT * FROM ALLE_AUTOMATISIERUNGSTECHNIKER
                    WHERE upper(automatisierungstechniker_id) LIKE upper('%{$automationengineerid}%')
                    ORDER BY upper(nachname) ASC";
        }
        else
        {
            $sql = "SELECT * FROM ALLE_AUTOMATISIERUNGSTECHNIKER
                    ORDER BY upper(nachname) ASC";
        }

        $statement = oci_parse($this->conn, $sql);

        // Executes the statement
        oci_execute($statement);

        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        //clean up;
        oci_free_statement($statement);

        return $res;
    }



    // selectFromAllDesignEngineersWhere
    public function selectFromAllDesignEngineersWhere($nachname, $vorname, $companyname, $designengineerid)
    {
        if ($nachname && $vorname && $companyname)
        {
            $sql = "SELECT * FROM ALLE_KONSTRUKTEURE
                WHERE upper(nachname) LIKE upper('%{$nachname}%')
                AND upper(vorname) LIKE upper('%{$vorname}%')
                AND upper(unternehmensname) LIKE upper('%{$companyname}%')";
        }
        elseif ($nachname)
        {
            $sql = "SELECT * FROM ALLE_KONSTRUKTEURE
                    WHERE upper(nachname) LIKE upper('%{$nachname}%')
                    ORDER BY upper(nachname) ASC";
        }
        else if($vorname)
        {
            $sql = "SELECT * FROM ALLE_KONSTRUKTEURE
                    WHERE upper(vorname) LIKE upper('%{$vorname}%')
                    ORDER BY upper(nachname) ASC";
        }
        else if($companyname)
        {
            $sql = "SELECT * FROM ALLE_KONSTRUKTEURE
                    WHERE upper(unternehmensname) LIKE upper('%{$companyname}%')
                    ORDER BY upper(nachname) ASC";
        }
        else if($designengineerid)
        {
            $sql = "SELECT * FROM ALLE_KONSTRUKTEURE
                    WHERE upper(konstrukteur_id) LIKE upper('%{$designengineerid}%')
                    ORDER BY upper(nachname) ASC";
        }
        else
        {
            $sql = "SELECT * FROM ALLE_KONSTRUKTEURE
                    ORDER BY upper(nachname) ASC";
        }

        $statement = oci_parse($this->conn, $sql);

        // Executes the statement
        oci_execute($statement);

        oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        //clean up;
        oci_free_statement($statement);

        return $res;
    }
}
