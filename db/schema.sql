DROP DATABASE IF EXISTS mauction;
CREATE DATABASE mauction;
USE mauction;

-- things to finalise: put in itemPhoto attribute when ready, multivalued attributes, separate buyer and seller entitites? 

-- CREATE DOMAIN MORE_THAN_ZERO AS REAL CHECK
-- (value > 0);

-- Should create a domain to stop people creating startDates in the past. 

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
userID INT NOT NULL, 
startDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
category VARCHAR(100) NOT NULL,
startPrice DECIMAL NOT NULL,
description VARCHAR(300) NOT NULL, 
reservePrice DECIMAL NULL,
endTime TIME NOT NULL, 
endDate DATE NOT NULL, 
finalPrice DECIMAL NULL, 
commission DECIMAL NOT NULL,               -- commission is a fixed value, no dependance on finalPrice yet
delivery VARCHAR(20) NOT NULL, 
outcome VARCHAR(30) NOT NULL,
cond VARCHAR(30) NOT NULL, 
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

INSERT INTO `users` (userName, email, firstName, lastName, country, password, status)
VALUES ("cecrandell", "caroline.crandell.20@ucl.ac.uk", "Caroline", "Crandell", "USA", SHA("password"), 'buyer');

INSERT INTO `users` (userName, email, firstName, lastName, country, password, status)
VALUES ("erinuclkwon", "wei.quan.20@ucl.ac.uk", "Wei", "Quan", "UK", SHA("1234"), 'seller');

INSERT INTO `users` (userName, email, firstName, lastName, country, password, status)
VALUES ("mattShorvon", "matthew.shorvon.20@ucl.ac.uk", "Matthew", "Shorvon", "UK", SHA("password"), 'seller');

INSERT INTO `users` (userName, email, firstName, lastName, country, password, status)
VALUES ("AriannaBourke", "arianna.bourke.20@ucl.ac.uk", "Arianna", "Bourke", "UK", SHA("1234"), 'buyer');

             -- have to edit this insert with new attributes. 
INSERT INTO `auctions` (itemName, userID, category, startPrice, description, reservePrice, endTime, endDate, commission, delivery, outcome, cond)
VALUES ("Vaccine", 1, "Health", 1000000, "COVID-19 Cure", 10000000, '12:00:00','10-10-21', 20, "Post", "Bidding", "New");

INSERT INTO `bids` (userID, saleItemID, bidAmount)
VALUES (1,1,4);


