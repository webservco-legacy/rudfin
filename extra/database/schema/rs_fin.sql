SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
-- SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `rs_fin` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `rs_fin` ;

-- -----------------------------------------------------
-- Table `rs_fin`.`old_fin_transactions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rs_fin`.`old_fin_transactions` ;

CREATE  TABLE IF NOT EXISTS `rs_fin`.`old_fin_transactions` (
  `transaction_id` INT(9) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` INT(9) UNSIGNED NOT NULL DEFAULT '0' ,
  `account_id` INT(9) UNSIGNED NOT NULL DEFAULT '1' ,
  `transaction_type_id` INT(9) UNSIGNED NOT NULL ,
  `transaction_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `transaction_ammount` DECIMAL(10,2) NOT NULL DEFAULT '0.00' ,
  `transaction_notes` VARCHAR(10000) NOT NULL DEFAULT '' ,
  `transaction_status` ENUM('ok','pending') NOT NULL DEFAULT 'ok' ,
  PRIMARY KEY (`transaction_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rs_fin`.`old_fin_transaction_details`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rs_fin`.`old_fin_transaction_details` ;

CREATE  TABLE IF NOT EXISTS `rs_fin`.`old_fin_transaction_details` (
  `transaction_detail_id` INT(9) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `transaction_id` INT(9) UNSIGNED NOT NULL ,
  `transaction_asset_id` INT(9) UNSIGNED NOT NULL ,
  `transaction_detail_ammount` DECIMAL(10,2) NOT NULL DEFAULT '0.00' ,
  `transaction_detail_price` DECIMAL(10,2) NOT NULL DEFAULT '0.00' ,
  `transaction_detail_notes` VARCHAR(10000) NOT NULL DEFAULT '' ,
  PRIMARY KEY (`transaction_detail_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rs_fin`.`old_fin_accounts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rs_fin`.`old_fin_accounts` ;

CREATE  TABLE IF NOT EXISTS `rs_fin`.`old_fin_accounts` (
  `account_id` INT(9) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `account_name` VARCHAR(45) NOT NULL DEFAULT '' ,
  `account_currency` INT(9) UNSIGNED NOT NULL DEFAULT '1' ,
  `account_notes` VARCHAR(10000) NOT NULL DEFAULT '' ,
  PRIMARY KEY (`account_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rs_fin`.`old_fin_transaction_types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rs_fin`.`old_fin_transaction_types` ;

CREATE  TABLE IF NOT EXISTS `rs_fin`.`old_fin_transaction_types` (
  `transaction_type_id` INT(9) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `transaction_type_name` VARCHAR(45) NOT NULL DEFAULT '' ,
  `transaction_type_notes` VARCHAR(10000) NOT NULL DEFAULT '' ,
  PRIMARY KEY (`transaction_type_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rs_fin`.`old_fin_special_transaction_types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rs_fin`.`old_fin_special_transaction_types` ;

CREATE  TABLE IF NOT EXISTS `rs_fin`.`old_fin_special_transaction_types` (
  `special_transaction_type_id` INT(9) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `special_transaction_type_name` VARCHAR(45) NOT NULL DEFAULT '' ,
  `special_transaction_type_notes` VARCHAR(10000) NOT NULL DEFAULT '' ,
  PRIMARY KEY (`special_transaction_type_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rs_fin`.`old_fin_special_transactions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rs_fin`.`old_fin_special_transactions` ;

CREATE  TABLE IF NOT EXISTS `rs_fin`.`old_fin_special_transactions` (
  `special_transaction_id` INT(9) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `special_transaction_type_id` INT(9) UNSIGNED NOT NULL ,
  `transaction_id` INT(9) UNSIGNED NOT NULL ,
  `special_transaction_notes` VARCHAR(10000) NOT NULL DEFAULT '' ,
  PRIMARY KEY (`special_transaction_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rs_fin`.`old_fin_transaction_assets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rs_fin`.`old_fin_transaction_assets` ;

CREATE  TABLE IF NOT EXISTS `rs_fin`.`old_fin_transaction_assets` (
  `transaction_asset_id` INT(9) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `transaction_asset_name` VARCHAR(45) NOT NULL DEFAULT '' ,
  `transaction_asset_notes` VARCHAR(10000) NOT NULL DEFAULT '' ,
  PRIMARY KEY (`transaction_asset_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rs_fin`.`fin_daybooks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rs_fin`.`fin_daybooks` ;

CREATE  TABLE IF NOT EXISTS `rs_fin`.`fin_daybooks` (
  `book_id` VARBINARY(16) NOT NULL DEFAULT '00' ,
  `book_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `book_account` ENUM('cash','bank') NOT NULL DEFAULT 'bank' ,
  `book_type` ENUM('income','payment') NOT NULL DEFAULT 'payment' ,
  `book_amount` DECIMAL(10,2) NOT NULL DEFAULT '0.00' ,
  `book_document` VARCHAR(45) NOT NULL DEFAULT '' ,
  `book_notes` VARCHAR(255) NOT NULL DEFAULT '' ,
  PRIMARY KEY (`book_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `date` ON `rs_fin`.`fin_daybooks` (`book_date` ASC) ;

CREATE INDEX `book` ON `rs_fin`.`fin_daybooks` (`book_account` ASC, `book_type` ASC) ;

USE `rs_fin`;

DELIMITER $$

USE `rs_fin`$$
DROP TRIGGER IF EXISTS `rs_fin`.`fin_daybooks_insert` $$
USE `rs_fin`$$


CREATE TRIGGER fin_daybooks_insert
BEFORE INSERT ON fin_daybooks
FOR EACH ROW
BEGIN
	IF NEW.book_id = '00' THEN
		SET NEW.book_id = UNHEX( REPLACE( UUID(), '-', '' ) );
	END IF;
	IF NEW.book_date = '0000-00-00 00:00:00' THEN
		SET NEW.book_date = NOW();
	END IF;
END;$$


DELIMITER ;


-- SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
