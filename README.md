# Zever in pakskes

## TODO

- [x] login / signup
- [x] bestellingen pagina sql
- [ ] search --> AJAX
- [ ] js form check [bootstrap validation](https://getbootstrap.com/docs/5.0/forms/validation/)
- [ ] error handling? 1 try en catch gebruiken
- [ ] bestelling moet ook stock verminderen
- [x] bestellingen klantNaam weergeven ipv klant ID --> miss ook adres weergeven?
- [ ] onnodige files verwijderen
- [ ] 'alert=Prepare statement3 failed.' veranderen naar iets klantvriendelijker
- [ ] sql user veranderen naar de juiste!!!
- [ ] nieuwe ERD maken

## Webuser account

```
email    : webuser@zeverinpakskes.be
password : Lab2021
```

## Andere accounts

gewone klant account
```
email    : lode.gilis@lode.be
password : lode
```

andere admin account
```
email    : admin@zeverinpakskes.be
password : eenGoedWachtwoord
```

## Soorten

- [x] politieke zever (Een ware Belgische bestseller)
- [x] economische zever
- [x] Covid-19 zever
- [x] persoonlijke zever
- [x] culturele zever
- [ ] wetenschappelijke zever
- [x] lokale zever

## Groottes

- kg?
- L?
- klein/groot
- palletten?


## Commands gebruikt voor SQL aan te make (ERD aanpassen)

eerst in mysql console geraken door de command `mysql -u root -p`

```sql
CREATE DATABASE ZeverInPakskesDB;

USE ZeverInPakskesDB;

CREATE TABLE Adressen (
    adresID int NOT NULL AUTO_INCREMENT,
    straatnaam varchar(255) NOT NULL,
    postcode varchar(255) NOT NULL,
    dorpsnaam varchar(255) NOT NULL,
    straatnummer varchar(255) NOT NULL,
    PRIMARY KEY ( adresID )
);

CREATE TABLE Klanten (
    klantID int NOT NULL AUTO_INCREMENT,
    naam varchar(255) NOT NULL,
    familieNaam varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    geboorteDatum date NOT NULL,
    registratieTijd timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    admin tinyint(1) NOT NULL DEFAULT '0',
    verwijderd tinyint(1) NOT NULL DEFAULT '0',
    adresID int NOT NULL,
    PRIMARY KEY ( klantID )
);

CREATE TABLE Bestellingen (
    bestellingID int NOT NULL AUTO_INCREMENT,
    klantID int NOT NULL,
    bestellingTijd timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    betaald tinyint(1) NOT NULL DEFAULT '0',
    PRIMARY KEY ( bestellingID )
);

CREATE TABLE BestellingProducten (
    bestelProductID int NOT NULL AUTO_INCREMENT,
    bestellingID int NOT NULL,
    productID int NOT NULL,
    hoeveelheid int NOT NULL,
    PRIMARY KEY ( bestelProductID )
);

CREATE TABLE Producten (
    productID int NOT NULL AUTO_INCREMENT,
    naam varchar(255) NOT NULL,
    beschrijving varchar(1024) NOT NULL,
    voorraad int NOT NULL,
    prijs decimal(10,2) NOT NULL DEFAULT '0.00',
    afbeeldingNaam varchar(255) NOT NULL DEFAULT 'placeholder.jpg',
    verwijderd tinyint(1) NOT NULL DEFAULT '0',
    PRIMARY KEY ( productID )
);


INSERT INTO Producten (naam, beschrijving, voorraad, prijs) VALUES
('Politieke Zever', 'Dit is een ware Belgische Bestseller', '12', '330.30'),
('Corona Zever', 'De afgelopen tijd is dit zeer hard van toepassing', '16', '199.99'),
('Economische Zever', 'Allemaal zever over geld en toestanden', '6', '250'),
('Culturele Zever', 'Deze zever kan een beetje controversieel zijn', '11', '100');
```

bestelling pagina sql queries

```sql
SELECT b.bestellingID, CONCAT(k.naam, ' ', k.familieNaam) as 'klant', CONCAT(a.straatnaam, ' ', a.straatnummer, ', ', a.postcode, ' ', a.dorpsnaam) as 'bezorgadres', b.bestellingTijd, sum(p.prijs * bp.hoeveelheid) as 'totaal', b.betaald
FROM bestellingen b
    INNER JOIN bestellingproducten bp
    ON b.bestellingID = bp.bestellingID
        INNER JOIN producten p
        ON bp.productID = p.productID
    INNER JOIN klanten k
    ON b.klantID = k.klantID
        INNER JOIN adressen a
        ON k.adresID = a.adresID
GROUP BY b.bestellingID
ORDER BY b.bestellingTijd DESC;

SELECT p.productID, p.naam, p.prijs, bp.hoeveelheid, p.prijs * bp.hoeveelheid as 'totaal'
FROM bestellingproducten bp
    INNER JOIN producten p
    ON bp.productID = p.productID
WHERE bp.bestellingID = 11
ORDER BY totaal DESC
```

accounts aanmaken (test user, geen check voor bestaande dingen nodig)

```sql
INSERT INTO Klanten (naam, familieNaam, email, password, geboorteDatum, admin, adresID) VALUES
('Test1', 'TesterFamilie', 'test.test@test.be', '$2y$10$2AYbBRu8vO9AoAWJELcNQuAEoP/INrK20ZEEiztXmNkuA7vK1pBw2', '2002-07-12', '1', '1');

INSERT INTO Adressen (straatnaam, postcode, dorpsnaam, straatnummer) VALUES
('TestStraat', '1234', 'TestDorp', '1A');

UPDATE klanten SET admin=1 WHERE klantID=1;


SELECT k.klantID, CONCAT(k.naam, ' ', k.familieNaam) as 'volledigeNaam', k.email, CONCAT(a.straatnaam, ' ', a.straatnummer, ', ', a.postcode, ' ', a.dorpsnaam) as 'adres', k.geboorteDatum, k.registratieTijd, k.admin FROM klanten k
    INNER JOIN adressen a
    ON k.adresID = a.adresID
WHERE k.verwijderd = '0'
```

login dingen checken

```sql
SELECT * FROM Klanten
WHERE email='test.test@test.be'
```

signup
```sql
SELECT adresID FROM adressen
WHERE straatnaam='TestStraat' AND postcode='1234' AND dorpsnaam='testdorp' AND straatnummer='1A';
```