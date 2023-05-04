--
-- Base de datos: `juegos_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plataformas`
--

DROP TABLE IF EXISTS `plataformas`;
CREATE TABLE IF NOT EXISTS `plataformas` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nombre` varchar(45) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `plataformas`
--

INSERT INTO `plataformas` (`id`, `nombre`) VALUES
(2, 'PS5'),
(3, 'PS4'),
(4, 'PS3'),
(5, 'PS2'),
(6, 'PS1'),
(7, 'PSP'),
(8, 'PSVita'),
(9, 'Nintendo Switch'),
(10, 'Wii U'),
(11, 'Wii'),
(12, 'Nintendo 3DS'),
(13, 'Nintendo DS'),
(14, 'Gamecube'),
(15, 'Nintendo 64'),
(16, 'SNES'),
(17, 'NES'),
(18, 'Xbox One'),
(19, 'Xbox series'),
(20, 'Xbox 360'),
(21, 'Xbox'),
(22, 'Atari 2000'),
(23, 'PC');