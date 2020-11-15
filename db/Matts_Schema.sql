DROP DATABASE IF EXISTS mauction;
CREATE DATABASE mauction;
USE mauction;

-- things to finalise: put in itemPhoto attribute when ready, multivalued attributes, separate buyer and seller entitites? 

-- CREATE DOMAIN MORE_THAN_ZERO AS REAL CHECK
-- (value > 0);

-- Should create a domain to stop people creating startDates in the past. 

CREATE TABLE users (
userID INT NOT NULL AUTO_INCREMENT,
userName VARCHAR(45) NOT NULL,
email VARCHAR(45) NOT NULL,              
registrationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
firstName VARCHAR(45) NULL,
lastName VARCHAR(45) NULL,
country VARCHAR (45) NOT NULL, 
principality VARCHAR (45) NULL,
city VARCHAR (45) NULL, 
addressLine1 VARCHAR (80) NULL,
addressLine2 VARCHAR (80) NULL,
postcode VARCHAR (20) NULL, 
password VARCHAR(60) NOT NULL,
accountType VARCHAR(20) NOT NULL,
PRIMARY KEY (userID))
ENGINE = InnoDB;

CREATE TABLE photos (
saleItemID INT NOT NULL,
photo VARCHAR(200) NULL,
PRIMARY KEY (saleItemID))
ENGINE = InnoDB;

CREATE TABLE auctions (
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
             
CREATE TABLE bids (
bidID INT NOT NULL AUTO_INCREMENT,
userID INT NULL,
bidTime DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
saleItemID INT NULL,
-- bidAmount DECIMAL NOT NULL MORE_THAN_ZERO,    -- THIS LINE MIGHT THROW ERRORS 
bidAmount DECIMAL NOT NULL,
PRIMARY KEY (bidID))
ENGINE = InnoDB;

INSERT INTO users (userName, email, firstName, lastName, country, password, accountType)
VALUES ("cecrandell", "caroline.crandell.20@ucl.ac.uk", "Caroline", "Crandell", "USA", SHA("password"), 'buyer');

INSERT INTO users (userName, email, firstName, lastName, country, password, accountType)
VALUES ("erinuclkwon", "wei.quan.20@ucl.ac.uk", "Wei", "Quan", "UK", SHA("1234"), 'seller');

INSERT INTO users (userName, email, firstName, lastName, country, password, accountType)
VALUES ("mattShorvon", "matthew.shorvon.20@ucl.ac.uk", "Matthew", "Shorvon", "UK", SHA("password"), 'seller');

INSERT INTO users (userName, email, firstName, lastName, country, password, accountType)
VALUES ("AriannaBourke", "arianna.bourke.20@ucl.ac.uk", "Arianna", "Bourke", "UK", SHA("1234"), 'buyer');

             -- have to edit this insert with new attributes. 
INSERT INTO auctions (itemName, userID, category, startPrice, description, reservePrice, endTime, endDate, commission, delivery, outcome, cond)
VALUES ("Vaccine", 1, "Health", 1000000, "COVID-19 Cure", 10000000, '12:00:00','10-4-21', 20, "Post", "Bidding", "New");

INSERT INTO auctions (itemName, userID, category, startPrice, description, reservePrice, endTime, endDate, commission, delivery, outcome, cond)
VALUES ("Vase", 1, "Home Decor", 10, "Perfect for flowers", 10000000, '12:00:00','10-7-21', 1, "Post", "Bidding", "New");

INSERT INTO auctions (itemName, userID, category, startPrice, description, reservePrice, endTime, endDate, commission, delivery, outcome, cond)
VALUES ("New President", 1, "Mental Wellbeing", 2020, "Harris2020", 10000000, '12:00:00','10-8-21', 2, "Post", "Bidding", "New");


INSERT INTO auctions (itemName, userID, category, startPrice, description, reservePrice, endTime, endDate, commission, delivery, outcome, cond)
VALUES ("Bowl", 1, "Home Decor", 3, "Perfect for ice cream", 10000000, '12:00:00','10-9-21', 3, "Post", "Bidding", "New");

INSERT INTO auctions (itemName, userID, category, startPrice, description, reservePrice, endTime, endDate, commission, delivery, outcome, cond)
VALUES ("M&Ms", 1, "Mental Wellbeing", 1, "Perfect for post-graduate students", 10000000, '12:00:00','10-10-21', 4, "Post", "Bidding", "New");

INSERT INTO auctions (itemName, userID, category, startPrice, description, reservePrice, endTime, endDate, commission, delivery, outcome, cond)
VALUES ("Toothpaste", 1, "Health", 10, "For clenched teeth", 10000000, '12:00:00','09-10-21', 5, "Post", "Bidding", "New");

INSERT INTO auctions (itemName, userID, category, startPrice, description, reservePrice, endTime, endDate, commission, delivery, outcome, cond)
VALUES ("Toothpaste", 1, "Health", 1000000, "For sensitive teeth", 10000000, '12:00:00','09-10-21', 5, "Post", "Bidding", "New");


INSERT INTO bids (userID, saleItemID, bidAmount)
VALUES (1,1,4);