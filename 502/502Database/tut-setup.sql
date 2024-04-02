DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS papers;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS paperTypes;
DROP TABLE IF EXISTS locations;
DROP TABLE IF EXISTS roles;

-- Question 1

CREATE TABLE roles (
    roleId INTEGER NOT NULL UNIQUE AUTO_INCREMENT,
   	description TEXT NOT NULL,
    PRIMARY KEY (roleId)
);

CREATE TABLE locations (
    locationId INTEGER NOT NULL UNIQUE AUTO_INCREMENT,
    locationName VARCHAR(255) NOT NULL,
    PRIMARY KEY (locationId)
);

CREATE TABLE paperTypes (
    paperTypeId INTEGER NOT NULL UNIQUE AUTO_INCREMENT,
    paperTypeName VARCHAR(255) NOT NULL,
    PRIMARY KEY (paperTypeId)
);

CREATE TABLE users (
	userId INTEGER NOT NULL UNIQUE AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    affiliation TEXT NOT NULL,
    roleId INTEGER NOT NULL,
    PRIMARY KEY (userId),
    FOREIGN KEY (roleId) REFERENCES roles(roleId)
);

CREATE TABLE papers (
    paperId INTEGER NOT NULL UNIQUE AUTO_INCREMENT,
    userId INTEGER NOT NULL,
    paperTypeId INTEGER NOT NULL,
    accepted BOOLEAN NOT NULL,
    title VARCHAR(255) NOT NULL,
    abstract TEXT,
    locationId INTEGER NOT NULL,
    PRIMARY KEY (paperId),
    FOREIGN KEY (userId) REFERENCES users(userId),
    FOREIGN KEY (paperTypeId) REFERENCES paperTypes(paperTypeId),
    FOREIGN KEY (locationId) REFERENCES locations(locationId)
);

CREATE TABLE reviews (
	reviewId INTEGER NOT NULL UNIQUE AUTO_INCREMENT,
    userId INTEGER NOT NULL,
    paperId INTEGER NOT NULL,
    result FLOAT NOT NULL,
    PRIMARY KEY (reviewId),
    FOREIGN KEY (userId) REFERENCES users(userId),
    FOREIGN KEY (paperId) REFERENCES papers(paperId)
);

-- Question 5
-- (Doing this first to avoid constraints)

INSERT INTO roles (roleId, description)
VALUES
(1, 'Chair'),
(2, 'Organiser'),
(3, 'Reviewer'),
(4, 'Author');

-- Question 2

INSERT INTO users (userId, name, email, affiliation, roleId)
VALUES
(1, 'Katharine Silva', 'ks@test.com', 'UTAS', 1),
(2, 'Sue Benitez', 'sb@test.com', 'UNSW',2),
(3, 'Ladonna Gregory', 'lg@test.com', 'RMIT', 2),
(4, 'Virginia Butler', 'vb@test.com', 'UQ', 3),
(5, 'Ronda Hull', 'rh@test.com', 'UTS', 3),
(6, 'Collin Cook', 'col@test.com', 'UTAS', 4),
(7, 'Roma Mitchell', 'rm@test.com', 'UQ', 4),
(8, 'Alexa Town', 'at@test.com', 'ANU', 4);

-- Question 6

INSERT INTO paperTypes (paperTypeId, paperTypeName)
VALUES
(1, 'Papers'),
(2, 'Tips, Techniques and Courseware');

INSERT INTO locations (locationId, locationName)
VALUES
(1, 'Hobart City'),
(2, 'Sandy Bay');

INSERT INTO papers (paperId, userId, paperTypeId, accepted, title, abstract, locationId)
VALUES
(1, 6, 1, false, 'Responsive
webpage', 'The paper investigates how
to make responsive webpage
with modern technology.', 1),
(2, 7, 1, true, 'How to secure your
website?', 'The paper analyses the
possible cyberattacks and
proposes the solutions.', 2),
(3, 8, 2, true, 'Investigation on
user experience', 'The purpose of the paper is
to understand how to
improve the design of the
web page for better user
experience.', 2);

-- Question 4
-- (Doing this in the end to avoid constraints)

INSERT INTO reviews (reviewId, userId, paperId, result)
VALUES
(1, 4, 2, 4),
(2, 5, 1, 2),
(3, 5, 3, 3),
(4, 4, 1, 1);
