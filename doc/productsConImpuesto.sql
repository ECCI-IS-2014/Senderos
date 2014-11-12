-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2014 a las 17:25:18
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `platform_id` int(10) unsigned NOT NULL,
  `release_year` year(4) NOT NULL,
  `price` double unsigned NOT NULL,
  `description` text NOT NULL,
  `presentation` int(10) unsigned NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `requirement` text,
  `rated` int(10) unsigned DEFAULT NULL,
  `discount` int(10) unsigned DEFAULT NULL,
  `rating` double unsigned DEFAULT NULL,
  `outofstock` tinyint(1) NOT NULL DEFAULT '0',
  `image` text,
  `video` text,
  `tax` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `platform_id`, `release_year`, `price`, `description`, `presentation`, `enabled`, `requirement`, `rated`, `discount`, `rating`, `outofstock`, `image`, `video`, `tax`) VALUES
(1, 'MW3', 11, 1970, 40, 'First Person Shooter', 0, 1, 'CPU: Intel Core 2 Duo E6600 or AMD Phenom X3 8750 processor or better.   \r\nRAM: 2 GB    \r\nOS: Windows XP/ Windows Vista / Windows 7   \r\nVideo Card: Shader 3.0 or better 256 MB NVIDIA GeForce 8600GT / ATI Radeon X1950 or better   \r\nSound Card: Yes   \r\nFree Disk Space:16 GB ', 4, 20, NULL, 0, NULL, 'http://www.youtube.com/watch?v=QhS188zA8Ng', 13),
(2, 'advanced Warfare', 4, 2014, 60, 'First Person SHooter', 0, 1, 'Ninguno', 4, 0, NULL, 0, NULL, '', 13);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
