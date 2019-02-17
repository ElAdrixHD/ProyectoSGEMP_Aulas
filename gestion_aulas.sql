-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-02-2019 a las 17:19:14
-- Versión del servidor: 10.3.12-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_aulas`
--
CREATE DATABASE IF NOT EXISTS `gestion_aulas` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gestion_aulas`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

DROP TABLE IF EXISTS `aula`;
CREATE TABLE `aula` (
  `id_aula` int(10) UNSIGNED NOT NULL,
  `nombre_aula` varchar(100) NOT NULL,
  `nombre_corto` varchar(5) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `tic` tinyint(1) NOT NULL DEFAULT 0,
  `numero_pcs` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `aula`
--

INSERT INTO `aula` (`id_aula`, `nombre_aula`, `nombre_corto`, `ubicacion`, `tic`, `numero_pcs`, `descripcion`) VALUES
(1, 'Informatica 1', 'INF1', 'Pasillo 3, Puerta 1', 1, 30, 'Aula de informatica'),
(2, 'Informatica 2', 'INF2', 'Pasillo 3, Puerta 2', 1, 30, 'Aula de informatica'),
(3, 'Estudio 1', 'EST1', 'Pasillo 2,Puerta 5', 0, 6, 'Sala de estudio'),
(4, 'Estudio 2', 'EST2', 'Pasillo 1, Puerta 7', 0, 10, 'Sala de estudio'),
(5, 'Estudio 3', 'EST3', 'Pasillo 3, Puerta 10', 0, 4, 'Sala de estudio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

DROP TABLE IF EXISTS `reserva`;
CREATE TABLE `reserva` (
  `id_reserva` bigint(20) NOT NULL,
  `fecha_reserva` date NOT NULL,
  `hora_reserva` varchar(100) NOT NULL,
  `id_aula` int(10) UNSIGNED NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id_reserva`, `fecha_reserva`, `hora_reserva`, `id_aula`, `id_usuario`, `descripcion`) VALUES
(8, '2019-02-16', '1º Hora', 1, 2, 'Un motivo'),
(5, '2019-02-17', '1º Hora', 3, 1, 'Mi MOtivjo'),
(6, '2019-02-18', '1º Hora', 1, 1, 'Clase de DEINT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` bigint(20) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `contrasenia` varchar(4092) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre_usuario`, `contrasenia`, `apellidos`, `nombre`, `fecha_nacimiento`, `email`) VALUES
(1, 'ElAdrixHD', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Muñoz Mudarrita', 'Manolo', '1980-02-06', 'adrianmmudarra@gmail.com'),
(2, 'adrisan', '7118c8baebed52f7dfc224f8803c5713d5d7a5ea', 'Muñoz Mudarra', 'Adrián', '1997-12-27', 'eladrixhd@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`id_aula`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`fecha_reserva`,`hora_reserva`,`id_aula`),
  ADD UNIQUE KEY `id_reserva` (`id_reserva`),
  ADD KEY `id_usuario` (`id_usuario`) USING BTREE,
  ADD KEY `reserva_ibfk_1` (`id_aula`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aula`
--
ALTER TABLE `aula`
  MODIFY `id_aula` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_aula`) REFERENCES `aula` (`id_aula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
