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
- SQL ()
- Bootstrap ([open source toolkit for developing with HTML, CSS, and JS](http://getbootstrap.com/))
- Slim framework ([Slim is a PHP micro framework that helps you quickly write simple yet powerful web applications and APIs](https://www.slimframework.com/))
- Kint ([modern and powerful PHP debugging helper](https://kint-php.github.io/kint/))
- Composer ([Dependency Manager for PHP](https://getcomposer.org/))


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
- [ ] Dokumentoi perusasiat [doc-kansioon yhteen pdf-tiedostoon (johdanto, käyttötapaukset)](./doc/HunajaPurkki.pdf)
- [x] Pystytä työympäristö
- [x] Rekisteröidy labtooliin

### Viikko 2
- [ ] Suunnittele käyttöliittymäsi ja toteuta niistä staattiset HTML-sivut [(sovelluksen navigaatio toimii, joten en listaa tänne kaikkia linkkejä erikseen)](http://tainalep.users.cs.helsinki.fi/hunajapurkki/)
  - [ ] Suunnittele etusivu
  - [ ] Suunnittele kaikki listaussivut
  - [ ] Suunnittele kaikki muokkaus- ja esittelysivut
- [ ] Ota tietokanta käyttöön ja dokumentoi se
  - [ ] Lisää dokumentaatioon järjestelmän tietosisältö osio ja relaatiotietokantakaavio
  - [ ] Lisää tietokantataulujen pystytyslauseet create_tables.sql-tiedostoon. Pystytä näillä taulut tietokantaan.
  - [ ] Lisää tietokantataulujen poistolauseet drop_tables.sql-tiedostoon
  - [ ] Lisää testidatan lisäyslauseet add_test_data.sql-tiedostoon. Aja testidata tietokantaan.
- [ ] Pushaa kaikki tekemäsi muutokset Gittiin
