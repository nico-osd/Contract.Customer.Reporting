SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

SHOW WARNINGS;

DROP DATABASE IF EXISTS `ss14-bvz2-fst-2`;
CREATE DATABASE `ss14-bvz2-fst-2`;

SET SQL_MODE = '';
-- GRANT USAGE ON *.* TO ss14-bvz2-fst-2;
DROP USER 'ss14-bvz2-fst-2';
SET SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
SHOW WARNINGS;
CREATE USER 'ss14-bvz2-fst-2' IDENTIFIED BY 'DbPass4BVZ2-2';

GRANT ALL ON `ss14-bvz2-fst-2`.* TO 'ss14-bvz2-fst-2';
SHOW WARNINGS;


SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ss14-bvz2-fst-2`.`Kundengruppe`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ss14-bvz2-fst-2`.`Kundengruppe` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ss14-bvz2-fst-2`.`Kundengruppe` (
  `idKundengruppe` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `beschreibung` TEXT NULL,
  PRIMARY KEY (`idKundengruppe`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ss14-bvz2-fst-2`.`Serienbrief`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ss14-bvz2-fst-2`.`Serienbrief` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ss14-bvz2-fst-2`.`Serienbrief` (
  `idSerienbrief` INT NOT NULL AUTO_INCREMENT,
  `inhalt` LONGTEXT NOT NULL,
  `sendedatum` VARCHAR(45) NULL,
  `idKundengruppe` INT NOT NULL,
  PRIMARY KEY (`idSerienbrief`),
  INDEX `fk_Serienbrief_Kundengruppe1_idx` (`idKundengruppe` ASC),
  CONSTRAINT `fk_Serienbrief_Kundengruppe1`
    FOREIGN KEY (`idKundengruppe`)
    REFERENCES `ss14-bvz2-fst-2`.`Kundengruppe` (`idKundengruppe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ss14-bvz2-fst-2`.`Emailings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ss14-bvz2-fst-2`.`Emailings` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ss14-bvz2-fst-2`.`Emailings` (
  `idEmailings` INT NOT NULL AUTO_INCREMENT,
  `inhalt` LONGTEXT NOT NULL,
  `sendedatum` VARCHAR(45) NULL,
  `idKundengruppe` INT NOT NULL,
  PRIMARY KEY (`idEmailings`),
  INDEX `fk_Emailings_Kundengruppe1_idx` (`idKundengruppe` ASC),
  CONSTRAINT `fk_Emailings_Kundengruppe1`
    FOREIGN KEY (`idKundengruppe`)
    REFERENCES `ss14-bvz2-fst-2`.`Kundengruppe` (`idKundengruppe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ss14-bvz2-fst-2`.`Adresse`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ss14-bvz2-fst-2`.`Adresse` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ss14-bvz2-fst-2`.`Adresse` (
  `idAdresse` INT NOT NULL AUTO_INCREMENT,
  `strasse` VARCHAR(255) NULL,
  `hausnummer` INT NULL,
  `stiege` INT NULL,
  `tuernummer` INT NULL,
  `postleitzahl` INT NULL,
  `ort` VARCHAR(255) NULL,
  `land` VARCHAR(255) NULL,
  PRIMARY KEY (`idAdresse`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ss14-bvz2-fst-2`.`Kunde`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ss14-bvz2-fst-2`.`Kunde` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ss14-bvz2-fst-2`.`Kunde` (
  `idKunde` INT NOT NULL AUTO_INCREMENT,
  `vorname` VARCHAR(255) NOT NULL,
  `nachname` VARCHAR(255) NOT NULL,
  `telefonnummer` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  `idKundengruppe` INT NOT NULL,
  `idAdresse` INT NOT NULL,
  PRIMARY KEY (`idKunde`),
  INDEX `fk_Kunde_Kundengruppe_idx` (`idKundengruppe` ASC),
  INDEX `fk_Kunde_Adresse1_idx` (`idAdresse` ASC),
  CONSTRAINT `fk_Kunde_Kundengruppe`
    FOREIGN KEY (`idKundengruppe`)
    REFERENCES `ss14-bvz2-fst-2`.`Kundengruppe` (`idKundengruppe`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Kunde_Adresse1`
    FOREIGN KEY (`idAdresse`)
    REFERENCES `ss14-bvz2-fst-2`.`Adresse` (`idAdresse`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ss14-bvz2-fst-2`.`Artikel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ss14-bvz2-fst-2`.`Artikel` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ss14-bvz2-fst-2`.`Artikel` (
  `idArtikel` INT NOT NULL AUTO_INCREMENT,
  `bezeichnung` VARCHAR(45) NULL,
  `kategorie` VARCHAR(45) NULL,
  `einheit` VARCHAR(45) NULL,
  `einkaufspreis` FLOAT NULL,
  `nettopreis` FLOAT NULL,
  PRIMARY KEY (`idArtikel`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ss14-bvz2-fst-2`.`Beschwerde`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ss14-bvz2-fst-2`.`Beschwerde` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ss14-bvz2-fst-2`.`Beschwerde` (
  `idBeschwerde` INT NOT NULL AUTO_INCREMENT,
  `datum` VARCHAR(45) NULL,
  `grund` VARCHAR(150) NULL,
  `zusammenfassung` TEXT NULL,
  `verbesserungsvorschlaege` TEXT NULL,
  `betroffenerArtikel` INT NOT NULL,
  `idKunde` INT NOT NULL,
  PRIMARY KEY (`idBeschwerde`),
  INDEX `fk_Beschwerde_Artikel1_idx` (`betroffenerArtikel` ASC),
  INDEX `fk_Beschwerde_Kunde1_idx` (`idKunde` ASC),
  CONSTRAINT `fk_Beschwerde_Artikel1`
    FOREIGN KEY (`betroffenerArtikel`)
    REFERENCES `ss14-bvz2-fst-2`.`Artikel` (`idArtikel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Beschwerde_Kunde1`
    FOREIGN KEY (`idKunde`)
    REFERENCES `ss14-bvz2-fst-2`.`Kunde` (`idKunde`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ss14-bvz2-fst-2`.`Mitarbeiter`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ss14-bvz2-fst-2`.`Mitarbeiter` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ss14-bvz2-fst-2`.`Mitarbeiter` (
  `idMitarbeiter` INT NOT NULL AUTO_INCREMENT,
  `nachname` VARCHAR(45) NULL,
  `vorname` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `telefonnummer` VARCHAR(45) NULL,
  `abteilung` VARCHAR(45) NULL,
  `eintrittsdatum` VARCHAR(45) NULL,
  `idAdresse` INT NOT NULL,
  PRIMARY KEY (`idMitarbeiter`),
  INDEX `fk_Mitarbeiter_Adresse1_idx` (`idAdresse` ASC),
  CONSTRAINT `fk_Mitarbeiter_Adresse1`
    FOREIGN KEY (`idAdresse`)
    REFERENCES `ss14-bvz2-fst-2`.`Adresse` (`idAdresse`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ss14-bvz2-fst-2`.`AnfrageStatus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ss14-bvz2-fst-2`.`AnfrageStatus` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ss14-bvz2-fst-2`.`AnfrageStatus` (
  `idAnfrageStatus` INT NOT NULL,
  `status` VARCHAR(45) NULL,
  PRIMARY KEY (`idAnfrageStatus`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ss14-bvz2-fst-2`.`Anfrage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ss14-bvz2-fst-2`.`Anfrage` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ss14-bvz2-fst-2`.`Anfrage` (
  `idAnfrage` INT NOT NULL AUTO_INCREMENT,
  `thema` VARCHAR(255) NULL,
  `beschreibung` LONGTEXT NULL,
  `datumFaellig` VARCHAR(45) NULL,
  `datumErstellen` VARCHAR(45) NULL,
  `idKunde` INT NOT NULL,
  `idArtikel` INT NOT NULL,
  `zugewiesenIdMitarbeiter` INT NOT NULL,
  `erstelltIdMitarbeiter` INT NOT NULL,
  `idAnfrageStatus` INT NOT NULL,
  PRIMARY KEY (`idAnfrage`),
  INDEX `fk_Anfrage_Kunde1_idx` (`idKunde` ASC),
  INDEX `fk_Anfrage_Artikel1_idx` (`idArtikel` ASC),
  INDEX `fk_Anfrage_Mitarbeiter1_idx` (`zugewiesenIdMitarbeiter` ASC),
  INDEX `fk_Anfrage_Mitarbeiter2_idx` (`erstelltIdMitarbeiter` ASC),
  INDEX `fk_Anfrage_AnfrageStatus1_idx` (`idAnfrageStatus` ASC),
  CONSTRAINT `fk_Anfrage_Kunde1`
    FOREIGN KEY (`idKunde`)
    REFERENCES `ss14-bvz2-fst-2`.`Kunde` (`idKunde`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Anfrage_Artikel1`
    FOREIGN KEY (`idArtikel`)
    REFERENCES `ss14-bvz2-fst-2`.`Artikel` (`idArtikel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Anfrage_Mitarbeiter1`
    FOREIGN KEY (`zugewiesenIdMitarbeiter`)
    REFERENCES `ss14-bvz2-fst-2`.`Mitarbeiter` (`idMitarbeiter`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Anfrage_Mitarbeiter2`
    FOREIGN KEY (`erstelltIdMitarbeiter`)
    REFERENCES `ss14-bvz2-fst-2`.`Mitarbeiter` (`idMitarbeiter`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Anfrage_AnfrageStatus1`
    FOREIGN KEY (`idAnfrageStatus`)
    REFERENCES `ss14-bvz2-fst-2`.`AnfrageStatus` (`idAnfrageStatus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ss14-bvz2-fst-2`.`Lieferantenkonditionen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ss14-bvz2-fst-2`.`Lieferantenkonditionen` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ss14-bvz2-fst-2`.`Lieferantenkonditionen` (
  `idKondition` INT NOT NULL,
  `Lieferkondition` VARCHAR(45) NULL,
  `Zahlungskondition` VARCHAR(45) NULL,
  `Beschreibung` TEXT NULL,
  PRIMARY KEY (`idKondition`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ss14-bvz2-fst-2`.`Lieferantenkontakt`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ss14-bvz2-fst-2`.`Lieferantenkontakt` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ss14-bvz2-fst-2`.`Lieferantenkontakt` (
  `idLieferant` INT NOT NULL,
  `vorname` VARCHAR(255) NULL,
  `nachname` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  `position` VARCHAR(45) NULL,
  `telefonnummer` VARCHAR(255) NULL,
  `idAdresse` INT NOT NULL,
  `idKondition` INT NOT NULL,
  PRIMARY KEY (`idLieferant`),
  INDEX `fk_Lieferantenkontakt_Adresse1_idx` (`idAdresse` ASC),
  INDEX `fk_Lieferantenkontakt_Lieferantenkonditionen1_idx` (`idKondition` ASC),
  CONSTRAINT `fk_Lieferantenkontakt_Adresse1`
    FOREIGN KEY (`idAdresse`)
    REFERENCES `ss14-bvz2-fst-2`.`Adresse` (`idAdresse`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Lieferantenkontakt_Lieferantenkonditionen1`
    FOREIGN KEY (`idKondition`)
    REFERENCES `ss14-bvz2-fst-2`.`Lieferantenkonditionen` (`idKondition`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ss14-bvz2-fst-2`.`Arbeiter`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ss14-bvz2-fst-2`.`Arbeiter` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ss14-bvz2-fst-2`.`Arbeiter` (
  `lohn` FLOAT NULL,
  `idMitarbeiter` INT NOT NULL,
  `arbeitszeit_monat` FLOAT NULL,
  INDEX `fk_Montagemitarbeiter_Mitarbeiter1_idx` (`idMitarbeiter` ASC),
  PRIMARY KEY (`idMitarbeiter`),
  CONSTRAINT `fk_Montagemitarbeiter_Mitarbeiter1`
    FOREIGN KEY (`idMitarbeiter`)
    REFERENCES `ss14-bvz2-fst-2`.`Mitarbeiter` (`idMitarbeiter`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ss14-bvz2-fst-2`.`Angestellter`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ss14-bvz2-fst-2`.`Angestellter` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ss14-bvz2-fst-2`.`Angestellter` (
  `gehalt` FLOAT NULL,
  `idMitarbeiter` INT NOT NULL,
  INDEX `fk_Montagemitarbeiter_Mitarbeiter1_idx` (`idMitarbeiter` ASC),
  PRIMARY KEY (`idMitarbeiter`),
  CONSTRAINT `fk_Montagemitarbeiter_Mitarbeiter10`
    FOREIGN KEY (`idMitarbeiter`)
    REFERENCES `ss14-bvz2-fst-2`.`Mitarbeiter` (`idMitarbeiter`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ss14-bvz2-fst-2`.`AngebotStatus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ss14-bvz2-fst-2`.`AngebotStatus` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ss14-bvz2-fst-2`.`AngebotStatus` (
  `idAngebotStatus` INT NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idAngebotStatus`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ss14-bvz2-fst-2`.`Auftrag_has_AngebotStatus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ss14-bvz2-fst-2`.`Auftrag_has_AngebotStatus` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ss14-bvz2-fst-2`.`Auftrag_has_AngebotStatus` (
  `AngebotStatus_idAngebotStatus` INT NOT NULL,
  `aenderungsdatum` VARCHAR(45) NULL,
  PRIMARY KEY (`AngebotStatus_idAngebotStatus`),
  INDEX `fk_Auftrag_has_AngebotStatus_AngebotStatus1_idx` (`AngebotStatus_idAngebotStatus` ASC),
  CONSTRAINT `fk_Auftrag_has_AngebotStatus_AngebotStatus1`
    FOREIGN KEY (`AngebotStatus_idAngebotStatus`)
    REFERENCES `ss14-bvz2-fst-2`.`AngebotStatus` (`idAngebotStatus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ss14-bvz2-fst-2`.`Auftrag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ss14-bvz2-fst-2`.`Auftrag` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ss14-bvz2-fst-2`.`Auftrag` (
  `idAngebot` INT NOT NULL AUTO_INCREMENT,
  `datum` VARCHAR(45) NULL,
  `montage` FLOAT NULL,
  `rabatt` FLOAT NULL,
  `idMitarbeiter` INT NOT NULL,
  `Anfrage_idAnfrage` INT NOT NULL,
  `status` INT NOT NULL,
  PRIMARY KEY (`idAngebot`),
  INDEX `fk_Angebot_Mitarbeiter1_idx` (`idMitarbeiter` ASC),
  INDEX `fk_Angebot_Anfrage1_idx` (`Anfrage_idAnfrage` ASC),
  INDEX `fk_Auftrag_Auftrag_has_AngebotStatus1_idx` (`status` ASC),
  CONSTRAINT `fk_Angebot_Mitarbeiter1`
    FOREIGN KEY (`idMitarbeiter`)
    REFERENCES `ss14-bvz2-fst-2`.`Mitarbeiter` (`idMitarbeiter`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Angebot_Anfrage1`
    FOREIGN KEY (`Anfrage_idAnfrage`)
    REFERENCES `ss14-bvz2-fst-2`.`Anfrage` (`idAnfrage`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Auftrag_Auftrag_has_AngebotStatus1`
    FOREIGN KEY (`status`)
    REFERENCES `ss14-bvz2-fst-2`.`Auftrag_has_AngebotStatus` (`AngebotStatus_idAngebotStatus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ss14-bvz2-fst-2`.`Angebot_has_Artikel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ss14-bvz2-fst-2`.`Angebot_has_Artikel` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ss14-bvz2-fst-2`.`Angebot_has_Artikel` (
  `Angebot_idAngebot` INT NOT NULL,
  `Artikel_idArtikel` INT NOT NULL,
  `menge` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Angebot_idAngebot`, `Artikel_idArtikel`),
  INDEX `fk_Angebot_has_Artikel_Artikel1_idx` (`Artikel_idArtikel` ASC),
  INDEX `fk_Angebot_has_Artikel_Angebot1_idx` (`Angebot_idAngebot` ASC),
  CONSTRAINT `fk_Angebot_has_Artikel_Angebot1`
    FOREIGN KEY (`Angebot_idAngebot`)
    REFERENCES `ss14-bvz2-fst-2`.`Auftrag` (`idAngebot`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Angebot_has_Artikel_Artikel1`
    FOREIGN KEY (`Artikel_idArtikel`)
    REFERENCES `ss14-bvz2-fst-2`.`Artikel` (`idArtikel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `ss14-bvz2-fst-2`.`Rechnung`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ss14-bvz2-fst-2`.`Rechnung` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `ss14-bvz2-fst-2`.`Rechnung` (
  `idRechnung` INT NOT NULL AUTO_INCREMENT,
  `rechnungsnummer` VARCHAR(45) NULL,
  `datum` VARCHAR(45) NULL,
  `idAngebot` INT NOT NULL,
  PRIMARY KEY (`idRechnung`),
  INDEX `fk_Rechnung_Auftrag1_idx` (`idAngebot` ASC),
  CONSTRAINT `fk_Rechnung_Auftrag1`
    FOREIGN KEY (`idAngebot`)
    REFERENCES `ss14-bvz2-fst-2`.`Auftrag` (`idAngebot`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
