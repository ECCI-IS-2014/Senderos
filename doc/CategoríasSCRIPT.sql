-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-11-2014 a las 17:13:19
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `blog_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `lft` int(10) unsigned DEFAULT NULL,
  `rght` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `lft`, `rght`) VALUES
(1, 'AcciÃ³n', NULL, 1, 2),
(2, 'Aventura', NULL, 5, 10),
(3, 'AcciÃ³n-Aventura', NULL, 3, 4),
(4, 'Aventura Conversacional', 2, 6, 7),
(5, 'Aventura GrÃ¡fica', 2, 8, 9),
(6, 'Carreras', NULL, 11, 16),
(7, 'Carreras de Combate', 6, 14, 15),
(8, 'Carreras Animadas', 6, 12, 13),
(9, 'ConstrucciÃ³n', NULL, 17, 28),
(10, 'ConstrucciÃ³n HistÃ³rica', 9, 18, 21),
(11, 'ConstrucciÃ³n TemÃ¡tica', 9, 22, 27),
(12, 'ConstrucciÃ³n Parques de Diversiones', 11, 23, 24),
(13, 'ConstrucciÃ³n Parques TemÃ¡ticos', 11, 25, 26),
(14, 'ConstrucciÃ³n de Ciudades', 10, 19, 20),
(15, 'Deportes', NULL, 29, 54),
(16, 'Acrobacias', 18, 51, 52),
(17, 'De Pelota', 24, 31, 42),
(18, 'Gimnasia', 15, 50, 53),
(19, 'Baseball', 17, 32, 33),
(20, 'Basketball', 17, 34, 35),
(21, 'Soccer', 17, 38, 39),
(22, 'Boliche', 17, 36, 37),
(23, 'Tennis', 17, 40, 41),
(24, 'A Campo Abierto', 15, 30, 43),
(25, 'De Mesa', 15, 44, 49),
(26, 'Ping Pong', 25, 47, 48),
(27, 'Ajedrez', 25, 45, 46);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
