-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2018 a las 13:20:56
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
-- Base de datos: `epd6ej`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'nombre del usuario',
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'usuario de acceso al sistema',
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL COMMENT 'contraseña de acceso al sistema',
  `f_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'fecha de alta en el sistema'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `usuario`, `password`, `f_registro`) VALUES
('andres', 'and', '$2y$10$qL4tcvNzey8JcZHUHJsuneOvH9kvT8jbtDdcFhv1.hDlLYNVm1LQC', '2018-11-19 12:20:11'),
('vengador', 'german', 'finlandes', '2018-11-14 18:52:52'),
('racso', 'oscar', 'root', '2018-11-14 18:50:12'),
('prueba', 'prueba', 'prueba', '2018-11-04 23:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
