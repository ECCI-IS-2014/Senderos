-- Creaci�n de las tablas
CREATE TABLE stations
(
  id int NOT NULL,
  name varchar(100) NOT NULL,
  location varchar(100) NOT NULL,
  description varchar(100) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE trails
(
  id int NOT NULL,
  name varchar(100) NOT NULL,
  description varchar(100) NOT NULL,
  map multipoint NOT NULL,
  station_id int NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(station_id) REFERENCES stations(id)
);

CREATE TABLE points 
(
  id int NOT NULL,
  name varchar(100) NOT NULL,
  cordx point NOT NULL,
  cordy point NOT NULL,
  description varchar(100) NOT NULL,
  trail_id int NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(trail_id) REFERENCES trails(id)
);

CREATE TABLE multimedias 
(
  id int NOT NULL,
  name varchar(100) NOT NULL,
  description varchar(500) NOT NULL,
  type varchar(100) NOT NULL,
  route varchar(100) NOT NULL,
  language varchar(100) NOT NULL,
  point_id int NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(point_id) REFERENCES points(id)
);

CREATE TABLE point_multimedias 
(
  point_id int NOT NULL,
  multimedia_id int NOT NULL,
  PRIMARY KEY(point_id, multimedia_id),
  FOREIGN KEY(point_id) REFERENCES points(id),
  FOREIGN KEY(multimedia_id) REFERENCES multimedias(id)
);

CREATE TABLE countries
(
  id int NOT NULL,
  code varchar(2) NOT NULL,
  name varchar(100) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE users
(
  id int NOT NULL,
  username varchar(100) NOT NULL,
  name varchar(100) NOT NULL,
  lastname varchar(100) NOT NULL,
  role varchar(100) NOT NULL,
  password varchar(100) NOT NULL,
  country_id int NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(country_id) REFERENCES countries(id)
);

CREATE TABLE visitors
(
  id int NOT NULL,
  role varchar(100) NOT NULL,
  multimedia_id int NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(multimedia_id) REFERENCES multimedias(id)
);

-- Autoincrementos para las tablas.

CREATE SEQUENCE stations_seq;
CREATE SEQUENCE trails_seq;
CREATE SEQUENCE points_seq;
CREATE SEQUENCE multimedias_seq;
CREATE SEQUENCE visitors_seq;
CREATE SEQUENCE country_seq;
CREATE SEQUENCE users_seq;

CREATE OR REPLACE TRIGGER stations_ai
BEFORE INSERT ON stations 
FOR EACH ROW
BEGIN
  SELECT stations_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

CREATE OR REPLACE TRIGGER trails_ai
BEFORE INSERT ON trails
FOR EACH ROW
BEGIN
  SELECT trails_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

CREATE OR REPLACE TRIGGER points_ai
BEFORE INSERT ON points
FOR EACH ROW
BEGIN
  SELECT points_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

CREATE OR REPLACE TRIGGER multimedias_ai
BEFORE INSERT ON multimedias
FOR EACH ROW
BEGIN
  SELECT multimedias_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

CREATE OR REPLACE TRIGGER visitors_ai
BEFORE INSERT ON visitors
FOR EACH ROW
BEGIN
  SELECT visitors_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

CREATE OR REPLACE TRIGGER country_ai
BEFORE INSERT ON countries
FOR EACH ROW
BEGIN
  SELECT country_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

CREATE OR REPLACE TRIGGER users_ai
BEFORE INSERT ON users
FOR EACH ROW
BEGIN
  SELECT users_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

-- Eliminar todas la tablas creadas.
DROP TABLE users;
DROP TABLE countries;
DROP TABLE visitors;
DROP TABLE point_multimedias;
DROP TABLE multimedias;
DROP TABLE points;
DROP TABLE trails;
DROP TABLE stations;

-- Eliminar los autoincrementos
DROP SEQUENCE stations_seq;
DROP TRIGGER stations_ai;
DROP SEQUENCE trails_seq;
DROP TRIGGER trails_ai;
DROP SEQUENCE points_seq;
DROP TRIGGER points_ai;
DROP SEQUENCE multimedias_seq;
DROP TRIGGER multimedias_ai;
DROP SEQUENCE visitors_seq;
DROP TRIGGER visitors_ai;
DROP SEQUENCE country_seq;
DROP TRIGGER country_ai;
DROP SEQUENCE users_seq;
DROP TRIGGER users_ai;