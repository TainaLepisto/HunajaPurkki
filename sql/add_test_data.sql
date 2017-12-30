-- Lisää INSERT INTO lauseet tähän tiedostoon

-- Beekeeper-taulun testidata
INSERT INTO beekeeper (email, password)
VALUES
('testi@testi.fi', 'testi123')
,
('testi2@testi.fi', '123testi')
;

-- Hive taulun testidata
INSERT INTO hive
(name,location,comments)
VALUES
('Mökkimetsän hunajatarha','40.741895,-73.989308','Laukaan mökkimetsissä olevat pesät.')
;


-- Apiary taulun testidata
INSERT INTO apiary
(hiveID,name,location,comments)
VALUES
(1, 'Mökkimetsän hunajapesä nro 1','40.741895,-73.989308','Tämä on se lähimpänä mökkiä oleva.')
,
(1, 'Mökkimetsän hunajapesä nro 2','40.741895,-73.989308','Tämä on se rannan puoleinen.')
;
