-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-09-2022 a las 06:10:05
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trabajo1dw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla1`
--

CREATE TABLE `tabla1` (
  `ID` int(15) NOT NULL,
  `Nombre` varchar(20) DEFAULT NULL,
  `Apellido` varchar(20) DEFAULT NULL,
  `Sexo` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tabla1`
--

INSERT INTO `tabla1` (`ID`, `Nombre`, `Apellido`, `Sexo`) VALUES
(3, 'Jhon', 'Connor', 'masculino'),
(4, 'Mai', 'Sakura', 'Femenino'),
(5, 'Daniel', 'Thunder', 'Masculino'),
(35, 'Merry', 'Christmast', 'Femenino'),
(36, 'Peter', 'Parker', 'masculino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla2`
--

CREATE TABLE `tabla2` (
  `ID` int(15) NOT NULL,
  `Departamento` varchar(20) DEFAULT NULL,
  `Ciudad` varchar(20) DEFAULT NULL,
  `Fecha_ped` datetime DEFAULT NULL,
  `Fecha_Nac` date DEFAULT NULL,
  `Valor` int(20) DEFAULT NULL,
  `Cantidad_prod` float DEFAULT NULL,
  `Email` varchar(20) DEFAULT NULL,
  `FK_TABLA1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tabla2`
--

INSERT INTO `tabla2` (`ID`, `Departamento`, `Ciudad`, `Fecha_ped`, `Fecha_Nac`, `Valor`, `Cantidad_prod`, `Email`, `FK_TABLA1`) VALUES
(15, 'Sucre', 'Sincelejo', '2022-07-20 07:26:13', '2022-09-26', 234700, 3, 'merry@gmail.com', 35),
(16, 'Cordoba', 'Monteria', '2022-07-29 08:26:22', '1998-08-24', 312000, 2, 'correo', 36),
(17, 'Bolivar', 'Cartagena', '2022-06-30 10:25:17', '1997-05-27', 432000, 4, 'Elcorreo', 5),
(18, 'Valle del cauca', 'Cali', '2022-07-12 07:31:18', '1995-07-16', 734000, 5, 'CORREOOO', 4),
(19, 'Antioquia', 'Medellin', '2022-05-24 16:20:25', '1994-06-18', 598000, 5, 'Correo.correo', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tabla1`
--
ALTER TABLE `tabla1`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tabla2`
--
ALTER TABLE `tabla2`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_TABLA1` (`FK_TABLA1`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tabla1`
--
ALTER TABLE `tabla1`
  MODIFY `ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `tabla2`
--
ALTER TABLE `tabla2`
  MODIFY `ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tabla2`
--
ALTER TABLE `tabla2`
  ADD CONSTRAINT `tabla2_ibfk_1` FOREIGN KEY (`FK_TABLA1`) REFERENCES `tabla1` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
