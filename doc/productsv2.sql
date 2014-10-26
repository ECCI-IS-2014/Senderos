<<<<<<< HEAD
-- TODO LO REFERENTE A LOS PRODUCTOS LO TRABAJO POR ACÁ
-- http://book.cakephp.org/2.0/en/models/associations-linking-models-together.html
-- http://book.cakephp.org/2.0/es/getting-started/cakephp-conventions.html#convenciones-para-modelos-y-bases-de-datos

-- rating del juego, esto va a ser una asociación entre la tabla de clientes que le dan puntajes al videojuego y el producto 
-- categoría es una entrada nueva en la tabla categories_products, no sé si deba ser una opción a la hora de agregar el producto

--PRODUCTOS Y PLATAFORMAS
-- Product belongsTo Platform
-- Platform hasMany Product

--PRODUCTOS Y CATEGORÍAS
-- Product hasAndBelongsToMany Category
-- Category hasAndBelongsToMany Product
-- porque en la tabla, los ids no son exclusivos

--CATEGORÍAS Y CATEGORÍAS
-- Category belongsTo Category
-- Category hasMany Category


--PRODUCTOS Y OFERTAS
-- Product hasAndBelongsToMany Bargain
-- Bargain hasAndBelongsToMany Product
-- porque en la tabla, los ids no son exclusivos


CREATE TABLE products(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL, -- no hay restricciones, pueden repetirse nombres 
    -- genre VARCHAR(100) NOT NULL, -- no hay restricciones
	platform_id INT UNSIGNED NOT NULL, -- solo se vale una plataforma por producto
	release_year YEAR(4) NOT NULL, -- debe ser entre 1990-actualidad
	price DOUBLE UNSIGNED NOT NULL, -- debe ser en dólares
	description TEXT NOT NULL, -- no hay restricciones
	-- amount INT UNSIGNED NOT NULL, -- cantidad actual del producto, en unidades
	presentation VARCHAR(100) NOT NULL, -- se refiere a si es digital o física
	requirement TEXT, -- no hay restricciones, requerimientos específicos del videojuego
	rated TEXT, -- se refiere al público del juego, no hay restricciones 
	rating DOUBLE UNSIGNED, -- se va a calcular un promedio del puntaje asignado por los ususarios cliente
	image TEXT, -- nombre.extensión
	video TEXT -- link válido de un vídeo
);

CREATE TABLE platforms(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL -- nombre de la plataforma
);

-- las categorías son los géneros 
CREATE TABLE categories(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	parent_id INT UNSIGNED -- hace referencia al padre de la subcategoría, puede no tener padre
);

CREATE TABLE categories_products(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	product_id INT UNSIGNED NOT NULL,
	category_id INT UNSIGNED NOT NULL
);

CREATE TABLE stocks(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	product_id INT UNSIGNED NOT NULL, 
	amount INT UNSIGNED NOT NULL
);

-- ESTO LO ESTOY HACIENDO NUEVO 
CREATE TABLE stocks(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	product_id INT UNSIGNED NOT NULL, 
	amount INT UNSIGNED NOT NULL
);

-- 
CREATE TABLE wishlists(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user_id INT UNSIGNED NOT NULL
);

CREATE TABLE product_wishlists(
	-- id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	wishlist_id INT UNSIGNED NOT NULL,
	product_id INT UNSIGNED NOT NULL
);


-- TABLA DE PROMOCIONES, UNO O UN CONJUNTO DE PRODUCTOS QUE SI SE LLEVAN JUNTOS SE APLICA % DESCUENTO
CREATE TABLE bargains(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	start_date DATE NOT NULL,
	end_date DATE NOT NULL,
	discount INT UNSIGNED NOT NULL
);

-- TABLA RELACIÓN HASANDBELONGSTOMANY ENTRE BARGAINS Y PRODUCTS
CREATE TABLE bargains_products(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	bargain_id INT UNSIGNED NOT NULL,
	product_id INT UNSIGNED NOT NULL
);
-- HASTA AQUÍ LO ESTOY HACIENDO NUEVO 
--CREATE TABLE platforms_products(
	--id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	--product_id INT UNSIGNED NOT NULL,
	--platform_id INT UNSIGNED NOT NULL
--);
--CREATE TABLE consoles(
	--id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	--name VARCHAR(100) NOT NULL, -- nombre de la consola
	--brand VARCHAR(100) NOT NULL, -- marca de la consola
	--model VARCHAR(100) NOT NULL, -- marca de la consola
	--cpu VARCHAR(100) NOT NULL, -- CPU de la consola
	--ram DOUBLE UNSIGNED NOT NULL, -- marca de la consola
	--hdd INT UNSIGNED NOT NULL, -- memoria en MB
	--cpu VARCHAR(100) NOT NULL, -- 
	--resolution VARCHAR(100) NOT NULL, -- resolution en pixels
--);

-- FIN DE LO REFERENTE A PRODUCTOS
--
--
-- 
-- TODO LO REFERENTE A LOS USUARIOS, POR ACÁ

CREATE TABLE users(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
	name VARCHAR(100) NOT NULL,
	lastname VARCHAR(100) NOT NULL,
	country VARCHAR(100) NOT NULL,
	role TEXT NOT NULL
=======
-- TODO LO REFERENTE A LOS PRODUCTOS LO TRABAJO POR ACÁ
-- http://book.cakephp.org/2.0/en/models/associations-linking-models-together.html
-- http://book.cakephp.org/2.0/es/getting-started/cakephp-conventions.html#convenciones-para-modelos-y-bases-de-datos

-- rating del juego, esto va a ser una asociación entre la tabla de clientes que le dan puntajes al videojuego y el producto 
-- categoría es una entrada nueva en la tabla categories_products, no sé si deba ser una opción a la hora de agregar el producto

--PRODUCTOS Y PLATAFORMAS
-- Product belongsTo Platform
-- Platform hasMany Product

--PRODUCTOS Y CATEGORÍAS
-- Product hasAndBelongsToMany Category
-- Category hasAndBelongsToMany Product
-- porque en la tabla, los ids no son exclusivos

--CATEGORÍAS Y CATEGORÍAS
-- Category belongsTo Category
-- Category hasMany Category


--PRODUCTOS Y OFERTAS
-- Product hasAndBelongsToMany Bargain
-- Bargain hasAndBelongsToMany Product
-- porque en la tabla, los ids no son exclusivos

CREATE TABLE products(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL, -- no hay restricciones, pueden repetirse nombres 
    genre VARCHAR(100) NOT NULL, -- no hay restricciones
	platform_id INT UNSIGNED NOT NULL, -- solo se vale una plataforma por producto
	release_year YEAR(4) NOT NULL, -- debe ser entre 1990-actualidad
	price DOUBLE UNSIGNED NOT NULL, -- debe ser en dólares
	description TEXT NOT NULL, -- no hay restricciones
	amount INT UNSIGNED NOT NULL, -- cantidad actual del producto, en unidades
	presentation VARCHAR(100) NOT NULL, -- se refiere a si es digital o física
	requirement TEXT, -- no hay restricciones, requerimientos específicos del videojuego
	rated TEXT, -- se refiere al público del jeugo, no hay restricciones 
	rating DOUBLE UNSIGNED, -- se va a calcular un promedio del puntaje asignado por los ususarios cliente
	image TEXT, -- nombre.extensión
	video TEXT -- link válido de un vídeo
);

CREATE TABLE platforms(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL -- nombre de la plataforma
);

CREATE TABLE categories(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	id_category INT UNSIGNED -- hace referencia al padre de la subcategoría, puede no tener padre
);

CREATE TABLE categories_products(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	product_id INT UNSIGNED NOT NULL,
	category_id INT UNSIGNED NOT NULL
);

-- TABLA DE PROMOCIONES, UNO O UN CONJUNTO DE PRODUCTOS QUE SI SE LLEVAN JUNTOS SE APLICA % DESCUENTO
CREATE TABLE bargains(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	start_date DATE NOT NULL,
	end_date DATE NOT NULL,
	discount INT UNSIGNED NOT NULL
);

-- TABLA RELACIÓN HASANDBELONGSTOMANY ENTRE BARGAINS Y PRODUCTS
CREATE TABLE bargains_products(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	bargain_id INT UNSIGNED NOT NULL,
	product_id INT UNSIGNED NOT NULL
);

--CREATE TABLE platforms_products(
	--id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	--product_id INT UNSIGNED NOT NULL,
	--platform_id INT UNSIGNED NOT NULL
--);
--CREATE TABLE consoles(
	--id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	--name VARCHAR(100) NOT NULL, -- nombre de la consola
	--brand VARCHAR(100) NOT NULL, -- marca de la consola
	--model VARCHAR(100) NOT NULL, -- marca de la consola
	--cpu VARCHAR(100) NOT NULL, -- CPU de la consola
	--ram DOUBLE UNSIGNED NOT NULL, -- marca de la consola
	--hdd INT UNSIGNED NOT NULL, -- memoria en MB
	--cpu VARCHAR(100) NOT NULL, -- 
	--resolution VARCHAR(100) NOT NULL, -- resolution en pixels
--);

-- FIN DE LO REFERENTE A PRODUCTOS
--
--
-- 
-- TODO LO REFERENTE A LOS USUARIOS, POR ACÁ

CREATE TABLE users(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
	name VARCHAR(100) NOT NULL,
	lastname VARCHAR(100) NOT NULL,
	country VARCHAR(100) NOT NULL,
	role TEXT NOT NULL
>>>>>>> 3c8099ef26d5d5b48b7229f8e1d1c61676c7fe55
);