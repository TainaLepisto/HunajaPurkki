-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE Beekeeper(
  beekeeperID SERIAL PRIMARY KEY,
  email varchar(50) NOT NULL,
  password varchar(50) NOT NULL
);

CREATE TABLE Hive(
  hiveID SERIAL PRIMARY KEY,
  beekeeperID INTEGER REFERENCES Beekeeper(beekeeperID),
  name varchar(100) NOT NULL,
  picture bytea,
  location varchar(100),
  comments varchar(500)
);

CREATE TABLE Queen(
  queenID SERIAL PRIMARY KEY,
  beekeeperID INTEGER REFERENCES Beekeeper(beekeeperID),
  name varchar(100) NOT NULL,
  picture bytea,
  color varchar(100),
  comments varchar(500)
);

CREATE TABLE Apiary(
  apiaryID SERIAL PRIMARY KEY,
  beekeeperID INTEGER REFERENCES Beekeeper(beekeeperID),
  hiveID INTEGER REFERENCES Hive(hiveID),
  queenID INTEGER REFERENCES Queen(queenID),
  name varchar(100) NOT NULL,
  picture bytea,
  location varchar(100),
  comments varchar(500)
);

CREATE TABLE Reminder(
  reminderID SERIAL PRIMARY KEY,
  beekeeperID INTEGER REFERENCES Beekeeper(beekeeperID),
  apiaryID INTEGER REFERENCES Apiary(apiaryID),
  title varchar(100) NOT NULL,
  remindDate DATE,
  comments varchar(500)
);

CREATE TABLE InspectionHeader(
  inspectionHeaderID SERIAL PRIMARY KEY,
  beekeeperID INTEGER REFERENCES Beekeeper(beekeeperID),
  title varchar(100) NOT NULL
);

CREATE TABLE InspectionField(
  inspectionFieldID SERIAL PRIMARY KEY,
  inspectionHeaderID INTEGER REFERENCES InspectionHeader(inspectionHeaderID),
  fieldName varchar(100),
  fieldType varchar(100),
  fieldValues varchar(100),
  fieldUnit varchar(100),
  sortOrder INTEGER
);

CREATE TABLE ApiaryInspection(
  apiaryInspectionID SERIAL PRIMARY KEY,
  beekeeperID INTEGER REFERENCES Beekeeper(beekeeperID),
  apiaryID INTEGER REFERENCES Apiary(apiaryID),
  inspectionHeaderID INTEGER REFERENCES InspectionHeader(inspectionHeaderID),
  inspectionFieldID INTEGER REFERENCES InspectionField(inspectionFieldID),
  inspectionDate DATE,
  comments varchar(500),
  value varchar(200)
);

CREATE TABLE QueenInspection(
  queenInspectionID SERIAL PRIMARY KEY,
  beekeeperID INTEGER REFERENCES Beekeeper(beekeeperID),
  queenID INTEGER REFERENCES Queen(queenID),
  inspectionHeaderID INTEGER REFERENCES InspectionHeader(inspectionHeaderID),
  inspectionFieldID INTEGER REFERENCES InspectionField(inspectionFieldID),
  inspectionDate DATE,
  comments varchar(500),
  value varchar(200)
);
