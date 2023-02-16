//Database Systems (Module IDS) 

import java.io.BufferedReader;
import java.io.FileReader;
import java.util.ArrayList;
import java.util.Random;

// The RandomHelper class wraps around the JAVA Random class to provide convenient access to random data as we need it
// Additionally it provides access to external single-columned files (e.g. courses.csv, names.csv, surnames.csv)
class RandomHelper {
	private final char[] alphabet = getCharSet();
	private Random rand;
	private ArrayList<String> firstNames;
	private ArrayList<String> lastNames;
	private ArrayList<String> dayOfBirth;
	private ArrayList<String> sexArrayList;
	private ArrayList<String> companyName;
	private ArrayList<String> laptops;
	private ArrayList<String> training;
	private ArrayList<String> aircraftIDs;
	private ArrayList<String> aircraftModels;
	private static final String firstNameFile = ".\\java\\resources\\names.csv";
	private static final String lastNameFile = ".\\java\\resources\\surnames.csv";
	private static final String dayOfBirthFile = ".\\java\\resources\\dayofbirth.csv";
	private static final String companyNameFile = ".\\java\\resources\\aircraftcompanies.csv";
	private static final String laptopFile = ".\\java\\resources\\laptops.csv";
	private static final String airCraftModelFile = ".\\java\\resources\\ListOfAircraftModel.csv";
	
	// instantiate the Random object and store data from files in lists
	RandomHelper() {
		this.rand = new Random();
		this.lastNames = readFile(lastNameFile);
		this.firstNames = readFile(firstNameFile);
		this.dayOfBirth = readFile(dayOfBirthFile);
		this.companyName = readFile(companyNameFile);
		this.laptops = readFile(laptopFile);
		this.aircraftIDs = readFileAirCraftIDs(airCraftModelFile);
		this.aircraftModels = readFileAirCraftModels(airCraftModelFile);
		this.sexArrayList = new ArrayList<>();
		sexArrayList.add("m");
		sexArrayList.add("f");
		sexArrayList.add("d");
		this.training = new ArrayList<>();
		training.add("j");
		training.add("n");
	}

	// not used but it might be helpful
	
	  String getRandomString(int minLen, int maxLen) {
		  StringBuilder out = new StringBuilder();
		  int len = rand.nextInt((maxLen - minLen) + 1) + minLen;
		  while (out.length() < len) {
			  
			  int idx = Math.abs((rand.nextInt() %alphabet.length));
			  out.append(alphabet[idx]);
			  
		  }
		  return out.toString();
	  }
	 

	String getRandomFirstName() {
		return firstNames.get(getRandomInteger(0, firstNames.size() - 1));
	}

	String getRandomLastName() {
		return lastNames.get(getRandomInteger(0, lastNames.size() - 1));
	}
	
	String getRandomDayOfBirth() {
		return dayOfBirth.get(getRandomInteger(0, dayOfBirth.size() - 1));
	}
	
	String getRandomSex() {
		return sexArrayList.get(getRandomInteger(0, sexArrayList.size() - 1));
	}
	
	String getRandomCompany() {
		return companyName.get(getRandomInteger(0, companyName.size() - 1));
	}
	
	String getRandomLaptop() {
		return laptops.get(getRandomInteger(0, laptops.size() - 1));
	}
	
	String getRandomTraining() {
		return training.get(getRandomInteger(0, training.size() - 1));
	}
	
	Long getRandomSVNumber(long min, long max) {
		return rand.nextLong((max - min) + 1) + min;
	}
	

	// returns random double from the Interval [min, max] and a defined precision
	// (e.g. precision:2 => 3.14)
	Double getRandomDouble(double min, double max, int precision) {
		// Hack that is not the cleanest way to ensure a specific precision, but...
		double r = Math.pow(10, precision);
		return Math.round(min + (rand.nextDouble() * (max - min)) * r) / r;
	}

	// return random Integer from the Interval [min, max]; (min, max are possible as
	// well)
	Integer getRandomInteger(int min, int max) {
		return rand.nextInt((max - min) + 1) + min;
	}

	// reads single-column files and stores its values as Strings in an ArraList
	private ArrayList<String> readFile(String filename) {
		String line;
		ArrayList<String> set = new ArrayList<>();
		try {
			BufferedReader br = new BufferedReader(new FileReader(filename));
			
			while ((line = br.readLine()) != null) {
				try {
					line = line.strip();
					set.add(line);
				} catch (Exception ignored) {
				}
			}
			br.close();

		} catch (Exception e) {
			e.printStackTrace();
		}
		return set;
	}
	
	
	private ArrayList<String> readFileAirCraftIDs(String filename) {
		String line;
		ArrayList<String> listIDs = new ArrayList<>(); 
		try {
			BufferedReader br = new BufferedReader(new FileReader(filename));
			
			while ((line = br.readLine()) != null) {
				String[] keyValuePair = line.trim().split(",", 2);
				try {
					listIDs.add(keyValuePair[0]);
				} catch (Exception ignored) {
				}
			}
			br.close();

		} catch (Exception e) {
			e.printStackTrace();
		}
		return listIDs;
	}
	
	
	private ArrayList<String> readFileAirCraftModels(String filename) {
		String line;
		ArrayList<String> listModels = new ArrayList<>(); 
		try {
			BufferedReader br = new BufferedReader(new FileReader(filename));
			
			while ((line = br.readLine()) != null) {
				String[] keyValuePair = line.trim().split(",", 2);
				try {
					listModels.add(keyValuePair[1]);
				} catch (Exception ignored) {
				}
			}
			br.close();

		} catch (Exception e) {
			e.printStackTrace();
		}
		return listModels;
	}
	// defines which chars are used to create random strings
	private char[] getCharSet() { // create getCharSet char array
		StringBuffer b = new StringBuffer(128);
		for (int i = 48; i <= 57; i++) b.append((char) i); // 0-9
		for (int i = 65; i <= 90; i++) b.append((char) i); // A-Z
		return b.toString().toCharArray();
	}
	
	public ArrayList<String> getFirstNames() {
		return firstNames;
	}
	
	public ArrayList<String> getLastNames() {
		return lastNames;
	}
	
	public ArrayList<String> getAircraftIDs() {
		return aircraftIDs;
	}
	
	public ArrayList<String> getAircraftModels() {
		return aircraftModels;
	}

}