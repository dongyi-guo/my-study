-- Initialize the Database

-- Drop previous tables

DROP TABLE IF EXISTS energy_transactions;
DROP TABLE IF EXISTS energy_products;
DROP TABLE IF EXISTS fee_history;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS account_transactions;
DROP TABLE IF EXISTS trading_positions;
DROP TABLE IF EXISTS account_transaction_types;
DROP TABLE IF EXISTS accounts;
DROP TABLE IF EXISTS energy_types;
DROP TABLE IF EXISTS zones;

-- Create table zones

CREATE TABLE zones (
    id INT AUTO_INCREMENT,
    zoneName TEXT NOT NULL,
    PRIMARY KEY (id)
);

-- Create table energy_types

CREATE TABLE energy_types (
    id INT AUTO_INCREMENT,
    typeName TEXT NOT NULL,
    PRIMARY KEY (id)
);

-- Create table accounts

CREATE TABLE accounts (
    id INT AUTO_INCREMENT,
    balance DOUBLE NOT NULL DEFAULT 0.00,
    PRIMARY KEY (Id)
);

-- Create account_transaction_types table

CREATE TABLE account_transaction_types (
    id INT AUTO_INCREMENT,
    typeName TEXT NOT NULL,
    PRIMARY KEY (Id)
);

-- Create table trading_positions

CREATE TABLE trading_positions (
    id INT AUTO_INCREMENT,
    title TEXT NOT NULL,
    PRIMARY KEY (id)
);

-- Create table account_transactions

CREATE TABLE account_transactions (
    id INT AUTO_INCREMENT,
    accountId INT NOT NULL,
    transactionTypeId INT NOT NULL,
    transactionDateTime DATETIME NOT NULL,
    amount DOUBLE NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (accountId) REFERENCES accounts(id),
    FOREIGN KEY (transactionTypeId) REFERENCES account_transaction_types(id)
);

-- Create table users

CREATE TABLE users (
    id INT AUTO_INCREMENT,
    tradingPositionId INT NOT NULL,
    userName TEXT NOT NULL,
    email TEXT NOT NULL,
    isManager BOOLEAN NOT NULL,
    passwd TEXT NOT NULL,
    isActive BOOLEAN NOT NULL,
    postalAddress TEXT NOT NULL,
    zoneId INT NOT NULL,
    accountId INT NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (tradingPositionId) REFERENCES trading_positions(id),
    FOREIGN KEY (accountId) REFERENCES accounts(id),
    FOREIGN KEY (zoneId) REFERENCES zones(id)
);

-- Create table fee_history

CREATE TABLE fee_history (
    id INT AUTO_INCREMENT,
    feeDateTime DATETIME NOT NULL,
    managerId INT NOT NULL,
    marketFee DOUBLE NOT NULL,
    adminFee DOUBLE NOT NULL,
    taxRate DOUBLE NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (managerId) REFERENCES users(id)
);

-- Create table energy_products

CREATE TABLE energy_products (
    id INT AUTO_INCREMENT,
    ownerId INT NOT NULL,
    energyTypeId INT NOT NULL,
    zoneId INT NOT NULL,
    volume INT NOT NULL DEFAULT 0,
    sellerPrice DOUBLE NOT NULL DEFAULT 0.00,
    PRIMARY KEY (id),
    FOREIGN KEY (ownerId) REFERENCES users(id),
    FOREIGN KEY (energyTypeId) REFERENCES energy_types(id)
);

-- Create table energy_transactions

CREATE TABLE energy_transactions(
    id INT AUTO_INCREMENT,
    feeId INT NOT NULL,
    buyerId INT NOT NULL,
    sellerId INT NOT NULL,
    energyTypeId INT NOT NULL,
    zoneId INT NOT NULL,
    transactionDateTime DATETIME NOT NULL,
    volume DOUBLE NOT NULL,
    tax DOUBLE NOT NULL,
    tradingPrice DOUBLE NOT NULL,
    sellerReceivedPrice DOUBLE NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (feeId) REFERENCES fee_history(id),
    FOREIGN KEY (buyerId) REFERENCES users(id),
    FOREIGN KEY (sellerId) REFERENCES users(id),
    FOREIGN KEY (energyTypeId) REFERENCES energy_types(id),
    FOREIGN KEY (zoneId) REFERENCES zones(id)
);

-- Populate data into accounts table

INSERT INTO accounts (id, balance) VALUES (1001, 5000.00);
INSERT INTO accounts (id, balance) VALUES (1002, 3000.50);
INSERT INTO accounts (id, balance) VALUES (1003, 2000.00);
INSERT INTO accounts (id, balance) VALUES (1004, 4000.75);
INSERT INTO accounts (id, balance) VALUES (1005, 2500.25);
INSERT INTO accounts (id, balance) VALUES (1006, 3500.00);
INSERT INTO accounts (id, balance) VALUES (1007, 1500.50);
INSERT INTO accounts (id, balance) VALUES (1008, 3500.25);
INSERT INTO accounts (id, balance) VALUES (1009, 8500.00);
INSERT INTO accounts (id, balance) VALUES (1010, 9000.75);

-- Populate data into trading_positions table

INSERT INTO trading_positions (id, title)
VALUES (1, 'Buy');
INSERT INTO trading_positions (id, title)
VALUES (2, 'Sell');
INSERT INTO trading_positions (id, title)
VALUES (3, 'Buy/Sell');
INSERT INTO trading_positions (id, title)
VALUES (4, 'Restrict');

-- Populate data into zones table

INSERT INTO zones (id, zoneName)
VALUES (1, 'A');
INSERT INTO zones (id, zoneName)
VALUES (2, 'B');
INSERT INTO zones (id, zoneName)
VALUES (3, 'C');
INSERT INTO zones (id, zoneName)
VALUES (4, 'D');
INSERT INTO zones (id, zoneName)
VALUES (5, 'E');

-- Populate data into energy_types table

INSERT INTO energy_types (id, typeName)
VALUES (1, 'Wind');
INSERT INTO energy_types (id, typeName)
VALUES (2, 'Solar');
INSERT INTO energy_types (id, typeName)
VALUES (3, 'Geothermal');
INSERT INTO energy_types (id, typeName)
VALUES (4, 'Hydroelectric');
INSERT INTO energy_types (id, typeName)
VALUES (5, 'Biomass');

-- Populate data into users table
INSERT INTO users (id, tradingPositionId, userName, email, isManager, passwd, isActive, postalAddress, zoneId, accountId)
VALUES (1, 3, 'Sam Jones', 'sam@gmail.com', False, 'sam@123', True, 'Brisbane Street, Hobart, 7005', 1, 1001);
INSERT INTO users (id, tradingPositionId, userName, email, isManager, passwd, isActive, postalAddress, zoneId, accountId)
VALUES (2, 3, 'Liam Johnson', 'liam@outlook.com', False, 'liam@123', True, 'Green Street, Sydney, 2000', 2, 1002);
INSERT INTO users (id, tradingPositionId, userName, email, isManager, passwd, isActive, postalAddress, zoneId, accountId)
VALUES (3, 3, 'Noah Smith', 'noah@gmail.com', False, 'noah@123', True, 'Elizabeth Street, Melbourne, 3005', 3, 1003);
INSERT INTO users (id, tradingPositionId, userName, email, isManager, passwd, isActive, postalAddress, zoneId, accountId)
VALUES (4, 3, 'Oliver Brown', 'oliver@yahoo.com', False, 'oliver@123', True, 'Collins Street, Brisbane, 4005', 1, 1004);
INSERT INTO users (id, tradingPositionId, userName, email, isManager, passwd, isActive, postalAddress, zoneId, accountId)
VALUES (5, 3, 'James Miller', 'james@aol.com', False, 'james@123', True, 'James Street, Canberra, 2601', 2, 1005);
INSERT INTO users (id, tradingPositionId, userName, email, isManager, passwd, isActive, postalAddress, zoneId, accountId)
VALUES (6, 3, 'Olivia Johnson', 'olivia@gmail.com', False, 'olivia@123', True, 'Glen Street, Adelaide, 5005', 1, 1006);
INSERT INTO users (id, tradingPositionId, userName, email, isManager, passwd, isActive, postalAddress, zoneId, accountId)
VALUES (7, 3, 'Emma Martinez', 'emma@outlook.com', False, 'emma@123', True, 'Battery Point, Darwin, 0810', 3, 1007);
INSERT INTO users (id, tradingPositionId, userName, email, isManager, passwd, isActive, postalAddress, zoneId, accountId)
VALUES (8, 3, 'Ava Lopez', 'ava@gmail.com', False, 'ava@123', True, 'Bank Arcade, Perth, 6005', 1, 1008);
INSERT INTO users (id, tradingPositionId, userName, email, isManager, passwd, isActive, postalAddress, zoneId, accountId)
VALUES (9, 3, 'Mia Thomas', 'mia@yahoo.com', True, 'mia@123', True, 'Brooke Street, Newcastle, 2280', 3, 1009);
INSERT INTO users (id, tradingPositionId, userName, email, isManager, passwd, isActive, postalAddress, zoneId, accountId)
VALUES (10, 3, 'Harper Smith', 'harper@aol.com', True, 'harper@123', True, 'Jennings Lane , Cairns, 4868', 2, 1010);

-- Populate data into account_transaction_types table

INSERT INTO account_transaction_types (id, typeName)
VALUES (1, 'Credit');
INSERT INTO account_transaction_types (id, typeName)
VALUES (2, 'Debit');

-- Populate data into account_transactions table

INSERT INTO account_transactions (id, accountId, transactionTypeId, transactionDateTime, amount)
VALUES (1, 1001, 1, '2022-03-01 12:15:15', 7000.00);
INSERT INTO account_transactions (id, accountId, transactionTypeId, transactionDateTime, amount)
VALUES (2, 1001, 2, '2022-10-01 13:00:00', 2000.00);
INSERT INTO account_transactions (id, accountId, transactionTypeId, transactionDateTime, amount)
VALUES (3, 1002, 1, '2022-03-10 09:10:15', 5000.50);
INSERT INTO account_transactions (id, accountId, transactionTypeId, transactionDateTime, amount)
VALUES (4, 1002, 2, '2022-09-20 10:00:00', 2000.00);
INSERT INTO account_transactions (id, accountId, transactionTypeId, transactionDateTime, amount)
VALUES (5, 1003, 1, '2022-10-01 12:15:15', 2000.00);
INSERT INTO account_transactions (id, accountId, transactionTypeId, transactionDateTime, amount)
VALUES (6, 1004, 1, '2023-01-01 12:15:15', 4000.75);
INSERT INTO account_transactions (id, accountId, transactionTypeId, transactionDateTime, amount)
VALUES (7, 1005, 1, '2023-02-10 09:00:00', 2500.25);
INSERT INTO account_transactions (id, accountId, transactionTypeId, transactionDateTime, amount)
VALUES (8, 1006, 1, '2022-12-10 12:00:00', 3500.00);
INSERT INTO account_transactions (id, accountId, transactionTypeId, transactionDateTime, amount)
VALUES (9, 1007, 1, '2022-12-20 15:00:50', 1500.50);
INSERT INTO account_transactions (id, accountId, transactionTypeId, transactionDateTime, amount)
VALUES (10, 1008, 1, '2022-11-01 13:12:15', 3500.25);
INSERT INTO account_transactions (id, accountId, transactionTypeId, transactionDateTime, amount)
VALUES (11, 1009, 1, '2022-09-01 14:25:25', 8500.00);
INSERT INTO account_transactions (id, accountId, transactionTypeId, transactionDateTime, amount)
VALUES (12, 1010, 1, '2022-08-01 15:45:35', 9000.75);

-- Populate data into fee_history table

INSERT INTO fee_history (id, feeDateTime, managerId, marketFee, adminFee, taxRate)
VALUES (1, '2022-03-01 12:00:00', 9, 5, 5, 5);
INSERT INTO fee_history (id, feeDateTime, managerId, marketFee, adminFee, taxRate)
VALUES (2, '2022-04-01 10:00:00', 9, 5.5, 5.5, 5);
INSERT INTO fee_history (id, feeDateTime, managerId, marketFee, adminFee, taxRate)
VALUES (3, '2022-05-01 11:00:00', 10, 7, 7, 6);
INSERT INTO fee_history (id, feeDateTime, managerId, marketFee, adminFee, taxRate)
VALUES (4, '2022-06-01 13:00:00', 10, 7.5, 7.5, 6);
INSERT INTO fee_history (id, feeDateTime, managerId, marketFee, adminFee, taxRate)
VALUES (5, '2022-07-01 15:00:00', 9, 8, 8, 8);
INSERT INTO fee_history (id, feeDateTime, managerId, marketFee, adminFee, taxRate)
VALUES (6, '2022-08-01 14:00:00', 9, 8.5, 8.5, 8);
INSERT INTO fee_history (id, feeDateTime, managerId, marketFee, adminFee, taxRate)
VALUES (7, '2022-09-01 13:00:00', 10, 9, 9, 8);
INSERT INTO fee_history (id, feeDateTime, managerId, marketFee, adminFee, taxRate)
VALUES (8, '2022-10-01 08:00:00', 10, 9.5, 9.5, 10);
INSERT INTO fee_history (id, feeDateTime, managerId, marketFee, adminFee, taxRate)
VALUES (9, '2022-11-01 09:00:00', 9, 10, 10, 10);
INSERT INTO fee_history (id, feeDateTime, managerId, marketFee, adminFee, taxRate)
VALUES (10, '2022-12-01 10:00:00', 9, 10.5, 10.5, 12);
INSERT INTO fee_history (id, feeDateTime, managerId, marketFee, adminFee, taxRate)
VALUES (11, '2023-01-01 12:00:00', 10, 11, 11, 12);
INSERT INTO fee_history (id, feeDateTime, managerId, marketFee, adminFee, taxRate)
VALUES (12, '2023-02-01 13:00:00', 10, 11.5, 11.5, 15);
INSERT INTO fee_history (id, feeDateTime, managerId, marketFee, adminFee, taxRate)
VALUES (13, '2023-03-01 14:00:00', 9, 12, 12, 15);

-- Populate data into energy_products table

INSERT INTO energy_products (id, ownerId, energyTypeId, zoneId, volume, sellerPrice)
VALUES (1, 1, 1, 1, 100, 5);
INSERT INTO energy_products (id, ownerId, energyTypeId, zoneId, volume, sellerPrice)
VALUES (2, 2, 2, 2, 50, 5);
INSERT INTO energy_products (id, ownerId, energyTypeId, zoneId, volume, sellerPrice)
VALUES (3, 3, 1, 3, 10, 5);
INSERT INTO energy_products (id, ownerId, energyTypeId, zoneId, volume, sellerPrice)
VALUES (4, 4, 1, 1, 200, 5);
INSERT INTO energy_products (id, ownerId, energyTypeId, zoneId, volume, sellerPrice)
VALUES (5, 5, 2, 2, 75, 5);
INSERT INTO energy_products (id, ownerId, energyTypeId, zoneId, volume, sellerPrice)
VALUES (6, 6, 1, 3, 80, 5);

-- Populate data into energy_transactions table

INSERT INTO energy_transactions (id, feeId, buyerId, sellerId, energyTypeId, zoneId, transactionDateTime, volume, tax, tradingPrice, sellerReceivedPrice) VALUES (1, 1, 1, 4, 1, 1, '2022-03-02 12:00:00', 10, 5, 6, 5);
INSERT INTO energy_transactions (id, feeId, buyerId, sellerId, energyTypeId, zoneId, transactionDateTime, volume, tax, tradingPrice, sellerReceivedPrice) VALUES (2, 2, 4, 1, 1, 1, '2022-04-02 10:00:00', 10, 5, 6, 5);
INSERT INTO energy_transactions (id, feeId, buyerId, sellerId, energyTypeId, zoneId, transactionDateTime, volume, tax, tradingPrice, sellerReceivedPrice) VALUES (3, 3, 1, 4, 1, 1, '2022-05-02 11:00:00', 10, 6, 6, 5);
INSERT INTO energy_transactions (id, feeId, buyerId, sellerId, energyTypeId, zoneId, transactionDateTime, volume, tax, tradingPrice, sellerReceivedPrice) VALUES (4, 4, 4, 1, 1, 1, '2022-06-02 13:00:00', 10, 6, 6, 5);
INSERT INTO energy_transactions (id, feeId, buyerId, sellerId, energyTypeId, zoneId, transactionDateTime, volume, tax, tradingPrice, sellerReceivedPrice) VALUES (5, 5, 2, 5, 2, 2, '2022-07-02 15:00:00', 10, 8, 6, 5);
INSERT INTO energy_transactions (id, feeId, buyerId, sellerId, energyTypeId, zoneId, transactionDateTime, volume, tax, tradingPrice, sellerReceivedPrice) VALUES (6, 6, 5, 2, 2, 2, '2022-08-02 14:00:00', 10, 8, 6, 5);
INSERT INTO energy_transactions (id, feeId, buyerId, sellerId, energyTypeId, zoneId, transactionDateTime, volume, tax, tradingPrice, sellerReceivedPrice) VALUES (7, 7, 2, 5, 2, 2, '2022-09-02 13:00:00', 10, 8, 6, 5);
INSERT INTO energy_transactions (id, feeId, buyerId, sellerId, energyTypeId, zoneId, transactionDateTime, volume, tax, tradingPrice, sellerReceivedPrice) VALUES (8, 8, 3, 6, 1, 3, '2022-10-02 08:00:00', 10, 10, 6, 5);
INSERT INTO energy_transactions (id, feeId, buyerId, sellerId, energyTypeId, zoneId, transactionDateTime, volume, tax, tradingPrice, sellerReceivedPrice) VALUES (9, 9, 6, 3, 1, 3, '2022-11-02 09:00:00', 10, 10, 6, 5);
INSERT INTO energy_transactions (id, feeId, buyerId, sellerId, energyTypeId, zoneId, transactionDateTime, volume, tax, tradingPrice, sellerReceivedPrice) VALUES (10, 10, 3, 6, 1, 3, '2022-12-02 10:00:00', 10, 10, 6, 5);
