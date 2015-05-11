-- Creacion de las tablas
CREATE TABLE stations
(
  id int NOT NULL,
  name varchar(100) NOT NULL,
  location varchar(100),
  description varchar(100),
  PRIMARY KEY(id)
);

CREATE TABLE trails
(
  id int NOT NULL,
  name varchar(100) NOT NULL,
  description varchar(100),
  image varchar(100),
  station_id int,
  PRIMARY KEY(id),
  FOREIGN KEY(station_id) REFERENCES stations(id) ON DELETE SET NULL
);

CREATE TABLE points 
(
  id int NOT NULL,
  pnumber int NOT NULL,
  name varchar(100) NOT NULL,
  cordx float,
  cordy float,
  description varchar(100),
  trail_id int,
  px_x int,
  px_y int,
  PRIMARY KEY(id),
  FOREIGN KEY(trail_id) REFERENCES trails(id) ON DELETE SET NULL
);

CREATE TABLE documents
(
  id int NOT NULL,
  name varchar(100) NOT NULL,
  description varchar(500),
  type varchar(100),
  route varchar(100),
  language varchar(100),
  PRIMARY KEY(id) 
);

CREATE TABLE documents_points
(
  id int NOT NULL,
  document_id int,
  point_id int,
  FOREIGN KEY(point_id) REFERENCES points(id) ON DELETE SET NULL,
  FOREIGN KEY(document_id) REFERENCES documents(id) ON DELETE SET NULL,
  PRIMARY KEY (id)
);

CREATE TABLE countries
(
  id int NOT NULL,
  code varchar(2),
  name varchar(100),
  PRIMARY KEY(id)
);

CREATE TABLE clients
(
  id int NOT NULL,
  username varchar(100),
  name varchar(100),
  lastname varchar(100),
  role varchar(100),
  password varchar(100),
  country_id int,
  PRIMARY KEY(id),
  FOREIGN KEY(country_id) REFERENCES countries(id) ON DELETE SET NULL
);

CREATE TABLE visitors
(
  id int NOT NULL,
  role varchar(100),
  document_id int,
  PRIMARY KEY(id)
  --FOREIGN KEY(document_id) REFERENCES documents(id) ON DELETE SET NULL
);

CREATE TABLE functions
(
  id int NOT NULL,
  client_id int,
  model varchar(100),
  record_id int,
  creating int,
  reading int,
  updating int,
  deleting int,
  PRIMARY KEY(id)
);


-- Autoincrementos para las tablas.

CREATE SEQUENCE stations_seq;
CREATE SEQUENCE trails_seq;
CREATE SEQUENCE points_seq;
CREATE SEQUENCE documents_seq;
CREATE SEQUENCE dots_seq;
CREATE SEQUENCE visitors_seq;
CREATE SEQUENCE country_seq;
CREATE SEQUENCE clients_seq;
CREATE SEQUENCE functions_seq;

-- Triggers para los autoincrementos.

/

CREATE OR REPLACE TRIGGER stations_ai
BEFORE INSERT ON stations 
FOR EACH ROW
BEGIN
  SELECT stations_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

/

CREATE OR REPLACE TRIGGER trails_ai
BEFORE INSERT ON trails
FOR EACH ROW
BEGIN
  SELECT trails_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

/

CREATE OR REPLACE TRIGGER points_ai
BEFORE INSERT ON points
FOR EACH ROW
BEGIN
  SELECT points_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

/

CREATE OR REPLACE TRIGGER documents_ai
BEFORE INSERT ON documents
FOR EACH ROW
BEGIN
  SELECT documents_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

/

CREATE OR REPLACE TRIGGER dots_ai
BEFORE INSERT ON documents_points
FOR EACH ROW
BEGIN
  SELECT dots_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

/

CREATE OR REPLACE TRIGGER visitors_ai
BEFORE INSERT ON visitors
FOR EACH ROW
BEGIN
  SELECT visitors_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

/

CREATE OR REPLACE TRIGGER country_ai
BEFORE INSERT ON countries
FOR EACH ROW
BEGIN
  SELECT country_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

/

CREATE OR REPLACE TRIGGER clients_ai
BEFORE INSERT ON clients
FOR EACH ROW
BEGIN
  SELECT clients_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

/

CREATE OR REPLACE TRIGGER functions_ai
BEFORE INSERT ON functions
FOR EACH ROW
BEGIN
  SELECT functions_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

/

commit;