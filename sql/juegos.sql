-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-04-2023 a las 02:30:42
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_php`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `id` int auto_increment primary key,
  `nombre` varchar(255) NOT NULL,
  `imagen` text NOT NULL,
  `tipo_imagen` varchar(10) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `url` varchar(80) NOT NULL,
  `id_genero` int(11) NOT NULL,
  `id_plataforma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`id`, `nombre`, `imagen`, `tipo_imagen`, `descripcion`, `url`, `id_genero`, `id_plataforma`) VALUES
(1, 'Holaa', '', '.jpg', 'Es un saludo', 'https://hola.com', 13, 16),
(2, 'Mario Odyssey', 'sandro-botticelli-carte-de-lenfer.jpeg', '.jpg', 'Super Mario Odyssey es un videojuego de plataformas en tres dimensiones para Nintendo Switch desarrollado y publicado por Nintendo que se lanzó el 27 de octubre de 2017.', 'https://www.nintendo.com/es-ar/store/products/super-mario-odyssey-switch/', 56, 9);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_genero_idx` (`id_genero`),
  ADD KEY `fk_plataforma_idx` (`id_plataforma`);

ALTER TABLE `juegos`
  ADD CONSTRAINT `fk_genero` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_plataforma` FOREIGN KEY (`id_plataforma`) REFERENCES `plataformas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
