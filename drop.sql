DROP TABLE UNTERNEHMEN;
DROP TABLE MITARBEITER;
DROP TABLE AUTOMATISIERUNGSTECHNIKER;
DROP TABLE KONSTRUKTEUR;
DROP TABLE PROJEKT;
DROP TABLE FLUGZEUG;
DROP TABLE PRUEFANLAGE;
DROP TABLE HERSTELLUNG;
DROP TABLE AUTOMATISIERUNG;

DROP SEQUENCE SEQ_UNTERNEHMEN_ID;
DROP SEQUENCE SEQ_PROJEKT_NUMMER;

DROP TRIGGER TRI_UNTERNEHMEN_ID;
DROP TRIGGER TRI_MITARBEITER_ID;
DROP TRIGGER TRI_PROJEKT_NUMMER;

DROP PROCEDURE P_DELETE_UNTERNEHMEN;
DROP PROCEDURE P_DELETE_MITARBEITER;
DROP PROCEDURE P_DELETE_AUTOMATISIERUNGSTECHNIKER;
DROP PROCEDURE P_DELETE_KONSTRUKTEUR;
DROP PROCEDURE P_DELETE_PROJEKT;
DROP PROCEDURE P_DELETE_FLUGZEUG;
DROP PROCEDURE P_DELETE_PRUEFANLAGE;
DROP PROCEDURE P_DELETE_HERSTELLUNG;
DROP PROCEDURE P_DELETE_AUTOMATISIERUNG;

DROP VIEW ALLE_AUTOMATISIERUNGSTECHNIKER;
DROP VIEW ALLE_KONSTRUKTEURE;