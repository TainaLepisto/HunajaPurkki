-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE beekeeper(
  beekeeperid SERIAL PRIMARY KEY,
  email VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL
);

CREATE TABLE hive(
  hiveid SERIAL PRIMARY KEY,
  beekeeperid INTEGER REFERENCES beekeeper(beekeeperid),
  name VARCHAR(100) NOT NULL,
  picture VARCHAR(500),
  location VARCHAR(100),
  comments TEXT
);

CREATE TABLE queen(
  queenid SERIAL PRIMARY KEY,
  beekeeperid INTEGER REFERENCES beekeeper(beekeeperid),
  name VARCHAR(100) NOT NULL,
  picture VARCHAR(500),
  color VARCHAR(100),
  comments TEXT
);

CREATE TABLE apiary(
  apiaryid SERIAL PRIMARY KEY,
  beekeeperid INTEGER REFERENCES beekeeper(beekeeperid),
  hiveid INTEGER REFERENCES hive(hiveid),
  queenid INTEGER REFERENCES queen(queenid),
  name VARCHAR(100) NOT NULL,
  picture VARCHAR(500),
  location VARCHAR(100),
  comments TEXT
);

CREATE TABLE reminder(
  reminderid SERIAL PRIMARY KEY,
  beekeeperid INTEGER REFERENCES beekeeper(beekeeperid),
  apiaryid INTEGER REFERENCES apiary(apiaryid),
  title VARCHAR(100) NOT NULL,
  reminderdate DATE,
  comments TEXT
);

CREATE TABLE linkreminderapiary(
  linkreminderapiaryid SERIAL PRIMARY KEY,
  reminderid INTEGER REFERENCES reminder(reminderid),
  apiaryid INTEGER REFERENCES apiary(apiaryid)
);

CREATE TABLE inspectionheader(
  inspectionheaderid SERIAL PRIMARY KEY,
  beekeeperid INTEGER REFERENCES beekeeper(beekeeperid),
  title VARCHAR(100) NOT NULL
);

CREATE TABLE inspectionfield(
  inspectionfieldid SERIAL PRIMARY KEY,
  inspectionheaderid INTEGER REFERENCES inspectionheader(inspectionheaderid),
  fieldname VARCHAR(100),
  fieldtype VARCHAR(100),
  fieldValues VARCHAR(100),
  fieldUnit VARCHAR(100),
  sortOrder INTEGER
);

CREATE TABLE apiaryinspection(
  apiaryinspectionid SERIAL PRIMARY KEY,
  beekeeperid INTEGER REFERENCES beekeeper(beekeeperid),
  apiaryid INTEGER REFERENCES apiary(apiaryid),
  inspectionheaderid INTEGER REFERENCES inspectionheader(inspectionheaderid),
  inspectionfieldid INTEGER REFERENCES inspectionfield(inspectionfieldid),
  inspectionDate DATE,
  comments TEXT,
  value VARCHAR(200)
);

CREATE TABLE queeninspection(
  queeninspectionid SERIAL PRIMARY KEY,
  beekeeperid INTEGER REFERENCES beekeeper(beekeeperid),
  queenid INTEGER REFERENCES queen(queenid),
  inspectionheaderid INTEGER REFERENCES inspectionheader(inspectionheaderid),
  inspectionfieldid INTEGER REFERENCES inspectionfield(inspectionfieldid),
  inspectiondate DATE,
  comments TEXT,
  value VARCHAR(200)
);
