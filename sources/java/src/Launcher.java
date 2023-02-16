import java.sql.*;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;


public class Launcher {
	
	public static void main(String[] args) throws SQLException {
		DatabaseHelper dbHelper = new DatabaseHelper();
		RandomHelper randomHelper = new RandomHelper();
		final List<String[]> employeeList = new ArrayList<>();
		final List<String[]> automationEngineerList = new ArrayList<>();
		final List<String[]> designEngineerList = new ArrayList<>();
		final List<String[]> projectsList = new ArrayList<>();
		
		Map<String, String> mapOfCompanyCountry = new HashMap<String, String>();
		mapOfCompanyCountry = dbHelper.selectCompanyCountry(mapOfCompanyCountry);
		
		for (int i = 0; i < randomHelper.getFirstNames().size(); i++) {
			for (int j = 0; j < randomHelper.getLastNames().size(); j++) {
				String[] employee = {randomHelper.getRandomFirstName(),
										randomHelper.getRandomLastName(),
										randomHelper.getRandomDayOfBirth(),
										randomHelper.getRandomSex(),
										randomHelper.getRandomCompany()};

				employeeList.add(employee);
				
				dbHelper.insertIntoEmployee(employee[0], employee[1], employee[2], employee[3], employee[4]);
			}
		}

		List<String> employeeIDs = dbHelper.selectEmployeeIdFromEmployee();
		
		
		for (int i = 0; i < employeeIDs.size(); i++)
		{
			if (i%2 == 0) {
				String[] automationEngineer = {employeeIDs.get(i),
						randomHelper.getRandomDouble(10000, 150000, 2).toString(),
						dbHelper.selectFromMitarbeiter(employeeIDs.get(i), mapOfCompanyCountry),
						randomHelper.getRandomLaptop()};
				
				automationEngineerList.add(automationEngineer);
			}
		}
		
		
		for (String[] automationEngineer : automationEngineerList) {
			dbHelper.insertIntoAutomationEngineer(automationEngineer[0], automationEngineer[1], automationEngineer[2], automationEngineer[3]);
		}
		
		
		
		
		for (int i = 0; i < employeeIDs.size(); i++)
		{
			if (i%2 == 1) {
				String[] designEngineer = {employeeIDs.get(i),
						randomHelper.getRandomSVNumber(1000000000L, 9999999999L).toString(),
						null,
						randomHelper.getRandomTraining()};
				
				designEngineerList.add(designEngineer);
			}
		}
		
		for (String[] designEngineer : designEngineerList) {
			dbHelper.insertIntoDesignEngineer(designEngineer[0], designEngineer[1], designEngineer[2], designEngineer[3]);
		}
		
		
		
		for (String model : randomHelper.getAircraftModels()) {
			
			String deadline1 = randomHelper.getRandomInteger(2023, 2040).toString() + "-" + randomHelper.getRandomInteger(1, 12).toString() + "-" + randomHelper.getRandomInteger(1, 31).toString();
			String deadline2 = randomHelper.getRandomInteger(2023, 2040).toString() + "-" + randomHelper.getRandomInteger(1, 12).toString() + "-" + randomHelper.getRandomInteger(1, 31).toString();
			String deadline3 = randomHelper.getRandomInteger(2023, 2040).toString() + "-" + randomHelper.getRandomInteger(1, 12).toString() + "-" + randomHelper.getRandomInteger(1, 31).toString();
			
			
			String projectProduction = "Production of " + model;
			String[] project1 = {randomHelper.getRandomCompany(), projectProduction, randomHelper.getRandomDouble(100000, 5000000, 2).toString(), deadline1};
			
			String projectAutomation = "Automation of " + model;
			String[] project2 = {randomHelper.getRandomCompany(), projectAutomation, randomHelper.getRandomDouble(100000, 5000000, 2).toString(), deadline2};

			String projectMaintenance = "Maintenance of " + model;
			String[] project3 = {randomHelper.getRandomCompany(), projectMaintenance, randomHelper.getRandomDouble(100000, 5000000, 2).toString(), deadline3};
			
			projectsList.add(project1);
			projectsList.add(project2);
			projectsList.add(project3);
			
		}
		
		for (String[] project : projectsList) {
			dbHelper.insertIntoProject(project[0], project[1], project[2], project[3]);
		}
		
		for (int i = 0; i < randomHelper.getAircraftIDs().size(); i++) {
			String aircraftID = randomHelper.getAircraftIDs().get(i);
			String aircraftModel = randomHelper.getAircraftModels().get(i);
			
			List<String[]> tmpCompanies = new ArrayList<>();
			tmpCompanies = dbHelper.selectFromProjectNumberAndCompany(aircraftModel);
			int tmpCompanies_idx = randomHelper.getRandomInteger(0, tmpCompanies.size()-1);
			String company = tmpCompanies.get(tmpCompanies_idx)[1];
			String projectNumber = tmpCompanies.get(tmpCompanies_idx)[0];
			
			String[] aircraft = {company, projectNumber, aircraftID, aircraftModel, randomHelper.getRandomDouble(5, 90, 2).toString(), randomHelper.getRandomDouble(10, 120, 2).toString(), randomHelper.getRandomDouble(2, 25, 2).toString()};
			
			dbHelper.insertIntoAirCraft(aircraft[0], aircraft[1], aircraft[2], aircraft[3], aircraft[4], aircraft[5], aircraft[6]);
		}
		
		
		List<String> maintenanceList = new ArrayList<>();
		for (int i = 0; i < projectsList.size(); i++) {
			if (projectsList.get(i)[1].startsWith("Maintenance") || projectsList.get(i)[1].startsWith("Automation")) {
				maintenanceList.add(projectsList.get(i)[1]);				
			}
		}
		
		
		for (String maintenance : maintenanceList) {
			String[] testFacility = {dbHelper.selectFromProjectCompanyName(maintenance), dbHelper.selectFromProjectProjectNumber(maintenance).toString(), randomHelper.getRandomString(1, 3), randomHelper.getRandomInteger(1, 10).toString()};
			dbHelper.insertIntoTestFacility(testFacility[0], testFacility[1], testFacility[2], testFacility[3]);
		}
		
		
		
		
		List<String> productionList = new ArrayList<>();
		for (int i = 0; i < projectsList.size(); i++) {
			if (projectsList.get(i)[1].startsWith("Production")) {
				productionList.add(projectsList.get(i)[1]);				
			}
		}
		
		for (String production : productionList) {
			String[] pruductionStrings = {dbHelper.selectFromProjectCompanyName(production), dbHelper.selectFromProjectProjectNumber(production).toString(), dbHelper.selectFromAircrafObjectId(dbHelper.selectFromProjectProjectNumber(production).toString()) , designEngineerList.get(randomHelper.getRandomInteger(0, designEngineerList.size()-1))[0], randomHelper.getRandomInteger(1, 10).toString()};
			dbHelper.insertIntoProduction(pruductionStrings[0], pruductionStrings[1], pruductionStrings[2], pruductionStrings[3], pruductionStrings[4]);
		}
		

		for (String automation : maintenanceList) {
			if (automation.startsWith("Automation")) {
				String automationEnngineerID = automationEngineerList.get(randomHelper.getRandomInteger(0, automationEngineerList.size()-1))[0];
				String company = dbHelper.selectFromProjectCompanyName(automation);
				String[] automationStrings = {automationEnngineerID, company, dbHelper.selectFromProjectProjectNumber(automation).toString(), dbHelper.selectFromTestFacilityTFNumber(dbHelper.selectFromProjectProjectNumber(automation).toString())};
				dbHelper.insertIntoAutomation(automationStrings[0], automationStrings[1], automationStrings[2], automationStrings[3]);
			}
		}
		
		
		dbHelper.selectCounterFromUnternehmen();
		dbHelper.selectCounterFromEmployee();
		dbHelper.selectCounterFromAutomationEngineer();
		dbHelper.selectCounterFromDesignEngineer();
		dbHelper.selectCounterFromProject();
		dbHelper.selectCounterFromAircraft();
		dbHelper.selectCounterFromTestFacility();
		
		dbHelper.close();

	}

}
