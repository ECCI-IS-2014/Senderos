CREATE TABLE products(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL, -- no hay restricciones, pueden repetirse nombres 
    -- genre VARCHAR(100) NOT NULL, -- no hay restricciones
	platform_id INT UNSIGNED NOT NULL, -- solo se vale una plataforma por producto
	release_year YEAR(4) NOT NULL, -- debe ser entre 1990-actualidad
	price DOUBLE UNSIGNED NOT NULL, -- debe ser en d�lares
	description TEXT NOT NULL, -- no hay restricciones
	-- amount INT UNSIGNED NOT NULL, -- cantidad actual del producto, en unidades
	presentation VARCHAR(100) NOT NULL, -- se refiere a si es digital o f�sica
	requirement TEXT, -- no hay restricciones, requerimientos espec�ficos del videojuego
	rated TEXT, -- se refiere al p�blico del juego, no hay restricciones 
	rating DOUBLE UNSIGNED, -- se va a calcular un promedio del puntaje asignado por los ususarios cliente
	image TEXT, -- nombre.extensi�n
	video TEXT -- link v�lido de un v�deo
);

CREATE TABLE platforms(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL -- nombre de la plataforma
);

-- las categor�as son los g�neros 
CREATE TABLE categories(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	parent_id INT UNSIGNED DEFAULT NULL,	-- hace referencia al padre de la subcategor�a, puede no tener padre
	lft INT UNSIGNED DEFAULT NULL,
    rght INT UNSIGNED DEFAULT NULL
);

CREATE TABLE category_products(
	product_id INT UNSIGNED NOT NULL,
	category_id INT UNSIGNED NOT NULL
);

CREATE TABLE stocks(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	product_id INT UNSIGNED NOT NULL, 
	amount INT UNSIGNED NOT NULL
);

CREATE TABLE wishlists(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user_id INT UNSIGNED NOT NULL
);

-- TABLA DE LA RELACI�N HASANDBELONGSTOMANY ENTRE WISHLIST Y PRODUCTO 
CREATE TABLE product_wishlists(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
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

-- Este SCRIPT no fue creado por ninguno de nuestros miembros,
-- dado lo mec�nico y tedioso de digitar toda esta informaci�n
-- decidimos tomar lo que ya estaba hecho de un foro.

CREATE TABLE `countries` 
(
`id` int(11) NOT NULL auto_increment,
`country_code` varchar(2) NOT NULL default '',
`country_name` varchar(100) NOT NULL default '',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=240 ;
-- 
-- Dumping data for table `countries`
-- 
INSERT INTO `countries` VALUES (1, 'US', 'United States');
INSERT INTO `countries` VALUES (2, 'CA', 'Canada');
INSERT INTO `countries` VALUES (3, 'AF', 'Afghanistan');
INSERT INTO `countries` VALUES (4, 'AL', 'Albania');
INSERT INTO `countries` VALUES (5, 'DZ', 'Algeria');
INSERT INTO `countries` VALUES (6, 'DS', 'American Samoa');
INSERT INTO `countries` VALUES (7, 'AD', 'Andorra');
INSERT INTO `countries` VALUES (8, 'AO', 'Angola');
INSERT INTO `countries` VALUES (9, 'AI', 'Anguilla');
INSERT INTO `countries` VALUES (10, 'AQ', 'Antarctica');
INSERT INTO `countries` VALUES (11, 'AG', 'Antigua and/or Barbuda');
INSERT INTO `countries` VALUES (12, 'AR', 'Argentina');
INSERT INTO `countries` VALUES (13, 'AM', 'Armenia');
INSERT INTO `countries` VALUES (14, 'AW', 'Aruba');
INSERT INTO `countries` VALUES (15, 'AU', 'Australia');
INSERT INTO `countries` VALUES (16, 'AT', 'Austria');
INSERT INTO `countries` VALUES (17, 'AZ', 'Azerbaijan');
INSERT INTO `countries` VALUES (18, 'BS', 'Bahamas');
INSERT INTO `countries` VALUES (19, 'BH', 'Bahrain');
INSERT INTO `countries` VALUES (20, 'BD', 'Bangladesh');
INSERT INTO `countries` VALUES (21, 'BB', 'Barbados');
INSERT INTO `countries` VALUES (22, 'BY', 'Belarus');
INSERT INTO `countries` VALUES (23, 'BE', 'Belgium');
INSERT INTO `countries` VALUES (24, 'BZ', 'Belize');
INSERT INTO `countries` VALUES (25, 'BJ', 'Benin');
INSERT INTO `countries` VALUES (26, 'BM', 'Bermuda');
INSERT INTO `countries` VALUES (27, 'BT', 'Bhutan');
INSERT INTO `countries` VALUES (28, 'BO', 'Bolivia');
INSERT INTO `countries` VALUES (29, 'BA', 'Bosnia and Herzegovina');
INSERT INTO `countries` VALUES (30, 'BW', 'Botswana');
INSERT INTO `countries` VALUES (31, 'BV', 'Bouvet Island');
INSERT INTO `countries` VALUES (32, 'BR', 'Brazil');
INSERT INTO `countries` VALUES (33, 'IO', 'British lndian Ocean Territory');
INSERT INTO `countries` VALUES (34, 'BN', 'Brunei Darussalam');
INSERT INTO `countries` VALUES (35, 'BG', 'Bulgaria');
INSERT INTO `countries` VALUES (36, 'BF', 'Burkina Faso');
INSERT INTO `countries` VALUES (37, 'BI', 'Burundi');
INSERT INTO `countries` VALUES (38, 'KH', 'Cambodia');
INSERT INTO `countries` VALUES (39, 'CM', 'Cameroon');
INSERT INTO `countries` VALUES (40, 'CV', 'Cape Verde');
INSERT INTO `countries` VALUES (41, 'KY', 'Cayman Islands');
INSERT INTO `countries` VALUES (42, 'CF', 'Central African Republic');
INSERT INTO `countries` VALUES (43, 'TD', 'Chad');
INSERT INTO `countries` VALUES (44, 'CL', 'Chile');
INSERT INTO `countries` VALUES (45, 'CN', 'China');
INSERT INTO `countries` VALUES (46, 'CX', 'Christmas Island');
INSERT INTO `countries` VALUES (47, 'CC', 'Cocos (Keeling) Islands');
INSERT INTO `countries` VALUES (48, 'CO', 'Colombia');
INSERT INTO `countries` VALUES (49, 'KM', 'Comoros');
INSERT INTO `countries` VALUES (50, 'CG', 'Congo');
INSERT INTO `countries` VALUES (51, 'CK', 'Cook Islands');
INSERT INTO `countries` VALUES (52, 'CR', 'Costa Rica');
INSERT INTO `countries` VALUES (53, 'HR', 'Croatia (Hrvatska)');
INSERT INTO `countries` VALUES (54, 'CU', 'Cuba');
INSERT INTO `countries` VALUES (55, 'CY', 'Cyprus');
INSERT INTO `countries` VALUES (56, 'CZ', 'Czech Republic');
INSERT INTO `countries` VALUES (57, 'DK', 'Denmark');
INSERT INTO `countries` VALUES (58, 'DJ', 'Djibouti');
INSERT INTO `countries` VALUES (59, 'DM', 'Dominica');
INSERT INTO `countries` VALUES (60, 'DO', 'Dominican Republic');
INSERT INTO `countries` VALUES (61, 'TP', 'East Timor');
INSERT INTO `countries` VALUES (62, 'EC', 'Ecuador');
INSERT INTO `countries` VALUES (63, 'EG', 'Egypt');
INSERT INTO `countries` VALUES (64, 'SV', 'El Salvador');
INSERT INTO `countries` VALUES (65, 'GQ', 'Equatorial Guinea');
INSERT INTO `countries` VALUES (66, 'ER', 'Eritrea');
INSERT INTO `countries` VALUES (67, 'EE', 'Estonia');
INSERT INTO `countries` VALUES (68, 'ET', 'Ethiopia');
INSERT INTO `countries` VALUES (69, 'FK', 'Falkland Islands (Malvinas)');
INSERT INTO `countries` VALUES (70, 'FO', 'Faroe Islands');
INSERT INTO `countries` VALUES (71, 'FJ', 'Fiji');
INSERT INTO `countries` VALUES (72, 'FI', 'Finland');
INSERT INTO `countries` VALUES (73, 'FR', 'France');
INSERT INTO `countries` VALUES (74, 'FX', 'France, Metropolitan');
INSERT INTO `countries` VALUES (75, 'GF', 'French Guiana');
INSERT INTO `countries` VALUES (76, 'PF', 'French Polynesia');
INSERT INTO `countries` VALUES (77, 'TF', 'French Southern Territories');
INSERT INTO `countries` VALUES (78, 'GA', 'Gabon');
INSERT INTO `countries` VALUES (79, 'GM', 'Gambia');
INSERT INTO `countries` VALUES (80, 'GE', 'Georgia');
INSERT INTO `countries` VALUES (81, 'DE', 'Germany');
INSERT INTO `countries` VALUES (82, 'GH', 'Ghana');
INSERT INTO `countries` VALUES (83, 'GI', 'Gibraltar');
INSERT INTO `countries` VALUES (84, 'GR', 'Greece');
INSERT INTO `countries` VALUES (85, 'GL', 'Greenland');
INSERT INTO `countries` VALUES (86, 'GD', 'Grenada');
INSERT INTO `countries` VALUES (87, 'GP', 'Guadeloupe');
INSERT INTO `countries` VALUES (88, 'GU', 'Guam');
INSERT INTO `countries` VALUES (89, 'GT', 'Guatemala');
INSERT INTO `countries` VALUES (90, 'GN', 'Guinea');
INSERT INTO `countries` VALUES (91, 'GW', 'Guinea-Bissau');
INSERT INTO `countries` VALUES (92, 'GY', 'Guyana');
INSERT INTO `countries` VALUES (93, 'HT', 'Haiti');
INSERT INTO `countries` VALUES (94, 'HM', 'Heard and Mc Donald Islands');
INSERT INTO `countries` VALUES (95, 'HN', 'Honduras');
INSERT INTO `countries` VALUES (96, 'HK', 'Hong Kong');
INSERT INTO `countries` VALUES (97, 'HU', 'Hungary');
INSERT INTO `countries` VALUES (98, 'IS', 'Iceland');
INSERT INTO `countries` VALUES (99, 'IN', 'India');
INSERT INTO `countries` VALUES (100, 'ID', 'Indonesia');
INSERT INTO `countries` VALUES (101, 'IR', 'Iran (Islamic Republic of)');
INSERT INTO `countries` VALUES (102, 'IQ', 'Iraq');
INSERT INTO `countries` VALUES (103, 'IE', 'Ireland');
INSERT INTO `countries` VALUES (104, 'IL', 'Israel');
INSERT INTO `countries` VALUES (105, 'IT', 'Italy');
INSERT INTO `countries` VALUES (106, 'CI', 'Ivory Coast');
INSERT INTO `countries` VALUES (107, 'JM', 'Jamaica');
INSERT INTO `countries` VALUES (108, 'JP', 'Japan');
INSERT INTO `countries` VALUES (109, 'JO', 'Jordan');
INSERT INTO `countries` VALUES (110, 'KZ', 'Kazakhstan');
INSERT INTO `countries` VALUES (111, 'KE', 'Kenya');
INSERT INTO `countries` VALUES (112, 'KI', 'Kiribati');
INSERT INTO `countries` VALUES (113, 'KP', 'Korea, Democratic People''s Republic of');
INSERT INTO `countries` VALUES (114, 'KR', 'Korea, Republic of');
INSERT INTO `countries` VALUES (115, 'XK', 'Kosovo');
INSERT INTO `countries` VALUES (116, 'KW', 'Kuwait');
INSERT INTO `countries` VALUES (117, 'KG', 'Kyrgyzstan');
INSERT INTO `countries` VALUES (118, 'LA', 'Lao People''s Democratic Republic');
INSERT INTO `countries` VALUES (119, 'LV', 'Latvia');
INSERT INTO `countries` VALUES (120, 'LB', 'Lebanon');
INSERT INTO `countries` VALUES (121, 'LS', 'Lesotho');
INSERT INTO `countries` VALUES (122, 'LR', 'Liberia');
INSERT INTO `countries` VALUES (123, 'LY', 'Libyan Arab Jamahiriya');
INSERT INTO `countries` VALUES (124, 'LI', 'Liechtenstein');
INSERT INTO `countries` VALUES (125, 'LT', 'Lithuania');
INSERT INTO `countries` VALUES (126, 'LU', 'Luxembourg');
INSERT INTO `countries` VALUES (127, 'MO', 'Macau');
INSERT INTO `countries` VALUES (128, 'MK', 'Macedonia');
INSERT INTO `countries` VALUES (129, 'MG', 'Madagascar');
INSERT INTO `countries` VALUES (130, 'MW', 'Malawi');
INSERT INTO `countries` VALUES (131, 'MY', 'Malaysia');
INSERT INTO `countries` VALUES (132, 'MV', 'Maldives');
INSERT INTO `countries` VALUES (133, 'ML', 'Mali');
INSERT INTO `countries` VALUES (134, 'MT', 'Malta');
INSERT INTO `countries` VALUES (135, 'MH', 'Marshall Islands');
INSERT INTO `countries` VALUES (136, 'MQ', 'Martinique');
INSERT INTO `countries` VALUES (137, 'MR', 'Mauritania');
INSERT INTO `countries` VALUES (138, 'MU', 'Mauritius');
INSERT INTO `countries` VALUES (139, 'TY', 'Mayotte');
INSERT INTO `countries` VALUES (140, 'MX', 'Mexico');
INSERT INTO `countries` VALUES (141, 'FM', 'Micronesia, Federated States of');
INSERT INTO `countries` VALUES (142, 'MD', 'Moldova, Republic of');
INSERT INTO `countries` VALUES (143, 'MC', 'Monaco');
INSERT INTO `countries` VALUES (144, 'MN', 'Mongolia');
INSERT INTO `countries` VALUES (145, 'ME', 'Montenegro');
INSERT INTO `countries` VALUES (146, 'MS', 'Montserrat');
INSERT INTO `countries` VALUES (147, 'MA', 'Morocco');
INSERT INTO `countries` VALUES (148, 'MZ', 'Mozambique');
INSERT INTO `countries` VALUES (149, 'MM', 'Myanmar');
INSERT INTO `countries` VALUES (150, 'NA', 'Namibia');
INSERT INTO `countries` VALUES (151, 'NR', 'Nauru');
INSERT INTO `countries` VALUES (152, 'NP', 'Nepal');
INSERT INTO `countries` VALUES (153, 'NL', 'Netherlands');
INSERT INTO `countries` VALUES (154, 'AN', 'Netherlands Antilles');
INSERT INTO `countries` VALUES (155, 'NC', 'New Caledonia');
INSERT INTO `countries` VALUES (156, 'NZ', 'New Zealand');
INSERT INTO `countries` VALUES (157, 'NI', 'Nicaragua');
INSERT INTO `countries` VALUES (158, 'NE', 'Niger');
INSERT INTO `countries` VALUES (159, 'NG', 'Nigeria');
INSERT INTO `countries` VALUES (160, 'NU', 'Niue');
INSERT INTO `countries` VALUES (161, 'NF', 'Norfork Island');
INSERT INTO `countries` VALUES (162, 'MP', 'Northern Mariana Islands');
INSERT INTO `countries` VALUES (163, 'NO', 'Norway');
INSERT INTO `countries` VALUES (164, 'OM', 'Oman');
INSERT INTO `countries` VALUES (165, 'PK', 'Pakistan');
INSERT INTO `countries` VALUES (166, 'PW', 'Palau');
INSERT INTO `countries` VALUES (167, 'PA', 'Panama');
INSERT INTO `countries` VALUES (168, 'PG', 'Papua New Guinea');
INSERT INTO `countries` VALUES (169, 'PY', 'Paraguay');
INSERT INTO `countries` VALUES (170, 'PE', 'Peru');
INSERT INTO `countries` VALUES (171, 'PH', 'Philippines');
INSERT INTO `countries` VALUES (172, 'PN', 'Pitcairn');
INSERT INTO `countries` VALUES (173, 'PL', 'Poland');
INSERT INTO `countries` VALUES (174, 'PT', 'Portugal');
INSERT INTO `countries` VALUES (175, 'PR', 'Puerto Rico');
INSERT INTO `countries` VALUES (176, 'QA', 'Qatar');
INSERT INTO `countries` VALUES (177, 'RE', 'Reunion');
INSERT INTO `countries` VALUES (178, 'RO', 'Romania');
INSERT INTO `countries` VALUES (179, 'RU', 'Russian Federation');
INSERT INTO `countries` VALUES (180, 'RW', 'Rwanda');
INSERT INTO `countries` VALUES (181, 'KN', 'Saint Kitts and Nevis');
INSERT INTO `countries` VALUES (182, 'LC', 'Saint Lucia');
INSERT INTO `countries` VALUES (183, 'VC', 'Saint Vincent and the Grenadines');
INSERT INTO `countries` VALUES (184, 'WS', 'Samoa');
INSERT INTO `countries` VALUES (185, 'SM', 'San Marino');
INSERT INTO `countries` VALUES (186, 'ST', 'Sao Tome and Principe');
INSERT INTO `countries` VALUES (187, 'SA', 'Saudi Arabia');
INSERT INTO `countries` VALUES (188, 'SN', 'Senegal');
INSERT INTO `countries` VALUES (189, 'RS', 'Serbia');
INSERT INTO `countries` VALUES (190, 'SC', 'Seychelles');
INSERT INTO `countries` VALUES (191, 'SL', 'Sierra Leone');
INSERT INTO `countries` VALUES (192, 'SG', 'Singapore');
INSERT INTO `countries` VALUES (193, 'SK', 'Slovakia');
INSERT INTO `countries` VALUES (194, 'SI', 'Slovenia');
INSERT INTO `countries` VALUES (195, 'SB', 'Solomon Islands');
INSERT INTO `countries` VALUES (196, 'SO', 'Somalia');
INSERT INTO `countries` VALUES (197, 'ZA', 'South Africa');
INSERT INTO `countries` VALUES (198, 'GS', 'South Georgia South Sandwich Islands');
INSERT INTO `countries` VALUES (199, 'ES', 'Spain');
INSERT INTO `countries` VALUES (200, 'LK', 'Sri Lanka');
INSERT INTO `countries` VALUES (201, 'SH', 'St. Helena');
INSERT INTO `countries` VALUES (202, 'PM', 'St. Pierre and Miquelon');
INSERT INTO `countries` VALUES (203, 'SD', 'Sudan');
INSERT INTO `countries` VALUES (204, 'SR', 'Suriname');
INSERT INTO `countries` VALUES (205, 'SJ', 'Svalbarn and Jan Mayen Islands');
INSERT INTO `countries` VALUES (206, 'SZ', 'Swaziland');
INSERT INTO `countries` VALUES (207, 'SE', 'Sweden');
INSERT INTO `countries` VALUES (208, 'CH', 'Switzerland');
INSERT INTO `countries` VALUES (209, 'SY', 'Syrian Arab Republic');
INSERT INTO `countries` VALUES (210, 'TW', 'Taiwan');
INSERT INTO `countries` VALUES (211, 'TJ', 'Tajikistan');
INSERT INTO `countries` VALUES (212, 'TZ', 'Tanzania, United Republic of');
INSERT INTO `countries` VALUES (213, 'TH', 'Thailand');
INSERT INTO `countries` VALUES (214, 'TG', 'Togo');
INSERT INTO `countries` VALUES (215, 'TK', 'Tokelau');
INSERT INTO `countries` VALUES (216, 'TO', 'Tonga');
INSERT INTO `countries` VALUES (217, 'TT', 'Trinidad and Tobago');
INSERT INTO `countries` VALUES (218, 'TN', 'Tunisia');
INSERT INTO `countries` VALUES (219, 'TR', 'Turkey');
INSERT INTO `countries` VALUES (220, 'TM', 'Turkmenistan');
INSERT INTO `countries` VALUES (221, 'TC', 'Turks and Caicos Islands');
INSERT INTO `countries` VALUES (222, 'TV', 'Tuvalu');
INSERT INTO `countries` VALUES (223, 'UG', 'Uganda');
INSERT INTO `countries` VALUES (224, 'UA', 'Ukraine');
INSERT INTO `countries` VALUES (225, 'AE', 'United Arab Emirates');
INSERT INTO `countries` VALUES (226, 'GB', 'United Kingdom');
INSERT INTO `countries` VALUES (227, 'UM', 'United States minor outlying islands');
INSERT INTO `countries` VALUES (228, 'UY', 'Uruguay');
INSERT INTO `countries` VALUES (229, 'UZ', 'Uzbekistan');
INSERT INTO `countries` VALUES (230, 'VU', 'Vanuatu');
INSERT INTO `countries` VALUES (231, 'VA', 'Vatican City State');
INSERT INTO `countries` VALUES (232, 'VE', 'Venezuela');
INSERT INTO `countries` VALUES (233, 'VN', 'Vietnam');
INSERT INTO `countries` VALUES (234, 'VG', 'Virgin Islands (British)');
INSERT INTO `countries` VALUES (235, 'VI', 'Virgin Islands (U.S.)');
INSERT INTO `countries` VALUES (236, 'WF', 'Wallis and Futuna Islands');
INSERT INTO `countries` VALUES (237, 'EH', 'Western Sahara');
INSERT INTO `countries` VALUES (238, 'YE', 'Yemen');
INSERT INTO `countries` VALUES (239, 'YU', 'Yugoslavia');
INSERT INTO `countries` VALUES (240, 'ZR', 'Zaire');
INSERT INTO `countries` VALUES (241, 'ZM', 'Zambia');
INSERT INTO `countries` VALUES (242, 'ZW', 'Zimbabwe');