create database project;
use project;
CREATE TABLE property
(
    propertyId INT(10) PRIMARY KEY NOT NULL,
    status BOOLEAN,
    location VARCHAR(255),
    cost INT
);
CREATE TABLE tenant
(
    tenantId INT(11) PRIMARY KEY NOT NULL
    AUTO_INCREMENT,
    firstName VARCHAR
    (25) NOT NULL,
    lastName VARCHAR
    (25) NOT NULL,
    nin VARCHAR
    (40) ,
    email VARCHAR
    (40) NOT NULL,
    password LONGTEXT NOT NULL,
    username VARCHAR
    (40) NOT NULL
);

    CREATE TABLE maintance
    (
        maintanceId INT(10) PRIMARY KEY NOT NULL,
        photo,
        video,
        category VARCHAR(255) NOT NULL,
        descriptions VARCHAR(255) NOT NULL,
    );
    CREATE TABLE landlord
    (
        firstName VARCHAR(25) NOT NULL,
        lastName VARCHAR(25) NOT NULL,
        email VARCHAR(40) NOT NULL,
        username VARCHAR(25) NOT NULL PRIMARY KEY
    );
