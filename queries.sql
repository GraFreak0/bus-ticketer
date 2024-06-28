--users

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    createdDt DATETIME NOT NULL,
    modifiedDt DATETIME NOT NULL
);

--codes_lakowe
CREATE TABLE codes_lakowe (
    serial_no INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    code VARCHAR(10) NOT NULL,
    date_time DATETIME NOT NULL
);
