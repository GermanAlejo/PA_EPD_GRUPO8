-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2018 a las 13:11:26
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `epd6p3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficheros`
--

CREATE TABLE `ficheros` (
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'nombre completo del fichero',
  `f_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de alta en el sistema',
  `titulo` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'titulo del fichero por parte del usuario',
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'nombre del usuario',
  `hash` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'hash'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ficheros`
--

INSERT INTO `ficheros` (`nombre`, `f_registro`, `titulo`, `usuario`, `hash`) VALUES
('epd05.pdf', '2018-11-15 18:05:02', 'EPD 5', 'Oscar', 'bad11e836928bea55853f66ef1de4001'),
('epd06.pdf', '2018-11-15 18:05:02', 'EPD6', 'Oscar', '494d7bee5f272dc84c2f27992f81812d'),
('EPD2-bastionado-windows(2).pdf', '2018-11-19 10:42:54', 'e', 'Oscar', '696324643c2c4be051b817b0634d6441'),
('EPD3-bastionado-Linux_ubuntu.pdf', '2018-11-19 09:53:22', 'epd3l\r\n', 'Oscar', '21d11a8c90d29df27560391af301e78f'),
('EPD5-registros-monitorizacion-estado-PROFESOR.pdf', '2018-11-19 10:20:04', 'epd5', 'Oscar', 'f9e25b1efcf81a541102834df61455e0'),
('examen_epd_ene_2017.pdf', '2018-11-19 09:49:27', 'examen', 'Oscar', 'd8018fc9d10866003fad4a5757f787bd'),
('TEMA 4.pdf', '2018-11-15 18:05:42', 'temaTemita', 'Oscar', 'b974df57d570250a62acf35481d7f9eb');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'nombre de usuario del sistema',
  `password` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'clave de usuario',
  `correo` varchar(150) COLLATE utf8_spanish_ci NOT NULL COMMENT 'correo del usuario',
  `universidad` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'universidad del usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `password`, `correo`, `universidad`) VALUES
('Carlos', '1234', 'cc@cc.ddd', 'Universidad de Clase'),
('German', '1234', 'bb@bb.com', 'Universidad Pablo de Olavide'),
('Oscar', '1234', 'a@a.com', 'Universidad de Sevilla');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ficheros`
--
ALTER TABLE `ficheros`
  ADD PRIMARY KEY (`nombre`,`usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`),
  ADD UNIQUE KEY `indiceCorreo` (`correo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
