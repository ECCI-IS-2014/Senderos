insert into stations (name,location,description) values('Estacion 1','Location 1','Descripcion estacion 1');

CREATE OR REPLACE TRIGGER stations_ai
BEFORE INSERT ON stations 
FOR EACH ROW
BEGIN
  SELECT stations_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

insert into trails (name, description, image, station_id) values('Nativas','Descripcion Nativas','/img/Nativas.jpg',1);

CREATE OR REPLACE TRIGGER trails_ai
BEFORE INSERT ON trails
FOR EACH ROW
BEGIN
  SELECT trails_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;

insert into points(name,cordx,cordy,description, trail_id) values ('punto 1',88888,99999,'Descripcion punto 1', 1);
insert into points(name,cordx,cordy,description, trail_id) values ('punto 2',88888,99999,'Descripcion punto 2', 1);
insert into points(name,cordx,cordy,description, trail_id) values ('punto 3',88888,99999,'Descripcion punto 3', 1);
insert into points(name,cordx,cordy,description, trail_id) values ('punto 4',88888,99999,'Descripcion punto 4', 1);
insert into points(name,cordx,cordy,description, trail_id) values ('punto 5',88888,99999,'Descripcion punto 5', 1);
insert into points(name,cordx,cordy,description, trail_id) values ('punto 6',88888,99999,'Descripcion punto 6', 1);
insert into points(name,cordx,cordy,description, trail_id) values ('punto 7',88888,99999,'Descripcion punto 7', 1);
insert into points(name,cordx,cordy,description, trail_id) values ('punto 8',88888,99999,'Descripcion punto 8', 1);
insert into points(name,cordx,cordy,description, trail_id) values ('punto 9',88888,99999,'Descripcion punto 9', 1);
insert into points(name,cordx,cordy,description, trail_id) values ('punto 10',88888,99999,'Descripcion punto 10', 1);
insert into points(name,cordx,cordy,description, trail_id) values ('punto 11',88888,99999,'Descripcion punto 11', 1);
insert into points(name,cordx,cordy,description, trail_id) values ('punto 12',88888,99999,'Descripcion punto 12', 1);
insert into points(name,cordx,cordy,description, trail_id) values ('punto 13',88888,99999,'Descripcion punto 13', 1);

CREATE OR REPLACE TRIGGER points_ai
BEFORE INSERT ON points
FOR EACH ROW
BEGIN
  SELECT points_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;