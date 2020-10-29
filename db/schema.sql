DROP DATABASE IF EXISTS mauction;
CREATE DATABASE mauction;
USE mauction;

--things to finalise: put in itemPhoto attribute when ready, multivalued attributes, separate buyer and seller entitites? 

CREATE DOMAIN MORE_THAN_ZERO AS REAL CHECK
(value > 0);

--Should create a domain to stop people creating startDates in the past. 

CREATE TABLE 'users' (
userID INT NOT NULL AUTO_INCREMENT,
userName VARCHAR(45) NOT NULL,
email VARCHAR(45) NOT NULL,              --removed addresses as attribute (may put it as separate entity)
registrationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
firstName VARCHAR(45) NULL,
lastName VARCHAR(45) NULL,
password VARCHAR(40) NOT NULL,
status VARCHAR(20) NOT NULL,
PRIMARY KEY (userID))
ENGINE = InnoDB;

CREATE TABLE 'addresses' (
userName VARCHAR (45) NOT NULL, 
country VARCHAR (45) NOT NULL, 
principality VARCHAR (45) NULL,
city VARCHAR (45) NULL, 
addressLine1 VARCHAR (80) NOT NULL,
addressLine2 VARCHAR (80) NULL,
postcode VARCHAR (20) NOT NULL, 
PRIMARY KEY (userName))
ENGINE = InnoDB;

CREATE TABLE `auctions` (
saleItemID INT NOT NULL AUTO_INCREMENT,
itemName VARCHAR(200) NOT NULL,
userID INT NOT NULL, startDate DATE NOT NULL,
startTime TIME NOT NULL, category VARCHAR(100) NOT NULL,
startPrice DECIMAL NOT NULL
description VARCHAR(300) NOT NULL, reservePrice DECIMAL NULL,
endTime TIME NOT NULL, endDate DATE NOT NULL, 
finalPrice DECIMAL NOT NULL, commission DECIMAL NOT NULL,               --commission is a fixed value, no dependance on finalPrice yet
delivery VARCHAR(20) NOT NULL, outcome VARCHAR(30) NOT NULL,
cond VARCHAR(30) NOT NULL, 
PRIMARY KEY (saleItemID))
ENGINE = InnoDB; 
             
CREATE TABLE `bids` (
bidID INT NOT NULL AUTO_INCREMENT,
userID INT NOT NULL,
timeStamp DATETIME NOT NULL,
saleItemID INT NOT NULL,
bidAmount DECIMAL NOT NULL MORE_THAN_ZERO,    --THIS LINE MIGHT THROW ERRORS 
PRIMARY KEY (bidID))
ENGINE = InnoDB;

INSERT INTO `users` (userName, email, address, firstName, lastName, password, status)
VALUES ("cecrandell", "caroline.crandell.20@ucl.ac.uk", "CA, USA", "Caroline", "Crandell", SHA("password"), 'buyer');

INSERT INTO `users` (userName, email, address, firstName, lastName, password, status)
VALUES ("erinuclkwon", "wei.quan.20@ucl.ac.uk", "Birmingham, UK", "Wei", "Quan", SHA("1234"), 'seller');

INSERT INTO `users` (userName, email, address, firstName, lastName, password, status)
VALUES ("mattShorvon", "matthew.shorvon.20@ucl.ac.uk", "London, UK", "Matthew", "Shorvon", SHA("password"), 'seller');

INSERT INTO `users` (userName, email, address, firstName, lastName, password, status)
VALUES ("AriannaBourke", "arianna.bourke.20@ucl.ac.uk", "London, UK", "Arianna", "Bourke", SHA("1234"), 'buyer');

             -- have to edit this insert with new attributes. 
INSERT INTO `auctions` (saleItemID, sellerID, startDate, startTime, category, description, reservePrice, endTime, endDate, finalPrice, commission, delivery, outcome, cond)
VALUES ('1','1','01-01-20','00:00:00','video games','EPIC fortnite skins','10000.00','12:00:00','10-10-20','10000.00','1','post','still bidding','new');

INSERT INTO `bids` (buyerID, saleItemID)
VALUES (1,1);


