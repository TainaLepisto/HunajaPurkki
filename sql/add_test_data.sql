-- Lisää INSERT INTO lauseet tähän tiedostoon

-- Beekeeper-taulun testidata
INSERT INTO Beekeeper (email, password) VALUES ('testi@testi.fi', 'testi123');
INSERT INTO Beekeeper (email, password) VALUES ('testi2@testi.fi', '123testi');

-- Hive taulun testidata
INSERT INTO Hive
( name,
  location,
  comments)
  VALUES (
    'Mökkimetsän hunajatarha',
    '40.741895,-73.989308',
    'Laukaan mökkimetsissä olevat pesät.'
  );
