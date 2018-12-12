-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2018 a las 14:07:23
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `epd6p1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `nombre_ciudad` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`nombre_ciudad`) VALUES
('Almeria'),
('Cadiz'),
('Cordoba'),
('Granada'),
('Huelva'),
('Jaen'),
('Malaga'),
('Sevilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipo` int(10) NOT NULL,
  `nombre_equipo` varchar(50) CHARACTER SET utf16 COLLATE utf16_spanish_ci NOT NULL,
  `ciudad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `PJ` int(10) NOT NULL,
  `PG` int(10) NOT NULL,
  `PP` int(10) NOT NULL,
  `PF` int(10) NOT NULL,
  `PE` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_equipo`, `nombre_equipo`, `ciudad`, `PJ`, `PG`, `PP`, `PF`, `PE`) VALUES
(1, 'los mataos', 'Malaga', 0, 0, 0, 0, 0),
(3, 'los lokos', 'sevilla', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidos`
--

CREATE TABLE `partidos` (
  `local` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'nombre equipo local',
  `visitante` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'nombre equipo visitante',
  `puntosLocal` int(50) NOT NULL COMMENT 'puntos equipo local',
  `puntosVisitante` int(50) NOT NULL COMMENT 'puntos equipo visitante'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `partidos`
--

INSERT INTO `partidos` (`local`, `visitante`, `puntosLocal`, `puntosVisitante`) VALUES
('A', 'B', 1, 1),
('B', 'A', 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`nombre_ciudad`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipo`);

--
-- Indices de la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD PRIMARY KEY (`local`,`visitante`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
