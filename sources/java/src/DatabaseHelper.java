//Database Systems (Module IDS) 

import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;


// The DatabaseHelper class encapsulates the communication with our database
class DatabaseHelper {
    // Database connection info
    private static final String DB_CONNECTION_URL = "jdbc:oracle:thin:@oracle19.cs.univie.ac.at:1521:orclcdb";
    private static final String USER = "***"; 
    private static final String PASS = "***"; 

    // The name of the class loaded from the ojdbc14.jar driver file
    private static final String CLASSNAME = "oracle.jdbc.driver.OracleDriver";

    // We need only one Connection and one Statement during the execution => class variable
    private static Statement stmt;
    private static Connection con;
    
    
    //CREATE CONNECTION
    DatabaseHelper() {
        try {
            //Loads the class into the memory
            Class.forName(CLASSNAME);

            // establish connection to database
            con = DriverManager.getConnection(DB_CONNECTION_URL, USER, PASS);
            stmt = con.createStatement();

        } catch (Exception e) {
            e.printStackTrace();
        }
    }
    
    Map<String, String> selectCompanyCountry(Map<String, String> mapOfCompanyCountry) {
    	
    	try
    	{
    		ResultSet rs = stmt.executeQuery("SELECT NAME,COUNTRY FROM UNTERNEHMEN");
    		while (rs.next()) {
    			if (rs.getNString("COUNTRY") != null && !rs.getNString("COUNTRY").isEmpty())
    				mapOfCompanyCountry.put(rs.getNString("NAME").toLowerCase().trim().replaceAll(" & ", "-").replaceAll(" ", "-").replaceAll(",", "").toString(), rs.getNString("COUNTRY").toLowerCase().trim().toString());
    			else
    				mapOfCompanyCountry.put(rs.getNString("NAME").toLowerCase().trim().replaceAll(" & ", "-").replaceAll(" ", "-").replaceAll(",", "").toString(), "com");
			}
    		rs.close();
    		
    	} catch (Exception e) {
    		System.err.println(("Error at: selectCompanyCountry\n message: " + e.getMessage()).trim());
		}
    	return mapOfCompanyCountry;
    }
    
    
    //INSERT INTO Employee
    public void insertIntoEmployee(String firstName, String lastName, String dateOfBirth, String sex, String companyName) {
        try {
            String sql = "INSERT INTO MITARBEITER ("
	            		+ "VORNAME,"
	            		+ "NACHNAME,"
	            		+ "GEBURTSDATUM,"
	            		+ "GESCHLECHT,"
	            		+ "UNTERNEHMENSNAME) VALUES ('"
	            		+ firstName + "', '"
	            		+ lastName + "',"
	            		+ "TO_DATE('" + dateOfBirth + "', 'yyyy-mm-dd'), '"
	            		+ sex + "', '"
	            		+ companyName + "')";
            stmt.execute(sql);
        } catch (Exception e) {
            System.err.println("Error at: insertIntoEmployee\nmessage: " + e.getMessage());
        }
    }
    
    List<String> selectEmployeeIdFromEmployee() {
    	List<String> IDs = new ArrayList<>();
    	
    	try
    	{
    		ResultSet rs = stmt.executeQuery("SELECT MITARBEITERID FROM MITARBEITER");
    		while (rs.next())
                IDs.add(rs.getNString("MITARBEITERID"));
    		rs.close();
    		
    	} catch (Exception e) {
    		System.err.println(("Error at: selectEmployeeIdFromEmployee\n message: " + e.getMessage()).trim());
		}
    	
    	return IDs;
    }
    
    //Making emails using SELECT FROM MITARBEITER
    String selectFromMitarbeiter(String id, Map<String, String> getCompanyCountry) {
    	String email = "";
    	try
    	{
    		ResultSet rs = stmt.executeQuery("SELECT VORNAME,NACHNAME,UNTERNEHMENSNAME FROM MITARBEITER WHERE MITARBEITERID LIKE '" + id + "'");

    		while (rs.next()) {
				StringBuilder tmp = new  StringBuilder();
				tmp.append(rs.getNString("VORNAME").toLowerCase());
				tmp.append(".");
				tmp.append(rs.getNString("NACHNAME").toLowerCase());
				tmp.append("@");
				tmp.append(rs.getNString("UNTERNEHMENSNAME").toLowerCase().trim().replaceAll(" & ", "-").replaceAll(" ", "-").replaceAll(",", "").toString());
				tmp.append(".");
				if (getCompanyCountry.containsKey(rs.getNString("UNTERNEHMENSNAME").toLowerCase().trim().replaceAll(" & ", "-").replaceAll(" ", "-").replaceAll(",", "").toString()))
					tmp.append(getCompanyCountry.get(rs.getNString("UNTERNEHMENSNAME").toLowerCase().trim().replaceAll(" & ", "-").replaceAll(" ", "-").replaceAll(",", "").toString()));
				email = tmp.toString();
                
    		}
    		rs.close();
    		
    	} catch (Exception e) {
    		System.err.println(("Error at: selectFromMitarbeiter\n message: " + e.getMessage()).trim());
		}
    	
    	return email;
    }

    
    
    //INSERT INTO Automation Engineer
    public void insertIntoAutomationEngineer(String automationEngineerID, String salary, String email, String laptop) {
        try {
            String sql = "INSERT INTO AUTOMATISIERUNGSTECHNIKER VALUES ('" +
            		automationEngineerID + "'," +
            		Double.parseDouble(salary) + ",'" +
            		email + "','" +
            		laptop + "')";
            stmt.execute(sql);
        } catch (Exception e) {
            System.err.println("Error at: insertIntoAutomationEngineer\nmessage: " + e.getMessage());
        }
    }



    public void insertIntoDesignEngineer(String designEngineerID, String svnumber, String equipment, String training) {
    	try {
    		String sql = "INSERT INTO KONSTRUKTEUR VALUES ('" +
    				designEngineerID + "'," +
    				Long.parseLong(svnumber) + ",'" +
    				equipment + "','" +
    				training + "')";
    		stmt.execute(sql);
    	} catch (Exception e) {
    		System.err.println("Error at: insertIntoDesignEngineer\nmessage: " + e.getMessage());
		}
    }
    
    
    public void insertIntoProject(String companyName, String projectName, String budget, String deadline) {
        try {
        	String sql = "INSERT INTO PROJEKT("
        			+ "UNTERNEHMENSNAME,"
        			+ "PROJEKTNAME,"
        			+ "BUDGET,"
        			+ "DEADLINE) VALUES ('"
        			+ companyName + "','" +
            		projectName + "'," +
            		Double.parseDouble(budget) + ","
            		+ "TO_DATE('" + deadline + "', 'yyyy-mm-dd'))";
            stmt.execute(sql);
        } catch (Exception e) {
            System.err.println("Error at: insertIntoProject\nmessage: " + e.getMessage());
        }
    }
    
    
    public void insertIntoAirCraft(String companyName, String projectNumber, String objectID, String aircrafModel, String length, String width, String height) {
    	try {
    		String sql = "INSERT INTO FLUGZEUG(UNTERNEHMENSNAME,PROJEKTNUMMER_FUER_FLUGZEUG,OBJEKTID,MODEL,LAENGE,BREITE,HOEHE) VALUES ('" +
    				companyName + "'," +
    				Integer.parseInt(projectNumber) + ",'" +
    				objectID + "','" +
    				aircrafModel + "'," +
    				Double.parseDouble(length) + "," +
    				Double.parseDouble(width) + "," +
    				Double.parseDouble(height) + ")";
    		stmt.execute(sql);
    	} catch (Exception e) {
    		System.err.println("Error at: insertIntoAircraft\nmessage: " + e.getMessage());
		}
    }
    
    
    List<String[]> selectFromProjectNumberAndCompany(String aircraftModel) {
    	List<String[]> companies = new ArrayList<>();
    	
    	try {
            ResultSet rs = stmt.executeQuery("SELECT PROJEKTNUMMER,PROJEKTNAME,UNTERNEHMENSNAME FROM PROJEKT WHERE PROJEKTNAME LIKE 'Production of " + aircraftModel +
            		"'OR PROJEKTNAME LIKE 'Automation of " + aircraftModel + "' OR PROJEKTNAME LIKE 'Maintenance of " + aircraftModel + "'");
            while (rs.next()) {
            	if (rs.getNString("PROJEKTNAME").contains(aircraftModel)) {
            		String[] keyValue = {rs.getNString("PROJEKTNUMMER"), rs.getNString("UNTERNEHMENSNAME")};
            		companies.add(keyValue);
            	}
            }
            rs.close();
        } catch (Exception e) {
            System.err.println(("Error at: selectFromProjectCompany\n message: " + e.getMessage()).trim());
        }
    	return companies;
    }
    
    void insertIntoTestFacility(String companyName, String projectNumber, String testFacilityNumber, String supervisory) {
    	try {
        	String sql = "INSERT INTO PRUEFANLAGE("
        			+ "UNTERNEHMENSNAME,"
        			+ "PROJEKTNUMMER_FUER_PRUEFANLAGE,"
        			+ "PRUEFANLAGENNUMMER,"
        			+ "BEAUFSICHTSPERSON) VALUES ('"
        			+ companyName + "',"
            		+ Integer.parseInt(projectNumber) + ",'"
            		+ testFacilityNumber + "',"
            		+ Integer.parseInt(supervisory) + ")";
            stmt.execute(sql);
        } catch (Exception e) {
            System.err.println("Error at: insertIntoTestFacility\nmessage: " + e.getMessage());
        }
    }
    
    
    void insertIntoProduction(String companyName, String projectNumber, String objectID, String designEngineerID, String productionTime) {
    	try {
        	String sql = "INSERT INTO HERSTELLUNG("
        			+ "UNTERNEHMENSNAME,"
        			+ "PROJEKTNUMMER_FUER_FLUGZEUG,"
        			+ "OBJEKTID,"
        			+ "KONSTRUKTEUR_ID,"
        			+ "HERSTELLUNGSDAUER) VALUES ('"
        			+ companyName + "',"
            		+ Integer.parseInt(projectNumber) + ",'"
            		+ objectID + "','"
            		+ designEngineerID + "',"
            		+ Integer.parseInt(productionTime) + ")";
            stmt.execute(sql);
        } catch (Exception e) {
            System.err.println("Error at: insertIntoProduction\nmessage: " + e.getMessage());
        }
    }
    
    
    void insertIntoAutomation(String automationEngineerID, String companyName, String projectNumber, String testFacilityNumber) {
    	try {
        	String sql = "INSERT INTO AUTOMATISIERUNG("
        			+ "AUTOMATISIERUNGSTECHNIKERID,"
        			+ "UNTERNEHMENSNAME,"
        			+ "PROJEKTNUMMER_FUER_PRUEFANLAGE,"
        			+ "PRUEFANLAGENNUMMER) VALUES ('"
        			+ automationEngineerID + "','"
            		+ companyName + "',"
            		+ Integer.parseInt(projectNumber) + ",'"
            		+ testFacilityNumber + "')";
            stmt.execute(sql);
        } catch (Exception e) {
            System.err.println("Error at: insertIntoAutomation\nmessage: " + e.getMessage());
        }
    }
    
    Integer selectFromProjectProjectNumber(String projectName) {
    	int projectNumber = 0;
    	try {
            ResultSet rs = stmt.executeQuery("SELECT PROJEKTNUMMER FROM PROJEKT WHERE PROJEKTNAME LIKE '" + projectName + "'");
            while (rs.next()) {
            	projectNumber = rs.getInt("PROJEKTNUMMER");
            	
            }
            rs.close();
        } catch (Exception e) {
            System.err.println(("Error at: selectFromProjectProjectNumber\n message: " + e.getMessage()).trim());
        }
    	return projectNumber;
    }
    
    String selectFromProjectCompanyName(String projectName) {
    	String company = "";
    	try {
            ResultSet rs = stmt.executeQuery("SELECT UNTERNEHMENSNAME FROM PROJEKT WHERE PROJEKTNAME LIKE '" + projectName + "'");
            while (rs.next()) {
            	company = rs.getNString("UNTERNEHMENSNAME");
            	
            }
            rs.close();
        } catch (Exception e) {
            System.err.println(("Error at: selectFromProjectCompanyName\n message: " + e.getMessage()).trim());
        }
    	return company;
    }
    
    
    String selectFromAircrafObjectId(String projectNumber) {
    	String objectId = "";
    	try {
            ResultSet rs = stmt.executeQuery("SELECT OBJEKTID FROM FLUGZEUG WHERE PROJEKTNUMMER_FUER_FLUGZEUG LIKE " + Integer.parseInt(projectNumber));
            while (rs.next()) {
            	objectId = rs.getNString("OBJEKTID");
            	
            }
            rs.close();
        } catch (Exception e) {
            System.err.println(("Error at: selectFromAircrafObjectId\n message: " + e.getMessage()).trim());
        }
    	return objectId;
    }
    
    
    
    String selectFromTestFacilityTFNumber(String projectNumber) {
    	String testFacilityNo = "";
    	try {
            ResultSet rs = stmt.executeQuery("SELECT PRUEFANLAGENNUMMER FROM PRUEFANLAGE WHERE PROJEKTNUMMER_FUER_PRUEFANLAGE LIKE " + Integer.parseInt(projectNumber));
            while (rs.next()) {
            	testFacilityNo = rs.getNString("PRUEFANLAGENNUMMER");
            	
            }
            rs.close();
        } catch (Exception e) {
            System.err.println(("Error at: selectFromTestFacilityTFNumber\n message: " + e.getMessage()).trim());
        }
    	return testFacilityNo;
    }
    
    
    List<String> selectFromEmployeeID(String companyName) {
    	List<String> employeeID = new ArrayList<>() ;
    	try {
            ResultSet rs = stmt.executeQuery("SELECT MITARBEITERID FROM MITARBEITER WHERE UNTERNEHMENSNAME LIKE " + companyName);
            while (rs.next()) {
            	employeeID.add(rs.getNString("MITARBEITERID"));
            	
            }
            rs.close();
        } catch (Exception e) {
            System.err.println(("Error at: selectFromEmployeeID\n message: " + e.getMessage()).trim());
        }
    	return employeeID;
    }
    
    
    void selectCounterFromUnternehmen() {
		try {
			ResultSet rs = stmt.executeQuery("SELECT COUNT(*) FROM UNTERNEHMEN");
			if (rs.next()) {
	    		int count = rs.getInt(1);
	    		System.out.println("Number of datasets for Company: " + count);
	    	}
		} catch (Exception e) {
			e.printStackTrace();
		}
    	
    }
    
    void selectCounterFromEmployee() {
		try {
			ResultSet rs = stmt.executeQuery("SELECT COUNT(*) FROM MITARBEITER");
			if (rs.next()) {
	    		int count = rs.getInt(1);
	    		System.out.println("Number of datasets for Employee: " + count);
	    	}
		} catch (Exception e) {
			e.printStackTrace();
		}
    	
    }
    
    void selectCounterFromAutomationEngineer() {
		try {
			ResultSet rs = stmt.executeQuery("SELECT COUNT(*) FROM AUTOMATISIERUNGSTECHNIKER");
			if (rs.next()) {
	    		int count = rs.getInt(1);
	    		System.out.println("Number of datasets for Automation Engineer: " + count);
	    	}
		} catch (Exception e) {
			e.printStackTrace();
		}
    	
    }
    
    
    void selectCounterFromDesignEngineer() {
		try {
			ResultSet rs = stmt.executeQuery("SELECT COUNT(*) FROM KONSTRUKTEUR");
			if (rs.next()) {
	    		int count = rs.getInt(1);
	    		System.out.println("Number of datasets for Design Engineer: " + count);
	    	}
		} catch (Exception e) {
			e.printStackTrace();
		}
    	
    }
    
    
    void selectCounterFromProject() {
		try {
			ResultSet rs = stmt.executeQuery("SELECT COUNT(*) FROM PROJEKT");
			if (rs.next()) {
	    		int count = rs.getInt(1);
	    		System.out.println("Number of datasets for Project: " + count);
	    	}
		} catch (Exception e) {
			e.printStackTrace();
		}
    	
    }
    
    
    void selectCounterFromAircraft() {
		try {
			ResultSet rs = stmt.executeQuery("SELECT COUNT(*) FROM FLUGZEUG");
			if (rs.next()) {
	    		int count = rs.getInt(1);
	    		System.out.println("Number of datasets for Aircraft: " + count);
	    	}
		} catch (Exception e) {
			e.printStackTrace();
		}
    	
    }
    
    
    void selectCounterFromTestFacility() {
		try {
			ResultSet rs = stmt.executeQuery("SELECT COUNT(*) FROM PRUEFANLAGE");
			if (rs.next()) {
	    		int count = rs.getInt(1);
	    		System.out.println("Number of datasets for Test Facility: " + count);
	    	}
		} catch (Exception e) {
			e.printStackTrace();
		}
    	
    }
    

	public void close()  {
        try {
            stmt.close(); //clean up
            con.close();
        } catch (Exception ignored) {
        }
    }
}