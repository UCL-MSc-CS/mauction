DROP DATABASE IF EXISTS mauction;
CREATE DATABASE mauction;
USE mauction;

CREATE TABLE `buyers` (
buyerID INT NOT NULL AUTO_INCREMENT,
userName VARCHAR(45) NULL,
email VARCHAR(45) NULL,
address VARCHAR(45) NULL,
registrationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
firstName VARCHAR(45) NULL,
lastName VARCHAR(45) NULL,
password VARCHAR(40),
PRIMARY KEY (buyerID))
ENGINE = InnoDB;

CREATE TABLE `sellers` (
sellerID INT NOT NULL AUTO_INCREMENT,
userName VARCHAR(45) NULL,
email VARCHAR(45) NULL,
address VARCHAR(45) NULL,
registrationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
firstName VARCHAR(45) NULL,
lastName VARCHAR(45) NULL,
password VARCHAR(40),
PRIMARY KEY (sellerID))
ENGINE = InnoDB;

CREATE TABLE `auctions` (
saleItemID INT NOT NULL AUTO_INCREMENT,
sellerID INT NOT NULL, startDate DATE NOT NULL,
startTime TIME NOT NULL, category VARCHAR(100) NOT NULL,
description VARCHAR(300) NOT NULL, reservePrice DECIMAL NOT NULL,
endTime TIME NOT NULL, endDate DATE NOT NULL, 
finalPrice DECIMAL NOT NULL, commission DECIMAL NOT NULL, 
delivery VARCHAR(20) NOT NULL, outcome VARCHAR(30) NOT NULL,
cond VARCHAR(30) NOT NULL, 
PRIMARY KEY (saleItemID))
ENGINE = InnoDB; 

CREATE TABLE `bids` (
bidID INT NOT NULL AUTO_INCREMENT,
buyerID INT NOT NULL,
saleItemID INT NOT NULL,
PRIMARY KEY (bidID))
ENGINE = InnoDB;

INSERT INTO `buyers` (userName, email, address, firstName, lastName, password)
VALUES ("cecrandell", "caroline.crandell.20@ucl.ac.uk", "CA, USA", "Caroline", "Crandell", SHA("password"));

INSERT INTO `buyers` (userName, email, address, firstName, lastName, password)
VALUES ("erinuclkwon", "wei.quan.20@ucl.ac.uk", "Birmingham, UK", "Wei", "Quan", SHA("1234"));

INSERT INTO `sellers` (userName, email, address, firstName, lastName, password)
VALUES ("mattShorvon", "matthew.shorvon.20@ucl.ac.uk", "London, UK", "Matthew", "Shorvon", SHA("password"));

INSERT INTO `sellers` (userName, email, address, firstName, lastName, password)
VALUES ("AriannaBourke", "arianna.bourke.20@ucl.ac.uk", "London, UK", "Arianna", "Bourke", SHA("1234"));

INSERT INTO `auctions` (saleItemID, sellerID, startDate, startTime, category, description, reservePrice, endTime, endDate, finalPrice, commission, delivery, outcome, cond)
VALUES ('1','1','01-01-20','00:00:00','video games','EPIC fortnite skins','10000.00','12:00:00','10-10-20','10000.00','1','post','still bidding','new');

INSERT INTO `bids` (buyerID, saleItemID)
VALUES (1,1);


