DROP DATABASE IF EXISTS mauction;
CREATE DATABASE mauction;
USE mauction;

CREATE TABLE user (
userName VARCHAR(45) NOT NULL,
email VARCHAR(45) NOT NULL, 
registrationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
firstName VARCHAR(45) NOT NULL,
lastName VARCHAR(45) NOT NULL,
country VARCHAR (45) NOT NULL, 
principality VARCHAR (45) NULL,
city VARCHAR (45) NOT NULL, 
addressLine1 VARCHAR (80) NOT NULL,
addressLine2 VARCHAR (80) NULL,
postcode VARCHAR (20) NOT NULL, 
password VARCHAR(60) NOT NULL,
accountType VARCHAR(20) NOT NULL,
PRIMARY KEY (userName))
ENGINE = InnoDB;

CREATE TABLE watchlist (
watchID INT NOT NULL AUTO_INCREMENT,
userName VARCHAR(45) NOT NULL,
saleItemID INT NOT NULL,
PRIMARY KEY (watchID))
ENGINE = InnoDB;

CREATE TABLE auction (
saleItemID INT NOT NULL AUTO_INCREMENT,
photo LONGBLOB NULL,
itemName VARCHAR(200) NOT NULL,
userName VARCHAR(45) NOT NULL, 
category VARCHAR(100) NOT NULL,
startPrice DECIMAL NOT NULL,
description VARCHAR(300) NOT NULL, 
reservePrice DECIMAL NULL, 
endDate DATETIME NOT NULL, 
delivery VARCHAR(20) NOT NULL, 
itemCondtion VARCHAR(30) NOT NULL, 
PRIMARY KEY (saleItemID))
ENGINE = InnoDB; 
             
CREATE TABLE bid (
bidID INT NOT NULL AUTO_INCREMENT,
userName VARCHAR(45) NOT NULL,
bidTime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
saleItemID INT NOT NULL,
bidAmount DECIMAL NOT NULL,
PRIMARY KEY (bidID))
ENGINE = InnoDB;

INSERT INTO user (userName, email, firstName, lastName, country, city, addressLine1, postcode, password, accountType)
VALUES ("cecrandell", "caroline.crandell.20@ucl.ac.uk", "Caroline", "Crandell", "USA", "Santa Ana", "1 Memory Lane", "90210", SHA("password"), 'seller');

INSERT INTO user (userName, email, firstName, lastName, country, city, addressLine1, postcode, password, accountType)
VALUES ("erinuclkwon", "wei.quan.20@ucl.ac.uk", "Wei", "Quan", "UK", "Santa Ana", "1 Memory Lane", "90210", SHA("1234"), 'buyer');

INSERT INTO user (userName, email, firstName, lastName, country, city, addressLine1, postcode, password, accountType)
VALUES ("mattShorvon", "matthew.shorvon.20@ucl.ac.uk", "Matthew", "Shorvon", "UK", "Santa Ana", "1 Memory Lane", "90210", SHA("password"), 'buyer');

INSERT INTO user (userName, email, firstName, lastName, country, city, addressLine1, postcode, password, accountType)
VALUES ("AriannaBourke", "arianna.bourke.20@ucl.ac.uk", "Arianna", "Bourke", "UK", "Santa Ana", "1 Memory Lane", "90210", SHA("1234"), 'seller');

INSERT INTO auction (itemName, userName, category, startPrice, description, reservePrice, endDate, delivery, itemCondtion)
VALUES ("Vaccine", "cecrandell", "Health", 1000000, "COVID-19 Cure", 10000000, '21-4-21', "Post", "New");

INSERT INTO auction (itemName, userName, category, startPrice, description, reservePrice, endDate, delivery, itemCondtion)
VALUES ("Vase", "cecrandell", "Home Decor", 10, "Perfect for flowers", 10000000, '21-7-21', "Post", "New");

INSERT INTO auction (itemName, userName, category, startPrice, description, reservePrice, endDate, delivery, itemCondtion)
VALUES ("New President", "cecrandell", "Mental Wellbeing", 2020, "Harris2020", 10000000, '10-8-21', "Post", "New");

INSERT INTO auction (itemName, userName, category, startPrice, description, reservePrice, endDate, delivery, itemCondtion)
VALUES ("Bowl", "AriannaBourke", "Home Decor", 3, "Perfect for ice cream", 10000000, '21-9-21', "Post", "New");

INSERT INTO auction (itemName, userName, category, startPrice, description, reservePrice, endDate, delivery, itemCondtion)
VALUES ("M&Ms", "AriannaBourke", "Mental Wellbeing", 1, "Perfect for post-graduate students", 10000000, '10-10-21', "Post", "New");

INSERT INTO auction (itemName, userName, category, startPrice, description, reservePrice, endDate, delivery, itemCondtion)
VALUES ("Toothpaste", "AriannaBourke", "Health", 10, "For clenched teeth", 1000, '09-10-21', "Post", "New");

INSERT INTO auction (itemName, userName, category, startPrice, description, reservePrice, endDate, delivery, itemCondtion)
VALUES ("Toothpaste", "AriannaBourke", "Health", 100, "For sensitive teeth", 10000000, '09-10-21', "Post", "New");

INSERT INTO bid (userName, saleItemID, bidAmount)
VALUES ("mattShorvon",1,1000001);

INSERT INTO bid (userName, saleItemID, bidAmount)
VALUES ("erinuclkwon",1,1000002);

INSERT INTO bid (userName, saleItemID, bidAmount)
VALUES ("mattShorvon",1,1000003);

INSERT INTO bid (userName, saleItemID, bidAmount)
VALUES ("erinuclkwon",1,1000004);

INSERT INTO bid (userName, saleItemID, bidAmount)
VALUES ("mattShorvon",1,1000005);

INSERT INTO bid (userName, saleItemID, bidAmount)
VALUES ("erinuclkwon",1,1000006);

INSERT INTO bid (userName, saleItemID, bidAmount)
VALUES ("mattShorvon",1,1000007);

INSERT INTO bid (userName, saleItemID, bidAmount)
VALUES ("erinuclkwon",1,1000008);

INSERT INTO watchlist (userName, saleItemID)
VALUES ("AriannaBourke",1);
