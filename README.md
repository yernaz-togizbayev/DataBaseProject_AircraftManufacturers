# ✈️ Aircraft Manufacturing Database System – Database Systems Course Project

This project simulates a relational database system for managing companies that design, produce, and maintain aircraft. It includes entity modeling, logical design, SQL-based implementation, and a web frontend built with Java and PHP. The focus is on **real-world data modeling**, **SQL automation**, and **web integration**.

---

## 📚 Course Context

**Course**: Database Systems  
**Milestones**:
1. Requirements Analysis & Conceptual Design  
2. Logical Design & Relational Mapping  
3. SQL Implementation (PostgreSQL + Oracle)  
4. Java + PHP Integration & Web GUI  

---

## 🧱 Project Structure

### 📐 ER Design (Milestone 1)

The system models the following real-world entities:

- `Unternehmen` (Company)
- `Mitarbeiter` (Employee)  
  - Specializations: `Automatisierungstechniker` (Automation Engineer), `Konstrukteur` (Design Engineer)
- `Projekt` (Project)
- `Flugzeug` (Aircraft)
- `Prüfanlage` (Test Facility)

Key relationships include:
- Employees work for companies
- Projects involve employees and produce aircraft
- Aircraft are maintained through test facilities and automation engineers

<figure>
  <img src="./docs/images/er-diagram.png](https://user-images.githubusercontent.com/71610255/219408134-dc276a15-4f9b-4b8a-9052-fc382caa043e.png)" alt="ER Diagram" width="600"/>
  <figcaption><b>Figure:</b> Entity Relationship Diagram</figcaption>
</figure>

---

### 🔢 Logical Design (Milestone 2)

All entities were mapped to relational tables with:
- Primary Keys (PK)
- Foreign Keys (FK)
- Cardinality and entity relationships preserved

See full logical mapping [here](./docs/relational_design.txt)

---

## 💾 Milestone 3: SQL + Java + PHP Implementation

### 📁 SQL & Data

- Tables and constraints written in SQL
- Data imported from real sources:
  - Aircraft manufacturers: [aircraft-database.com](https://aircraft-database.com)
  - Aircraft models: [back4app.com](https://www.back4app.com)
- Procedures, triggers, and views created to automate:
  - ID generation (`DBMS_RANDOM.STRING`)
  - Email generation
  - License numbers and dates

> **Views** were added to easily retrieve combined employee/project data

---

### ☕ Java Module (Backend)

Located in `/java`:
- CSV-based data generation (`.csv` files → DB)
- Randomized insert logic (e.g. names, birthdates, salaries)
- Employee specialization mapping (`AutomationEngineer`, `Constructor`)
- Libraries used:
  - JDBC
  - `randomHelper.java` for reproducible fake data

---

### 🌐 PHP Web Interface

Located in `/php`:
- Responsive interface with `<details>` collapsible sections per table
- User can:
  - **Add**, **Update**, **Delete**, or **Search** entries
  - Easily switch companies for employees
  - Update salary/laptop for automation engineers

<figure>
  <img src="./docs/images/web-interface.png" alt="Web UI Screenshot" width="600"/>
  <figcaption><b>Figure:</b> Screenshot of the collapsible web frontend</figcaption>
</figure>

---

## 🔧 Technologies Used

| Layer      | Tech Stack                         |
|------------|------------------------------------|
| Database   | Oracle SQL + PostgreSQL            |
| Backend    | Java + CSV + JDBC                  |
| Frontend   | HTML, CSS, PHP                     |
| Tools      | DBVisualizer, SQL Developer, IntelliJ |

---

## 🧪 Sample Features

- 💼 View aircraft manufacturers and employees by company
- ⚙️ Track production and maintenance projects
- 🔎 Filter automation engineers by ID, salary, or laptop
- 📅 Randomized project deadlines and equipment codes

---

## 🧠 Learning Outcomes

- Translate real-world domain into relational structure
- Work with multi-table JOINs, views, and constraints
- Use procedural SQL for automation
- Build a working full-stack app (SQL + Java + PHP)
- Understand ER → Logical → Physical DB development

---

## 📄 License

This project is developed for educational purposes in the **Database Systems** course. No commercial use intended.

---






# DataBaseProject_AircraftManufacturers
### Milestone 1: Requirements Analysis & Conceptual Design
Der Datenbank repräsentiert mehrere Unternehmen, die Flugzeuge bauen. Das Entity Unternehmen hat ein ID als primär Schlüssel, Firmenname und Land, wo das Unternehmen sich befindet. Jedes Unternehmen hat mehrere Mitarbeiter, deren Attribute Vorname, Nachname Geburtsdatum, Geschlecht sind and jeder Mitarbeiter hat ein eindeutiges Mitarbeiter ID. Ein Mitarbeiter ist Chef von anderen Mitarbeitern. Die Mitarbeiter sind Automatisierungstechniker_Innen (ID, Gehalt, E – Mail, Laptop) und Konstrukteur_Innen (ID, SV-Nummer, Ausbildung, Ausrüstung). Zu den Tätigkeiten der Automatisierungstechniker_Innen gehören Automatisierung von Flugzeugen und Automatisierung von Prüfanlagen. Zu den Aufgaben der Konstrukteure_Innen gehören 3D Modellierung, Durchführung von Simulationen und Berechnungen und Bauen von Flugzeugen.
Die Unternehmen arbeiten auf verschiede Projekte (eindeutige Projektnummer, Deadline, Budget, Projektname). Eine von den Projekten sind die Herstellung von Flugzeugen mit Attributen: Model, ein eindeutigen Objekt ID und mehrwertige Attribute – Größe, und Konstrukteure_Innen arbeiten an diesen Projekten. Ein weiteres Projekt ist die Instandhaltung von Prüfanlangen (Prüfanlagenummer, Werkzeuge, Aufsichtsperson), wo die Flugzeuge geprüft und nach Bedarf repariert, werden können und Automatisierungstechniker sind für diese Projekte beteiligt.
![image](https://user-images.githubusercontent.com/71610255/219408134-dc276a15-4f9b-4b8a-9052-fc382caa043e.png)

### Milestone 2: Logical Design
```
Unternehmen (UnternehmensID, Unternehmensname, Land)
  PK: UnternehmensID, Unternehmensname
  
Mitarbeiter (MitarbeiterID, Vorname, Nachname, Geburtsdatum, Geschlecht)
  PK: MitarbeiterID
  FK: Mitarbeiter.Unternehmensname <> Unternehmen.Name
  
Automatisierungstechniker (AutomatisierungstechnikerID, Gehalt, E-Mail, Laptop)
  PK: AutomatisierungstechnikerID
  FK: Automatisierungstechniker.AutomatisierungstechnikerID <> Mitarbeiter.MitarbeiterID
  
Konstrukteur (KonstrukteurID, SV-Nummer, Ausrüstung, Ausbildung)
  PK:KonstrukteurID
  FK:Konstrukteur.KonstrukteurID <> Mitarbeiter.MitarbeiterID
  
Projekt (Unternehmensname, Projektnummer, Projektname, Budget, Deadline)
  PK: (Unternehmensname, Projektnummer)
  FK: Projekt.Unternehmensname <> Unternehmen.Name
  
Flugzeug (Unternehmensname, Projektnummer, ObjektID, Model, Groesse)
  PK: ObjektID
  FK: Flugzeug.(Unternehmensname, Projektnummer) <> Projekt.(Unternehmensname, Projektnummer)
  
Prüfanlage (Unternehmensname, Projektnummer, Prüfanlagennummer, Werkzeug, Aufsichtsperson)
  PK: Prüfanlagennummer
  FK: Prüfanlage.(Unternehmensname,Projektnummer) <> Projekt.(Unternehmensname,Projektnummer)
  
Herstellung (Unternehmensname, Projektnummer, Materialnummer, KonstruktuerID, Verbrauchszeit)
  PK: (Unternehmensname, Projektnummer)
  FK: Herstellung.KonstrukteurID <> Konstrukteur.KonstrukteurID,
      Herstellung.ObjektID <> Flugzeug.ObjektID,
      Herstellung.(Unternehmensname, Projektnummer) <> Flugzeug.(Unternehmensname, Projektnummer)

Automatisierung (AutomatisierungstechnikerID, Unternehmensname, Projektnummer, Prüfanlagennummer)
  PK: (Unternehmensname, Projektnummer)
  FK: Automatisierung.AutomatisierungstechnikerID <> Automatisierungstechniker.AutomatisierungstechnikerID,
      Automatisierung.Prüfanlagennummer <> Prüfanlage.Prüfanlagennummer,
      Automatisierung.(Unternehmensname, Projektnummer) <> Prüfanlage.(Unternehmensname, Projektnummer)
```

### Milestone 3: Implementation
#### SQL
Die Flugzeugunternehmensliste wurde aus der Website [Aircraft database (aircraft-database.com)](https://aircraft-database.com/) heruntergeladen, sowohl als SQL-Datei (AircraftManufacturersEntries.sql) mit „INSERT“ Befehlen, als auch als Excel Datei (.\\sources\\java\\resources\\aircraftcompanies.csv). Außer Tabellen, Proceduren, Sequencen und Triggern zu entwerfen, wurde noch 2 Views erstellt, mittels INNER JOIN, sodass man deutlich jeweiliger Automatisierungstechniker und Konstrukteur mit Vorname, Nachname, ID und Unternehmen sehen kann.



#### Java
Für das Einfügen von Mitarbeitern wurde zwei csv – Dateien erstellt und mit ausgedachten unterschiedlichen Vornamen und unterschiedlichen Nachnamen befüllt und durch doppelte Schleife durchiteriert und in die Tabelle hinzugefügt.

Die MitarbeiterIDs sind automatisch mittels SQL – Funktion `DBMS_RANDOM.STRING('x', 10)` als TRIGGER generiert.

Für die Geburtstagseinträge wurde ebenfalls eine csv – Datei erstellt mit beliebigen Daten und zufälligerweise jedem Mitarbeiter zugewiesen.

Als weiteres wurde auch ein laptops.csv erstellt und mit verschiedenen Laptop Modellen und wurden ebenfalls zufälligerweise dem Mitarbeiter zugewiesen.

Für die Automatisierungstechniker wurden die Hälfte von den Mitarbeitern hinzugefügt. Das Gehalt wurde zufälligerweise mittels Methode randomHelper.getRandomDouble() generiert. Als Basis für die E-Mail-Adresse wurde Vorname und Nachname jeweiliger Mitarbeiter genommen (unter Verwendung von SELECT statement), getrennt durch „Punkt“, gefolgt von ‚@‘ und danach die Unternehmensname punkt Land (ebenfalls mit SELECT statement). Zum Beispiel, Max Mustermann, arbeitet in der deutsche Firma xyz -> max.musterman@xyz.de.

Die Selbstversicherungsnummer wurde automatisch mittels Methode randomHelper.getRandomSVNumber() generiert. Die Equipment Spalte wurde überall als ‚null‘ gesetzt, wobei man in der Webseite beliebige equipment Einträge hinzufügen kann.

Die Flugzeugmodelle wurden aus der Website [Aircraft Models, Makers, and Countries | Database Hub (back4app.com)](https://www.back4app.com/database/back4app/aircraft-make-and-model-list) als Excel Datei ((.\\sources\\java\\resources\\ListOfAircraftModel.csv) heruntergeladen und als Basis für die ‚Projekt‘ Tabelle entnommen:
  1. Automation of ‚Model‘
  2. Production of ‚Model‘
  3. Maintenance of ‚Model‘

Deadline von Projekten wurde automatisch mittels `randomHelper.getRandomInteger()` generiert und mittels SQL Befehl `TO_DATE()` in die Tabelle gesetzt.

Pruefanlagennummer wurde auch automatisch generiert, mittels `randomHelper.getRandomString()`.



##### PHP
(Reference zum [Hintergrundsbild](https://www.lockheedmartin.com/content/dam/lockheed-martin/eo/photo/yourmission/1820_LM_F35_SIDE_MISSION_MARKS.jpg))

Es wurde eine einfache Webseite entwickelt mit allen benötigten Funktionalitäten. Damit es nicht zu viele Tabellen auf eine Seite erscheinen, wurde alle Tabelle ‚aufklappbar‘ implementiert mit dem HTML-Befehl `<details>`.
![image](https://user-images.githubusercontent.com/71610255/219413644-da256a4a-b8a4-4869-ae70-89733650f9c4.png)

Und wenn man eine von den benötigten Tabellen aufklappt, kann man in die Tabelle Einträge hinzufügen, bzw. von der Tabelle löschen, oder auch suchen.

Die Tabellen Mitarbeiter und Automatisierungstechniker verfügen über einer zusätzlichen Funktionalität ‚Update‘, sodass ein Mitarbeiter das Unternehmen wechseln kann bzw. man bei der Automatisierungstechniker Gehalt und Laptop ändern kann.
![image](https://user-images.githubusercontent.com/71610255/219414547-e20cf17c-ab3b-4fe7-aa6e-c7168fb30cc9.png)
