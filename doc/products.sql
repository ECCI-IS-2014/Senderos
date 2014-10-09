
CREATE TABLE products(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
    genre VARCHAR(100) NOT NULL,
	console VARCHAR(100) NOT NULL,
	relase_year YEAR(4) NOT NULL,
	price DOUBLE NOT NULL,
	description TEXT NOT NULL,
	image TEXT,
	video TEXT
);

CREATE TABLE users(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
	name VARCHAR(100) NOT NULL,
	lastname VARCHAR(100) NOT NULL,
	country VARCHAR(100) NOT NULL,
	role TEXT NOT NULL
);