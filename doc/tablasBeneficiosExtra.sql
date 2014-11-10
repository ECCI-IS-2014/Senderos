CREATE TABLE IF NOT EXISTS `benefits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `discount` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `benefits`
--

INSERT INTO `benefits` (`id`, `name`, `discount`) VALUES
(1, 'Cliente VIP', 15),
(2, 'Adulto Mayor', 15)


CREATE TABLE IF NOT EXISTS `benefits_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `benefit_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
)