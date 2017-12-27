# HunajaPurkki

HunajaPurkki on mehiläistarhaajien apuväline mehiläisten hoitoon. Sovellukseen tallennetaan tiedot pesistä ja niiden tarkastuksista. Sovellus on suunnattu suomalaisen mehiläistarhaajan käyttöön. Sovellus muistuttaa pesien tarkastuksista säännöllisin väliajoin ja pitää kirjaa myös mahdollisista taudeista.

[Sovelluksen dokumentaatio Gitissä](./doc/HunajaPurkki.pdf)

[Sovellus julkaistu laitoksen user-palvelimelle](http://tainalep.users.cs.helsinki.fi/hunajapurkki/)

## Projektista

Itsenäinen projekti itsevalitun aiheen mukaisesti. Toteutettu PHP:lla käyttäen PostgreSQL-tietokantapalvelinta. . Käyttäjän selaimen tulee tukea JavaScriptiä.

[Tietokantasovellus on tietojenkäsittelytieteen aineopintojen harjoitustyökurssi](http://tsoha.github.io/), jossa harjoitellaan tietokantaohjelmointia käytännössä ja opitaan samalla web-sovellusohjelmointia.

Kurssin tarkoituksena on tuottaa toimiva, käytettävä, siististi koodattu ja hyvällä arkkitehtuurilla rakennettu web-sovellus, joka kommunikoi tietokannan kanssa käyttäen SQL-kieltä.

### TechStack

 - HTML([lyhenne sanoista Hypertext Markup Language, suomennettuna hypertekstin merkintäkieli)](https://fi.wikipedia.org/wiki/HTML))
- PHP ([PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages](https://www.w3schools.com/php/))
- PostgreSQL ([powerful, open source object-relational database system](http://www.tutorialspoint.com/postgresql/index.htm))
- SQL ([]())
- Bootstrap ([open source toolkit for developing with HTML, CSS, and JS](http://getbootstrap.com/))
- Slim framework ([Slim is a PHP micro framework that helps you quickly write simple yet powerful web applications and APIs](https://www.slimframework.com/))
- Kint ([modern and powerful PHP debugging helper](https://kint-php.github.io/kint/))
- Composer ([Dependency Manager for PHP](https://getcomposer.org/))
- PHP Data Objects (PDO) ([lightweight, consistent interface for accessing databases in PHP](http://php.net/manual/en/intro.pdo.php))

### MVC-malli (model-view-controller)

Web-sovellusten toteutusmalli, jonka tarkoituksena on erottaa näkymä sovelluslogiikasta.
Siinä sovellus jaetaan kolmeen osaan:

- malliin (model), joka mahdollistaa tietokannasta haetun tiedon esittämisen sovelluksen kannalta mielekkäässä muodossa, eli yleensä olioina, jolloin kukin malli kuvaa yhtä sovelluksen tietokohteista (esim. Asiakas, Tuote, Opiskelija, jne.). Kaikki tietokantaan kohdistuvat kyselyt suoritetaan mallien kautta.
- näkymään (view), joka määrittää sovelluksen käyttöliittymän ulkoasun ja tiedon esitysmuodon. Sen kautta lähetään myös käyttäjän syöttämiä tietoja sovellukselle esimerkiksi lomakkeiden kautta.
- kontrolleriin (controller), joka toimii liimana näkymän ja mallin välissä. Se käsittelee selaimen lähettämät pyynnöt, välittää mallilta saamansa sisällön näkymälle tai pyytää mallia tekemään muutoksia tietokantaan.

(kopioitu kurssisivulta)

## Eteneminen

### Viikko 1
- [x] Valitse harjoitustyösi aihe
- [x] Pystytä versionhallinta
- [ ] Dokumentoi perusasiat [doc-kansioon yhteen pdf-tiedostoon](./doc/HunajaPurkki.pdf)
  - [x] Johdanto
  - [ ] Käyttötapaukset (pääosin tehty - puuttuu vielä tekstikuvaukset)
- [x] Pystytä työympäristö
- [x] Rekisteröidy labtooliin

### Viikko 2
- [x] Suunnittele käyttöliittymäsi ja toteuta niistä staattiset HTML-sivut [(sovelluksen navigaatio toimii pääosin, joten en listaa tänne kaikkia linkkejä erikseen)](http://tainalep.users.cs.helsinki.fi/hunajapurkki/)
  - [x] Suunnittele [etusivu (kirjautumisen jälkeen)](http://tainalep.users.cs.helsinki.fi/hunajapurkki/login)
  - [x] Suunnittele kaikki listaussivut (Rikoin heti tarhan näkymät, joten tässä ne. [tarhojen listaus](http://tainalep.users.cs.helsinki.fi/hunajapurkki/staticlist)), [yhden tarhan näkymä](http://tainalep.users.cs.helsinki.fi/hunajapurkki/staticshow)), [muokkaus](http://tainalep.users.cs.helsinki.fi/hunajapurkki/staticedit)
  - [ ] Suunnittele kaikki muokkaus- ja esittelysivut (pääosin tehty - tarkastuslomakkeiden vielä kesken)
- [x] Ota tietokanta käyttöön ja dokumentoi se
  - [x] Lisää [dokumentaatioon](./doc/HunajaPurkki.pdf) järjestelmän tietosisältö osio ja relaatiotietokantakaavio
  - [x] Lisää tietokantataulujen pystytyslauseet [create_tables.sql -tiedostoon](./sql/create_tables.sql). Pystytä näillä taulut tietokantaan.
  - [x] Lisää tietokantataulujen poistolauseet [drop_tables.sql -tiedostoon](./sql/drop_tables.sql).
  - [x] Lisää testidatan lisäyslauseet [add_test_data.sql -tiedostoon](./sql/add_test_data.sql). Aja testidata [tietokantaan](http://tainalep.users.cs.helsinki.fi/hunajapurkki/tietokantayhteys).
- [x] Pushaa kaikki tekemäsi muutokset Gittiin

### Viikko 3
- [ ] Toteuta sovellukseesi vähintään yksi malliluokka, jossa on kaikki tietokohteen oliot tietokannasta hakeva metodi (esim. all), tietyllä id:llä varustetun tietokohteen olion tietokannasta hakeva metodi (esim. find) ja tietokohteen olion tietokantaan lisäävä metodi (esim. save).
- [ ] Toteuta malliasi käyttämään kontrolleriin metodit, jotka esittävät tietokohteen listaus-, esittely- ja lisäysnäkymän. Toteuta myös kontrolleriisi metodi, joka mahdollistaa tietokohteen olion lisäämisen tietokantaan käyttäjän lähettämän lomakkeen tiedoilla.
- [ ] Kirjoita koodikatselmointi
- [ ] Pushaa kaikki muutokset

### Viikko 4
.
.
.
