-- Lisää INSERT INTO lauseet tähän tiedostoon

-- Beekeeper-taulun testidata
INSERT INTO beekeeper (email, password, name)
VALUES
('testi@honey.bee', 'hunajata' ,'Maija')
,
('testi@testi.fi', '123', 'Matti')
;

-- Hive taulun testidata
INSERT INTO hive
(beekeeperid, name,picture,location,comments)
VALUES
(1, 'Kotipihan hunajata','http://www.ts.fi/static/content/pic_5_413940_k413941_651.jpg','Kotona','Minustako mehiläistarhaaja?
Mehiläistarhaus on antoisaa sekä harrastuksena että ammattina. Oman ja lähipiirin hunajansaanti on turvattu ja noista pienistä hyönteisistä oppii aina lisää. Tarhauksella saa vielä kaupanpäällisiksi lähialueen puutarhatkin kukoistamaan.
Mikäli mehiläishoito kiinnostaa, kannattaa mennä peruskurssille ja kokeilla. Tarhata voi tarpeen mukaan - yksikin pesä on jo hyvä alku. Kursseista löydät tietoa sivuiltamme, mutta voit kysyä niistä myös oman alueen paikallisyhdistyksestä tai kansalais- ja työväenopistoista.
Mehiläistarhaus ei rajoitu pelkästään maaseudulle. Myös kaupunkiympäristö tarjoaa mehiläisille hyvät puitteet ja paljon ravintoa. Taajama-alueella kannattaa huomioida pesän paikka tarkkaan, mutta avoimuudella ja toiset huomioon ottamalla kaupunkitarhauskin onnistuu. Tutustu lausuntoon mehiläistarhauksesta kaupungeissa.
Hunajaisia aikoja mehiläistesi parissa!')
,
(1, 'Mökkimetsän hunajatarha','https://i.imgur.com/3isduC8.jpg','40.741895,-73.989308','Laukaan mökkimetsissä olevat pesät.')
;


-- Apiary taulun testidata
INSERT INTO apiary
(beekeeperid, hiveID,name,picture,location,comments)
VALUES
(1, 1, 'Mökkimetsän hunajapesä nro 1','http://www.hunaja.fi/wp-content/uploads/2013/11/ML_langstroth.jpg','40.741895,-73.989308','Tämä on se lähimpänä mökkiä oleva.')
,
(1, 1, 'Mökkimetsän hunajapesä nro 2','http://m.paratiisintaimitarha.fi/tuotekuvat/900x600/WG311.jpg','40.741895,-73.989308','Tämä on se rannan puoleinen.')
;


INSERT INTO queen
(beekeeperid, name, picture,color, comments)
VALUES
(1, 'Sininen pörröpää','https://peda.net/oppimateriaalit/e-oppi/verkkokauppa/yl%C3%A4koulu/poistuneet-tuotteet/metsien-biologia2/6ijpmeo/kuvamappi/hy%C3%B6nteiset/kuvamappi/hy%C3%B6nteiset/mehil%C3%A4inen2:file/download/fd7e8a941c89a69d03cc445a06180f90c775e0e0/hyonteiset_mehilainen_shutterstock_93621823.jpg','sininen','Suhteellisen lempeä kuningatar ja hyvin tuottaa hunajaa.')
,
(1, 'Äkäinen punainen','https://peda.net/jokioinen/perusopetus/paanan-koulu/luokat-ja-opettajat/pr1-tma/ebiologia-8/e8n/6ijpmeo/pop/si:file/download/3b20f716a3083afd9d83db024d045ae6c4cf6f35/shutterstock_375476722_mehilainen_%20irin-k.jpg','punainen','Muista suojautua kunnolla, tämä pistää.')
;
