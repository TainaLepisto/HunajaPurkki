# HunajaPurkki

HunajaPurkki on mehiläistarhaajien apuväline mehiläisten hoitoon. Sovellukseen tallennetaan tiedot pesistä ja niiden tarkastuksista. Sovellus on suunnattu suomalaisen mehiläistarhaajan käyttöön. Sovellus muistuttaa pesien tarkastuksista säännöllisin väliajoin ja pitää kirjaa myös mahdollisista taudeista.

[Sovelluksen dokumentaatio Gitissä](./doc/HunajaPurkki.pdf)

[Sovellus julkaistu laitoksen user-palvelimelle](http://tainalep.users.cs.helsinki.fi/hunajapurkki/)

## Projektista

Itsenäinen projekti itsevalitun aiheen mukaisesti. Toteutettu PHP:lla käyttäen PostgreSQL-tietokantapalvelinta. Käyttäjän selaimen tulee tukea JavaScriptiä.

[Tietokantasovellus on tietojenkäsittelytieteen aineopintojen harjoitustyökurssi](http://tsoha.github.io/), jossa harjoitellaan tietokantaohjelmointia käytännössä ja opitaan samalla web-sovellusohjelmointia.

Kurssin tarkoituksena on tuottaa toimiva, käytettävä, siististi koodattu ja hyvällä arkkitehtuurilla rakennettu web-sovellus, joka kommunikoi tietokannan kanssa käyttäen SQL-kieltä.

### TechStack

- HTML ([Hypertext Markup Language, eli hypertekstin merkintäkieli)](https://fi.wikipedia.org/wiki/HTML))
- PHP ([PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages](https://www.w3schools.com/php/))
- PostgreSQL ([powerful, open source object-relational database system](http://www.tutorialspoint.com/postgresql/index.htm))
- SQL ([Structured Query Language, lets you access and manipulate databases](https://www.w3schools.com/sql/sql_intro.asp))
- Bootstrap ([open source toolkit for developing with HTML, CSS, and JS](http://getbootstrap.com/))
- Slim framework ([Slim is a PHP micro framework that helps you quickly write simple yet powerful web applications and APIs](https://www.slimframework.com/))
- Kint ([modern and powerful PHP debugging helper](https://kint-php.github.io/kint/))
- Composer ([Dependency Manager for PHP](https://getcomposer.org/))
- PHP Data Objects (PDO) ([lightweight, consistent interface for accessing databases in PHP](http://php.net/manual/en/intro.pdo.php))

### MVC-malli (model-view-controller)

> Web-sovellusten toteutusmalli, jonka tarkoituksena on erottaa näkymä sovelluslogiikasta.
Siinä sovellus jaetaan kolmeen osaan:
>
> - malliin (model), joka mahdollistaa tietokannasta haetun tiedon esittämisen sovelluksen kannalta mielekkäässä muodossa, eli yleensä olioina, jolloin kukin malli kuvaa yhtä sovelluksen tietokohteista (esim. Asiakas, Tuote, Opiskelija, jne.). Kaikki tietokantaan kohdistuvat kyselyt suoritetaan mallien kautta.
> - näkymään (view), joka määrittää sovelluksen käyttöliittymän ulkoasun ja tiedon esitysmuodon. Sen kautta lähetään myös käyttäjän syöttämiä tietoja sovellukselle esimerkiksi lomakkeiden kautta.
> - kontrolleriin (controller), joka toimii liimana näkymän ja mallin välissä. Se käsittelee selaimen lähettämät pyynnöt, välittää mallilta saamansa sisällön näkymälle tai pyytää mallia tekemään muutoksia tietokantaan.

(kuvaus kopioitu kurssisivulta)

## Eteneminen

### Viikko 1
- [x] Valitse harjoitustyösi aihe
- [x] Pystytä versionhallinta
- [x] Dokumentoi perusasiat [doc-kansioon yhteen pdf-tiedostoon](./doc/HunajaPurkki.pdf)
  - [x] Johdanto
  - [x] Käyttötapaukset
- [x] Pystytä työympäristö
- [x] Rekisteröidy labtooliin

### Viikko 2
- [x] Suunnittele käyttöliittymäsi ja toteuta niistä staattiset HTML-sivut
  - [x] Suunnittele etusivu
    - [tunnusten luonti](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/signup)
    - [kirjautuminen](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/home)
    - [kirjautumisen jälkeen (muistutusten listaus)](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/login)
  - [x] Suunnittele kaikki listaussivut
    - [tarha](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/hive/list)
    - [pesä](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/apiary/list)
      - [pesän tarkastuslomakkeen valinta](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/apiary/inspection)
      - [pesän tarkastuslomake](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/apiary/inspectionForm)
    - [emo](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/queen/list)
      - [emon tarkastuslomakkeen valinta](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/queen/inspection)
      - [emon tarkastuslomake](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/queen/inspectionForm)
    - [tarkastuslomakkeet](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/inspection/list)
  - [ ] Suunnittele kaikki muokkaussivut
    - [tarha](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/hive/edit)
    - [pesä](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/apiary/edit)
    - [emo](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/queen/edit)
    - tarkastuslomakkeet - KESKEN
  - [x] Suunnittele kaikki esittelysivut
    - [tarha](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/hive/show)
    - [pesä](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/apiary/show)
    - [emo](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/queen/show)
    - [tarkastuslomakkeet](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/inspection/show)
  - [ ] Suunnittele kaikki luontisivut
    - [tarha](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/hive/new)
    - [pesä](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/apiary/new)
    - [emo](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/queen/new)
    - [muistutus](http://tainalep.users.cs.helsinki.fi/hunajapurkki/static/reminder/new)
    - tarkastuslomakkeet - KESKEN
  - [x] Ota tietokanta käyttöön ja dokumentoi se
    - [x] Lisää [dokumentaatioon](./doc/HunajaPurkki.pdf) järjestelmän tietosisältö osio ja relaatiotietokantakaavio
    - [x] Lisää tietokantataulujen pystytyslauseet [create_tables.sql -tiedostoon](./sql/create_tables.sql). Pystytä näillä taulut tietokantaan.
    - [x] Lisää tietokantataulujen poistolauseet [drop_tables.sql -tiedostoon](./sql/drop_tables.sql).
    - [x] Lisää testidatan lisäyslauseet [add_test_data.sql -tiedostoon](./sql/add_test_data.sql). Aja testidata [tietokantaan](http://tainalep.users.cs.helsinki.fi/hunajapurkki/tietokantayhteys).
  - [x] Pushaa kaikki tekemäsi muutokset Gittiin

### Viikko 3
- [x] Toteuta sovellukseesi vähintään yksi malliluokka ([Tarha](./app/models/hive.php), [Pesä](./app/models/apiary.php), ), jossa on
  - [x] kaikki tietokohteen oliot tietokannasta hakeva metodi (esim. all)
  - [x] tietyllä id:llä varustetun tietokohteen olion tietokannasta hakeva metodi (esim. find)
  - [x] tietokohteen olion tietokantaan lisäävä metodi (esim. save)
- [x] Toteuta malliasi käyttämään kontrolleriin ([Tarha](./app/controllers/hive-controller.php), [Pesä](./app/controllers/apiary-controller.php), ) metodit, jotka esittävät tietokohteen listaus-, esittely- ja lisäysnäkymän. Toteuta myös kontrolleriisi metodi, joka mahdollistaa tietokohteen olion lisäämisen tietokantaan käyttäjän lähettämän lomakkeen tiedoilla.
- [x] Kirjoita [koodikatselmointi](https://github.com/ihamaki/LahjaSovellus/issues/1)
- [x] Pushaa kaikki muutokset

### Viikko 4
- [x] Lisää malliluokkaasi metodi ja käyttäjälle toiminnot tietokohteen olion
  - [x] muokkaamiselle (esim. update)
  - [x] poistolle (esim. destroy)
- [x] Lisää malliisi tarvittavat validaattorit ja estä kontrollereissa virheellisten syötteiden lisääminen tietokantaan.
  - [x] näytä lomakkeissa virhetilanteissa virheilmoitukset
  - [x] täytä kentät käyttäjän antamilla syötteillä
- [x] Toteuta malliluokka sovelluksen käyttäjälle ja toteuta käyttäjän kirjautuminen.
  - [ ] Toteuta get_user_logged_in-metodi
  - [ ] käytä kirjautuneen käyttäjän tietoa hyväksi näkymissä ja malleissa
- [ ] Kirjoita alustava käynnistys- / käyttöohje dokumentaatioosi.
- [x] käyttäjätunnus (testi@honey.bee) ja salasana (hunajata), jolla voi kirjautua sisään sovellukseesi
- [ ] Pushaa kaikki tekemäsi muutokset repoosi

### Viikko 5
- [ ] Toteuta käyttäjän uloskirjautuminen ja estä kirjautumattoman käyttäjän pääsy sivuille, jotka vaativat kirjautumisen.
- [ ] Edistä sovellustasi ja pidä koodi siistinä noudattamalla selkeää kansiorakennetta ja järkevää nimeämistä tiedostojen, luokkien ja metodien nimissä.
  - [ ] ainakin kahdelle tietokohteelle on toteutettu sivuja. Kaikkia CRUD-nelikon osia ei kuitenkaan tarvitse toteuttaa, listaus- ja esittelysivut uudelle tietokohteelle riittävät hyvin.
  - [ ] toimintojen tulee toimia ja virhetilanteissa käyttäjälle täytyy antaa järkeviä virheilmoituksia.
- [ ] Lisää dokumentaatioosi
  - [ ] järjestelmän-yleisrakenne-osio
  - [ ] käyttöliittymän ja järjestelmän komponentteja kuvaa kaavio.
- [ ] Kirjoita koodikatselmointi
- [ ] Pushaa kaikki muutokset
