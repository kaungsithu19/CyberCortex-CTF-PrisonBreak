CREATE DATABASE IF NOT EXISTS prison;
USE prison;

CREATE TABLE IF NOT EXISTS prisoners (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  description VARCHAR(255)
);

INSERT INTO prisoners(username, password, description)
VALUES ('admin','password','FLAG_1:{You are Lucky. You broke the first prison!!!}');
