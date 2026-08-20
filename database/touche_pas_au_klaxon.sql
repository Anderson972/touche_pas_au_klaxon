-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema touche_pas_au_klaxon
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema touche_pas_au_klaxon
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `touche_pas_au_klaxon` ;

CREATE SCHEMA IF NOT EXISTS `touche_pas_au_klaxon` DEFAULT CHARACTER SET utf8 ;
USE `touche_pas_au_klaxon` ;

-- -----------------------------------------------------
-- Table `touche_pas_au_klaxon`.`Users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `touche_pas_au_klaxon`.`Users` ;

CREATE TABLE IF NOT EXISTS `touche_pas_au_klaxon`.`Users` (
  `id_users` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `prenom` VARCHAR(45) NOT NULL,
  `telephone` VARCHAR(10) NOT NULL,
  `email` VARCHAR(125) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `role` ENUM('admin', 'user') NOT NULL,
  PRIMARY KEY (`id_users`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `touche_pas_au_klaxon`.`Agences`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `touche_pas_au_klaxon`.`Agences` ;

CREATE TABLE IF NOT EXISTS `touche_pas_au_klaxon`.`Agences` (
  `id_agences` INT NOT NULL AUTO_INCREMENT,
  `villes` VARCHAR(125) NOT NULL,
  PRIMARY KEY (`id_agences`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `touche_pas_au_klaxon`.`Trajets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `touche_pas_au_klaxon`.`Trajets` ;

CREATE TABLE IF NOT EXISTS `touche_pas_au_klaxon`.`Trajets` (
  `id_trajets` INT NOT NULL AUTO_INCREMENT,
  `GDH_depart` DATETIME NOT NULL,
  `GDH_arrivee` DATETIME NOT NULL,
  `nb_places_total` TINYINT(10) NOT NULL,
  `nb_places_dispo` TINYINT(10) NOT NULL,
  `fk_id_users` INT NOT NULL,
  `fk_id_agences_depart` INT NOT NULL,
  `fk_id_agences_arrivee` INT NOT NULL,
  PRIMARY KEY (`id_trajets`),
  INDEX `fk_id_users` (`fk_id_users` ASC) VISIBLE,
  INDEX `fk_id_agences_depart` (`fk_id_agences_depart` ASC) VISIBLE,
  INDEX `fk_id_agences_arrivee` (`fk_id_agences_arrivee` ASC) VISIBLE,
  CONSTRAINT `fk_id_users`
    FOREIGN KEY (`fk_id_users`)
    REFERENCES `touche_pas_au_klaxon`.`Users` (`id_users`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_agences_depart`
    FOREIGN KEY (`fk_id_agences_depart`)
    REFERENCES `touche_pas_au_klaxon`.`Agences` (`id_agences`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_agences_arrivee`
    FOREIGN KEY (`fk_id_agences_arrivee`)
    REFERENCES `touche_pas_au_klaxon`.`Agences` (`id_agences`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
