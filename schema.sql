DROP DATABASE IF EXISTS mauction;
CREATE DATABASE mauction;
USE mauction;

CREATE TABLE `users` (
userID INT NOT NULL AUTO_INCREMENT,
userName VARCHAR(45) NOT NULL,
email VARCHAR(45) NOT NULL,              -- removed addresses as attribute (may put it as separate entity)
registrationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
firstName VARCHAR(45) NULL,
lastName VARCHAR(45) NULL,
country VARCHAR (45) NOT NULL, 
principality VARCHAR (45) NULL,
city VARCHAR (45) NULL, 
addressLine1 VARCHAR (80) NULL,
addressLine2 VARCHAR (80) NULL,
postcode VARCHAR (20) NULL, 
password VARCHAR(40) NOT NULL,
status VARCHAR(20) NOT NULL,
PRIMARY KEY (userID))
ENGINE = InnoDB;

CREATE TABLE `photos` (
saleItemID INT NOT NULL,
photo VARCHAR(200) NULL,
PRIMARY KEY (saleItemID))
ENGINE = InnoDB;

CREATE TABLE `auctions` (
saleItemID INT NOT NULL AUTO_INCREMENT,
itemName VARCHAR(200) NOT NULL,
userID INT  NULL, 
startDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
category VARCHAR(100) NOT NULL,
startPrice DECIMAL NOT NULL,
description VARCHAR(300)  NULL, 
reservePrice DECIMAL NULL,
endTime TIME NULL, 
endDate DATE NOT NULL,                -- temporarily just a date object
finalPrice DECIMAL NULL, 
commission DECIMAL NULL,               -- commission is a fixed value, no dependance on finalPrice yet
delivery VARCHAR(20)  NULL, 
outcome VARCHAR(30)  NULL,
cond VARCHAR(30)  NULL, 
PRIMARY KEY (saleItemID))
ENGINE = InnoDB; 
             
CREATE TABLE `bids` (
bidID INT NOT NULL AUTO_INCREMENT,
userID INT NOT NULL,
bidTime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
saleItemID INT NOT NULL,
-- bidAmount DECIMAL NOT NULL MORE_THAN_ZERO,    -- THIS LINE MIGHT THROW ERRORS 
bidAmount DECIMAL NOT NULL,
PRIMARY KEY (bidID))
ENGINE = InnoDB;


INSERT INTO `auctions` (saleItemID, userID, startDate, category, itemName, description, startPrice, endDate, finalPrice, commission, delivery, outcome, cond)
VALUES ('1','1','01-01-20','video games','EPIC fortnite skins', 'epic','10000.00','10-10-20 12:00:00','10000.00','1','post','still bidding','new');


