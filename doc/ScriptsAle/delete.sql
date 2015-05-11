-- Eliminar todas la tablas creadas.
DROP TABLE functions;
DROP TABLE clients;
DROP TABLE countries;
DROP TABLE visitors;
DROP TABLE documents_points;
DROP TABLE documents;
DROP TABLE points;
DROP TABLE trails;
DROP TABLE stations;

-- Eliminar los autoincrementos
DROP TRIGGER stations_ai;
DROP SEQUENCE stations_seq;
DROP TRIGGER trails_ai;
DROP SEQUENCE trails_seq;
DROP TRIGGER points_ai;
DROP SEQUENCE points_seq;
DROP TRIGGER documents_ai;
DROP SEQUENCE documents_seq;
DROP TRIGGER dots_ai;
DROP SEQUENCE dots_seq;
DROP TRIGGER visitors_ai;
DROP SEQUENCE visitors_seq;
DROP TRIGGER country_ai;
DROP SEQUENCE country_seq;
DROP TRIGGER clients_ai;
DROP SEQUENCE clients_seq;
DROP TRIGGER functions_ai;
DROP SEQUENCE functions_seq;

commit;

