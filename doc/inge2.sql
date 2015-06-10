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
  cordx float,
  cordy float,
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

CREATE TABLE countries
(
  id int NOT NULL,
  code varchar(2) NOT NULL,
  name varchar(100) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE clients
(
  id int NOT NULL,
  username varchar(100) NOT NULL,
  name varchar(100) NOT NULL,
  lastname varchar(100) NOT NULL,
  role varchar(100) NOT NULL,
  password varchar(100) NOT NULL,
  country_id int,
  PRIMARY KEY(id),
  FOREIGN KEY(country_id) REFERENCES countries(id) ON DELETE CASCADE
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
CREATE SEQUENCE country_seq;
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
-- Datos de países
INSERT INTO countries (code, name) VALUES ('US', 'United States');
INSERT INTO countries (code, name) VALUES ('CA', 'Canada');
INSERT INTO countries (code, name) VALUES ('AF', 'Afghanistan');
INSERT INTO countries (code, name) VALUES ('AL', 'Albania');
INSERT INTO countries (code, name) VALUES ('DZ', 'Algeria');
INSERT INTO countries (code, name) VALUES ('DS', 'American Samoa');
INSERT INTO countries (code, name) VALUES ('AD', 'Andorra');
INSERT INTO countries (code, name) VALUES ('AO', 'Angola');
INSERT INTO countries (code, name) VALUES ('AI', 'Anguilla');
INSERT INTO countries (code, name) VALUES ('AQ', 'Antarctica');
INSERT INTO countries (code, name) VALUES ('AG', 'Antigua and/or Barbuda');
INSERT INTO countries (code, name) VALUES ('AR', 'Argentina');
INSERT INTO countries (code, name) VALUES ('AM', 'Armenia');
INSERT INTO countries (code, name) VALUES ('AW', 'Aruba');
INSERT INTO countries (code, name) VALUES ('AU', 'Australia');
INSERT INTO countries (code, name) VALUES ('AT', 'Austria');
INSERT INTO countries (code, name) VALUES ('AZ', 'Azerbaijan');
INSERT INTO countries (code, name) VALUES ('BS', 'Bahamas');
INSERT INTO countries (code, name) VALUES ('BH', 'Bahrain');
INSERT INTO countries (code, name) VALUES ('BD', 'Bangladesh');
INSERT INTO countries (code, name) VALUES ('BB', 'Barbados');
INSERT INTO countries (code, name) VALUES ('BY', 'Belarus');
INSERT INTO countries (code, name) VALUES ('BE', 'Belgium');
INSERT INTO countries (code, name) VALUES ('BZ', 'Belize');
INSERT INTO countries (code, name) VALUES ('BJ', 'Benin');
INSERT INTO countries (code, name) VALUES ('BM', 'Bermuda');
INSERT INTO countries (code, name) VALUES ('BT', 'Bhutan');
INSERT INTO countries (code, name) VALUES ('BO', 'Bolivia');
INSERT INTO countries (code, name) VALUES ('BA', 'Bosnia and Herzegovina');
INSERT INTO countries (code, name) VALUES ('BW', 'Botswana');
INSERT INTO countries (code, name) VALUES ('BV', 'Bouvet Island');
INSERT INTO countries (code, name) VALUES ('BR', 'Brazil');
INSERT INTO countries (code, name) VALUES ('IO', 'British lndian Ocean Territory');
INSERT INTO countries (code, name) VALUES ('BN', 'Brunei Darussalam');
INSERT INTO countries (code, name) VALUES ('BG', 'Bulgaria');
INSERT INTO countries (code, name) VALUES ('BF', 'Burkina Faso');
INSERT INTO countries (code, name) VALUES ('BI', 'Burundi');
INSERT INTO countries (code, name) VALUES ('KH', 'Cambodia');
INSERT INTO countries (code, name) VALUES ('CM', 'Cameroon');
INSERT INTO countries (code, name) VALUES ('CV', 'Cape Verde');
INSERT INTO countries (code, name) VALUES ('KY', 'Cayman Islands');
INSERT INTO countries (code, name) VALUES ('CF', 'Central African Republic');
INSERT INTO countries (code, name) VALUES ('TD', 'Chad');
INSERT INTO countries (code, name) VALUES ('CL', 'Chile');
INSERT INTO countries (code, name) VALUES ('CN', 'China');
INSERT INTO countries (code, name) VALUES ('CX', 'Christmas Island');
INSERT INTO countries (code, name) VALUES ('CC', 'Cocos (Keeling) Islands');
INSERT INTO countries (code, name) VALUES ('CO', 'Colombia');
INSERT INTO countries (code, name) VALUES ('KM', 'Comoros');
INSERT INTO countries (code, name) VALUES ('CG', 'Congo');
INSERT INTO countries (code, name) VALUES ('CK', 'Cook Islands');
INSERT INTO countries (code, name) VALUES ('CR', 'Costa Rica');
INSERT INTO countries (code, name) VALUES ('HR', 'Croatia (Hrvatska)');
INSERT INTO countries (code, name) VALUES ('CU', 'Cuba');
INSERT INTO countries (code, name) VALUES ('CY', 'Cyprus');
INSERT INTO countries (code, name) VALUES ('CZ', 'Czech Republic');
INSERT INTO countries (code, name) VALUES ('DK', 'Denmark');
INSERT INTO countries (code, name) VALUES ('DJ', 'Djibouti');
INSERT INTO countries (code, name) VALUES ('DM', 'Dominica');
INSERT INTO countries (code, name) VALUES ('DO', 'Dominican Republic');
INSERT INTO countries (code, name) VALUES ('TP', 'East Timor');
INSERT INTO countries (code, name) VALUES ('EC', 'Ecuador');
INSERT INTO countries (code, name) VALUES ('EG', 'Egypt');
INSERT INTO countries (code, name) VALUES ('SV', 'El Salvador');
INSERT INTO countries (code, name) VALUES ('GQ', 'Equatorial Guinea');
INSERT INTO countries (code, name) VALUES ('ER', 'Eritrea');
INSERT INTO countries (code, name) VALUES ('EE', 'Estonia');
INSERT INTO countries (code, name) VALUES ('ET', 'Ethiopia');
INSERT INTO countries (code, name) VALUES ('FK', 'Falkland Islands (Malvinas)');
INSERT INTO countries (code, name) VALUES ('FO', 'Faroe Islands');
INSERT INTO countries (code, name) VALUES ('FJ', 'Fiji');
INSERT INTO countries (code, name) VALUES ('FI', 'Finland');
INSERT INTO countries (code, name) VALUES ('FR', 'France');
INSERT INTO countries (code, name) VALUES ('FX', 'France, Metropolitan');
INSERT INTO countries (code, name) VALUES ('GF', 'French Guiana');
INSERT INTO countries (code, name) VALUES ('PF', 'French Polynesia');
INSERT INTO countries (code, name) VALUES ('TF', 'French Southern Territories');
INSERT INTO countries (code, name) VALUES ('GA', 'Gabon');
INSERT INTO countries (code, name) VALUES ('GM', 'Gambia');
INSERT INTO countries (code, name) VALUES ('GE', 'Georgia');
INSERT INTO countries (code, name) VALUES ('DE', 'Germany');
INSERT INTO countries (code, name) VALUES ('GH', 'Ghana');
INSERT INTO countries (code, name) VALUES ('GI', 'Gibraltar');
INSERT INTO countries (code, name) VALUES ('GR', 'Greece');
INSERT INTO countries (code, name) VALUES ('GL', 'Greenland');
INSERT INTO countries (code, name) VALUES ('GD', 'Grenada');
INSERT INTO countries (code, name) VALUES ('GP', 'Guadeloupe');
INSERT INTO countries (code, name) VALUES ('GU', 'Guam');
INSERT INTO countries (code, name) VALUES ('GT', 'Guatemala');
INSERT INTO countries (code, name) VALUES ('GN', 'Guinea');
INSERT INTO countries (code, name) VALUES ('GW', 'Guinea-Bissau');
INSERT INTO countries (code, name) VALUES ('GY', 'Guyana');
INSERT INTO countries (code, name) VALUES ('HT', 'Haiti');
INSERT INTO countries (code, name) VALUES ('HM', 'Heard and Mc Donald Islands');
INSERT INTO countries (code, name) VALUES ('HN', 'Honduras');
INSERT INTO countries (code, name) VALUES ('HK', 'Hong Kong');
INSERT INTO countries (code, name) VALUES ('HU', 'Hungary');
INSERT INTO countries (code, name) VALUES ('IS', 'Iceland');
INSERT INTO countries (code, name) VALUES ('IN', 'India');
INSERT INTO countries (code, name) VALUES ('ID', 'Indonesia');
INSERT INTO countries (code, name) VALUES ('IR', 'Iran (Islamic Republic of)');
INSERT INTO countries (code, name) VALUES ('IQ', 'Iraq');
INSERT INTO countries (code, name) VALUES ('IE', 'Ireland');
INSERT INTO countries (code, name) VALUES ('IL', 'Israel');
INSERT INTO countries (code, name) VALUES ('IT', 'Italy');
INSERT INTO countries (code, name) VALUES ('CI', 'Ivory Coast');
INSERT INTO countries (code, name) VALUES ('JM', 'Jamaica');
INSERT INTO countries (code, name) VALUES ('JP', 'Japan');
INSERT INTO countries (code, name) VALUES ('JO', 'Jordan');
INSERT INTO countries (code, name) VALUES ('KZ', 'Kazakhstan');
INSERT INTO countries (code, name) VALUES ('KE', 'Kenya');
INSERT INTO countries (code, name) VALUES ('KI', 'Kiribati');
INSERT INTO countries (code, name) VALUES ('KP', 'Korea, Democratic People''s Republic of');
INSERT INTO countries (code, name) VALUES ('KR', 'Korea, Republic of');
INSERT INTO countries (code, name) VALUES ('XK', 'Kosovo');
INSERT INTO countries (code, name) VALUES ('KW', 'Kuwait');
INSERT INTO countries (code, name) VALUES ('KG', 'Kyrgyzstan');
INSERT INTO countries (code, name) VALUES ('LA', 'Lao People''s Democratic Republic');
INSERT INTO countries (code, name) VALUES ('LV', 'Latvia');
INSERT INTO countries (code, name) VALUES ('LB', 'Lebanon');
INSERT INTO countries (code, name) VALUES ('LS', 'Lesotho');
INSERT INTO countries (code, name) VALUES ('LR', 'Liberia');
INSERT INTO countries (code, name) VALUES ('LY', 'Libyan Arab Jamahiriya');
INSERT INTO countries (code, name) VALUES ('LI', 'Liechtenstein');
INSERT INTO countries (code, name) VALUES ('LT', 'Lithuania');
INSERT INTO countries (code, name) VALUES ('LU', 'Luxembourg');
INSERT INTO countries (code, name) VALUES ('MO', 'Macau');
INSERT INTO countries (code, name) VALUES ('MK', 'Macedonia');
INSERT INTO countries (code, name) VALUES ('MG', 'Madagascar');
INSERT INTO countries (code, name) VALUES ('MW', 'Malawi');
INSERT INTO countries (code, name) VALUES ('MY', 'Malaysia');
INSERT INTO countries (code, name) VALUES ('MV', 'Maldives');
INSERT INTO countries (code, name) VALUES ('ML', 'Mali');
INSERT INTO countries (code, name) VALUES ('MT', 'Malta');
INSERT INTO countries (code, name) VALUES ('MH', 'Marshall Islands');
INSERT INTO countries (code, name) VALUES ('MQ', 'Martinique');
INSERT INTO countries (code, name) VALUES ('MR', 'Mauritania');
INSERT INTO countries (code, name) VALUES ('MU', 'Mauritius');
INSERT INTO countries (code, name) VALUES ('TY', 'Mayotte');
INSERT INTO countries (code, name) VALUES ('MX', 'Mexico');
INSERT INTO countries (code, name) VALUES ('FM', 'Micronesia, Federated States of');
INSERT INTO countries (code, name) VALUES ('MD', 'Moldova, Republic of');
INSERT INTO countries (code, name) VALUES ('MC', 'Monaco');
INSERT INTO countries (code, name) VALUES ('MN', 'Mongolia');
INSERT INTO countries (code, name) VALUES ('ME', 'Montenegro');
INSERT INTO countries (code, name) VALUES ('MS', 'Montserrat');
INSERT INTO countries (code, name) VALUES ('MA', 'Morocco');
INSERT INTO countries (code, name) VALUES ('MZ', 'Mozambique');
INSERT INTO countries (code, name) VALUES ('MM', 'Myanmar');
INSERT INTO countries (code, name) VALUES ('NA', 'Namibia');
INSERT INTO countries (code, name) VALUES ('NR', 'Nauru');
INSERT INTO countries (code, name) VALUES ('NP', 'Nepal');
INSERT INTO countries (code, name) VALUES ('NL', 'Netherlands');
INSERT INTO countries (code, name) VALUES ('AN', 'Netherlands Antilles');
INSERT INTO countries (code, name) VALUES ('NC', 'New Caledonia');
INSERT INTO countries (code, name) VALUES ('NZ', 'New Zealand');
INSERT INTO countries (code, name) VALUES ('NI', 'Nicaragua');
INSERT INTO countries (code, name) VALUES ('NE', 'Niger');
INSERT INTO countries (code, name) VALUES ('NG', 'Nigeria');
INSERT INTO countries (code, name) VALUES ('NU', 'Niue');
INSERT INTO countries (code, name) VALUES ('NF', 'Norfork Island');
INSERT INTO countries (code, name) VALUES ('MP', 'Northern Mariana Islands');
INSERT INTO countries (code, name) VALUES ('NO', 'Norway');
INSERT INTO countries (code, name) VALUES ('OM', 'Oman');
INSERT INTO countries (code, name) VALUES ('PK', 'Pakistan');
INSERT INTO countries (code, name) VALUES ('PW', 'Palau');
INSERT INTO countries (code, name) VALUES ('PA', 'Panama');
INSERT INTO countries (code, name) VALUES ('PG', 'Papua New Guinea');
INSERT INTO countries (code, name) VALUES ('PY', 'Paraguay');
INSERT INTO countries (code, name) VALUES ('PE', 'Peru');
INSERT INTO countries (code, name) VALUES ('PH', 'Philippines');
INSERT INTO countries (code, name) VALUES ('PN', 'Pitcairn');
INSERT INTO countries (code, name) VALUES ('PL', 'Poland');
INSERT INTO countries (code, name) VALUES ('PT', 'Portugal');
INSERT INTO countries (code, name) VALUES ('PR', 'Puerto Rico');
INSERT INTO countries (code, name) VALUES ('QA', 'Qatar');
INSERT INTO countries (code, name) VALUES ('RE', 'Reunion');
INSERT INTO countries (code, name) VALUES ('RO', 'Romania');
INSERT INTO countries (code, name) VALUES ('RU', 'Russian Federation');
INSERT INTO countries (code, name) VALUES ('RW', 'Rwanda');
INSERT INTO countries (code, name) VALUES ('KN', 'Saint Kitts and Nevis');
INSERT INTO countries (code, name) VALUES ('LC', 'Saint Lucia');
INSERT INTO countries (code, name) VALUES ('VC', 'Saint Vincent and the Grenadines');
INSERT INTO countries (code, name) VALUES ('WS', 'Samoa');
INSERT INTO countries (code, name) VALUES ('SM', 'San Marino');
INSERT INTO countries (code, name) VALUES ('ST', 'Sao Tome and Principe');
INSERT INTO countries (code, name) VALUES ('SA', 'Saudi Arabia');
INSERT INTO countries (code, name) VALUES ('SN', 'Senegal');
INSERT INTO countries (code, name) VALUES ('RS', 'Serbia');
INSERT INTO countries (code, name) VALUES ('SC', 'Seychelles');
INSERT INTO countries (code, name) VALUES ('SL', 'Sierra Leone');
INSERT INTO countries (code, name) VALUES ('SG', 'Singapore');
INSERT INTO countries (code, name) VALUES ('SK', 'Slovakia');
INSERT INTO countries (code, name) VALUES ('SI', 'Slovenia');
INSERT INTO countries (code, name) VALUES ('SB', 'Solomon Islands');
INSERT INTO countries (code, name) VALUES ('SO', 'Somalia');
INSERT INTO countries (code, name) VALUES ('ZA', 'South Africa');
INSERT INTO countries (code, name) VALUES ('GS', 'South Georgia South Sandwich Islands');
INSERT INTO countries (code, name) VALUES ('ES', 'Spain');
INSERT INTO countries (code, name) VALUES ('LK', 'Sri Lanka');
INSERT INTO countries (code, name) VALUES ('SH', 'St. Helena');
INSERT INTO countries (code, name) VALUES ('PM', 'St. Pierre and Miquelon');
INSERT INTO countries (code, name) VALUES ('SD', 'Sudan');
INSERT INTO countries (code, name) VALUES ('SR', 'Suriname');
INSERT INTO countries (code, name) VALUES ('SJ', 'Svalbarn and Jan Mayen Islands');
INSERT INTO countries (code, name) VALUES ('SZ', 'Swaziland');
INSERT INTO countries (code, name) VALUES ('SE', 'Sweden');
INSERT INTO countries (code, name) VALUES ('CH', 'Switzerland');
INSERT INTO countries (code, name) VALUES ('SY', 'Syrian Arab Republic');
INSERT INTO countries (code, name) VALUES ('TW', 'Taiwan');
INSERT INTO countries (code, name) VALUES ('TJ', 'Tajikistan');
INSERT INTO countries (code, name) VALUES ('TZ', 'Tanzania, United Republic of');
INSERT INTO countries (code, name) VALUES ('TH', 'Thailand');
INSERT INTO countries (code, name) VALUES ('TG', 'Togo');
INSERT INTO countries (code, name) VALUES ('TK', 'Tokelau');
INSERT INTO countries (code, name) VALUES ('TO', 'Tonga');
INSERT INTO countries (code, name) VALUES ('TT', 'Trinidad and Tobago');
INSERT INTO countries (code, name) VALUES ('TN', 'Tunisia');
INSERT INTO countries (code, name) VALUES ('TR', 'Turkey');
INSERT INTO countries (code, name) VALUES ('TM', 'Turkmenistan');
INSERT INTO countries (code, name) VALUES ('TC', 'Turks and Caicos Islands');
INSERT INTO countries (code, name) VALUES ('TV', 'Tuvalu');
INSERT INTO countries (code, name) VALUES ('UG', 'Uganda');
INSERT INTO countries (code, name) VALUES ('UA', 'Ukraine');
INSERT INTO countries (code, name) VALUES ('AE', 'United Arab Emirates');
INSERT INTO countries (code, name) VALUES ('GB', 'United Kingdom');
INSERT INTO countries (code, name) VALUES ('UM', 'United States minor outlying islands');
INSERT INTO countries (code, name) VALUES ('UY', 'Uruguay');
INSERT INTO countries (code, name) VALUES ('UZ', 'Uzbekistan');
INSERT INTO countries (code, name) VALUES ('VU', 'Vanuatu');
INSERT INTO countries (code, name) VALUES ('VA', 'Vatican City State');
INSERT INTO countries (code, name) VALUES ('VE', 'Venezuela');
INSERT INTO countries (code, name) VALUES ('VN', 'Vietnam');
INSERT INTO countries (code, name) VALUES ('VG', 'Virgin Islands (British)');
INSERT INTO countries (code, name) VALUES ('VI', 'Virgin Islands (U.S.)');
INSERT INTO countries (code, name) VALUES ('WF', 'Wallis and Futuna Islands');
INSERT INTO countries (code, name) VALUES ('EH', 'Western Sahara');
INSERT INTO countries (code, name) VALUES ('YE', 'Yemen');
INSERT INTO countries (code, name) VALUES ('YU', 'Yugoslavia');
INSERT INTO countries (code, name) VALUES ('ZR', 'Zaire');
INSERT INTO countries (code, name) VALUES ('ZM', 'Zambia');
INSERT INTO countries (code, name) VALUES ('ZW', 'Zimbabwe');

INSERT INTO languages (code, name) VALUES ('en', 'English');
INSERT INTO languages (code, name) VALUES ('es', 'Spanish');
INSERT INTO languages (code, name) VALUES ('pt', 'Portuguese');

INSERT INTO visitors (role, description) VALUES ('Student', 'NA');
INSERT INTO visitors (role, description) VALUES ('Researcher', 'NA');
INSERT INTO visitors (role, description) VALUES ('Professor', 'NA');
INSERT INTO visitors (role, description) VALUES ('Natural', 'NA');

INSERT INTO clients (username, name, lastname, role, password, country_id) VALUES ('root_senderos', 'root_senderos', 'root_senderos', 'admin', '25d454ef4917fb457afe5f3562335d46c0bfdfc9', 52);

COMMIT;

-----------------------------------------------------------------------
-----------------------------------------------------------------------
-----------------------------------------------------------------------
-- Eliminar todas la tablas creadas.

DROP TABLE countries;
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
DROP SEQUENCE country_seq;
DROP TRIGGER country_ai;
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