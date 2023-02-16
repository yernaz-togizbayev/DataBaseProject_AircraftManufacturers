# DataBaseProject_AircraftManufacturers
#### Milestone 1: Requirements Analysis & Conceptual Design
Der Datenbank repräsentiert mehrere Unternehmen, die Flugzeuge bauen. Das Entity Unternehmen hat ein ID als primär Schlüssel, Firmenname und Land, wo das Unternehmen sich befindet. Jedes Unternehmen hat mehrere Mitarbeiter, deren Attribute Vorname, Nachname Geburtsdatum, Geschlecht sind and jeder Mitarbeiter hat ein eindeutiges Mitarbeiter ID. Ein Mitarbeiter ist Chef von anderen Mitarbeitern. Die Mitarbeiter sind Automatisierungstechniker*Innen (ID, Gehalt, E – Mail, Laptop) und Konstrukteur*Innen (ID, SV-Nummer, Ausbildung, Ausrüstung). Zu den Tätigkeiten der Automatisierungstechniker*Innen gehören Automatisierung von Flugzeugen und Automatisierung von Prüfanlagen. Zu den Aufgaben der Konstrukteure*Innen gehören 3D Modellierung, Durchführung von Simulationen und Berechnungen und Bauen von Flugzeugen.
Die Unternehmen arbeiten auf verschiede Projekte (eindeutige Projektnummer, Deadline, Budget, Projektname). Eine von den Projekten sind die Herstellung von Flugzeugen mit Attributen: Model, ein eindeutigen Objekt ID und mehrwertige Attribute – Größe, und Konstrukteure*Innen arbeiten an diesen Projekten. Ein weiteres Projekt ist die Instandhaltung von Prüfanlangen (Prüfanlagenummer, Werkzeuge, Aufsichtsperson), wo die Flugzeuge geprüft und nach Bedarf repariert, werden können und Automatisierungstechniker sind für diese Projekte beteiligt.
