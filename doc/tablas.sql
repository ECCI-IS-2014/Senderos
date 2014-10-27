
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
	parent_id INT UNSIGNED DEFAULT NULL, -- hace referencia al padre de la subcategoría, puede no tener padre
	lft INT UNSIGNED DEFAULT NULL, -- Almacena al hermano izquierdo de la categoría
	rght INT UNSIGNED DEFAULT NULL -- Almacena al hermano derecho de la categoría
);

CREATE TABLE category_products(
	product_id INT UNSIGNED NOT NULL,
	category_id INT UNSIGNED NOT NULL
);

CREATE TABLE stocks(
	-- id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	product_id INT UNSIGNED NOT NULL, 
	amount INT UNSIGNED NOT NULL
);

CREATE TABLE wishlists(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user_id INT UNSIGNED NOT NULL
);

-- TABLA DE LA RELACIÓN HASANDBELONGSTOMANY ENTRE WISHLIST Y PRODUCTO 
CREATE TABLE product_wishlists(
	-- id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	wishlist_id INT UNSIGNED NOT NULL,
	product_id INT UNSIGNED NOT NULL
);

CREATE TABLE users(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
	name VARCHAR(100) NOT NULL,
	lastname VARCHAR(100) NOT NULL,
	country VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL,
	role TEXT NOT NULL
);