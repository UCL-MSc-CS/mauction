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
PRIMARY KEY (buyerID)
);

CREATE TABLE `sellers` (
sellerID INT NOT NULL AUTO_INCREMENT,
userName VARCHAR(45) NULL,
email VARCHAR(45) NULL,
address VARCHAR(45) NULL,
registrationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
firstName VARCHAR(45) NULL,
lastName VARCHAR(45) NULL,
password VARCHAR(40),
PRIMARY KEY (sellerID)
);

CREATE TABLE `auctions` (
saleItemID INT NOT NULL AUTO_INCREMENT,
sellerID INT NOT NULL,
PRIMARY KEY (saleItemID)
);

CREATE TABLE `bids` (
bidID INT NOT NULL AUTO_INCREMENT,
buyerID INT NOT NULL,
saleItemID INT NOT NULL,
PRIMARY KEY (bidID)
);

INSERT INTO `buyers` (userName, email, address, firstName, lastName, password)
VALUES ("cecrandell", "caroline.crandell.20@ucl.ac.uk", "CA, USA", "Caroline", "Crandell", SHA("password"));

INSERT INTO `buyers` (userName, email, address, firstName, lastName, password)
VALUES ("erinuclkwon", "wei.quan.20@ucl.ac.uk", "Birmingham, UK", "Wei", "Quan", SHA("1234"));

INSERT INTO `sellers` (userName, email, address, firstName, lastName, password)
VALUES ("mattShorvon", "matthew.shorvon.20@ucl.ac.uk", "London, UK", "Matthew", "Shorvon", SHA("password"));

INSERT INTO `sellers` (userName, email, address, firstName, lastName, password)
VALUES ("AriannaBourke", "arianna.bourke.20@ucl.ac.uk", "London, UK", "Arianna", "Bourke", SHA("1234"));

INSERT INTO `auctions` (sellerID)
VALUES (1);

INSERT INTO `bids` (buyerID, saleItemID)
VALUES (1,1);


