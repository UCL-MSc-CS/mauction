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
itemName VARCHAR(200) NOT NULL,
userName VARCHAR(45) NOT NULL, 
category VARCHAR(100) NOT NULL,
startPrice DECIMAL NOT NULL,
description VARCHAR(300) NOT NULL, 
endDate DATETIME NOT NULL, 
delivery VARCHAR(20) NOT NULL, 
itemCondition VARCHAR(30) NOT NULL, 
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

CREATE TABLE Outcome (
outcomeID INT NOT NULL AUTO_INCREMENT,
saleItemID INT NOT NULL,
sold TINYINT(1) NULL, 
endBid DECIMAL NULL,
sellerUsername VARCHAR(45) NOT NULL,
buyerUsername VARCHAR(45) NULL,
sellerEmailSent TINYINT(1) NOT NULL,
buyerEmailSent TINYINT(1) NULL,
PRIMARY KEY (outcomeID))
ENGINE = InnoDB;

INSERT INTO user (userName, email, firstName, lastName, country, city, addressLine1, postcode, password, accountType)
VALUES ("cecrandell", "caroline.crandell.20@ucl.ac.uk", "Caroline", "Crandell", "USA", "Santa Ana", "1 Memory Lane", "90210", SHA("password"), 'seller');

INSERT INTO user (userName, email, firstName, lastName, country, city, addressLine1, postcode, password, accountType)
VALUES ("erinuclkwon", "wei.quan.20@ucl.ac.uk", "Wei", "Quan", "UK", "Santa Ana", "1 Memory Lane", "90210", SHA("1234"), 'buyer');

INSERT INTO user (userName, email, firstName, lastName, country, city, addressLine1, postcode, password, accountType)
VALUES ("mattShorvon", "matthew.shorvon.20@ucl.ac.uk", "Matthew", "Shorvon", "UK", "Santa Ana", "1 Memory Lane", "90210", SHA("password"), 'buyer');

INSERT INTO user (userName, email, firstName, lastName, country, city, addressLine1, postcode, password, accountType)
VALUES ("AriannaBourke", "arianna.bourke.20@ucl.ac.uk", "Arianna", "Bourke", "UK", "Santa Ana", "1 Memory Lane", "90210", SHA("1234"), 'seller');

INSERT INTO auction (itemName, userName, category, startPrice, description, endDate, delivery, itemCondition)
VALUES ("Ibuprofen", "cecrandell", "Health", 2, "Good for headaches", '21-4-21', "Mail-First Class", "New");

INSERT INTO auction (itemName, userName, category, startPrice, description, endDate, delivery, itemCondition)
VALUES ("Paracetamol", "AriannaBourke", "Health", 0.6, "Good for general pain", '21-3-21', "Mail-First Class", "New");

INSERT INTO auction (itemName, userName, category, startPrice, description, endDate, delivery, itemCondition)
VALUES ("Becoming", "cecrandell", "Books", 28.99, "Michelle Obama's life", '20-3-21', "Mail-First Class", "Used");

INSERT INTO auction (itemName, userName, category, startPrice, description, endDate, delivery, itemCondition)
VALUES ("A Promised Land", "AriannaBourke", "Books", 31.99, "Barack Obama's life", '21-3-21', "Mail-First Class", "New");

INSERT INTO auction (itemName, userName, category, startPrice, description, endDate, delivery, itemCondition)
VALUES ("Bowl", "cecrandell", "Home Decor", 10.5, "Ceramic yellow bowl with green stripes. Excellent for fruit", '20-2-26', "Pick-up in person", "Used");

INSERT INTO auction (itemName, userName, category, startPrice, description, endDate, delivery, itemCondition)
VALUES ("Armchair", "AriannaBourke", "Home Decor", 75, "Green tartan velvet armchair. Very comfortable", '20-6-1', "Pick-up in person", "New");

INSERT INTO auction (itemName, userName, category, startPrice, description, endDate, delivery, itemCondition)
VALUES ("Dumbbell 10kg", "cecrandell", "Sports and Fitness", 50, "Perfect for home workout", '21-6-1', "Mail-First Class", "New");

INSERT INTO auction (itemName, userName, category, startPrice, description, endDate, delivery, itemCondition)
VALUES ("Dumbbell 15kg", "AriannaBourke", "Sports and Fitness", 55, "Perfect for home workout", '21-6-1', "Pick-up in person", "New");

INSERT INTO bid (userName, saleItemID, bidAmount)
VALUES ("mattShorvon",1,3);

INSERT INTO bid (userName, saleItemID, bidAmount)
VALUES ("erinuclkwon",1,4);

INSERT INTO bid (userName, saleItemID, bidAmount)
VALUES ("mattShorvon",1,5);

INSERT INTO bid (userName, saleItemID, bidAmount)
VALUES ("erinuclkwon",1,6);

INSERT INTO bid (userName, saleItemID, bidAmount)
VALUES ("erinuclkwon",2,1);

INSERT INTO bid (userName, saleItemID, bidAmount)
VALUES ("erinuclkwon",4,35);

INSERT INTO bid (userName, saleItemID, bidAmount)
VALUES ("erinuclkwon",6,80);

INSERT INTO bid (userName, saleItemID, bidAmount)
VALUES ("mattShorvon",7,55);

INSERT INTO watchlist (userName, saleItemID)
VALUES ("erinuclkwon",3);

INSERT INTO Outcome(saleItemID, sold, sellerUsername, sellerEmailSent)
VALUES (5,0,"cecrandell",1);
