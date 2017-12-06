-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2017 a las 15:27:00
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `banco`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(20) NOT NULL,
  `nombre` varchar(10) NOT NULL,
  `apellido` varchar(10) NOT NULL,
  `cedula` varchar(14) NOT NULL,
  `telefono` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `apellido`, `cedula`, `telefono`) VALUES
(147, 'Daniel', 'Zepeda', '1', '68157565'),
(224, 'Paola', 'Visuete', '2', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `id_cuenta` varchar(16) NOT NULL,
  `saldo` double NOT NULL,
  `id_cliente` int(20) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contrasena` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`id_cuenta`, `saldo`, `id_cliente`, `usuario`, `contrasena`) VALUES
('1234568212394321', 1133, 147, 'pringi', '123'),
('1234568446669871', 3961.1, 224, 'paoli', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deposito`
--

CREATE TABLE `deposito` (
  `id_trans` int(20) NOT NULL,
  `interes` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `deposito`
--

INSERT INTO `deposito` (`id_trans`, `interes`) VALUES
(38, 3.125),
(971, 4.0375),
(511, 12.5),
(582, 1.5375),
(283, 4.0125),
(271, 1.5375);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retiro`
--

CREATE TABLE `retiro` (
  `id_trans` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `retiro`
--

INSERT INTO `retiro` (`id_trans`) VALUES
(491);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion`
--

CREATE TABLE `transaccion` (
  `id_trans` int(20) NOT NULL,
  `monto` int(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_cuenta` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `transaccion`
--

INSERT INTO `transaccion` (`id_trans`, `monto`, `nombre`, `fecha`, `id_cuenta`) VALUES
(38, 253, 'Deposito', '2017-11-24 06:56:41', '1234568446669871'),
(271, 125, 'Deposito', '2017-11-24 08:07:08', '1234568446669871'),
(283, 325, 'Deposito', '2017-11-24 08:03:21', '1234568446669871'),
(458, 312, 'Transferencia', '2017-11-24 08:07:13', '1234568446669871'),
(491, 123, 'Retiro', '2017-11-24 06:57:30', '1234568446669871'),
(511, 1013, 'Deposito', '2017-11-24 06:57:24', '1234568446669871'),
(582, 125, 'Deposito', '2017-11-24 08:03:18', '1234568446669871'),
(971, 327, 'Deposito', '2017-11-24 06:56:45', '1234568446669871');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transferir`
--

CREATE TABLE `transferir` (
  `id_trans` int(20) NOT NULL,
  `num_cuenta` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `transferir`
--

INSERT INTO `transferir` (`id_trans`, `num_cuenta`) VALUES
(458, '123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`id_cuenta`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `deposito`
--
ALTER TABLE `deposito`
  ADD KEY `id_trans` (`id_trans`);

--
-- Indices de la tabla `retiro`
--
ALTER TABLE `retiro`
  ADD KEY `id_trans` (`id_trans`);

--
-- Indices de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD PRIMARY KEY (`id_trans`),
  ADD KEY `id_cuenta` (`id_cuenta`);

--
-- Indices de la tabla `transferir`
--
ALTER TABLE `transferir`
  ADD KEY `id_trans` (`id_trans`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `fk_cuenta_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `deposito`
--
ALTER TABLE `deposito`
  ADD CONSTRAINT `fk_deposito_id_trans` FOREIGN KEY (`id_trans`) REFERENCES `transaccion` (`id_trans`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `retiro`
--
ALTER TABLE `retiro`
  ADD CONSTRAINT `fk_retiro_id_trans` FOREIGN KEY (`id_trans`) REFERENCES `transaccion` (`id_trans`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `transferir`
--
ALTER TABLE `transferir`
  ADD CONSTRAINT `fk_transferir_id_trans` FOREIGN KEY (`id_trans`) REFERENCES `transaccion` (`id_trans`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
