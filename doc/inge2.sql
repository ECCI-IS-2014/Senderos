-- Creación de las tablas.
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
  station_id int NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(station_id) REFERENCES stations(id) ON DELETE CASCADE
);

CREATE TABLE points (
  id int NOT NULL,
  pnumber int,
  name varchar(100),
  cordx decimal(20,10),
  cordy decimal(20,10),
  description varchar(100),
  trail_id int,
  px_x int,
  px_y int,
  style varchar(200),
  PRIMARY KEY(id),
  FOREIGN KEY(trail_id) REFERENCES trails(id) ON DELETE CASCADE
);

CREATE TABLE languages
(
  id int NOT NULL,
  code varchar(2) NOT NULL,
  name varchar(100) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE documents
(
  id int NOT NULL,
  name varchar(100) NOT NULL,
  description varchar(500),
  type varchar(100) NOT NULL,
  route varchar(100),
  htmltext varchar2(4000),
  PRIMARY KEY(id)
);

CREATE TABLE documents_points
(
  id int NOT NULL,
  document_id int NOT NULL,
  point_id INT,
  FOREIGN KEY(point_id) REFERENCES points(id) ON DELETE CASCADE,
  FOREIGN KEY(document_id) REFERENCES documents(id) ON DELETE CASCADE,
  PRIMARY KEY (id)
);

CREATE TABLE clients
(
  id int NOT NULL,
  username varchar(100) NOT NULL,
  name varchar(100) NOT NULL,
  lastname varchar(100) NOT NULL,
  role varchar(100) NOT NULL,
  password varchar(100) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE visitors(
  id int NOT NULL,
  role varchar(100) NOT NULL,
  description varchar(500), 
  PRIMARY KEY(id)
);

CREATE TABLE documents_visitors
(
  id int NOT NULL,
  document_id int NOT NULL,
  visitor_id int NOT NULL,
  FOREIGN KEY(document_id) REFERENCES documents(id) ON DELETE CASCADE,
  FOREIGN KEY(visitor_id) REFERENCES visitors(id) ON DELETE CASCADE,
  PRIMARY KEY (id)
);

CREATE TABLE documents_languages
(
  id int NOT NULL,
  document_id int NOT NULL,
  language_id int NOT NULL,
  FOREIGN KEY(document_id) REFERENCES documents(id) ON DELETE CASCADE,
  FOREIGN KEY(language_id) REFERENCES languages(id) ON DELETE CASCADE,
  PRIMARY KEY (id)
);

CREATE TABLE restrictions(
  id int NOT NULL,
  client_id int NOT NULL,
  station_id int NOT NULL,
  trail_id int,
  allt int NOT NULL, -- 0 o 1
  PRIMARY KEY(id),
  FOREIGN KEY(client_id) REFERENCES clients(id) ON DELETE CASCADE,
  FOREIGN KEY(station_id) REFERENCES stations(id) ON DELETE CASCADE,
  FOREIGN KEY(trail_id) REFERENCES trails(id) ON DELETE CASCADE
);

--CREATE TABLE restrictions(
--  id int NOT NULL,
--  client_id int,
--  model varchar(100),
--  recordid int,
--  creating int, -- 0|1
--  reading int, -- 0|1
--  updating int, -- 0|1
--  deleting int, -- 0|1
--  PRIMARY KEY(id),
--  FOREIGN KEY(client_id) REFERENCES clients(id) ON DELETE CASCADE
--);

-- Autoincrementos para las tablas.

CREATE SEQUENCE stations_seq;
CREATE SEQUENCE trails_seq;
CREATE SEQUENCE points_seq;
CREATE SEQUENCE documents_seq;
CREATE SEQUENCE visitors_seq;
CREATE SEQUENCE clients_seq;
CREATE SEQUENCE dots_seq;
CREATE SEQUENCE restrictions_seq;
CREATE SEQUENCE language_seq;
CREATE SEQUENCE dovi_seq;
CREATE SEQUENCE dola_seq;


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

CREATE OR REPLACE TRIGGER visitors_ai
BEFORE INSERT ON visitors
FOR EACH ROW
BEGIN
  SELECT visitors_seq.NEXTVAL
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

CREATE OR REPLACE TRIGGER restrictions_ai
BEFORE INSERT ON restrictions
FOR EACH ROW
BEGIN
  SELECT restrictions_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

/

CREATE OR REPLACE TRIGGER language_ai
BEFORE INSERT ON languages
FOR EACH ROW
BEGIN
  SELECT language_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

/

CREATE OR REPLACE TRIGGER dovi_ai
BEFORE INSERT ON documents_visitors
FOR EACH ROW
BEGIN
  SELECT dovi_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

/

CREATE OR REPLACE TRIGGER dola_ai
BEFORE INSERT ON documents_languages
FOR EACH ROW
BEGIN
  SELECT dola_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

/

commit;

-----------------------------------------------------------------------
-----------------------------------------------------------------------
-----------------------------------------------------------------------

INSERT INTO languages (code, name) VALUES ('en', 'English');
INSERT INTO languages (code, name) VALUES ('es', 'Spanish');
INSERT INTO languages (code, name) VALUES ('pt', 'Portuguese');

INSERT INTO visitors (role, description) VALUES ('Student', 'NA');
INSERT INTO visitors (role, description) VALUES ('Researcher', 'NA');
INSERT INTO visitors (role, description) VALUES ('Professor', 'NA');
INSERT INTO visitors (role, description) VALUES ('Natural', 'NA');

INSERT INTO clients (username, name, lastname, role, password) VALUES ('root_senderos', 'root_senderos', 'root_senderos', 'admin', '25d454ef4917fb457afe5f3562335d46c0bfdfc9');

COMMIT;

-----------------------------------------------------------------------
-----------------------------------------------------------------------
-----------------------------------------------------------------------
-- Eliminar todas la tablas creadas.

DROP TABLE restrictions;
DROP TABLE clients;
DROP TABLE documents_points;
DROP TABLE documents_visitors;
DROP TABLE documents_languages;
DROP TABLE visitors;
DROP TABLE languages;
DROP TABLE documents;
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
DROP SEQUENCE documents_seq;
DROP TRIGGER documents_ai;
DROP SEQUENCE visitors_seq;
DROP TRIGGER visitors_ai;
DROP SEQUENCE clients_seq;
DROP TRIGGER clients_ai;
DROP SEQUENCE dots_seq;
DROP TRIGGER dots_ai;
DROP SEQUENCE restrictions_seq;
DROP TRIGGER restrictions_ai;
DROP SEQUENCE language_seq;
DROP TRIGGER language_ai;
DROP TRIGGER dovi_ai;
DROP SEQUENCE dovi_seq;
DROP TRIGGER dola_ai;
DROP SEQUENCE dola_seq;