-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-01-2017 a las 12:10:14
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(1000) NOT NULL,
  `acronimo` varchar(500) DEFAULT NULL,
  `email` varchar(1000) NOT NULL,
  `clave` varchar(1000) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `fecha_conexion` datetime DEFAULT NULL,
  `bloqueo` tinyint(1) NOT NULL,
  `usuario_tipo_id` int(11) NOT NULL,
  `confirmar_email` tinyint(1) NOT NULL,
  `confirmar_url` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `acronimo`, `email`, `clave`, `fecha_creacion`, `fecha_modificacion`, `fecha_conexion`, `bloqueo`, `usuario_tipo_id`, `confirmar_email`, `confirmar_url`) VALUES
(1, 'DORIAN GONZALEZ', 'dorian', 'doriandarren1@gmail.com', 'bG90ZXJpYTY2ODQ=', '2016-01-31 00:00:00', NULL, '2016-09-18 13:23:28', 0, 1, 0, NULL),
(2, 'MILENA AGUILAR', 'milena', 'darimile@gmail.com', 'MTUzMjU4OTk=', '2016-02-13 00:00:00', NULL, '2016-03-16 09:56:05', 0, 1, 0, NULL),
(3, 'JEAN CARLOS REYES', 'jacoreyes', 'jcprogramador2016@gmail.com', 'MTIzNDU2', '2016-08-07 00:00:00', NULL, '2016-08-22 09:41:54', 0, 3, 0, NULL),
(5, 'ALIAS', 'alias', 'alias@gmail.com', 'MTIzNA==', '2016-08-08 00:00:00', NULL, '2016-08-21 11:13:27', 0, 3, 0, NULL),
(6, 'EROS ELIOS', 'eros', 'eros@hotmail.com', 'MTIzNA==', '2016-08-02 00:00:00', NULL, NULL, 1, 2, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_tipos`
--

CREATE TABLE `usuarios_tipos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios_tipos`
--

INSERT INTO `usuarios_tipos` (`id`, `descripcion`, `estatus`) VALUES
(1, 'ROOT', 1),
(2, 'ADMINISTRADOR', 1),
(3, 'USUARIO', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_tipos`
--
ALTER TABLE `usuarios_tipos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `usuarios_tipos`
--
ALTER TABLE `usuarios_tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
