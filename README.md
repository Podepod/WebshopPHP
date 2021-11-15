# Zever in pakskes

## Soorten

- politieke zever (Een ware Belgische bestseller)
- economische zever
- Covid-19 zever
- persoonlijke zever
- culturele zever
- wetenschappelijke zever
- lokale zever

## Groottes

- kg?
- L?
- klein/groot
- palletten?


## Commands gebruikt voor SQL aan te make (ERD aanpassen)

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